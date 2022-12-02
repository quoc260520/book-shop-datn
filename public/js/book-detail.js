$(".coupon-wrap").slick({
    slidesToShow: countVouchers > 3 ? 3 : countVouchers,
    slidesToScroll: 1,
});
$(document).ready(function () {
    $(".btn-add-to-cart").click(function () {
        $(this).prop("disabled", true);
        vm = this;
        let url = $(this).data("href");
        data = {
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
                $("#message")
                    .html(`<div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    Đã có lỗi xảy ra!
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
        $.ajax({
            url: url,
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: data,
            dataType: "JSON",
            success: function (response) {
                location.reload();
            },
            error: function (error) {
                $("#message")
                    .html(`<div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    Đã có lỗi xảy ra!
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
