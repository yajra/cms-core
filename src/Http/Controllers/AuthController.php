<?php

namespace Yajra\CMS\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use AuthenticatesUsers;

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
    protected $loginView = 'admin::auth.login';

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
     * @param \App\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authenticated(Request $request, User $user)
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
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect(config('site.admin_logout_redirect', $this->redirectAfterLogout));
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
}
