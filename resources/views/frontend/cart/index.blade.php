@extends('frontend.app')
@section('content')
    <div class="app__container">
        <div class="grid" style="margin-top:130px;">
            <div class="grid__row row">
                <h1 class="pt-3 pb-3">Giỏ hàng</h1>
                @if (count($carts) ?? false)
                <form action="{{ route('payment') }}" method="post" id="form-cart">
                    @csrf
                    <div class="grid__column-12 vh-100 d-flex flex-sm-row">
                        <div class="col-8">
                            <div class="p-3 ps-4 bg-white d-flex flex-row align-items-center header-cart">
                                <input class="check-all col-1" id="" name="check_all" type="checkbox">
                                <div class="label-book col-6">Chọn tất cả</div>
                                <div class="label-amount col-2">Số lượng</div>
                                <div class="label-total-price col-2">Thành tiền</div>
                                <div class="label-trash col-1"></div>
                            </div>
                            @foreach ($carts as $key => $cart)
                                @if ($key != 'total')
                                    <div class="rounded-2 p-3 ps-4 bg-white mt-3 d-flex flex-column ">
                                        <div class="d-flex flex-row align-items-center item-cart">
                                            <input class="check-all col-1" id="is_check" name="is_check[]" type="checkbox" value="{{ $cart['id'] }}" {{ isset($cart['delete']) ? 'disabled' : '' }}>
                                            <input name="id" type="hidden" value="{{ $cart['id'] }}">
                                            <div class="label-book col-6 d-flex flex-row">
                                                <div>
                                                    <img alt="" class="image-book"
                                                        src="{{ get_image_book($cart['image'][0]) }}">
                                                </div>
                                                <div class="d-flex flex-column justify-content-between">
                                                    <div class="book-name">{{ $cart['name'] }}</div>
                                                    <div class="book-name text-danger {{ isset($cart['delete']) ? 'd-flex' : 'd-none' }}">Số lượng vượt quá giới hạn</div>
                                                    <div class="price">
                                                        <span
                                                            class="cost">{{ number_format((intval($cart['price']) / 100) * (100 - intval($cart['percent']))) }}
                                                            đ</span>
                                                        @if ($cart['is_sale'])
                                                            <span class="price-sale">
                                                                {{ number_format($cart['price']) }}
                                                                đ</span>
                                                        @endif
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="label-amount col-2">
                                                <div class="custom-input d-flex flex-row col-9">
                                                    <div onclick="updateItemCart({{ $cart['id'] }}, this)" class="btn-amount btn-decrease order-0" data-type="decrease"><i
                                                            class="fa-solid fa-minus"></i></div>
                                                    <input class="counter order-1" id="counter" min="1" readonly
                                                        step="1" type="number" value="{{ $cart['amount'] }}">
                                                    <div onclick="updateItemCart({{ $cart['id'] }}, this)" class="btn-amount btn-increase order-2" data-type="increase"><i
                                                            class="fa-solid fa-plus"></i></div>
                                                </div>
                                            </div>
                                            <div class="label-total-price col-2">
                                                {{ number_format((intval($cart['price']) / 100) * (100 - intval($cart['percent'])) * intval($cart['amount'])) }}
                                                đ</div>
                                            <button class="label-trash text-black col-1 border-0 bg-white" onclick="deleteItemCart({{ $cart['id'] }})"><i class="fa-regular fa-trash-can"></i></button>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div class="col-4">
                            <div class="pt-3 pb-3 zz bg-white d-flex flex-column align-items-start voucher-wrap">
                                <div class="label-voucher col-12 ps-4">Mã giảm giá</div>
                                <div class="col-12 ps-4 pe-4">
                                <input type="text" name="code" placeholder="Nhập mã giảm giá" class="form-control input-voucher mt-3">
                                <div class="col-12 pt-2 fs-4 text text-danger message-voucher"></div>
                                <div class="col-12 mt-3 d-flex flex-row justify-content-center">
                                    <button class="btn-apply-voucher" type="button" disabled>
                                        Áp dụng
                                    </button>
                                </div>
                            </div>
                            </div>

                            <div class="p-3 mt-5 ps-4 bg-white d-flex flex-column align-items-start voucher-wrap">
                                <div class="pt-3 pb-3 col-12 d-flex flex-row justify-content-between">
                                    <div class="label-money">Thành tiền</div>
                                    <div class="label-money"><span id="total-money">0</span>đ</div>
                                </div>
                                <div class="col-12 d-flex justify-content-center">
                                    <div class="border-bottom col-11"></div>
                                </div>
                                <div class="d-flex flex-column col-12 ps-0 pe-0">
                                    <div class="col-12 d-flex flex-row justify-content-between">
                                        <div class="mt-3 fs-2 text fw-bold">Tổng số tiền</div>
                                        <div class="mt-3 fs-2 text fw-bold text-danger text-decoration-none"><span id="money">0</span>đ
                                            </div>
                                    </div>
                                    <div class="col-12 mt-3 d-flex flex-row justify-content-center">
                                        <button class="btn-apply-payment" type="submit" disabled>
                                            Thanh toán
                                        </button>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </form>
                @else
                    <div class="grid__column-12 vh-100">
                        <div class="cart-no-item d-flex flex-column justify-content-center align-items-center">
                            <img alt="" class="header__cart-no-cart-img"
                                src="{{ asset('images/app/no_cart.png') }}">
                            <span class="header__cart-list-no-cart-msg">
                                Chưa có sản phẩm
                            </span>
                            <a class="mt-3 btn-index d-flex align-items-center justify-content-center"
                                href="{{ route('index') }}">Tiếp tục mua sắm</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        @include('frontend.layout.footer')
    </div>
@endsection
@push('after-styles')
    <link href="{{ asset('css/cart.css') }}" rel="stylesheet" type="text/css">
@endpush
@push('after-scripts')
    <script src={{ asset('./js/cart.js') }}></script>
@endpush