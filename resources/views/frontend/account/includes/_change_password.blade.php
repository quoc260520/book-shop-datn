@extends('frontend.account.index')
@section('change-password')
    <div class="card border-0 p-3 ps-5 info-account row d-flex flex-row">
        <form action="{{ route('account.post.change-password') }}" class="row d-flex flex-row" method="post">
            @csrf
            <div class="col-8 d-flex flex-column pe-5">
                <input name="id" type="hidden" value="{{ auth()->user()->id }}">
                <div class="mb-5 mt-5 row">
                    <label class="col-sm-4 col-form-label">Mật khẩu hiện tại</label>
                    <div class="col-sm-8">
                        <input class="input-info" name="old_password" type="password" value="">
                    </div>
                </div>
                <div class="mb-5 row">
                    <label class="col-sm-4 col-form-label" for="staticEmail">Mật khẩu mới</label>
                    <div class="col-sm-8">
                        <input class="input-info" name="new_password" type="password" value="">
                    </div>
                </div>
                <div class="mb-5 row">
                    <label class="col-sm-4 col-form-label">Xác nhận mật khẩu</label>
                    <div class="col-sm-8">
                        <input class="input-info" name="new_password_confirmation" type="password" value="">
                    </div>
                </div>
                <div class="button-submit d-flex justify-content-end">
                    <button class="btn bg-warning col-3 fs-4" type="submit">Cập nhật</button>
                </div>
            </div>
        </form>
    </div>
@endsection
