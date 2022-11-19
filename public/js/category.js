$("#delete-category").click(function () {
    $(this).prop("disabled", true);
    Swal.fire({
        title: "Cảnh báo!",
        text: "Bạn đã chắc chắn muốn xóa?",
        icon: "warning",
        showCancelButton: true,
        revertButton: true,
    }).then((result) => {
        if (result.isConfirmed) {
            $("#form-delete-category").submit();
        } else {
            $(this).prop("disabled", false);
        }
    });
});

function getUpdateCategory(id, el) {
    $(el).prop("disabled", true);
    const url = `/admin/category/update/${id}`;
    $.ajax({
        url: url,
        type: "GET",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: id,
        dataType: "JSON",
        success: function (response) {
            $("#category-detail").html(response);
            $("#category-detail").modal("show");
            $(".category").select2();
        },
        error: function (error) {},
        complete: function () {
            $(el).prop("disabled", false);
        },
    });
}

$(document).ready(function () {
    $(".category").select2({ dropdownParent: $("#category-wrapper") });
});

$(document).on("click", "#btn-submit-category", function () {
    $(this).prop("disabled", true);
    $("#category-update-form").submit();
});

$("#delete-publisher").click(function () {
    $(this).prop("disabled", true);
    Swal.fire({
        title: "Cảnh báo!",
        text: "Bạn đã chắc chắn muốn xóa?",
        icon: "warning",
        showCancelButton: true,
        revertButton: true,
    }).then((result) => {
        if (result.isConfirmed) {
            $("#form-delete-publisher").submit();
        } else {
            $(this).prop("disabled", false);
        }
    });
});
