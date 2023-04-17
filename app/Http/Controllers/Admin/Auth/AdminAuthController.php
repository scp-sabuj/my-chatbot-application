<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AdminAuthController extends Controller
{
    public function admin_role()
    {
        if (Auth::guard('admin')->user()->role_id == 1) {
            return 'superadmin';
        }elseif (Auth::guard('admin')->user()->role_id == 2) {
            return 'admin';
        }elseif (Auth::guard('admin')->user()->role_id == 3) {
            return 'seller';
        }
    }
}
