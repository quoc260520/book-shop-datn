$(document).on({
    ajaxStart: function () {
        $("body").addClass("loading");
    },
    ajaxStop: function () {
        $("body").removeClass("loading");
    },
});

$(window).on("beforeunload", function () {
    $("body").addClass("loading");
});
$(window).on("unload", function () {
    $("body").removeClass("loading");
});

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

let sliderLinks = document.querySelectorAll(".category-item");
let contentPopup = document.querySelector(".category-child");
if (sliderLinks && contentPopup) {
    for (let sliderItem of sliderLinks) {
        sliderItem.onmouseover = function () {
            contentPopup.classList.add("d-flex");
            contentPopup.classList.remove("d-none");
            let categoryName = this.querySelector(
                "a.catrgory-item__link"
            ).getAttribute("value");
            createClass(categoryName, data);
        };
        sliderItem.onmouseout = function () {
            contentPopup.classList.remove("d-flex");
            contentPopup.classList.add("d-none");
        };
        contentPopup.onmouseover = function () {
            this.classList.add("d-flex");
            this.classList.remove("d-none");
        };
        contentPopup.onmouseout = function () {
            this.classList.remove("d-flex");
            this.classList.add("d-none");
        };
    }
}

const data = JSON.parse(localStorage.getItem("Category"));

async function createClass(categoryParent, data) {
    let category = data.filter((value) => {
        return value.parent_id == categoryParent;
    });
    let categoryDetailList = document.querySelector(".category-child");
    let htmls = category?.map((value) => {
        let childList = "";
        childList = childList + renderCategoryListChild(data, value);
        return `<div class="category_first-child col">
    <a class="catrgory-item__link" href="/search?category_id=${value.id}" value="${value.id}">${value.category_name}</a>
    <ul class="list-category-child p-0">
        ${childList}
    </ul>
</div>`;
    });
    var html = htmls?.join("");
    categoryDetailList.innerHTML = html;
}

function renderCategoryListChild(data, categoryParent) {
    return data
        .filter((item) => {
            return item.parent_id == categoryParent.id;
        })
        ?.map((child) => {
            return (
                `<li class="list-category-child-item">
    <a class="catrgory-item__link fs-4" href="/search?category_id=${child.id}"
        value="${child.id}">${child.category_name}</a>
</li>` + renderCategoryListChild(data, child)
            );
        });
}
