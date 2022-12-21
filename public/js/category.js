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

$("#delete-account").click(function () {
    $(this).prop("disabled", true);
    Swal.fire({
        title: "Cảnh báo!",
        text: "Bạn đã chắc chắn muốn xóa?",
        icon: "warning",
        showCancelButton: true,
        revertButton: true,
    }).then((result) => {
        if (result.isConfirmed) {
            $("#form-delete-account").submit();
        } else {
            $(this).prop("disabled", false);
        }
    });
});

$(".time").daterangepicker({
    timePicker: true,
    minDate: moment(),
    startDate: moment().startOf("hour"),
    locale: {
        format: "Y-M-D hh:mm:ss",
    },
    singleDatePicker: true,
});

$("#delete-voucher").click(function () {
    $(this).prop("disabled", true);
    Swal.fire({
        title: "Cảnh báo!",
        text: "Bạn đã chắc chắn muốn xóa?",
        icon: "warning",
        showCancelButton: true,
        revertButton: true,
    }).then((result) => {
        if (result.isConfirmed) {
            $("#form-delete-voucher").submit();
        } else {
            $(this).prop("disabled", false);
        }
    });
});
let isDetailOrder = true;

function detailOrder(id) {
    if (!isDetailOrder) {
        return;
    }
    isDetailOrder = false;
    const url = `/admin/order/detail/${id}`;
    $.ajax({
        url: url,
        type: "GET",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        dataType: "JSON",
        success: function (response) {
            $("#order-detail").html(response);
            $("#order-detail").modal("show");
        },
        error: function (error) {
            location.reload();
        },
        complete: function () {
            isDetailOrder = true;
        },
    });
}

let isUpdateOrder = true;

function updateOrder(id) {
    if (!isDetailOrder) {
        return;
    }
    isUpdateOrder = false;
    const url = `/admin/order/update/`;
    Swal.fire({
        title: "Cảnh báo!",
        text: "Cập nhật đơn hàng?",
        icon: "warning",
        showCancelButton: true,
        revertButton: true,
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: "POST",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                data: {
                    id,
                },
                dataType: "JSON",
                success: function (response) {
                    location.reload();
                },
                error: function (error) {
                    location.reload();
                },
                complete: function () {
                    isUpdateOrder = true;
                },
            });
        } else {
            isUpdateOrder = true;
        }
    });
}

function cancelOrder(id) {
    if (!isDetailOrder) {
        return;
    }
    isUpdateOrder = false;
    const url = `/admin/order/cancel/`;
    Swal.fire({
        title: "Cảnh báo!",
        text: "Hủy đơn hàng?",
        icon: "warning",
        showCancelButton: true,
        revertButton: true,
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: "POST",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                data: {
                    id,
                },
                dataType: "JSON",
                success: function (response) {
                    location.reload();
                },
                error: function (error) {
                    location.reload();
                },
                complete: function () {
                    isUpdateOrder = true;
                },
            });
        } else {
            isUpdateOrder = true;
        }
    });
}
