<div class="card m-3">
    <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start">
        <div class="label col-sm-3 col-6">Tên sách</div>
        <input class="form-control col-sm-6 col-9" name="book_name" placeholder="Tên sách"id="" type="text">
    </div>
    <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
        <div class="label col-sm-3 col-6">Tác giả</div>
        <input class="form-control col-sm-6 col-9" name="author_name" placeholder="Tác giả"id=""
            type="text">
    </div>
    <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
        <div class="label col-sm-3 col-6">Nhà xuất bản</div>
        <input class="form-control col-sm-6 col-9" name="publisher_name" placeholder="Nhà xuất bản"id=""
            type="text">
    </div>
    <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
        <div class="label col-sm-3 col-6">Năm xuất bản</div>
        <input class="form-control col-sm-6 col-9" name="date" placeholder="Năm xuất bản"id=""
            type="text">
    </div>
    <div class="d-flex flex-row align-items-center justify-content-end mt-3">
        <button class="btn btn-primary btn-xl" type="button">
            <i class="fa-solid fa-magnifying-glass"></i>
            Tìm kiếm
        </button>
    </div>
</div>
<div class="card m-3">
    <div class="d-flex flex-row m-3 align-items-center justify-content-end">
        <button class="btn btn-danger btn-xl mr-3" type="button">
            <i class="fa-solid fa-trash"></i>
            Xóa sách
        </button>
        <a class="btn btn-success btn-xl mr-2" type="button"
            href="{{ route('admin.book.create') }}">
            <i class="fa-solid fa-plus"></i>
            Thêm sách
        </a>
    </div>
    <div class="table-responsive">
        <table class="table caption-top">
            <thead>
                <tr>
                    <th class="w-5 no-wrap-keep text-center" scope="col"></th>
                    <th class="w-20 no-wrap-keep text-center" scope="col">Tên sách</th>
                    <th class="w-15 no-wrap-keep text-center" scope="col">Mã sách</th>
                    <th class="w-20 no-wrap-keep text-center" scope="col">Nhà xuất bản</th>
                    <th class="w-10 no-wrap-keep text-center" scope="col">Năm xuất bản</th>
                    <th class="w-15 no-wrap-keep text-center" scope="col">Tác giả</th>
                    <th class="w-15 no-wrap-keep text-center" scope="col">Chi tiết</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">
                        <input id="" name="delete_book" type="checkbox">
                    </th>
                    <td>Thám Tử Lừng Danh Conan: Hồ Sơ Tuyệt Mật - Heiji Hattori & Kazuha Toyama</td>
                    <td>TTLDCN</td>
                    <td>Kim Đồng</td>
                    <td>2020</td>
                    <td>Gosho Aoyama</td>
                    <td>
                        <div class="d-flex flex-row justify-content-around">
                            <div class="">
                                <i class="fa-solid fa-eye"></i>
                            </div>
                            <div class="">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </div>
                        </div>

                    </td>
                </tr>

                <tr>
                    <th scope="row">
                        <input id="" name="delete_book" type="checkbox">
                    </th>
                    <td>Thám Tử Lừng Danh Conan: Hồ Sơ Tuyệt Mật - Heiji Hattori & Kazuha Toyama</td>
                    <td>TTLDCN</td>
                    <td>Kim Đồng</td>
                    <td>2020</td>
                    <td>Gosho Aoyama</td>
                    <td>
                        <div class="d-flex flex-row justify-content-around">
                            <div class="">
                                <i class="fa-solid fa-eye"></i>
                            </div>
                            <div class="">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </div>
                        </div>

                    </td>
                </tr>

                <tr>
                    <th scope="row">
                        <input id="" name="delete_book" type="checkbox">
                    </th>
                    <td>Thám Tử Lừng Danh Conan: Hồ Sơ Tuyệt Mật - Heiji Hattori & Kazuha Toyama</td>
                    <td>TTLDCN</td>
                    <td>Kim Đồng</td>
                    <td>2020</td>
                    <td>Gosho Aoyama</td>
                    <td>
                        <div class="d-flex flex-row justify-content-around">
                            <div class="">
                                <i class="fa-solid fa-eye"></i>
                            </div>
                            <div class="">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </div>
                        </div>

                    </td>
                </tr>


            </tbody>
        </table>
    </div>
</div>
