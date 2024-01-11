<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index(Request $request)
    {
        return view('view.dashboard.index');
    }

    // Mgmt

    public function showLoginMgmt(Request $request)
    {
        return view('view.dashboard.auth.login')->with([
            'info' => 'Management Login',
            'postURL' => route('mgmt.login'),
        ]);
    }

    public function showRegisterMgmt(Request $request)
    {
        return view('view.dashboard.auth.register');
    }

    // Customer

    public function showLoginCustomer(Request $request)
    {
        return view('view.dashboard.auth.login')->with([
            'info' => 'Customer Login',
            'postURL' => route('customer.login'),
        ]);
    }
    public function showRegisterCustomer(Request $request)
    {
        return view('view.dashboard.auth.register');
    }
}
