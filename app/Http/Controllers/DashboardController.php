<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalUsers = User::count();

        $totalCustomers = Customer::count();

        $totalProducts = Product::count();

        $stockValue = Product::query()
            ->selectRaw(
                'COALESCE(SUM(price * quantity), 0) AS total'
            )
            ->value('total');

        $recentUsers = User::query()
            ->latest()
            ->take(5)
            ->get();

        $recentProducts = Product::query()
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalUsers',
            'totalCustomers',
            'totalProducts',
            'stockValue',
            'recentUsers',
            'recentProducts'
        ));
    }
}
