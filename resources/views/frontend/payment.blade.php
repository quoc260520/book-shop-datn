@extends('frontend.app')
@section('content')
    <div class="app__container">
        <form action="{{ route('apply-payment') }}" method="post" id="form-submit-cart">
            @csrf
            <div class="grid" style="margin-top:130px;">
                <div class="grid__row row">
                    <div class="grid__column-12 d-flex flex-column align-items-center">
                        <div class="d-flex flex-column bg-white col-10 border-2">
                            <h1 class="m-3 pb-3 border-bottom">Thông tin giao hàng</h1>
                            <div class="m-3 d-flex flex-row align-items-center">
                                <label class="col-sm-3 col-form-label label-payment">Họ tên người nhận</label>
                                <div class="col-sm-9">
                                    <input class="input-info col-8" name="full_name" required
                                        placeholder="Nhập họ và tên người nhận hàng" type="text" value="">
                                </div>
                            </div>
                            <div class="m-3 d-flex flex-row align-items-center">
                                <label class="col-sm-3 col-form-label label-payment">Số điện thoại</label>
                                <div class="col-sm-9">
                                    <input class="input-info col-8" name="phone" required
                                        placeholder="Nhập số điện thoại người nhận hàng" type="text"
                                        value="{{ auth()->user()->phone ?? '' }}">
                                </div>
                            </div>
                            <div class="m-3 d-flex flex-row align-items-center">
                                <label class="col-sm-3 col-form-label label-payment">Email</label>
                                <div class="col-sm-9">
                                    <input class="input-info col-8" name="email" required
                                        placeholder="Email nhận thông tin đơn hàng" type="email"
                                        value="{{ auth()->user()->email ?? '' }}">
                                </div>
                            </div>
                            <div class="m-3 d-flex flex-row align-items-center">
                                <label class="col-sm-3 col-form-label label-payment">Tỉnh/Thành phố</label>
                                <div class="col-sm-9">
                                    <select class="input-info col-8" id="province" name="province">
                                        <option value=""> --- </option>
                                    </select>
                                </div>
                            </div>
                            <div class="m-3 d-flex flex-row align-items-center">
                                <label class="col-sm-3 col-form-label label-payment">Quận/Huyện</label>
                                <div class="col-sm-9">
                                    <select class="input-info col-8" id="district" name="district">
                                        <option value=""> --- </option>
                                    </select>
                                </div>
                            </div>
                            <div class="m-3 d-flex flex-row align-items-center">
                                <label class="col-sm-3 col-form-label label-payment">Phương/Xã</label>
                                <div class="col-sm-9">
                                    <select class="input-info col-8" id="ward" name="ward">
                                        <option value=""> --- </option>
                                    </select>
                                </div>
                            </div>
                            <div class="m-3 mb-5 d-flex flex-row align-items-center">
                                <label class="col-sm-3 col-form-label label-payment">Địa chỉ nhà</label>
                                <div class="col-sm-9">
                                    <input autocomplete="off" class="input-info col-8" name="address" required
                                        placeholder="Địa chỉ nhà" type="text" value="">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-column bg-white col-10 mt-3" style="margin-bottom: 100px;">
                            <h1 class="m-3 pb-3 border-bottom">Xác nhận thông tin đơn hàng</h1>
                            <input name="code" type="hidden" value="{{ $code ?? '' }}">
                            <div class="rounded-2 p-3 ps-4 bg-white mt-2 d-flex flex-column">
                                @foreach ($carts as $key => $cart)
                                    @if ($key != 'total')
                                        <div class="d-flex flex-row justify-content-around item-cart">
                                            <input name="id[]" type="hidden" value="{{ $cart['book']->id }}">
                                            <div class="label-book col-6 d-flex flex-row">
                                                <div>
                                                    <img alt="" class="image-book"
                                                        src="{{ get_image_book($cart['book']->image[0]) }}">
                                                </div>
                                                <div class="d-flex flex-column justify-content-between">
                                                    <div class="book-name">{{ $cart['book']->name }}</div>
                                                </div>

                                            </div>
                                            <div class="d-flex flex-row">
                                                <div class="price d-flex flex-column align-items-start mr-5">
                                                    <div class="cost ml-3">
                                                        {{ number_format((intval($cart['book']->price) / 100) * (100 - intval($cart['book']->percent))) }}
                                                        đ</div>
                                                    @if ($cart['book']->is_sale)
                                                        <div class="price-sale ml-3">
                                                            {{ number_format($cart['book']->price) }}
                                                            đ</div>
                                                    @endif
                                                </div>
                                                <div class="price d-flex flex-column justify-content-start mr-5">
                                                    <span class="cost"> {{ intval($cart['qty']) }}</span>
                                                </div>
                                                <div class="label-total-price">
                                                    {{ number_format((intval($cart['book']->price) / 100) * (100 - intval($cart['book']->percent)) * intval($cart['qty'])) }}
                                                    đ</div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                <div class="d-flex p-5 flex-row justify-content-between align-items-center item-cart">
                                    <div class="col-6 text-uppercase fs-3 text">
                                        Tổng tiền
                                    </div>

                                    <div class='text-uppercase'>
                                        <div class="label-total-price fs-3 text ml-3">
                                            {{ number_format($carts['total']) }}
                                            <span class="text-lowercase">đ</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="vw-100 position-fixed bottom-0 left-0 right-0 bg-white d-flex justify-content-center">
                <div class="col-8 d-flex flex-row justify-content-between align-items-center">
                    <a class="return-cart text-black text-decoration-none" href="{{ route('cart') }}"> <i
                            class="fa-solid fa-arrow-left"></i> Quay lại giỏ hàng</a>
                    <div class="payment-apply mr-4"><button class="btn-submit-payment" type="submit">
                            XÁC NHẬN THANH TOÁN
                        </button></div>
                </div>
            </div>
        </form>

    </div>
@endsection
@push('after-styles')
    <link href="{{ asset('css/cart.css') }}" rel="stylesheet" type="text/css">
@endpush
@push('after-scripts')
    <script src={{ asset('./js/cart.js') }}></script>
@endpush
