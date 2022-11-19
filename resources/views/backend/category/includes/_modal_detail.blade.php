<div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Cập nhật danh mục</h5>
            <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.category.post.update') }}" id="category-update-form"  class="order-3" method="post">
                @csrf
                <input type="hidden" name="category_id" value="{{ $category->id ?? '' }}">
                <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
                    <div class="label col-sm-3 col-6">Tên danh mục</div>
                    <input class="form-control col-sm-6 col-6" name="category_name" placeholder="Link"
                        type="text" value="{{ old('link') ?? ($category->category_name ?? '') }}">
                </div>
                <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3" id="category-wrapper">
                    <div class="label col-sm-3 col-6">Danh mục cha</div>
                    <select class="category" name="category_parent">
                        <option value="0"> -- </option>
                        @foreach ($categorys ?? [] as $item) use ($category ?? '')
                            <option value="{{ $item->id }}" {{ $item->id == ($category->parent_id ?? '') ? 'selected' : '' }}>
                                {{ $item->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>

        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary mr-3" data-bs-dismiss="modal" type="button">Hủy</button>
            <button class="btn btn-primary" type="button" id="btn-submit-category">Cập nhật</button>
        </div>
    </div>
</div>
