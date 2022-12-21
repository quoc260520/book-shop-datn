@extends('frontend.app')
@section('content')
    <div class="grid" style="margin-top:100px;">
        <div class="grid__row app__content">
            <div class="grid__column-2">
                <nav class="category">
                    <h3 class="category__heading pb-4 text-white rounded" style="background-color:#505050;">Danh mục</h3>
                    <ul class="category-list">
                        @foreach ($categorys ?? [] as $category)
                            <li class="category-item">
                                <a class="catrgory-item__link" href="/search?category_id={{ $category->id }}"
                                    value="{{ $category->id }}">{{ $category->category_name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </nav>
            </div>
            <div class="grid__column-10 pe-0">
                <div class="category-child shadow-lg p-5 row row-cols-5 m-0 d-none">
                </div>
                @include('frontend.layout.slider')
            </div>
        </div>
    </div>
    <div class="app__container">
        <div class="grid">
            <div class="grid__row app__content shadow p-2 pb-5 mb-5 bg-white rounded">
                <div class="text-uppercase fs-2 text mb-2 w-100 p-2 ps-3 fw-bold"
                    style="background:#CFE2FF;margin:-5px;margin-right: -20px;">Sách mới</div>
                <div class="grid__column-12 w-100">
                    <div class="home-product">
                        <div class="grid__row d-flex flex-row flex-wrap">
                            @foreach ($bookNews as $bookNew)
                                <div class="col-2 product-wrap mb-3">
                                    <div class="home-product-item">
                                        <a class="text-decoration-none" href="{{ route('book.detail', $bookNew->id) }}">
                                            <div class="home-product-item__img">
                                                <img alt="" class="image-book"
                                                    src="{{ get_image_book($bookNew->image[0] ?? '') }}">
                                            </div>

                                            <h4 class="home-product-item__name">
                                                {{ $bookNew->book_name }}
                                            </h4>
                                        </a>
                                        <div class="home-product-item__price">
                                            <span class="home-product-item__price-current">
                                                {{ number_format((intval($bookNew->price) / 100) * (100 - intval($bookNew->percent))) }}</span>
                                            @if ($bookNew->is_sale)
                                                <div class="home-product-item__price-old">
                                                    {{ number_format($bookNew->price) }}
                                                </div>
                                            @endif
                                        </div>
                                        @php
                                            if (count($bookNew->reviews)) {
                                                $totalRate[$bookNew->id] = array_reduce(
                                                    $bookNew->reviews->toArray(),
                                                    function ($total, $item) {
                                                        return $total + intval($item['star']);
                                                    },
                                                    0,
                                                );
                                            }
                                            $avgRate = $totalRate[$bookNew->id] ?? false ? round($totalRate[$bookNew->id] / (count($bookNew->reviews) ? count($bookNew->reviews) : 1), 1) : 0;
                                        @endphp
                                        <div class="home-product-item__action align-items-center">
                                            <div
                                                class="home-product-item__rating w-100 d-flex flex-row justify-content-between align-items-center">
                                                <div class="home-product-item__star--gold">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if (round($avgRate - 0.25) >= $i)
                                                            <i class='fa-solid fa-star'></i>
                                                        @elseif (round($avgRate + 0.25) >= $i)
                                                            <i class="fa-solid fa-star-half-stroke"></i>
                                                        @else
                                                            <i class="fa-regular fa-star"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <div class="home-product-item__like">
                                                    <div class="home-product-item__sold">
                                                        {{ count($bookNew->orderDetails) }} đã bán</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="home-product-item__origin">
                                            <span class="home-product-item__brand">Tác giả:
                                                {{ $bookNew->author->name }}</span>
                                        </div>
                                        <div class="home-product-item__favourite">
                                            <i class="fas fa-check"></i>
                                            <span>Yêu thích</span>
                                        </div>
                                        <div class="home-product-item__sale-off">
                                            <span
                                                class="home-product-item__sale-off-percent">{{ $bookNew->percent }}%</span>
                                            <span class="home-product-item__sale-off-lable">Giảm</span>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid__row app__content shadow p-2 pb-5 mb-5 bg-white rounded">
                <div class="text-uppercase fs-2 text mb-2 w-100 p-2 ps-3 fw-bold"
                    style="background:#CFE2FF;margin:-5px;margin-right: -20px;">Sách khuyến mãi</div>
                <div class="grid__column-12 w-100">
                    <div class="home-product">
                        <div class="grid__row d-flex flex-row flex-wrap">
                            @foreach ($bookSales ?? [] as $bookSale)
                                <div class="col-2 product-wrap mb-3">
                                    <div class="home-product-item">
                                        <a class="text-decoration-none"
                                            href="{{ route('book.detail', $bookSale->id) }}">
                                            <div class="home-product-item__img">
                                                <img alt="" class="image-book"
                                                    src="{{ get_image_book($bookSale->image[0] ?? '') }}">
                                            </div>

                                            <h4 class="home-product-item__name">
                                                {{ $bookSale->book_name }}
                                            </h4>
                                        </a>
                                        <div class="home-product-item__price">
                                            <span class="home-product-item__price-current">
                                                {{ number_format((intval($bookSale->price) / 100) * (100 - intval($bookSale->percent))) }}</span>
                                            @if ($bookSale->is_sale)
                                                <div class="home-product-item__price-old">
                                                    {{ number_format($bookSale->price) }}
                                                </div>
                                            @endif
                                        </div>
                                        @php
                                            if (count($bookSale->reviews)) {
                                                $totalRate[$bookSale->id] = array_reduce(
                                                    $bookSale->reviews->toArray(),
                                                    function ($total, $item) {
                                                        return $total + intval($item['star']);
                                                    },
                                                    0,
                                                );
                                            }
                                            $avgRate = $totalRate[$bookSale->id] ?? false ? round($totalRate[$bookSale->id] / (count($bookSale->reviews) ? count($bookSale->reviews) : 1), 1) : 0;
                                        @endphp
                                        <div class="home-product-item__action align-items-center">
                                            <div
                                                class="home-product-item__rating w-100 d-flex flex-row justify-content-between align-items-center">
                                                <div class="home-product-item__star--gold">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if (round($avgRate - 0.25) >= $i)
                                                            <i class='fa-solid fa-star'></i>
                                                        @elseif (round($avgRate + 0.25) >= $i)
                                                            <i class="fa-solid fa-star-half-stroke"></i>
                                                        @else
                                                            <i class="fa-regular fa-star"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <div class="home-product-item__like">
                                                    <div class="home-product-item__sold">
                                                        {{ count($bookSale->orderDetails) }} đã bán</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="home-product-item__origin">
                                            <span class="home-product-item__brand">Tác giả:
                                                {{ $bookSale->author->name }}</span>
                                        </div>
                                        <div class="home-product-item__favourite">
                                            <i class="fas fa-check"></i>
                                            <span>Yêu thích</span>
                                        </div>
                                        <div class="home-product-item__sale-off">
                                            <span
                                                class="home-product-item__sale-off-percent">{{ $bookSale->percent }}%</span>
                                            <span class="home-product-item__sale-off-lable">Giảm</span>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid__row app__content shadow p-2 pb-5 mb-5 bg-white rounded">
                <div class="text-uppercase fs-2 text mb-2 w-100 p-2 ps-3 fw-bold"
                    style="background:#CFE2FF;margin:-5px;margin-right: -20px;">Sách bán chạy</div>
                <div class="grid__column-12 w-100">
                    <div class="home-product">
                        <div class="grid__row d-flex flex-row flex-wrap">
                            @foreach ($bookBestSelling as $bookBestSell)
                                <div class="col-2 product-wrap mb-3">
                                    <div class="home-product-item">
                                        <a class="text-decoration-none"
                                            href="{{ route('book.detail', $bookBestSell->id) }}">
                                            <div class="home-product-item__img">
                                                <img alt="" class="image-book"
                                                    src="{{ get_image_book($bookBestSell->image[0] ?? '') }}">
                                            </div>

                                            <h4 class="home-product-item__name">
                                                {{ $bookBestSell->book_name }}
                                            </h4>
                                        </a>
                                        <div class="home-product-item__price">
                                            <span class="home-product-item__price-current">
                                                {{ number_format((intval($bookBestSell->price) / 100) * (100 - intval($bookBestSell->percent))) }}</span>
                                            @if ($bookBestSell->is_sale)
                                                <div class="home-product-item__price-old">
                                                    {{ number_format($bookBestSell->price) }}
                                                </div>
                                            @endif
                                        </div>
                                        @php
                                            if (count($bookBestSell->reviews)) {
                                                $totalRate[$bookBestSell->id] = array_reduce(
                                                    $bookBestSell->reviews->toArray(),
                                                    function ($total, $item) {
                                                        return $total + intval($item['star']);
                                                    },
                                                    0,
                                                );
                                            }
                                            $avgRate = $totalRate[$bookBestSell->id] ?? false ? round($totalRate[$bookBestSell->id] / (count($bookBestSell->reviews) ? count($bookBestSell->reviews) : 1), 1) : 0;
                                        @endphp
                                        <div class="home-product-item__action align-items-center">
                                            <div
                                                class="home-product-item__rating w-100 d-flex flex-row justify-content-between align-items-center">
                                                <div class="home-product-item__star--gold">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if (round($avgRate - 0.25) >= $i)
                                                            <i class='fa-solid fa-star'></i>
                                                        @elseif (round($avgRate + 0.25) >= $i)
                                                            <i class="fa-solid fa-star-half-stroke"></i>
                                                        @else
                                                            <i class="fa-regular fa-star"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <div class="home-product-item__like">
                                                    <div class="home-product-item__sold">
                                                        {{ count($bookBestSell->orderDetails) }} đã bán</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="home-product-item__origin">
                                            <span class="home-product-item__brand">Tác giả:
                                                {{ $bookBestSell->author->name }}</span>
                                        </div>
                                        <div class="home-product-item__favourite">
                                            <i class="fas fa-check"></i>
                                            <span>Yêu thích</span>
                                        </div>
                                        <div class="home-product-item__sale-off">
                                            <span
                                                class="home-product-item__sale-off-percent">{{ $bookBestSell->percent }}%</span>
                                            <span class="home-product-item__sale-off-lable">Giảm</span>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid__row app__content shadow p-2 pt-5 pb-5 mb-5 bg-white rounded">
                <div class="grid__column-12 w-100">
                    <div class="home-product">
                        <div class="grid__row d-flex flex-row flex-wrap">
                            @foreach ($books as $book)
                                <div class="col-2 product-wrap mb-3">
                                    <div class="home-product-item">
                                        <a class="text-decoration-none" href="{{ route('book.detail', $book->id) }}">
                                            <div class="home-product-item__img">
                                                <img alt="" class="image-book"
                                                    src="{{ get_image_book($book->image[0] ?? '') }}">
                                            </div>

                                            <h4 class="home-product-item__name">
                                                {{ $book->book_name }}
                                            </h4>
                                        </a>
                                        <div class="home-product-item__price">
                                            <span class="home-product-item__price-current">
                                                {{ number_format((intval($book->price) / 100) * (100 - intval($book->percent))) }}</span>
                                            @if ($book->is_sale)
                                                <div class="home-product-item__price-old">
                                                    {{ number_format($book->price) }}
                                                </div>
                                            @endif
                                        </div>
                                        @php
                                            if (count($book->reviews)) {
                                                $totalRate[$book->id] = array_reduce(
                                                    $book->reviews->toArray(),
                                                    function ($total, $item) {
                                                        return $total + intval($item['star']);
                                                    },
                                                    0,
                                                );
                                            }
                                            $avgRate = $totalRate[$book->id] ?? false ? round($totalRate[$book->id] / (count($book->reviews) ? count($book->reviews) : 1), 1) : 0;
                                        @endphp
                                        <div class="home-product-item__action align-items-center">
                                            <div
                                                class="home-product-item__rating w-100 d-flex flex-row justify-content-between align-items-center">
                                                <div class="home-product-item__star--gold">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if (round($avgRate - 0.25) >= $i)
                                                            <i class='fa-solid fa-star'></i>
                                                        @elseif (round($avgRate + 0.25) >= $i)
                                                            <i class="fa-solid fa-star-half-stroke"></i>
                                                        @else
                                                            <i class="fa-regular fa-star"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <div class="home-product-item__like">
                                                    <div class="home-product-item__sold">
                                                        {{ count($book->orderDetails) }} đã bán</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="home-product-item__origin">
                                            <span class="home-product-item__brand">Tác giả:
                                                {{ $book->author->name }}</span>
                                        </div>
                                        <div class="home-product-item__favourite">
                                            <i class="fas fa-check"></i>
                                            <span>Yêu thích</span>
                                        </div>
                                        <div class="home-product-item__sale-off">
                                            <span class="home-product-item__sale-off-percent">{{ $book->percent }}%</span>
                                            <span class="home-product-item__sale-off-lable">Giảm</span>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <a class="btn btn-primary fs-3 text load-more mb-5" href="{{ route('index-load-more') }}">Xem thêm</a>
            </div>
        </div>
        @include('frontend.layout.footer')
    </div>
@endsection
@push('after-scripts')
<script>
    $.ajax({
        url: `/all-category`,
        type: "GET",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        dataType: "JSON",
        success: function(response) {
            localStorage.setItem("Category", JSON.stringify(response));
        },
    });
</script>
@endpush
