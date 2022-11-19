@extends('backend.author.index')
@section('list-author')
<div class="card m-3">
    <form action="" method="get">
        <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start">
            <div class="label col-sm-3 col-6">Tên tác giả</div>
            <input class="form-control col-sm-3 col-6" name="author_name" placeholder="Tên tác giả" type="text"
                value="{{ old('author_name') ?? ($authorName ?? '') }}">
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
    <form action="{{ route('admin.author.post.delete') }}" id="form-delete-book" method="post">
        @csrf
        <div class="d-flex flex-row m-3 align-items-center justify-content-end">
            <button class="btn btn-danger btn-xl mr-3" id="delete-book" type="button">
                <i class="fa-solid fa-trash"></i>
                Xóa tác giả
            </button>
            <a class="btn btn-success btn-xl mr-2" href="{{ route('admin.author.create') }}" type="button">
                <i class="fa-solid fa-plus"></i>
                Thêm tác giả
            </a>
        </div>
        <div class="table-responsive">
            <table class="table caption-top">
                <thead>
                    <tr>
                        <th class="w-5 no-wrap-keep" scope="col"></th>
                        <th class="w-20 no-wrap-keep" scope="col">Tên tác giả</th>
                        <th class="w-20 no-wrap-keep" scope="col">Ngày sinh</th>
                        <th class="w-10 no-wrap-keep" scope="col">Địa chỉ</th>
                        <th class="w-10 no-wrap-keep" scope="col">Cập nhật</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($authors))
                        @foreach ($authors ?? [] as $author)
                            <tr>
                                <th scope="row">
                                    <input id="" name="delete_author[]" type="checkbox"
                                        value="{{ $author->id }}">
                                </th>
                                <td>{{ $author->name }}</td>
                                <td>{{ $author->date_of_birth ?? '' }}</td>
                                <td>{{ $author->address ?? '' }}</td>
                                <td>
                                    <div class="d-flex flex-row justify-content-start">
                                       <button class="btn border-0" id="update-author" type="button">
                                            <a
                                                href="{{ route('admin.author.get.update', [$author->id]) }}"class="text-black">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        </button>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="text-center" colspan="5">Danh sách trống</td>
                        </tr>
                    @endif

                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end">
            {{ $authors->withQueryString()->links() }}
        </div>
    </form>
</div>

@endsection