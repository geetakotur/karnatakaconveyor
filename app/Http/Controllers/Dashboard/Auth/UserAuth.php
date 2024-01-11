<?php

namespace App\Http\Controllers\Dashboard\Auth;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

trait UserAuth{

    /**
     * Protected username
     */
    protected $username = '';

    protected $maxAttempts = 5;
    protected $decayMinutes = 5;

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        // dd(Auth::guard());
        return Auth::guard($this->guard);
    }


    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();
        // $request->session()->invalidate();
        // dd('logout');

        return redirect()->route($this->redirectOnLogoutPath());
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        //Log::debug('++++++++++++++++++++++++++++++++++++++++++++');

        // dd('login');

        $validData = $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);
        // dd($validData);
        $this->username = $validData['username'];

        $remember = false;
        if(isset($validData['remember']) && $validData['remember'])
            $remember = $validData['remember'];

        $validData['remember'] = $remember;

        // Attempt Login
        if ($this->attemptLogin($request, $validData)) {
            // Success
            return $this->sendLoginResponse($request);
        }

        // Unsuccessful
        return $this->sendFailedLoginResponse($request);
     }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Array of valid creds
     * @return bool
     */
    protected function attemptLogin(Request $request, $validData)
    {
        // dd($validData);

        if(sizeof($this->user()->where('username', $validData['username'])->get()) <= 0){
            // dd('invalid Username');
            return $this->sendFailedLoginResponse($request);
        }

        // dd($validData);

        if(Auth::guard($this->guard)->attempt(
            ['username' => $validData['username'], 'password' => $validData['password']], $validData['remember']
        )){
            // dd("LOGIN SUCCESS");
            // Success
            // dd($this->tokenGenerated);
            $this->authenticated($request, Auth::user());
            return $this->sendLoginResponse($request);
        }

        // dd("LOGIN FAILED");
        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return [
            $this->username() => $request->get($this->username()),
            'password' => $request->password,
        ];

        //Log::debug('creds.username: ' . $this->username());
        return $request->only($request->get($this->username()), 'password');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return $this->username;
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {

    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        // dd("success login");

        $request->session()->regenerate();
        // $this->clearLoginAttempts($request);

        return redirect()->route($this->redirectOnLoginPath());
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        //
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        // dd('login Failed');

        // Log::error('ERROR Failed to login for ' . $request->input('login'));
        return redirect()
                ->back()
                ->withInput($request->only($this->username()))
                ->withErrors([
                    'extra'=>'Invalid Username / Password'
                ]);
        /*
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
            'extra'=>'Invalid Username / Password',
        ]);
        */
    }

    /**
     * The user has logged out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function loggedOut(Request $request)
    {
        //
    }

    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectOnLoginPath()
    {
        if (method_exists($this, 'redirectOnLogin')) {
            return $this->redirectOnLogin();
        }

        return property_exists($this, 'redirectOnLogin') ? $this->redirectOnLogin : '/home';
    }

    /**
     * Get on logout redirect path.
     *
     * @return string
     */
    public function redirectOnLogoutPath()
    {
        if (method_exists($this, 'redirectOnLogout')) {
            return $this->redirectOnLogout();
        }

        return property_exists($this, 'redirectOnLogout') ? $this->redirectOnLogout : '/';
    }
}
?>
