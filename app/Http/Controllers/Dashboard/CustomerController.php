<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    // Home
    public function index(Request $request)
    {
        return view('view.dashboard.customer.index');
    }
}
