<div class="card m-3">
    <form action="" method="get">
        <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start">
            <div class="label col-sm-3 col-6">Tên sách</div>
            <input class="form-control col-sm-3 col-6" name="book_name" placeholder="Tên sách"id="" type="text"
                value="{{ old('book_name') ?? ($bookName ?? '') }}">
        </div>
        <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
            <div class="label col-sm-3 col-6">Tác giả</div>
            <select class="category" name="author">
                <option value="">Tác giả</option>
                @foreach ($authors ?? [] as $author)
                    <option {{ $authorId == $author->id ? 'selected' : '' }} value="{{ $author->id }}">
                        {{ $author->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
            <div class="label col-sm-3 col-6">Nhà xuất bản</div>
            <select class="category" name="publisher">
                <option value="">Nhà xuất bản</option>
                @foreach ($publishers ?? [] as $publisher)
                    <option {{ $publisherId == $publisher->id ? 'selected' : '' }} value="{{ $publisher->id }}">
                        {{ $publisher->publisher_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
            <div class="label col-sm-3 col-6">Năm xuất bản</div>
            <input class="form-control col-sm-3 col-6" maxlength="4" name="date" placeholder="Năm xuất bản"
                type="text" value="{{ old('date') ?? ($yearPublish ?? '') }}">
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
    <form action="{{ route('admin.book.post.delete') }}" method="post" id="form-delete-book">
        @csrf
        <div class="d-flex flex-row m-3 align-items-center justify-content-end">
            <button class="btn btn-danger btn-xl mr-3" type="button" id="delete-book">
                <i class="fa-solid fa-trash"></i>
                Xóa sách
            </button>
            <a class="btn btn-success btn-xl mr-2" href="{{ route('admin.book.create') }}" type="button">
                <i class="fa-solid fa-plus"></i>
                Thêm sách
            </a>
        </div>
        <div class="table-responsive">
            <table class="table caption-top">
                <thead>
                    <tr>
                        <th class="w-5 no-wrap-keep" scope="col"></th>
                        <th class="w-20 no-wrap-keep" scope="col">Tên sách</th>
                        <th class="w-20 no-wrap-keep" scope="col">Nhà xuất bản</th>
                        <th class="w-10 no-wrap-keep" scope="col">Năm xuất bản</th>
                        <th class="w-15 no-wrap-keep" scope="col">Giá bán</th>
                        <th class="w-15 no-wrap-keep" scope="col">Tác giả</th>
                        <th class="w-15 no-wrap-keep" scope="col">Chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($books))
                        @foreach ($books ?? [] as $book)
                            <tr>
                                <th scope="row">
                                    <input id="" name="delete_book[]" type="checkbox"
                                        value="{{ $book->id }}">
                                </th>
                                <td>{{ $book->book_name }}</td>
                                <td>{{ $book->publisher->publisher_name }}</td>
                                <td>{{ $book->year_publish }}</td>
                                <td>{{ $book->author->name }}</td>
                                <td>{{ $book->price }}</td>
                                <td>
                                    <div class="d-flex flex-row justify-content-around">
                                        <a href="{{ route('admin.book.get.update',[$book->id])}}"class="text-black">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.book.get.update',[$book->id])}}"class="text-black">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="text-center" colspan="7">Chưa có sách nào cả</td>
                        </tr>
                    @endif

                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end">
            {{ $books->withQueryString()->links() }}
        </div>
    </form>
</div>
