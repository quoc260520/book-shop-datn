@extends('backend.account.index')
@section('update-account')
    <form action="{{ route('admin.account.post.update') }}" method="post">
        @csrf
        <input name="id" type="hidden" value="{{ $account->id }}">
        <div class="card m-3">
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start">
                <div class="label col-sm-3 col-6">Họ</div>
                <input class="form-control col-sm-6 col-9" name="first_name" placeholder="Họ" type="text"
                    value="{{ old('first_name') ?? ($account->first_name ?? '') }}">
            </div>
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
                <div class="label col-sm-3 col-6">Tên</div>
                <input class="form-control col-sm-6 col-9" name="last_name" placeholder="Tên" type="text"
                    value="{{ old('last_name') ?? ($account->last_name ?? '') }}">
            </div>
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
                <div class="label col-sm-3 col-6">Email <span class="badge badge-danger">*</span></div>
                <input class="form-control col-sm-6 col-9" name="email" placeholder="Email" type="email"
                    value="{{ old('email') ?? ($account->email ?? '') }}">
            </div>
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
                <div class="label col-sm-3 col-6">Số điện thoại</div>
                <input class="form-control col-sm-6 col-9" name="phone" placeholder="Số điện thoại"id=""
                    type="text" value="{{ old('phone') ?? ($account->phone ?? '') }}">
            </div>
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
                <div class="label col-sm-3 col-6">Mật khẩu <span class="badge badge-danger">*</span> </div>
                <input class="form-control col-sm-6 col-9" name="password" placeholder="Mật khẩu" type="text"
                    value="{{ old('password') }}">
            </div>
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
                <div class="label col-sm-3 col-6">Địa chỉ</div>
                <input class="form-control col-sm-6 col-9" name="address" placeholder="Quê quán" type="text"
                    value="{{ old('address') ?? ($account->address ?? '') }}">
            </div>
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
                <div class="label col-sm-3 col-6">Ngày sinh</div>
                <input class="form-control col-sm-6 col-9" name="date_of_birth" placeholder="Ngày sinh" type="date"
                    value="{{ old('date_of_birth') ?? ($account->birthday ?? '') }}">
            </div>

            <div class="form-check form-switch d-flex flex-row justify-content-start align-items-start mt-3 p-0">
                <div class="label col-sm-3 col-6">Kích hoạt</div>
                <div class="float-right col-sm-6 col-9">
                    <input {{ $account->active ? 'checked' : '' }} class="form-check-input ml-0" name="active" type="checkbox">
                </div>
            </div>

            <div class="d-flex flex-row align-items-center justify-content-end mt-3 col-9">
                <button class="btn btn-warning btn-xl" type="submit">
                    <i class="fa-solid fa-pen-to-square"></i>
                    Cập nhật
                </button>
            </div>
        </div>
    </form>
@endsection
