$(".counter").on("input", function () {
    var newVal =
        parseFloat($(this).val()) > 999 ? 999 : parseFloat($(this).val());
    $(this).val(newVal);
});

function deleteItemCart(id) {
    $(this).prop("disabled", true);
    const url = `/delete-cart/${id}`;
    $.ajax({
        url: url,
        type: "DELETE",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: id,
        dataType: "JSON",
        success: function (response) {
            location.reload();
        },
        error: function (error) {},
        complete: function () {},
    });
}
function updateItemCart(id, el) {
    var button = $(el);
    var parent = $(button).parent();
    var oldValue = $(parent).find("#counter").val();

    if (button.attr("data-type") == "increase") {
        var newVal =
            parseFloat(oldValue) + 1 > 999 ? 999 : parseFloat(oldValue) + 1;
    } else {
        if (oldValue > 1) {
            var newVal = parseFloat(oldValue) - 1;
        } else {
            newVal = 1;
        }
    }

    let amount = newVal;
    const url = `/update-cart/${id}`;
    $.ajax({
        url: url,
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: {
            amount: amount,
        },
        dataType: "JSON",
        success: function (response) {
            $(parent).find("#counter").val(newVal);
            location.reload();
        },
        error: function (error) {
            Swal.fire({
                text: error.responseJSON?.message || "Đã có lỗi xảy ra!",
                icon: "warning",
                showCancelButton: true,
                showConfirmButton: false,
                timer: 1500,
            });
        },
        complete: function () {},
    });
}
$("input[name=check_all]").click(function () {
    let check = $('input[name="check_all"]').prop("checked");
    if (check) {
        $('input[id="is_check"]').prop("checked", true);
    } else {
        $('input[id="is_check"]').prop("checked", false);
    }
    checkPayment();
});

$("input[id=is_check]").click(function () {
    checkPayment();
});

function checkPayment() {
    let isDisabled = 0;
    let paymentItems = [];
    $("input[id=is_check]").each(function (index, el) {
        if ($(el).is(":checked")) {
            isDisabled++;
            paymentItems.push($(el).parent().find("input[name=id]").val());
        }
    });
    let code = $("input[name=code]").val();

    const url = `/check-payment`;
    $.ajax({
        url: url,
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: {
            payment_items: paymentItems,
            code: code,
        },
        dataType: "JSON",
        success: function (response) {
            console.log(response);
            $("#total-money").html(
                new Intl.NumberFormat("vi-VN", {
                    style: "currency",
                    currency: "VND",
                })
                    .format(response.intoMoney)
                    .replace("₫", "")
            );
            $("#money").html(
                new Intl.NumberFormat("vi-VN", {
                    style: "currency",
                    currency: "VND",
                })
                    .format(response.total)
                    .replace("₫", "")
            );
            $("#voucher").html(
                "- " +
                    new Intl.NumberFormat("vi-VN", {
                        style: "currency",
                        currency: "VND",
                    })
                        .format(response.voucher)
                        .replace("₫", "")
            );

            $(".btn-apply-payment").prop("disabled", isDisabled ? false : true);
            $(".message-voucher").html("");
            isDisabled = 0;
        },
        error: function (error) {
            $(".message-voucher").html(
                error.status == 422
                    ? error.responseJSON.message
                    : "Không thể áp dụng"
            );
        },
        complete: function () {},
    });
}

$(".input-voucher").on("input", function () {
    $(".btn-apply-voucher").prop(
        "disabled",
        $(this).val().length > 0 ? false : true
    );
});
$(".btn-apply-voucher").click(function () {
    $(this).prop("disabled", true);
    checkPayment();
});

$.ajax({
    url: "https://provinces.open-api.vn/api/p/",
    type: "GET",
    dataType: "JSON",
    success: function (response) {
        $("#province").html(
            response.map(
                (provinces) =>
                    `<option value="${provinces.name}" data-id="${provinces.code}">${provinces.name}</option>`
            )
        );
        const code = response[0].code;
        $.ajax({
            url: `https://provinces.open-api.vn/api/p/${code}?depth=2`,
            type: "GET",
            dataType: "JSON",
            success: function (response) {
                $("#district").html(
                    response.districts.map(
                        (districts) =>
                            `<option value="${districts.name}" data-id="${districts.code}">${districts.name}</option>`
                    )
                );
                const codeDistrict = response.districts[0].code;
                $.ajax({
                    url: `https://provinces.open-api.vn/api/d/${codeDistrict}?depth=2`,
                    type: "GET",
                    dataType: "JSON",
                    success: function (response) {
                        $("#ward").html(
                            response.wards.map(
                                (wards) =>
                                    `<option value="${wards.name}" data-id="${wards.code}">${wards.name}</option>`
                            )
                        );
                    },
                    complete: function () {},
                });
            },
            complete: function () {},
        });
    },
    complete: function () {},
});

$("#province").change(function () {
    const code = $("option:selected", this).attr("data-id");
    $.ajax({
        url: `https://provinces.open-api.vn/api/p/${code}?depth=2`,
        type: "GET",
        dataType: "JSON",
        success: function (response) {
            $("#district").html(
                response.districts.map(
                    (districts) =>
                        `<option value="${districts.name}" data-id="${districts.code}">${districts.name}</option>`
                )
            );
        },
        complete: function () {},
    });
});

$("#district").change(function () {
    const code = $("option:selected", this).attr("data-id");
    $.ajax({
        url: `https://provinces.open-api.vn/api/d/${code}?depth=2`,
        type: "GET",
        dataType: "JSON",
        success: function (response) {
            $("#ward").html(
                response.wards.map(
                    (wards) =>
                        `<option value="${wards.name}" data-id="${wards.code}">${wards.name}</option>`
                )
            );
        },
        complete: function () {},
    });
});
