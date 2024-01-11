<?php

namespace App\Http\Controllers\Dashboard\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Dashboard\Auth\UserAuth;
use App\Models\Customer\User;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function user()
    {
        return User::getModel();
    }

    public $guard = 'customer';

    public $redirectOnLogin = 'customer.home';
    public $redirectOnLogout = 'customer.home';

    use UserAuth;
}
