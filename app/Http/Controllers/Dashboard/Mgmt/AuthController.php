<?php

namespace App\Http\Controllers\Dashboard\Mgmt;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Dashboard\Auth\UserAuth;
use App\Models\Mgmt\User;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function user()
    {
        return User::getModel();
    }

    public $guard = 'mgmt';

    public $redirectOnLogin = 'mgmt.home';
    public $redirectOnLogout = 'mgmt.home';

    use UserAuth;
}
