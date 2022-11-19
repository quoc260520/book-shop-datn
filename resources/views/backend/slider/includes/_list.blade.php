<div class="card m-3">
    <form action="{{ route('admin.slider.create') }}" enctype="multipart/form-data" method="post">
        @csrf
        <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
            <div class="label col-sm-3 col-6">Link</div>
            <input class="form-control col-sm-6 col-6" name="link" placeholder="Link" type="text"
                value="{{ old('link') }}">
        </div>
        <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
            <div class="label col-sm-3 col-6">Hình ảnh</div>
            <input class="form-control col-sm-6 col-6" name="image" placeholder="Image" type="file">
        </div>
        <div class="d-flex flex-row align-items-center justify-content-end mt-3 mr-4">
            <button class="btn btn-primary btn-xl" type="submit">
                <i class="fa-solid fa-plus"></i>
                Thêm
            </button>
        </div>
    </form>
</div>

<div class="card m-3">
    <form action="{{ route('admin.slider.delete') }}" id="form-delete-slider" method="post">
        @csrf
        <div class="d-flex flex-row m-3 align-items-center justify-content-end">
            <button class="btn btn-danger btn-xl mr-3" id="delete-slider" type="button">
                <i class="fa-solid fa-trash"></i>
                Xóa
            </button>
        </div>
        <div class="table-responsive">
            <table class="table caption-top">
                <thead>
                    <tr>
                        <th class="w-5 no-wrap-keep" scope="col"></th>
                        <th class="w-20 no-wrap-keep" scope="col">STT</th>
                        <th class="w-20 no-wrap-keep" scope="col">Link</th>
                        <th class="w-15 no-wrap-keep" scope="col">Image</th>
                        <th class="w-15 no-wrap-keep" scope="col">Cập nhật</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($sliders))
                        @foreach ($sliders ?? [] as $index => $slider)
                            <tr>
                                <th scope="row">
                                    <input id="" name="delete_slider[]" type="checkbox"
                                        value="{{ $slider->id }}">
                                </th>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $slider->link }}</td>
                                <td><img alt="...Slider" height="150px" src="{{ get_image_book($slider->image) }}"
                                        width="300px"></td>
                                <td>
                                    <div class="d-flex flex-row justify-content-start">
                                        <button class="btn border-0 text-black" id="update-slider" type="button" onclick="getUpdate({{ $slider->id }})">
                                            <i class="fa-solid fa-pen-to-square"></i>
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
    </form>
</div>

@section('script')
    <script>
        $("#delete-slider").click(function() {
            $(this).prop("disabled", true);
            Swal.fire({
                title: "Cảnh báo!",
                text: "Bạn đã chắc chắn muốn xóa?",
                icon: "warning",
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#form-delete-slider").submit();
                } else {
                    $(this).prop("disabled", false);
                }
            });
        });
    </script>
@endsection
