@extends('frontend.app')

@section('content')
    <div class="app app__container">
        @include('frontend.layout.topbar')
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
                <div class="grid__row app__content">
                    <div class="grid__column-12">
                        <div class="home-filter d-flex flex-sm-row flex-column align-items-start">
                            <span class="home-filter__lable mt-2">Sắp xếp theo</span>
                            <button class="btn home-filter__btn mt-2">Phổ biến</button>
                            <button class="btn home-filter__btn btn--primary mt-2">Mới nhất</button>
                            <button class="btn home-filter__btn mt-2">Bán chạy</button>

                            <div class="select-input mt-2">
                                <span class="select-input__lable">Giá</span>
                                <i class="select-input__icon fas fa-angle-down"></i>
                                <!-- List-option -->
                                <ul class="select-input__list">
                                    <li class="select-input__item">
                                        <a class="select-input__link" href="">Giá: Thấp đến cao</a>
                                    </li>
                                    <li class="select-input__item">
                                        <a class="select-input__link" href="">Giá: Cao đến thấp</a>
                                    </li>
                                </ul>
                            </div>

                        </div>

                        <div class="home-product ">
                            <div class="grid__row d-flex flex-wrap">
                                <!-- Product item -->
                                @foreach ($books as $book)
                                    <div class="grid__column-2-4 product-wrap">
                                        <a class="home-product-item" href="#">
                                            <div class="home-product-item__img">
                                                <img alt="" class="image-book"
                                                    src="{{ get_image_book($book->image[0] ?? '') }}">
                                            </div>
                                            <h4 class="home-product-item__name">
                                                {{ $book->book_name }}
                                            </h4>
                                            <div class="home-product-item__price">
                                                <span class="home-product-item__price-old">{{ $book->price }}</span>
                                                <span class="home-product-item__price-current">{{ $book->price }}</span>
                                            </div>
                                            <div class="home-product-item__action">
                                                <span class="home-product-item__like home-product-item__like--liked">
                                                    <i class="home-product-item__like-icon-fill fas fa-heart"></i>
                                                    <i class="home-product-item__like-icon-empty far fa-heart"></i>
                                                </span>
                                                <div class="home-product-item__rating">
                                                    <i class="home-product-item__star--gold fas fa-star"></i>
                                                    <i class="home-product-item__star--gold fas fa-star"></i>
                                                    <i class="home-product-item__star--gold fas fa-star"></i>
                                                    <i class="home-product-item__star--gold fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </div>
                                                <span class="home-product-item__sold">88 đã bán</span>
                                            </div>
                                            <div class="home-product-item__origin">
                                                <span class="home-product-item__brand">Mlb</span>
                                                <span class="home-product-item__origin-name">Hàn Quốc</span>
                                            </div>
                                            <div class="home-product-item__favourite">
                                                <i class="fas fa-check"></i>
                                                <span>Yêu thích</span>
                                            </div>
                                            <div class="home-product-item__sale-off">
                                                <span class="home-product-item__sale-off-percent">10%</span>
                                                <span class="home-product-item__sale-off-lable">Giảm</span>
                                            </div>
                                        </a>

                                    </div>
                                @endforeach
                            </div>


                        </div>

                        <ul class="home-product__pagination pagination">
                            <li class="pagination-item">
                                <a class="pagination-item__link" href="">
                                    <i class="pagination-icon fas fa-angle-left"></i>
                                </a>
                            </li>

                            <li class="pagination-item pagination-item--active">
                                <a class="pagination-item__link" href="">1</a>
                            </li>


                            <li class="pagination-item">
                                <a class="pagination-item__link" href="">2</a>
                            </li>

                            <li class="pagination-item">
                                <a class="pagination-item__link" href="">3</a>
                            </li>

                            <li class="pagination-item">
                                <a class="pagination-item__link" href="">4</a>
                            </li>

                            <li class="pagination-item">
                                <a class="pagination-item__link" href="">5</a>
                            </li>

                            <li class="pagination-item">
                                <a class="pagination-item__link" href="">...</a>
                            </li>

                            <li class="pagination-item">
                                <a class="pagination-item__link" href="">15</a>
                            </li>



                            <li class="pagination-item">
                                <a class="pagination-item__link" href="">
                                    <i class="pagination-icon fas fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                        <div class="d-flex justify-content-end">
                            {{ $books->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('frontend.layout.footer')
    </div>
@endsection
