@extends('frontend.app')
@section('content')
    <div class="grid" style="margin-top:100px;">
        <div class="grid__row app__content">
            <div class="grid__column-2">
                <nav class="category">
                    <h3 class="category__heading">Danh mục</h3>
                    <ul class="category-list">
                        <li class="category-item category-item--active">
                            <a class="catrgory-item__link" href="#">Sản phẩm</a>
                        </li>
                        <li class="category-item ">
                            <a class="catrgory-item__link" href="#">Trang điểm</a>
                        </li>
                        <li class="category-item">
                            <a class="catrgory-item__link" href="#">Quần áo</a>
                        </li>
                        <li class="category-item">
                            <a class="catrgory-item__link" href="#">Giày dép</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="grid__column-10 pe-0">
                @include('frontend.layout.slider')
            </div>
        </div>
    </div>
    <div class="app__container">
        <div class="grid">
            <div class="grid__row app__content shadow p-2 pt-5 pb-5 mb-5 bg-white rounded">
                <div class="grid__column-12">
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
                                            <span class="home-product-item__price-current">{{ $book->price }}</span>
                                            @if ($book->is_sale)
                                                <div class="home-product-item__price-old">
                                                    {{ number_format((intval($book->price) / 100) * (100 - intval($book->percent))) }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="home-product-item__action align-items-center">
                                            <div
                                                class="home-product-item__rating w-100 d-flex flex-row justify-content-between align-items-center">
                                                <div class="">
                                                    <i class="home-product-item__star--gold fas fa-star"></i>
                                                    <i class="home-product-item__star--gold fas fa-star"></i>
                                                    <i class="home-product-item__star--gold fas fa-star"></i>
                                                    <i class="home-product-item__star--gold fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
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
                                            <span
                                                class="home-product-item__sale-off-percent">{{ $book->percent }}%</span>
                                            <span class="home-product-item__sale-off-lable">Giảm</span>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        {{ $books->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
        @include('frontend.layout.footer')
    </div>
@endsection
