@extends('backend.dashboard')
@section('content-body')
    <form action="{{ route('admin.book.post.update', [$book->id]) }}" enctype="multipart/form-data" method="post">
        @csrf
        <div class="card m-3">
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start">
                <div class="label col-sm-3 col-6">Tên sách <span class="text-danger">(*)</span></div>
                <input class="form-control col-sm-6 col-9" name="book_name" placeholder="Tên sách" type="text"
                    value="{{ $book->book_name ?? olg('book_name') }}">
            </div>
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3 justify-content-start">
                <div class="label col-sm-3 col-6">Danh mục</div>
                <select class="category" name="category">
                    @foreach ($categorys ?? [] as $category)
                        <option {{ $book->category_id == $category->id ? 'selected' : '' }} value="{{ $category->id }}">
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
                <div class="label col-sm-3 col-6">Tác giả</div>
                <select class="category" name="author">
                    @foreach ($authors ?? [] as $author)
                        <option {{ $book->author_id == $author->id ? 'selected' : '' }} value="{{ $author->id }}">
                            {{ $author->name }}
                        </option>
                    @endforeach
                </select>

            </div>
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
                <div class="label col-sm-3 col-6">Nhà xuất bản</div>
                <select class="category" name="publisher">
                    @foreach ($publishers ?? [] as $publisher)
                        <option {{ $book->publisher_id == $publisher->id ? 'selected' : '' }} value="{{ $publisher->id }}">
                            {{ $publisher->publisher_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
                <div class="label col-sm-3 col-6">Năm xuất bản</div>
                <input class="form-control col-sm-6 col-9" maxlength="4" name="year_publish" placeholder="Năm xuất bản"
                    type="text" value="{{ $book->year_publish ?? old('year_publish') }}">
            </div>
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
                <div class="label col-sm-3 col-6">Giá tiền</div>
                <input class="form-control col-sm-6 col-9" name="price" placeholder="Giá tiền"id=""
                    type="text" value="{{ $book->price ?? old('price') }}">
            </div>
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
                <div class="label col-sm-3 col-6">Giảm giá</div>
                <input class="form-control col-sm-5 col-8" maxlength="3" name="sale"
                    placeholder="Phần trăm giảm"id="" type="text" value="{{ $book->sale ?? old('sale') }}">
                <input {{ $book->is_sale ? 'checked' : '' }} class="col-sm-1 col-1" id="vehicle1" name="is_sale"
                    type="checkbox">
            </div>
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
                <div class="label col-sm-3 col-6">Số lượng</div>
                <input class="form-control col-sm-6 col-9" name="amount" placeholder="Số lượng"id=""
                    value="{{ $book->amount ?? old('amount') }}"type="number">
            </div>
            <div class="image-upload-wrap d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
                <div class="label col-sm-3 col-6">Hình ảnh</div>
                <button class="btn btn-success btn-add-image" type="button"><i class="fa-solid fa-plus"></i>  Thêm ảnh</button>
                <input class="form-control col-sm-6 col-9 d-none" id="image-book" name="images[]" type="file" />
            </div>
            <div class="images float-right d-flex flex-sm-row flex-column align-items-center m-5">
                @foreach ($book->image ?? [] as $image)
                <div class="image-wrap col-sm-2 col-6 mt-sm-0 mt-2">
                    <div class="image-body">
                        <input type="hidden" name="image_update[]" value="{{ $image }}">
                        <img alt="image" class="image-book" src="{{ get_image_book($image) }}">
                        <div class="icon-delete"><i class="fa-regular fa-circle-xmark"></i></div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
                <div class="label col-sm-3 col-6">Trạng thái</div>
                <select aria-label="Tình trạng" class="form-select col-sm-3 col-6" name="status">
                    <option {{ $book->status == 1 ? 'selected' : '' }} value="1">Còn hàng</option>
                    <option {{ $book->status == 2 ? 'selected' : '' }} value="2">Hết hàng</option>
                </select>
            </div>
            <div class="d-flex flex-sm-row flex-column align-items-start mt-3">
                <div class="label col-sm-3 col-6">Mô tả</div>
                <textarea class="form-control col-sm-6 col-9" name="describe_book">
                    {{ $book->describe }}
                </textarea>
            </div>

            <div class="d-flex flex-row align-items-center justify-content-end mt-3 col-9">
                <button class="btn btn-primary btn-xl" type="submit">
                    <i class="fa-solid fa-pen-to-square"></i>
                    Cập nhật
                </button>
            </div>
        </div>
    </form>
@endsection
