@extends('backend.voucher.index')
@section('create-voucher')
    <form action="{{ route('admin.voucher.post.create') }}" method="post">
        @csrf
        <div class="card m-3">
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start">
                <div class="label col-sm-3 col-6">Mã <span class="badge badge-danger">*</span></div>
                <input class="form-control col-sm-3 col-6" name="code" placeholder="ABCXYZ" type="text"
                    value="{{ old('code') }}">
            </div>
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
                <div class="label col-sm-3 col-6">Số lượng</div>
                <input class="form-control col-sm-3 col-6" name="amount" placeholder="Số lượng" type="number"
                    value="{{ old('amount') }}">
            </div>
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
                <div class="label col-sm-3 col-6">Phần trăm giảm <span class="badge badge-danger">*</span></div>
                <input class="form-control col-sm-3 col-6" name="percent" placeholder="15%" type="number" min="0" max="100"
                    value="{{ old('percent') }}">
            </div>
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
                <div class="label col-sm-3 col-6">Thời gian bắt đầu <span class="badge badge-danger">*</span></div>
                <input class="form-control col-sm-3 col-6 time" name="time_start"
                    type="text" value="{{ old('time_start') }}">
            </div>
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
                <div class="label col-sm-3 col-6">Thời gian kết thúc </div>
                <input class="form-control col-sm-3 col-6 time" name="time_end" type="text"
                    value="{{ old('time_end') }}">
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
