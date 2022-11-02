@extends('backend.dashboard')
@section('content-body')
    <div class="card m-3">
        <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start">
            <div class="label col-sm-3 col-6">Tên sách <span class="text-danger">(*)</span></div>
            <input class="form-control col-sm-6 col-9" name="book_name" placeholder="Tên sách"id="" required
                type="text">
        </div>
        <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
            <div class="label col-sm-3 col-6">Danh mục</div>
            <select class="category form-control col-sm-6 col-9" name="category">
                <option value="AL">Alabama</option>
                ...
                <option value="WY">Wyoming</option>
                <option value="AL">Alabama</option>
                ...
                <option value="WY">Wyoming</option>
                
            </select>
        </div>
        <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
            <div class="label col-sm-3 col-6">Tác giả</div>
            <select class="js-example-basic-multiple" name="states[]" multiple="multiple">
                <option value="AL">Alabama</option>
                  ...
                <option value="WY">Wyoming</option>
              </select>
        </div>
        <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
            <div class="label col-sm-3 col-6">Nhà xuất bản</div>
            <input class="form-control col-sm-6 col-9" name="publisher" placeholder="Nhà xuất bản"id=""
                type="text">
        </div>
        <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
            <div class="label col-sm-3 col-6">Năm xuất bản</div>
            <input class="form-control col-sm-6 col-9" name="book_name" placeholder="Năm xuất bản"id=""
                type="text">
        </div>
        <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
            <div class="label col-sm-3 col-6">Giá tiền</div>
            <input class="form-control col-sm-6 col-9" name="author_name" placeholder="Giá tiền"id=""
                type="text">
        </div>
        <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
            <div class="label col-sm-3 col-6">Giảm giá</div>
            <input class="form-control col-sm-6 col-9" name="sale" placeholder="Nhà xuất bản"id=""
                type="text">
        </div>
        <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
            <div class="label col-sm-3 col-6">Số lượng</div>
            <input class="form-control col-sm-6 col-9" name="amount" placeholder="Số lượng"id="" type="text">
        </div>
        <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
            <div class="label col-sm-3 col-6">Hình ảnh</div>
            <input class="form-control col-sm-6 col-9" name="image" placeholder="Nhà xuất bản"id=""
                type="text">
        </div>
        <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
            <div class="label col-sm-3 col-6">Trạng thái</div>
            <select aria-label="Tình trạng" class="form-select col-sm-6 col-9" name="status">
                <option value="1">Còn hàng</option>
                <option value="2">Hết hàng</option>
            </select>
        </div>
        <div class="d-flex flex-sm-row flex-column align-items-start mt-3">
            <div class="label col-sm-3 col-6">Mô tả</div>
            <textarea class="form-control col-sm-6 col-9" name="describe_book"></textarea>
        </div>


        <div class="d-flex flex-row align-items-center justify-content-end mt-3 col-9">
            <button class="btn btn-primary btn-xl" type="button">
                <i class="fa-solid fa-plus"></i>
                Thêm sách
            </button>
        </div>
    </div>
@endsection
