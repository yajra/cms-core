<?php

namespace Yajra\CMS\Http\Controllers;

use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use AuthenticatesUsers, ThrottlesLogins;

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
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
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
            $request->user($this->getGuard())->logout();
            if ($user->blocked) {
                $message = 'Your account is currently banned from accessing the site!';
            } else {
                $message = 'Your account is not yet activated!';
            }
            flash()->error($message);

            return redirect()->to('administrator/login');
        }

        return redirect()->intended($this->redirectPath);
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    protected function getCredentials(Request $request)
    {
        return array_merge($request->only($this->loginUsername(), 'password'), [
            'administrator' => true,
        ]);
    }
}
