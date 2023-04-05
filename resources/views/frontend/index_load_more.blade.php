@extends('frontend.app')
@section('content')
    <div class="app__container">
        <div class="grid" style="margin-top:120px;">
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
                                                {{ number_format((intval($book->price) / 100) * (100 - intval($book->is_sale ? $book->percent : 0))) }}</span>
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
                                            <span class="home-product-item__sale-off-percent">{{ $book->is_sale ? $book->percent : 0}}%</span>
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
                {{ $books->withQueryString()->links() }}
            </div>
        </div>
        @include('frontend.layout.footer')
    </div>
@endsection
