<div class="card m-3">
    <form action="{{ route('admin.category.post.create') }}" method="post">
        @csrf
        <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start">
            <div class="label col-sm-3 col-6">Tên danh mục</div>
            <input class="form-control col-sm-3 col-6" name="category_name" placeholder="Tên danh mục" type="text"
                value="{{ old('category_name')}}">
        </div>
        <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
            <div class="label col-sm-3 col-6">Danh mục cha</div>
            <select class="category" name="category_parent">
                <option value="0"> -- </option>
                @foreach ($categorys ?? [] as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->category_name }}
                    </option>
                @endforeach
            </select>
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
    <form action="{{ route('admin.category.post.delete') }}" id="form-delete-category" method="post">
        @csrf
        <div class="d-flex flex-row m-3 align-items-center justify-content-end">
            <button class="btn btn-danger btn-xl mr-3" id="delete-category" type="button">
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
                        <th class="w-20 no-wrap-keep" scope="col">Tên danh mục</th>
                        <th class="w-15 no-wrap-keep" scope="col">Danh mục cha</th>
                        <th class="w-15 no-wrap-keep" scope="col">Cập nhật</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($categorys))
                        @foreach ($categorys ?? [] as $index => $category)
                            <tr>
                                <th scope="row">
                                    <input id="" name="delete_category[]" type="checkbox"
                                        value="{{ $category->id }}">
                                </th>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $category->category_name }}</td>
                                <td>{{ $category->parent_id == 0 ? '--' :  $category->category->category_name }}<td>
                                    <div class="d-flex flex-row justify-content-start">
                                        <button class="btn border-0 text-black" id="update-slider" type="button" onclick="getUpdateCategory({{ $category->id }})">
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

