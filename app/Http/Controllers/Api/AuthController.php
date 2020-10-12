<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ApiAuthenticationException;
use App\Exceptions\ApiNotFoundHttpException;
use App\Http\Requests\SetupEmpire;
use App\Http\Resources\RulerResource;
use App\Models\Planet;
use App\Models\Ruler;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends ApiController
{
    use SendsPasswordResetEmails;

    /**
     * Get a JWT via given credentials.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws ApiAuthenticationException
     */
    public function loginWithPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = Ruler::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw new ApiAuthenticationException('Incorrect login details');
        }

        return $user->createToken($request->device_name)->plainTextToken;
    }

    /**
     * Get the authenticated User.
     *
     * @return JsonResource
     */
    public function me()
    {
        $user = auth()->user();
        $user['planet_count'] = $user->planets()->count();
        $user['fleet_count'] = $user->fleets()->count();

        return new RulerResource($user);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }


    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @param bool $withPrompt
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function redirectToGoogle()
    {
        $with = [
            'access_type' => 'offline',
            // 'prompt' => 'consent select_account',
        ];

        /** @var \Symfony\Component\HttpFoundation\RedirectResponse $response */
        $response = Socialite::driver('google')
            ->with($with)
            ->stateless()
            ->redirect();

        return response()->json(['redirect' => $response->getTargetUrl()], 200);
    }

    /**
     * Obtain the user information from Google.
     *
     * @throws ApiAuthenticationException
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function loginWithGoogle(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')
                ->stateless()
                ->user();

            $ruler = Ruler::firstOrCreate([
                'email' => $googleUser->email,
            ], [
                'name' => $googleUser->name,
            ]);

            $ruler->social_provider = 'Google';
            $ruler->social_token = $googleUser->token;
            $ruler->social_refresh_token = $googleUser->refreshToken;
            $ruler->social_expires_at = Carbon::now()->addSeconds($googleUser->expiresIn);
            $ruler->social_avatar = $googleUser->avatar;
            $ruler->save();
        } catch (\Exception $e) {
            throw new ApiAuthenticationException($e->getMessage());
        }

        return $ruler->createToken($request->device_name)->plainTextToken;
    }

    /**
     * @param SetupEmpire $request
     *
     * @throws ApiNotFoundHttpException
     */
    public function setupEmpire(SetupEmpire $request)
    {
        /**
         * @var Planet
         */
        $home_planet = Planet::homePlanets()->unpopulated()->first();
        if (!$home_planet) {
            throw new ApiNotFoundHttpException('Sorry there are no home planets left!');
        }

        $home_planet->name = $request->input('home_planet_name');
        $home_planet->ruler_id = auth()->user()->id;
        $home_planet->save();
        $home_planet->populateStartingBuildings();

        $ruler = auth()->user();
        $ruler->name = $request->input('ruler_name');
        $ruler->save();
    }
}
