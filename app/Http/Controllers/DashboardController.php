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
            new Middleware('permission:dashboard.viewAny|dashboard.view'),
        ];
    }

    public function index()
    {
        $user = request()->user();
        $canViewAll = $user->can('dashboard.viewAny');

        return view('dashboard.index', [
            'canViewAll' => $canViewAll,
            'users' => $canViewAll ? User::count() : 1,
            'roles' => $canViewAll ? Role::count() : $user->roles()->count(),
            'permissions' => $canViewAll ? Permission::count() : $user->getAllPermissions()->count(),
            'products' => $canViewAll ? Product::count() : Product::whereBelongsTo($user)->count(),
        ]);
    }
}
