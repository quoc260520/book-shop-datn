<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAccountRequest;
use App\Http\Requests\DeleteAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Models\User;
use Google\Service\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        $paged = config('app.page_count');
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $accounts = User::when($email, function ($query, $email) {
            $query->where('email', 'like', ["%$email%"]);
        })
            ->when($name, function ($query, $name) {
                $query->whereRaw(concat_sql(['first_name', 'last_name']) . 'LIKE ?', ["%$name%"]);
            })
            ->when($phone, function ($query, $phone) {
                $query->where('phone', 'like', ["%$phone%"]);
            })
            ->orderBy('first_name')
            ->paginate($paged);
        return view('backend.account.includes._list')
            ->withAccounts($accounts)
            ->withEmail($email)
            ->withName($name)
            ->withPhone($phone);
    }

    public function getCreate(Request $request)
    {
        return view('backend.account.includes._create');
    }

    public function create(CreateAccountRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = User::create([
                'uuid' => Uuid::uuid4()->toString(),
                'user_name' => Str::random(6),
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'active' => User::ACTIVE,
                'address' => $request->address,
                'birthday' => $request->date_of_birth,
            ]);

            $user->assignRole(config('access.role.staff_role'));
            DB::commit();

            Log::info('Create user success: ' . $user->id);
            return back()->withFlashSuccess('Tạo tài khoản thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::channel('daily')->error('Thêm tài khoản lỗi:' . $e->getMessage());
            return back()->withFlashDanger('Thêm tài khoản không thành công');
        }
    }

    public function getUpdate(Request $request, $id)
    {
        $account = User::find($id);
        if (!$account) {
            return back()->withFlashDanger('Tài khoản không tồn tại');
        }
        return view('backend.account.includes._update')->withAccount($account);
    }
    public function update(UpdateAccountRequest $request)
    {
        $account = User::where('id', $request->id);
        if (!count($account->get())) {
            return back()->withFlashDanger('Tài khoản không tồn tại');
        }
        $dataUpdate = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'active' => $request->active ? User::ACTIVE : User::DEACTIVE ,
            'address' => $request->address,
            'birthday' => $request->date_of_birth,
        ];
        if ($request->password) {
            $dataUpdate['password'] = Hash::make($request->password);
        }
        try {
            $account->update($dataUpdate);
            return back()->withFlashSuccess('Cập nhật tài khoản thành công');
        } catch (\Exception $e) {
            Log::channel('daily')->error('Cập nhật tài khoản:' . $e->getMessage());
            return back()->withFlashDanger('Cập nhật tài khoản không thành công');
        }
    }

    public function deleteAccounts(DeleteAccountRequest $request)
    {
        $accounts = User::whereIn('id', $request->delete_account);
        if (count($accounts->get()) != count($request->delete_account)) {
            return back()->withFlashDanger('Một số tài khoản không tồn tại');
        }
        try {
            $accounts->delete();
            return back()->withFlashSuccess('Xóa tài khoản thành công');
        } catch (\Exception $e) {
            Log::channel('daily')->error('Xóa tài khoản lỗi:' . $e->getMessage());
            return back()->withFlashDanger('Xóa tài khoản không thành công');
        }
    }
}
