<?php

namespace App\Http\Controllers\Dashboard\Customer\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

use App\Models\Customer\User;
use App\Http\Controllers\Controller;

class AccountController extends Controller{

    // Home
    public function index(Request $request)
    {
        return view('view.dashboard.customer.account.index');
    }
}
