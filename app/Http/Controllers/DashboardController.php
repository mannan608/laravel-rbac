<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:dashboard.viewAny'),
        ];
    }

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
