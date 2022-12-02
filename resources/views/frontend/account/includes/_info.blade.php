@extends('frontend.account.index')
@section('info')
    <div class="card border-0 p-3 ps-5 info-account row d-flex flex-row">
        <form action="{{ route('account.update') }}" class="row d-flex flex-row" enctype="multipart/form-data" method="post">
            @csrf
            <div class="col-8 d-flex flex-column pe-5">
                <input name="id" type="hidden" value="{{ auth()->user()->id }}">
                <div class="mb-4 row">
                    <label class="col-sm-2 col-form-label" for="staticEmail">User Name</label>
                    <div class="col-sm-10">
                        <input class="input-info text-secondary" readonly type="text"
                            value="{{ auth()->user()->user_name }}">
                    </div>
                </div>
                <div class="mb-4 row">
                    <label class="col-sm-2 col-form-label">Họ</label>
                    <div class="col-sm-10">
                        <input class="input-info" name="first_name" type="text" value="{{ auth()->user()->first_name }}">
                    </div>
                </div>
                <div class="mb-4 row">
                    <label class="col-sm-2 col-form-label" for="staticEmail">Tên</label>
                    <div class="col-sm-10">
                        <input class="input-info" name="last_name" type="text" value="{{ auth()->user()->last_name }}">
                    </div>
                </div>
                <div class="mb-4 row">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input class="input-info" name="email" type="email" value="{{ auth()->user()->email }}">
                    </div>
                </div>
                <div class="mb-4 row">
                    <label class="col-sm-2 col-form-label">Số điện thoại</label>
                    <div class="col-sm-10">
                        <input class="input-info" name="phone" type="text" value="{{ auth()->user()->phone }}">
                    </div>
                </div>
                <div class="mb-4 row">
                    <label class="col-sm-2 col-form-label">Ngày sinh</label>
                    <div class="col-sm-10">
                        <input class="input-info" name="birthday" type="date" value="{{ auth()->user()->birthday }}">
                    </div>
                </div>
                <div class="mb-4 row">
                    <label class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                        <input class="input-info" name="address" type="text" value="{{ auth()->user()->address }}">
                    </div>
                </div>
                <div class="button-submit d-flex justify-content-end">
                    <button class="btn bg-warning col-3 fs-4" type="submit">Cập nhật</button>
                </div>
            </div>
            <div class="col-4 text-center border-start mt-5 file-input d-flex flex-column align-items-center">
                <img alt="avt" class="avatar-info mb-3" id="avatar-info" src="{{ get_avatar() }}">
                <input class="avatar-input" id="avatar-input" name="avatar" type="file">
                <label for="avatar-input">Chọn ảnh</label>
            </div>
        </form>
    </div>
@endsection
