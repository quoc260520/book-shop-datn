@extends('backend.account.index')
@section('create-account')
    <form action="{{ route('admin.account.post.create') }}" method="post">
        @csrf
        <div class="card m-3">
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start">
                <div class="label col-sm-3 col-6">Họ</div>
                <input class="form-control col-sm-6 col-9" name="first_name" placeholder="Họ" type="text"
                    value="{{ old('first_name') }}">
            </div>
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
                <div class="label col-sm-3 col-6">Tên</div>
                <input class="form-control col-sm-6 col-9" name="last_name" placeholder="Tên" type="text"
                    value="{{ old('last_name') }}">
            </div>
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
                <div class="label col-sm-3 col-6">Email <span class="badge badge-danger">*</span></div>
                <input class="form-control col-sm-6 col-9" name="email" placeholder="Email" type="email"
                    value="{{ old('email') }}">
            </div>
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
                <div class="label col-sm-3 col-6">Số điện thoại</div>
                <input class="form-control col-sm-6 col-9" name="phone" placeholder="Số điện thoại"id=""
                    type="text" value="{{ old('phone') }}">
            </div>
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
                <div class="label col-sm-3 col-6">Mật khẩu <span class="badge badge-danger">*</span> </div>
                <input class="form-control col-sm-6 col-9" name="password" placeholder="Mật khẩu" type="text"
                    value="{{ old('password') }}">
            </div>
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
                <div class="label col-sm-3 col-6">Địa chỉ</div>
                <input class="form-control col-sm-6 col-9" name="address" placeholder="Quê quán" type="text"
                    value="{{ old('address') }}">
            </div>
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
                <div class="label col-sm-3 col-6">Ngày sinh</div>
                <input class="form-control col-sm-6 col-9" name="date_of_birth" placeholder="Ngày sinh" type="date"
                    value="{{ old('date_of_birth') }}">
            </div>
           
            <div class="d-flex flex-row align-items-center justify-content-end mt-3 col-9">
                <button class="btn btn-primary btn-xl" type="submit">
                    <i class="fa-solid fa-plus"></i>
                    Thêm
                </button>
            </div>
        </div>
    </form>
@endsection
