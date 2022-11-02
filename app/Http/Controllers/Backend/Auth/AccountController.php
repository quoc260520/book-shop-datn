<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Mail\ForgotPasswordMail;
use App\Models\Cart;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class AccountController extends Controller
{
    public function forgotPassword()
    {
        return view('layout.forgot_password');
    }

    public function resetPassword()
    {
        return view('layout.reset_password');
    }

    public function sendMailForgotPassword(Request $request)
    {
        try {
            $email = $request->email;
            $token = Str::random(20);
            PasswordReset::insert([
                'email' => $email,
                'token' => $token,
                'created_at' => now(),
            ]);
            Mail::to($email)->send(new ForgotPasswordMail($token));
            return back()->withFlashSuccess('Gửi mail thành công. Vui lòng kiểm tra email và làm theo hướng dẫn');
        } catch (\Exception $e) {
            Log::channel('daily')->error($e->getMessage());
            return back()->withFlashDanger('Đã có lỗi xảy ra, vui lòng thủ lại sau');
        }
    }

    public function register(RegisterRequest $request)
    {
        $email = $request->email_register;
        $password = $request->password_register;
        try {
            DB::beginTransaction();
            $user = User::create([
                'uuid' => Uuid::uuid4()->toString(),
                'user_name' => Str::random(6),
                'email' => $email,
                'password' => Hash::make($password),
                'active' => User::ACTIVE,
            ]);

            $user->assignRole(config('access.role.default_role'));

            $cart = Cart::create([
                'user_id' => $user->id,
            ]);
            DB::commit();

            Log::info('Create user success: ' . $user->id);
            return back()->withFlashSuccess('Đăng ký thành cồng. Vui lòng đăng nhập');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::channel('daily')->error($e->getMessage());

            return back()->withFlashDanger('Đã có lỗi xảy ra, vui lòng thủ lại sau');
        }
    }
}
