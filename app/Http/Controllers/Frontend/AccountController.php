<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ChangePasswordRequest;
use App\Http\Requests\Frontend\UpdateAccountRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AccountController extends Controller
{
    public function showInfo(Request $request, $id)
    {
        return view('frontend.account.includes._info');
    }

    public function updateAccount(UpdateAccountRequest $request)
    {
        $allowFileExtension = ['jpg', 'png', 'jpeg'];
        $file = $request->avatar;
        $account = User::where('id', $request->id);
        if (!count($account->get())) {
            return redirect(route('logout'));
        }
        $dataUpdate = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'birthday' => $request->birthday,
        ];

        try {
            if ($request->hasFile('avatar')) {
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '_avatar' . Str::random(4) . '.' . $extension;
                $check = in_array($extension, $allowFileExtension);
                if ($check) {
                    if ($account->avatar) {
                        Storage::cloud()->delete($account->avatar);
                    }
                    Storage::cloud()->put($filename, file_get_contents($file->getRealPath()));
                    $dataUpdate['avatar'] = $filename;
                }
            }
            $account->update($dataUpdate);
            return back()->withFlashSuccess('Cập nhật tài khoản thành công');
        } catch (\Exception $e) {
            Log::channel('daily')->error('Cập nhật tài khoản:' . $e->getMessage());
            return back()->withFlashDanger('Cập nhật tài khoản không thành công');
        }
    }

    public function getChangePassword(Request $request, $id)
    {
        return view('frontend.account.includes._change_password');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $account = User::find($request->id);
        if (!$account) {
            return redirect(route('logout'));
        }
        if (!Hash::check($request->old_password, $account->password)) {
            return back()->withFlashDanger('Mật khẩu không chính xác. Vui lòng thử lại');
        }
        try {
            $account->update([
                'password' => Hash::make($request->new_password)
            ]);
        } catch (\Exception $e) {
            Log::channel('daily')->error('Cập nhật mật khẩu:' . $e->getMessage());
            return back()->withFlashDanger('Cập nhật mật khẩu không thành công');
        }
        return back()->withFlashSuccess('Mật khẩu đã được cập nhật');
    }
}
