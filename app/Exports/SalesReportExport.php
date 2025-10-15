<?php

namespace App\Exports;

use App\Models\OrderItem;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class SalesReportExport implements FromCollection, WithHeadings
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        $query = OrderItem::select(
                'product_id',
                DB::raw('SUM(quantity) as total_quantity'),
                DB::raw('SUM(price * quantity) as total_sales'),
                DB::raw('MAX(price) as price')
            )
            ->whereHas('order', function ($q) {
                $q->where('status', 'completed');
            })
            ->with('product')
            ->groupBy('product_id');

        if ($this->startDate && $this->endDate) {
            $query->whereBetween('created_at', [$this->startDate, $this->endDate]);
        }

        return $query->get()->map(function ($item, $index) {
            return [
                'No' => $index + 1,
                'Name' => $item->product->name ?? '-',
                'Price' => $item->price,
                'Quantity' => $item->total_quantity,
                'Total' => $item->total_sales,
            ];
        });
    }

    public function headings(): array
    {
        return ['No', 'Name', 'Price', 'Quantity', 'Total'];
    }
}
