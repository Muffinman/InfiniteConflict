<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Web\WebController;
use App\Ruler;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Validator;

class AuthController extends WebController
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Redirect the user to the Google authentication page.
     *
     * @return Response
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->scopes(['profile', 'email'])->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return Response
     */
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        if ($ruler = Ruler::updateOrCreate(['email' => $user->getEmail()], [
            'name' => $user->getEmail(),
            'social_avatar' => $user->getAvatar(),
            'social_provider' => 'google',
            'social_token' => $user->token,
            'social_refresh_token' => $user->refreshToken,
            'social_expires_at' => time() + $user->expiresIn,
        ])) {
            auth('web')->loginUsingId($ruler->id, true);

            return redirect('/');
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => 'required|max:255',
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return Ruler
     */
    protected function create(array $data)
    {
        return Ruler::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
