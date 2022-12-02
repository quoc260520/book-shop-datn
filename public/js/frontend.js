loadImage();
function loadImage() {
    $("#avatar-input").change(function (e) {
        var reader = new FileReader();
        reader.onload = function () {
            var output = document.getElementById("avatar-info");
            output.src = reader.result;
        };
        reader.readAsDataURL(e.target.files[0]);
    });
}

$(".slide").slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplaySpeed: 3000,
    arrow: true,
    dots: true,
});

$("#btn-search").click(function (e) {
    let parent = $(this).parent();
    let keySearch = $(parent.find("input[name=book_name]")).val();
    let historySearch = JSON.parse(localStorage.getItem("historySearch")) || [];
    if (keySearch.trim() && historySearch.indexOf(keySearch) == -1) {
        historySearch.unshift(keySearch);
        if (historySearch.length > 5) {
            historySearch.pop();
        }
        localStorage.setItem("historySearch", JSON.stringify(historySearch));
    }
});
renderHistorySearch();
function renderHistorySearch() {
    let historySearch = JSON.parse(localStorage.getItem("historySearch")) || [];
    let history = historySearch.map((value) => {
        return `<li class="header__search-input-history-item">
    <a href="/search?book_name=${value}">${value}</a>
</li>`;
    });
    $("#list-history").html(history);
}

$(".header__search-input").click(function () {
    $(".header__search-input-history-js").addClass("d-block");
});
$(".header__search-input").blur(function () {
    $(document).click(function (event) {
        if (
            !$(event.target).is(
                ".header__search-input-history,.header__search-input, .header__search-input-history-item"
            )
        ) {
            $(".header__search-input-history-js").removeClass("d-block");
        }
    });
});
