<?php

namespace Yajra\CMS\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\CMS\Http\LogoutGuard;

class AuthController extends Controller
{
    use AuthenticatesUsers, LogoutGuard {
        LogoutGuard::logout insteadof AuthenticatesUsers;
    }

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectPath = '/administrator';

    /**
     * Authentication guard.
     *
     * @var string
     */
    protected $guard = 'administrator';

    /**
     * Administrator login view.
     *
     * @var string
     */
    protected $loginView = 'administrator.auth.login';

    /**
     * Where to redirect users after logout.
     *
     * @var string
     */
    protected $redirectAfterLogout = '/administrator';

    /**
     * Create a new authentication controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view($this->loginView);
    }

    /**
     * Handle event when the user was authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @param mixed                    $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authenticated(Request $request, $user)
    {
        if ($user->is_blocked || ! $user->is_activated) {
            if ($user->is_blocked) {
                $message = 'Your account is currently banned from accessing the site!';
            } else {
                $message = 'Your account is not yet activated!';
            }
            $this->guard()->logout();
            flash()->error($message);

            return redirect()->route('administrator.login')->withErrors($message);
        }

        return redirect()->intended($this->redirectPath);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard($this->guard);
    }

    /**
     * Get the path that we should redirect once logged out.
     * Adaptable to user needs.
     *
     * @return string
     */
    public function logoutToPath()
    {
        return config('site.admin_logout_redirect', $this->redirectAfterLogout);
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        $options = config('site.login.backend.options', [
            'is_admin' => true,
        ]);

        return array_merge($request->only($this->username(), 'password'), $options);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return config('site.login.backend.username', 'email');
    }
}
