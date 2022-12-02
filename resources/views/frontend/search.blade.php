@extends('frontend.app')
@section('content')
    <div class="app__container">
        <div class="grid">
            <div class="breadcrumb pt-3" style="margin-top: 130px;">{!! Breadcrumbs::render() !!}</div>

            <div class="grid__row row">
                @if (count($books ?? []))
                    <div class="grid__column-12">
                        <div class="home-filter d-flex flex-sm-row flex-column align-items-center">
                            @php
                                $flagMatchShow = preg_match('/show=12/', Request::getRequestUri()) || preg_match('/show=24/', Request::getRequestUri()) || preg_match('/show=48/', Request::getRequestUri());
                                $flagMatchSort = preg_match('/sort=asc/', Request::getRequestUri()) || preg_match('/sort=desc/', Request::getRequestUri());
                            @endphp
                            <span class="home-filter__lable mt-2 font-weight-bold">Sắp xếp theo: </span>
                            <div class="mt-2 ms-5">
                                <select class="select-search" onChange="window.location.href=this.value">
                                    <option value="">
                                        Giá bán
                                    </option>
                                    <option
                                        {{ ($flagMatchSort
                                            ? str_replace(['sort=asc', 'sort=desc'], 'sort=asc', Request::getRequestUri())
                                            : Request::getRequestUri() . '&sort=asc') == Request::getRequestUri()
                                            ? 'selected'
                                            : '' }}
                                        value="{{ $flagMatchSort
                                            ? str_replace(['sort=asc', 'sort=desc'], 'sort=asc', Request::getRequestUri())
                                            : Request::getRequestUri() . '&sort=asc' }}">
                                        Giá: Thấp đến cao
                                    </option>
                                    <option
                                        {{ ($flagMatchSort
                                            ? str_replace(['sort=asc', 'sort=desc'], 'sort=desc', Request::getRequestUri())
                                            : Request::getRequestUri() . '&sort=desc') == Request::getRequestUri()
                                            ? 'selected'
                                            : '' }}
                                        value="{{ $flagMatchSort
                                            ? str_replace(['sort=asc', 'sort=desc'], 'sort=desc', Request::getRequestUri())
                                            : Request::getRequestUri() . '&sort=desc' }}">
                                        Giá: Cao đến thấp
                                    </option>
                                </select>
                            </div>
                            <div class="mt-2 ms-5">
                                <select class="select-search" onChange="window.location.href=this.value">
                                    <option value="">
                                        Số sản phẩm
                                    </option>
                                    <option
                                        {{ ($flagMatchShow
                                            ? str_replace(['show=12', 'show=24', 'show=48'], 'show=48', Request::getRequestUri())
                                            : Request::getRequestUri() . '&show=48') == Request::getRequestUri()
                                            ? 'selected'
                                            : '' }}
                                        value="{{ $flagMatchShow
                                            ? str_replace(['show=12', 'show=24', 'show=48'], 'show=48', Request::getRequestUri())
                                            : Request::getRequestUri() . '&show=48' }}">
                                        48 sản phẩm
                                    </option>
                                    <option
                                        {{ ($flagMatchShow
                                            ? str_replace(['show=12', 'show=24', 'show=48'], 'show=24', Request::getRequestUri())
                                            : Request::getRequestUri() . '&show=24') == Request::getRequestUri()
                                            ? 'selected'
                                            : '' }}
                                        value="{{ $flagMatchShow
                                            ? str_replace(['show=12', 'show=24', 'show=48'], 'show=24', Request::getRequestUri())
                                            : Request::getRequestUri() . '&show=24' }}">
                                        24 sản phẩm
                                    </option>
                                    <option
                                        {{ ($flagMatchShow
                                            ? str_replace(['show=12', 'show=24', 'show=48'], 'show=12', Request::getRequestUri())
                                            : Request::getRequestUri() . '&show=12') == Request::getRequestUri()
                                            ? 'selected'
                                            : '' }}
                                        value="{{ $flagMatchShow
                                            ? str_replace(['show=12', 'show=24', 'show=48'], 'show=12', Request::getRequestUri())
                                            : Request::getRequestUri() . '&show=12' }}">
                                        12 sản phẩm
                                    </option>
                                </select>
                            </div>

                        </div>
                        <div class="home-product">
                            <div class="grid__row d-flex flex-row flex-wrap">
                                <!-- Product item -->
                                @foreach ($books as $book)
                                    <div class="col-2 product-wrap">
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

                        <div class="pagination-book d-flex justify-content-center mt-5 mb-5">
                            {{ $books->withQueryString()->links() }}
                        </div>
                    </div>
                @else
                    <div class="no-result-book bg-white p-4 pt-5">
                        <div class="border border-warning p-3 mb-5" style="background-color:#FAFAEC;">
                            Không có sản phẩm nào phù hợp với từ khóa của bạn.
                        </div>
                    </div>
                @endif
            </div>
        </div>
        @include('frontend.layout.footer')
    </div>
@endsection
