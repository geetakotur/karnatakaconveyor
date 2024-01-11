<?php

namespace App\Http\Controllers\Dashboard\Mgmt\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

use App\Models\Mgmt\User;
use App\Http\Controllers\Controller;

class AccountController extends Controller{

    // Home
    public function index(Request $request)
    {
        return view('view.dashboard.mgmt.account.index');
    }
}
