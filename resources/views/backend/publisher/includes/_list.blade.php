@extends('backend.publisher.index')
@section('list-publisher')
<div class="card m-3">
    <form action="" method="get">
        <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start">
            <div class="label col-sm-3 col-6">Tên nhà xuất bản</div>
            <input class="form-control col-sm-3 col-6" name="publisher_name" placeholder="Tên nhà xuất bản" type="text"
                value="{{ old('publisher_name') ?? ($publisherName ?? '') }}">
        </div>
        <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
            <div class="label col-sm-3 col-6">Email</div>
            <input class="form-control col-sm-3 col-6" name="email_search" placeholder="Email" type="text"
                value="{{ old('email') ?? ($email ?? '') }}">
        </div>
        <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
            <div class="label col-sm-3 col-6">Số điện thoại</div>
            <input class="form-control col-sm-3 col-6" name="phone" placeholder="Số điện thoại" type="text"
                value="{{ old('phone') ?? ($phone ?? '') }}">
        </div>
        <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
            <div class="label col-sm-3 col-6">Địa chỉ</div>
            <input class="form-control col-sm-3 col-6" name="address" placeholder="Địa chỉ" type="text"
                value="{{ old('address') ?? ($address ?? '') }}">
        </div>
        
        <div class="d-flex flex-row align-items-center justify-content-end mt-3">
            <button class="btn btn-primary btn-xl" type="submit">
                <i class="fa-solid fa-magnifying-glass"></i>
                Tìm kiếm
            </button>
        </div>
    </form>
</div>

<div class="card m-3">
    <form action="{{ route('admin.publisher.post.delete') }}" id="form-delete-publisher" method="post">
        @csrf
        <div class="d-flex flex-row m-3 align-items-center justify-content-end">
            <button class="btn btn-danger btn-xl mr-3" id="delete-publisher" type="button">
                <i class="fa-solid fa-trash"></i>
                Xóa
            </button>
            <a class="btn btn-success btn-xl mr-2" href="{{ route('admin.publisher.create') }}" type="button">
                <i class="fa-solid fa-plus"></i>
                Thêm
            </a>
        </div>
        <div class="table-responsive">
            <table class="table caption-top">
                <thead>
                    <tr>
                        <th class="w-5 no-wrap-keep" scope="col"></th>
                        <th class="w-20 no-wrap-keep" scope="col">Tên nhà xuất bản</th>
                        <th class="w-15 no-wrap-keep" scope="col">Email</th>
                        <th class="w-10 no-wrap-keep" scope="col">Số điện thoại</th>
                        <th class="w-15 no-wrap-keep" scope="col">Địa chỉ</th>
                        <th class="w-20 no-wrap-keep" scope="col">Thông tin</th>
                        <th class="w-5 no-wrap-keep" scope="col">Cập nhật</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($publishers))
                        @foreach ($publishers ?? [] as $publisher)
                            <tr>
                                <th scope="row">
                                    <input id="" name="delete_publisher[]" type="checkbox"
                                        value="{{ $publisher->id }}">
                                </th>
                                <td>{{ $publisher->publisher_name }}</td>
                                <td>{{ $publisher->email ?? '' }}</td>
                                <td>{{ $publisher->phone ?? '' }}</td>
                                <td>{{ $publisher->address }}</td>
                                <td>{{ $publisher->more_info ?? '' }}</td>
                                <td>
                                    <div class="d-flex flex-row justify-content-start">
                                       <button class="btn border-0" id="update-author" type="button">
                                            <a
                                                href="{{ route('admin.publisher.update', [$publisher->id]) }}"class="text-black">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        </button>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="text-center" colspan="7">Danh sách trống</td>
                        </tr>
                    @endif

                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end">
            {{ $publishers->withQueryString()->links() }}
        </div>
    </form>
</div>

@endsection