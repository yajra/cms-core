<?php

namespace Yajra\CMS\Http\Controllers;

use App\User;
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
     * Username to use for login.
     *
     * @var string
     */
    protected $username = 'username';

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
        if ($user->blocked || ! $user->confirmed) {
            if ($user->blocked) {
                $message = 'Your account is currently banned from accessing the site!';
            } else {
                $message = 'Your account is not yet activated!';
            }
            auth($this->getGuard())->logout();
            flash()->error($message);

            return redirect()->to('administrator/login')->withErrors($message);
        }

        return redirect()->intended($this->redirectPath);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return config('site.login.backend.username', $this->username);
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
            'administrator' => true,
        ]);

        return array_merge($request->only($this->username(), 'password'), $options);
    }

    /**
     * Get auth guard.
     *
     * @return string
     */
    protected function getGuard()
    {
        return $this->guard;
    }
}
