<div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Cập nhật slider</h5>
            <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
        </div>
        <div class="modal-body">
            <form id="update_slider"  class="order-3" method="post" enctype="multipart/form-data">
                <input type="hidden" name="slider_id" value="{{ $slider->id ?? '' }}">
                <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
                    <div class="label col-sm-3 col-6">Link</div>
                    <input class="form-control col-sm-6 col-6" name="link_update" placeholder="Link"
                        type="text" value="{{ old('link') ?? ($slider->link ?? '') }}">
                </div>
                <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start mt-3">
                    <div class="label col-sm-3 col-6">Hình ảnh</div>
                    <input class="form-control col-sm-6 col-6" name="image" placeholder="Image"
                        type="file">
                    <input name="image_old" type="hidden" value="{{ $slider->image ?? '' }}">
                </div>
                <div class="text-center mt-5">
                    <img alt="" class="img-thumbnail" height="300px"
                        src="{{ $slider->image ?? false ? get_image_book($slider->image) : '' }}" width="400px">
                </div>
            </form>

        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary mr-3" data-bs-dismiss="modal" type="button">Hủy</button>
            <button class="btn btn-primary" id="submit-update-slider" type="button">Cập nhật</button>
        </div>
    </div>
</div>
