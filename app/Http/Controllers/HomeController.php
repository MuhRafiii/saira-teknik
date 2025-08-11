<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $company = CompanyProfile::first();
        $products = Product::all()->take(6);
        return view('home', compact('company', 'products'));
    }
}
