<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\Socialite as SocialiteModel;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function showLoginForm() {
        return view('layout.login');
    }

    public function username()
    {
        return config('access.user_name');
    }

    public function redirectPath()
    {
        $user = Auth::user();
        if ($user->isAdmin() || $user->isStaff()) {
            return route('admin.dashboard');
        }
        return route('index');
    }

    public function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string|email',
            'password' => 'required|string|min:8',
        ]);
    }

    public function authenticated(Request $request,User $user)
    {
        if ($user->active != User::ACTIVE){
            $this->guard()->logout();

            $request->session()->invalidate();
    
            $request->session()->regenerateToken();
            throw ValidationException::withMessages([
                $this->username() => 'Tài khoản đã bị khóa, vui lòng liên hệ quản trị viên để biết thêm chi tiết',
            ]);
            return back();
        }

        $this->redirectPath();
    }

    public function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => __('message.login.login_failed'),
        ]);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect(route('login'));
    }

    public function googleLogin(Request $request)
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback(Request $request)
    {
        $userSocialite = Socialite::driver('google')
            ->stateless()
            ->user();
        try {
            DB::beginTransaction();
            $socialFlag = SocialiteModel::where('user_socialite_id', $userSocialite->id)
                ->where('user_socialites', SocialiteModel::GOOGLE_SOCIALATION)
                ->first();
            $user = User::firstOrCreate(
                [
                    'email' => $userSocialite->email,
                ],
                [
                    'uuid' => Uuid::uuid4()->toString(),
                    'first_name' => $userSocialite->user['family_name'],
                    'last_name' => $userSocialite->user['given_name'],
                    'user_name' => Str::random(6),
                    'password' => Hash::make(User::DEFAULT_PASSWORD),
                    'active' => User::ACTIVE,
                ],
            );

            if (!$socialFlag) {
                $user->assignRole(config('access.role.default_role'));

                $cart = Cart::create([
                    'user_id' => $user->id,
                ]);

                SocialiteModel::firstOrCreate([
                    'user_id' => $user->id,
                    'user_socialite_id' => $userSocialite->id,
                    'user_socialites' => SocialiteModel::GOOGLE_SOCIALATION,
                    'avatar' => $userSocialite->user['picture'],
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            Log::channel('daily')->error('Login google fail:' . $e->getMessage());
            return redirect()->route('login');
        }
        
        auth()->login($user, true);
        return $this->sendLoginResponse($request);
    }
    public function driveCallback(Request $request) {
    }
    
}
