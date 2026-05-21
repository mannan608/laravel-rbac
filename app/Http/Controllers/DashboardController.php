<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'users' => User::count(),
            'roles' => Role::count(),
            'permissions' => Permission::count(),
            'products' => Product::count(),
        ]);
    }
}