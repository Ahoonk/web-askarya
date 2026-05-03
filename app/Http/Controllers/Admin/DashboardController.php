<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Product;
use App\Models\SiteSetting;

class DashboardController extends Controller
{
    public function index()
    {
        $setting = SiteSetting::query()->first() ?? new SiteSetting([
            'company_name' => config('app.name'),
        ]);

        return view('admin.dashboard', [
            'setting' => $setting,
            'clientCount' => Client::count(),
            'productCount' => Product::count(),
        ]);
    }
}
