@extends('frontend.app')
@section('content')
    <div class="grid">
        <div class="pt-3">{!! Breadcrumbs::render() !!}</div>
        <div id="message">

        </div>
        <div class="content-book cart bg-white rounded">
            <div class="content-info">
                <div class="content-info col-12 d-flex flex-sm-row flex-column">
                    <div class="img-wrapper col-6 d-flex align-items-center justify-content-around">
                        <div class="img-book-wrap col-4">
                            @foreach ($book->image ?? [] as $image)
                                <img alt="" class="img-books" src="{{ get_image_book($image) }}">
                            @endforeach
                        </div>
                        <div class="col-8 ml-5">
                            <img alt="" class="img-book" class="" src="{{ get_image_book($book->image[0]) }}">
                        </div>
                    </div>
                    <div class="info-wrapper col-6">
                        <div class="info-name">
                            {{ $book->book_name }}
                        </div>
                        <div class="multiple-info d-flex flex-sm-row flex-wrap">
                            <div class="info-wrap d-flex flex-row">
                                <div class="label-info">
                                    Nhà xuất bản:
                                </div>
                                <div class="info">
                                    {{ $book->publisher->publisher_name }}
                                </div>
                            </div>
                            <div class="info-wrap d-flex flex-row">
                                <div class="label-info">
                                    Tác giả:
                                </div>
                                <div class="info">
                                    {{ $book->author->name }}
                                </div>
                            </div>
                            <div class="info-wrap d-flex flex-row">
                                <div class="label-info">
                                    Thể loại:
                                </div>
                                <div class="info">
                                    {{ $book->category->category_name }}
                                </div>
                            </div>
                            <div class="info-wrap d-flex flex-row">
                                <div class="label-info">
                                    Năm xuất bản:
                                </div>
                                <div class="info">
                                    {{ $book->year_publish }}
                                </div>
                            </div>

                        </div>
                        <div class="price-wrap mt-3 d-flex flex-row align-items-center">
                            <div class="price">
                                {{ number_format($book->price) }} đ
                            </div>
                            @if ($book->is_sale)
                                <div class="price-sale">
                                    {{ number_format((intval($book->price) / 100) * (100 - intval($book->percent))) }}
                                </div>
                                <div class="percent ms-3"> -{{ $book->percent }} %</div>
                            @endif
                        </div>
                        <div class="amount-wrap mt-3 d-flex flex-row align-items-center">
                            <div class="label-amount col-3">
                                Số lượng:
                            </div>
                            <div class="custom-input d-flex flex-row col-9">
                                <span class="btn-amount btn-decrease order-0" data-type="decrease"><i
                                        class="fa-solid fa-minus"></i></span>
                                <input class="order-1" id="counter" min="1" step="1" type="number"
                                    value="1">
                                <span class="btn-amount btn-increase order-2" data-type="increase"><i
                                        class="fa-solid fa-plus"></i></span>
                            </div>

                        </div>
                        <div class="add-to-cart d-flex flex-row mt-5">
                            <button {{ $book->amount == 0 ? 'disabled' : '' }}
                                class="btn-add-to-cart d-flex flex-row align-items-center justify-content-center"
                                data-href="{{ route('add-cart', $book->id) }}" type="button">
                                <i class="fa-solid fa-cart-shopping"></i>
                                <div class="ml-2">Thêm vào giỏ hàng</div>
                            </button>
                            <button {{ $book->amount == 0 ? 'disabled' : '' }} class="btn-shopping-now" type="button">
                                Mua ngay
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (count($vouchers ?? []))
            <div class="content-book cart bg-white rounded mt-4 mb-5 p-5">
                <div class="d-flex flex-row d-flex flex-row align-items-center header-coupon">
                    <div class="">{!! file_get_contents(public_path('images/app/ico_coupon_red.svg')) !!}</div>
                    <div class="ml-2 label-coupon">Ưu đãi liên quan</div>
                </div>
                <div class="coupon-wrap d-flex flex-row mt-3 pt-5">
                    @foreach ($vouchers as $index => $voucher)
                        <div class="coupon-container shadow-lg rounded mr-3">
                            <div class="coupon d-flex flex-row">
                                <div class="coupon-left">
                                    <div class="coupon-left-icon">{!! file_get_contents(public_path('images/app/ico_promotion.svg')) !!}</div>
                                    <div class="circle circle-top-right"></div>
                                    <div class="circle circle-bottom-right"></div>
                                </div>
                                <div class="coupon-con d-flex flex-column justify-content-between">
                                    <div class="coupon-code">{{ $voucher->code }}</div>
                                    <div class="coupon-info">Giảm giá {{ $voucher->percent }} %</div>
                                    <div class="coupon-time">
                                        Thời hạn: {{ $voucher->end_date }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        <div class="content-book cart bg-white rounded mt-4 mb-5 p-5">
            <div class="d-flex flex-row align-items-center header-coupon">
                <div class="ml-2 label-coupon">Thông tin sản phẩm</div>
            </div>
            <div class="d-flex flex-column align-items-start more-info">
                <div class="table-responsive">
                    <table class="table table-info-book">
                        <thead>
                            <tr>
                                <th class="col-2 no-wrap-keep" scope="col"></th>
                                <th class="col-10 no-wrap-keep" scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="label-info">Mã hàng</td>
                                <td>{{ str_pad($book->id, 8, '0', STR_PAD_LEFT) }}</td>
                            </tr>
                            <tr>
                                <td class="label-info">Tên nhà xuất bản</td>
                                <td>{{ $book->publisher->publisher_name }}</td>
                            </tr>
                            <tr>
                                <td class="label-info">Tác giả</td>
                                <td>{{ $book->author->name }}</td>
                            </tr>
                            <tr>
                                <td class="label-info">Năm xuất bản</td>
                                <td>{{ $book->year_publish }}</td>
                            </tr>
                            <tr>
                                <td colspan="2">{!! $book->describe !!}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="content-book cart bg-white rounded mt-4 mb-5 p-5">
            <div class="d-flex flex-row align-items-center header-coupon">
                <div class="ml-2 label-coupon">Có thể bạn sẽ thích </div>
            </div>
            <div class="d-flex flex-row align-items-start suggest-books row">
                <div class="suggest-book col-3 d-flex flex-column">
                    <div class="img-suggest d-flex flex-row justify-content-center">
                        <div class="">
                            <a href="{{ route('book.detail', $book->id) }}">
                                <img alt="" class="ml-5 col-8" class="img-book"
                                    src="{{ get_image_book($book->image[0]) }}">
                            </a>
                        </div>

                        @if ($book->is_sale)
                            <div class="percent-suggest ms-3">{{ $book->percent }} %</div>
                        @endif
                    </div>
                    <a class="name-link" href="{{ route('book.detail', $book->id) }}">
                        <div class="name-suggest">
                            {{ $book->book_name }}
                        </div>
                    </a>
                    <div class="price-suggest">
                        {{ number_format($book->price) }} đ
                    </div>
                    @if ($book->is_sale)
                        <div class="price-sale">
                            {{ number_format((intval($book->price) / 100) * (100 - intval($book->percent))) }}
                        </div>
                    @endif
                </div>
                <div class="suggest-book col-3 d-flex flex-column">
                    <div class="img-suggest d-flex flex-row justify-content-center">
                        <div class="bg-secondary">
                            <img alt="" class="img-book" class="ml-5 col-8"
                                src="{{ get_image_book($book->image[0]) }}">
                        </div>

                        @if ($book->is_sale)
                            <div class="percent-suggest ms-3">{{ $book->percent }} %</div>
                        @endif
                    </div>
                    <div class="name-suggest">
                        {{ $book->book_name }}
                    </div>
                    <div class="price-suggest">
                        {{ number_format($book->price) }} đ
                    </div>
                    @if ($book->is_sale)
                        <div class="price-sale">
                            {{ number_format((intval($book->price) / 100) * (100 - intval($book->percent))) }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


    </div>
    @include('frontend.layout.footer')
    @include('frontend.book.includes._modal_detail')
@endsection
@push('after-styles')
    <link href="{{ asset('css/book-detail.css') }}" rel="stylesheet" type="text/css">
@endpush

@push('after-scripts')
    <script src={{ asset('./js/book-detail.js') }}></script>
@endpush
<script>
    var countVouchers = {!! json_encode(count($vouchers)) !!};
</script>
