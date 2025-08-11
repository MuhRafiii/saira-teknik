<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class SalesReportController extends Controller
{
    public function salesReport()
    {
        $sales = Order::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(total) as total_sales')
            ->where('status', 'completed')
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->get();

        return view('admin.sales-report', compact('sales'));
    }
}
