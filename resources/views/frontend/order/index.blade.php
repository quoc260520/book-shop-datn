@extends('frontend.account.index')
@section('order')
    @foreach ($orders as $order)
        <div class="card border-0 p-3 ps-5 info-account info-order row d-flex flex-row ms-2 mb-4">
            <div class="order-wrap">
                @foreach ($order->orderDetails as $orderDetail)
                    <div class="d-flex flex-row justify-content-around item-cart">
                        <input name="id[]" type="hidden" value="{{ $order->id }}">
                        <div class="label-book col-6 d-flex flex-row">
                            <div>
                                <img alt="" class="image-book"
                                    src="{{ get_image_book($orderDetail->book->image[0]) }}">
                            </div>
                            <div class="d-flex flex-column justify-content-between">
                                <div class="book-name">{{ $orderDetail->book->book_name }}</div>
                                <div class="book-name">x {{ $orderDetail->amount }}</div>
                            </div>

                        </div>
                        <div class="d-flex flex-row align-items-center justify-content-end col-4">
                            <div class="text-decoration-line-through col-5">
                                {{ number_format($orderDetail->book->price) }} đ
                            </div>
                            <div class="label-total-price">
                                {{ number_format($orderDetail->price) }} đ
                            </div>
                        </div>
                    </div>
                @endforeach
                @php
                    $status = $order->status;
                    if ($status == app('app\Models\Order')::STATUS_PENDING) {
                        $textOrder = 'Chờ xác nhận';
                        $color = 'text-warning';
                    } elseif ($status == app('app\Models\Order')::STATUS_SHIP) {
                        $textOrder = 'Đang vận chuyển';
                        $color = 'text-primary';
                    } elseif ($status == app('app\Models\Order')::STATUS_SUCCESS) {
                        $textOrder = 'Giao hàng thanh công';
                        $color = 'text-success';
                    } else {
                        $textOrder = 'Đơn hàng bị hủy';
                        $color = 'text-danger';
                    }
                    
                @endphp
                <div class="d-flex flex-row justify-content-around align-items-center item-cart">
                    <div class="label-book col-6 d-flex flex-row">
                        <div class="d-flex flex-column justify-content-between">
                            <div class="mb-3 d-flex flex-row align-items-center">
                                <div class="me-3 fs-3 fw-bold d-flex flex-row align-items-center">Ngày đặt: </div>
                                <div class="d-flex flex-row align-items-center">
                                    {{ date_format(date_create($order->created_at), 'H:i:s d-m-Y') }}</div>
                            </div>
                            <div class="d-flex flex-row align-items-center {{ $color }}">
                                <div class="me-3 fs-3 fw-bold d-flex flex-row align-items-center"><i
                                        class="fa-solid fa-truck"></i></div>
                                <div>{{ $textOrder }}</div>
                            </div>
                        </div>

                    </div>
                    <div class="d-flex flex-column justify-content-between col-4">
                        @if ($order->voucher)
                            <div class="d-flex flex-row align-items-center justify-content-end">
                                <div class="fs-3 me-3 col-5">Mã giảm giá: </div>
                                <div class="label-total-price">
                                    {{ number_format(intval(($order->total_money * 100) / (100 - $order->voucher->percent)) - intval($order->total_money)) }}
                                    đ
                                </div>
                            </div>
                        @endif
                        <div class="d-flex flex-row align-items-center justify-content-end">
                            <div class="fs-3 me-3 col-5">Thành tiền: </div>
                            <div class="label-total-price">
                                {{ number_format($order->total_money) }} đ
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    @endforeach
    <div class="d-flex justify-content-center">
        {{ $orders->withQueryString()->links() }}
    </div>
@endsection
<style type="text/css">
    .item-cart:not(:first-child) {
        border-top: 1px solid #ccc;
    }

    .item-cart {
        padding: 10px 0;
    }

    .info-order {
        background-color: #F5F5F5;
    }

    .item-cart .image-book {
        width: 120px;
        height: 120px;
    }

    .item-cart .book-name {
        font-weight: 400;
        font-size: 14px;
        color: #333333;
        word-break: break-word;
        white-space: normal;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        max-height: 6em;
        padding-top: 0px;
        margin-left: 10px;
    }

    .price-sale {
        color: #6C757D;
        font-weight: 500;
    }

    .label-total-price {
        font-weight: bold;
        color: #C92127;
        font-size: 16px;
    }
</style>
