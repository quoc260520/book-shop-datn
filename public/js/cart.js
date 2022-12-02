$(".btn-amount").on("click", function (e) {
    var button = $(this);
    var parent = $(button).parent();
    var oldValue = $(parent).find("#counter").val();

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

    $(parent).find("#counter").val(newVal);
});
$(".counter").on("input", function () {
    var newVal =
        parseFloat($(this).val()) > 999 ? 999 : parseFloat($(this).val());
    $(this).val(newVal);
});

$('input[name="check_all"]').change(function () {
    let check = $('input[name="check_all"]').prop("checked");
    if (check) {
        $('input[name="is_check"]').prop("checked", true);
    } else {
        $('input[name="is_check"]').prop("checked", false);
    }
});
