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
            return back()->withFlashSuccess('T???o t??i kho???n th??nh c??ng');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::channel('daily')->error('Th??m t??i kho???n l???i:' . $e->getMessage());
            return back()->withFlashDanger('Th??m t??i kho???n kh??ng th??nh c??ng');
        }
    }

    public function getUpdate(Request $request, $id)
    {
        $account = User::find($id);
        if (!$account) {
            return back()->withFlashDanger('T??i kho???n kh??ng t???n t???i');
        }
        return view('backend.account.includes._update')->withAccount($account);
    }
    public function update(UpdateAccountRequest $request)
    {
        $account = User::where('id', $request->id);
        if (!count($account->get())) {
            return back()->withFlashDanger('T??i kho???n kh??ng t???n t???i');
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
            return back()->withFlashSuccess('C???p nh???t t??i kho???n th??nh c??ng');
        } catch (\Exception $e) {
            Log::channel('daily')->error('C???p nh???t t??i kho???n:' . $e->getMessage());
            return back()->withFlashDanger('C???p nh???t t??i kho???n kh??ng th??nh c??ng');
        }
    }

    public function deleteAccounts(DeleteAccountRequest $request)
    {
        $accounts = User::whereIn('id', $request->delete_account);
        if (count($accounts->get()) != count($request->delete_account)) {
            return back()->withFlashDanger('M???t s??? t??i kho???n kh??ng t???n t???i');
        }
        try {
            $accounts->delete();
            return back()->withFlashSuccess('X??a t??i kho???n th??nh c??ng');
        } catch (\Exception $e) {
            Log::channel('daily')->error('X??a t??i kho???n l???i:' . $e->getMessage());
            return back()->withFlashDanger('X??a t??i kho???n kh??ng th??nh c??ng');
        }
    }
}
