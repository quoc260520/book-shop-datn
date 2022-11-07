@extends('backend.dashboard')
@section('content-body')
    <form action="{{ route('admin.book.post.create') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card m-3">
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start">
                <div class="label col-sm-3 col-6">Tên sách <span class="text-danger">(*)</span></div>
                <input class="form-control col-sm-6 col-9" name="book_name" placeholder="Tên sách"
                    type="text" value="{{ old('book_name') }}">
            </div>
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3 justify-content-start">
                <div class="label col-sm-3 col-6">Danh mục</div>
                <select class="category" name="category">
                    @foreach($categorys ?? [] as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->category_name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
                <div class="label col-sm-3 col-6">Tác giả</div>
                <select class="category" name="author">
                    @foreach($authors ?? [] as $author)
                    <option value="{{ $author->id }}">
                        {{ $author->name }}
                    </option>
                    @endforeach
                </select>

            </div>
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
                <div class="label col-sm-3 col-6">Nhà xuất bản</div>
                <select class="category" name="publisher">
                    @foreach($publishers ?? [] as $publisher)
                    <option value="{{ $publisher->id }}">
                        {{ $publisher->publisher_name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
                <div class="label col-sm-3 col-6">Năm xuất bản</div>
                <input class="form-control col-sm-6 col-9" name="year_publish" placeholder="Năm xuất bản"id=""
                    type="text" maxlength="4" value="{{ old('year_publish') }}">
            </div>
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
                <div class="label col-sm-3 col-6">Giá tiền</div>
                <input class="form-control col-sm-6 col-9" name="price" placeholder="Giá tiền"id=""
                    type="text" value="{{ old('price') }}">
            </div>
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
                <div class="label col-sm-3 col-6">Giảm giá</div>
                <input class="form-control col-sm-5 col-8" name="sale" placeholder="Phần trăm giảm"id=""
                    type="text" maxlength="3" value="{{ old('sale') }}">
                <input type="checkbox" id="vehicle1" name="is_sale" class="col-sm-1 col-1">
            </div>
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
                <div class="label col-sm-3 col-6">Số lượng</div>
                <input class="form-control col-sm-6 col-9" name="amount" placeholder="Số lượng"id=""
                    type="number" value="{{ old('amount') }}">
            </div>
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
                <div class="label col-sm-3 col-6">Hình ảnh</div>
                <input class="form-control col-sm-6 col-9" type="file" id="image-book" name="images[]" multiple/>
            </div>
            <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
                <div class="label col-sm-3 col-6">Trạng thái</div>
                <select aria-label="Tình trạng" class="form-select col-sm-3 col-6" name="status">
                    <option value="1">Còn hàng</option>
                    <option value="2">Hết hàng</option>
                </select>
            </div>
            <div class="d-flex flex-sm-row flex-column align-items-start mt-3">
                <div class="label col-sm-3 col-6">Mô tả</div>
                <textarea class="form-control col-sm-6 col-9" name="describe_book"></textarea>
            </div>


            <div class="d-flex flex-row align-items-center justify-content-end mt-3 col-9">
                <button class="btn btn-primary btn-xl" type="submit">
                    <i class="fa-solid fa-plus"></i>
                    Thêm sách
                </button>
            </div>
        </div>
    </form>
@endsection
