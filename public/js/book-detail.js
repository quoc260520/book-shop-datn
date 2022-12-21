$(".coupon-wrap").slick({
    slidesToShow: countVouchers > 3 ? 3 : countVouchers,
    slidesToScroll: 1,
});
$(document).ready(function () {
    $(".btn-add-to-cart").click(function () {
        $(this).prop("disabled", true);
        vm = this;
        let url = $(this).data("href");
        let data = {
            amount: $("#counter").val(),
        };
        $.ajax({
            url: url,
            type: "GET",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: data,
            dataType: "JSON",
            success: function (response) {
                location.reload();
            },
            error: function (error) {
                let message =
                    error.responseJSON.message == "over"
                        ? "Số lượng sách không đủ!"
                        : "Đã có lỗi xảy ra!";
                $("#message")
                    .html(`<div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                     ${message}
                </div>`);
            },
            complete: function () {
                $(vm).prop("disabled", false);
            },
        });
    });

    $(".btn-amount").on("click", function (e) {
        var button = $(this);
        var oldValue = $("#counter").val();

        if (button.attr("data-type") == "increase") {
            var newVal =
                parseFloat(oldValue) + 1 > 999 ? 999 : parseFloat(oldValue) + 1;
        } else {
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $("#counter").val(newVal);
        let id = $("input[name=book_id]").val();
        let vm = this;
        $.ajax({
            url: `/book/check-amount/${id}`,
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                amount: $("#counter").val(),
            },
            dataType: "JSON",
            success: function (response) {
                $(".btn-add-to-cart, .btn-shopping-now").prop(
                    "disabled",
                    false
                );
            },
            error: function (error) {
                $(".btn-add-to-cart, .btn-shopping-now").prop("disabled", true);
                let message =
                    error.responseJSON.message == "over"
                        ? "Số lượng sách không đủ!"
                        : "Đã có lỗi xảy ra!";
                $("#message")
                    .html(`<div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    ${message}
                </div>`);
            },
            complete: function () {
                $(vm).prop("disabled", false);
            },
        });
    });
    $("#counter").on("input", function () {
        var newVal =
            parseFloat($("#counter").val()) > 999
                ? 999
                : parseFloat($("#counter").val());
        $("#counter").val(newVal);
    });
});

$(".star-ratting").click(function () {
    let id = $(this).attr("id").slice(5, 6);
    console.log(id);
    $(".star-ratting").removeClass("star-ratting");
    for (let i = 1; i <= id; i++) {
        $("#star-" + i).addClass("star-ratting");
    }
});

$("#btn-comment").click(function () {
    $(this).prop("disabled", true);
    let vm = this;
    let id = $("input[name=book_id]").val();
    let star = $(".star-ratting").length;
    let content = $("#content").val();
    $.ajax({
        url: `/book/comment/${id}`,
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: {
            star: star,
            content: content,
        },
        dataType: "JSON",
        success: function (response) {},
        error: function (error) {},
        complete: function () {
            location.reload();
            $(vm).prop("disabled", false);
        },
    });
});
