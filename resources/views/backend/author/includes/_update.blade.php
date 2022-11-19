@extends('backend.author.index')
@section('update-author')
    <form action="{{ route('admin.author.post.update', $author->id) }}" method="post">
        @csrf
        <div class="card m-3">
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start">
                <div class="label col-sm-3 col-6">Tên tác giả <span class="text-danger">(*)</span></div>
                <input class="form-control col-sm-6 col-9" name="author_name" placeholder="Tên tác giả" type="text"
                    value="{{ old('author_name') ?? $author->name }}">
            </div>
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
                <div class="label col-sm-3 col-6">Ngày sinh</div>
                <input class="form-control col-sm-6 col-9" maxlength="4" name="date_of_birth"
                    placeholder="Ngày sinh"id="" type="date" value="{{ old('date_of_birth') ?? ($author->date_of_birth ?? '') }}">
            </div>
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
                <div class="label col-sm-3 col-6">Quê quán</div>
                <input class="form-control col-sm-6 col-9" name="address" placeholder="Quê quán" type="text"
                    value="{{ old('address') ?? ($author->address ?? '')}}">
            </div>

            <div class="d-flex flex-row align-items-center justify-content-end mt-3 col-9">
                <button class="btn btn-primary btn-xl" type="submit">
                    Cập nhật tác giả
                </button>
            </div>
        </div>
    </form>
@endsection
