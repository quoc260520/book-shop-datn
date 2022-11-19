@extends('backend.publisher.index')
@section('update-publisher')
<form action="{{ route('admin.publisher.post.update') }}" method="post">
    @csrf
    <div class="card m-3">
        <input type="hidden" name="publisher_id" value={{ $publisher->id }}>
        <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start">
            <div class="label col-sm-3 col-6">Tên nhà xuất bản <span class="text-danger">(*)</span></div>
            <input class="form-control col-sm-6 col-9" name="publisher_name" placeholder="Tên nhà xuất bản"
                type="text" value="{{ old('publisher_name') ?? $publisher->publisher_name }}">
        </div>        
        <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
            <div class="label col-sm-3 col-6">Email</div>
            <input class="form-control col-sm-6 col-9" name="email" placeholder="Email"
                type="email" value="{{ old('email') ?? $publisher->email}}">
        </div>
        <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
            <div class="label col-sm-3 col-6">Số điện thoại</div>
            <input class="form-control col-sm-6 col-9" name="phone" placeholder="Số điện thoại"id=""
                type="text" value="{{ old('phone') ?? $publisher->phone }}">
        </div>
        <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
            <div class="label col-sm-3 col-6">Địa chỉ</div>
            <input class="form-control col-sm-6 col-9" name="address" placeholder="Quê quán"
                type="text" value="{{ old('address') ?? $publisher->address}}">
        </div>
        <div class="d-flex flex-sm-row flex-column align-items-start mt-3">
            <div class="label col-sm-3 col-6">Thông tin</div>
            <textarea class="form-control col-sm-6 col-9"  name="info" cols="30" rows="10">
            {{ $publisher->more_info}}
            </textarea>
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