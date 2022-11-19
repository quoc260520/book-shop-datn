$(document).ready(function () {
    $(".category").select2();

    CKEDITOR.replace("describe_book");

    $("#image-book").change(function () {});

    $("#delete-book").click(function () {
        $(this).prop("disabled", true);
        Swal.fire({
            title: "Cảnh báo!",
            text: "Bạn đã chắc chắn muốn xóa?",
            icon: "warning",
            showCancelButton: true,
        }).then((result) => {
            if (result.isConfirmed) {
                $("#form-delete-book").submit();
            } else {
                $(this).prop("disabled", false);
            }
        });
    });
    deleteImage();
    function deleteImage() {
        $(".icon-delete").each(function (index, element) {
            $(element).click(function () {
                $(this).parent().remove();
                let id = $(this).attr("data-icon");
                $("#" + id).remove();
            });
        });
    }

    $(".btn-add-image").click(function () {
        $("#image-book").trigger("click");
    });
    initImage();
    function initImage() {
        $("#image-book").change(function (event) {
            console.log($(".image-wrap").length);
            if ($(".image-wrap").length == 5) {
                return;
            }
            let image = event.target.files[0];
            let listImage = $(".images");
            let time = Date.now();
            $(this).removeAttr("id");
            $(this).attr("id", time);

            $(
                listImage
            ).append(`<div class="image-wrap col-sm-2 col-6 m-sm-0 mt-2">
    <div class="image-body">
        <img alt="image" class="image-book" src="${URL.createObjectURL(image)}">
        <div class="icon-delete" data-icon="${time}"><i class="fa-regular fa-circle-xmark"></i>
        </div>
        <div class="image-body">
        </div>`);
            $(".image-upload-wrap").append(
                '<input class="d-none" id="image-book" name="images[]" type="file">'
            );
            deleteImage();
            initImage();
        });
    }

    $("#update-book").click(function () {
        $(this).prop("disabled", true);
    });
});
function getDetailBook(id) {
    const url = `/admin/book/detail/${id}`;
    $.ajax({
        url: url,
        type: "GET",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: id,
        dataType: "JSON",
        success: function (response) {
            $("#book-detail").html(response.data);
            $("#book-detail").modal("show");
        },
        error: function (error) {},
        complete: function () {},
    });
}
