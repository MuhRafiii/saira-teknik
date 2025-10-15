<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SalesReportController extends Controller
{
    public function index(Request $request)
    {
        // Default tanggal hari ini
        $startDate = $request->start_date ?? Carbon::today()->toDateString();
        $endDate = $request->end_date ?? Carbon::today()->toDateString();

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

        // Filter berdasarkan tanggal (selalu terisi karena sudah ada default)
        $query->whereBetween('created_at', [$startDate, $endDate]);

        $items = $query->get();
        $totalIncome = $items->sum('total_sales');

        // Format tanggal Indonesia untuk tampilan
        $startDateFormatted = Carbon::parse($startDate)->locale('id')->translatedFormat('d/m/Y');
        $endDateFormatted = Carbon::parse($endDate)->locale('id')->translatedFormat('d/m/Y');

        return view('admin.sales-report', compact(
            'items',
            'startDate',
            'endDate',
            'startDateFormatted',
            'endDateFormatted',
            'totalIncome'
        ));
    }

    public function exportExcel(Request $request)
    {
        $fileName = 'sales_report_' . now()->format('Y-m-d_His') . '.xlsx';

        return Excel::download(
            new \App\Exports\SalesReportExport($request->start_date ?? Carbon::today()->toDateString(), $request->end_date ?? Carbon::today()->toDateString()),
            $fileName
        );
    }

    public function exportPdf(Request $request)
    {
        $startDate = $request->start_date ?? Carbon::today()->toDateString();
        $endDate = $request->end_date ?? Carbon::today()->toDateString();

        $items = OrderItem::select(
                'product_id',
                DB::raw('SUM(quantity) as total_quantity'),
                DB::raw('SUM(price * quantity) as total_sales'),
                DB::raw('MAX(price) as price')
            )
            ->whereHas('order', function ($q) {
                $q->where('status', 'completed');
            })
            ->with('product')
            ->groupBy('product_id')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        $totalIncome = $items->sum('total_sales');

        $startDateFormatted = Carbon::parse($startDate)->locale('id')->translatedFormat('d/m/Y');
        $endDateFormatted = Carbon::parse($endDate)->locale('id')->translatedFormat('d/m/Y');

        $pdf = Pdf::loadView('admin.sales-report-pdf', [
            'items' => $items,
            'startDateFormatted' => $startDateFormatted,
            'endDateFormatted' => $endDateFormatted,
            'totalIncome' => $totalIncome,
        ])->setPaper('a4', 'portrait');

        return $pdf->download('sales_report_' . now()->format('Y-m-d_His') . '.pdf');
    }
}
