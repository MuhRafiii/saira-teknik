<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SalesReportExport implements FromView
{
    protected $month;

    public function __construct($month)
    {
        $this->month = $month;
    }

    public function view(): View
    {
        $orders = Order::where('status', 'completed')
            ->whereMonth('created_at', $this->month)
            ->get();

        return view('exports.sales-excel', compact('orders'));
    }
}
