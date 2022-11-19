function getUpdate(id, e) {
    $(e).prop("disabled", true);
    const url = `/admin/slider/update/${id}`;
    $.ajax({
        url: url,
        type: "GET",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: id,
        dataType: "JSON",
        success: function (response) {
            $("#slider-detail").html(response);
            $("#slider-detail").modal("show");
        },
        error: function (error) {},
        complete: function () {
            $(e).prop("disabled", false);
        },
    });
}

$(document).on("click", "#submit-update-slider", function () {
    $("#submit-update-slider").click(function () {
        $(this).prop("disabled", true);
        const url = `/admin/slider/update`;
        var fd = new FormData(document.querySelector("#update_slider"));
        $.ajax({
            url: url,
            type: "POST",
            processData: false,
            contentType: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: fd,
            dataType: "JSON",
            success: function (response) {
                location.reload();
            },
            error: function (error) {
                location.reload();
            },
            complete: function () {
                $(this).prop("disabled", false);
            },
        });
    });
});
