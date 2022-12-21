<div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Chi tiết đơn hàng</h5>
            <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
        </div>
        @php
            $status = $order->status ?? '';
            if ($status == app('app\Models\Order')::STATUS_PENDING) {
                $textOrder = 'Chờ xác nhận';
                $btnOrder = 'btn-warning';
            } elseif ($status == app('app\Models\Order')::STATUS_SHIP) {
                $textOrder = 'Đang vận chuyển';
                $btnOrder = 'btn-primary';
            } elseif ($status == app('app\Models\Order')::STATUS_SUCCESS) {
                $textOrder = 'Giao hàng thanh công';
                $btnOrder = 'btn-success';
            } else {
                $textOrder = 'Đơn hàng bị hủy';
                $btnOrder = 'btn-danger';
            }
            
        @endphp
        <div class="modal-body">
            <div class="table-responsive">
                <table class="table caption-top">
                    <tbody>
                        <tr>
                            <td>Tên khách</td>
                            <td>{{ $order->full_name ?? '' }}</td>
                        </tr>
                        <tr>
                            <td>Số điện thoại</td>
                            <td>{{ $order->phone ?? '' }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{ $order->email ?? '' }}</td>
                        </tr>
                        <tr>
                            <td>Địa chỉ nhận hàng</td>
                            <td>{{ $order->address ?? '' }}</td>
                        </tr>
                        <tr>
                            <td>Trạng thái</td>
                            <td>
                                <div class="btn {{ $btnOrder }}">{{ $textOrder }}</div>
                            </td>
                        </tr>
                        <tr>
                            <td>Ngày đặt</td>
                            <td>{{ date_format(date_create($order->created_at ?? ''), 'H:i:s d-m-Y') }}</td>
                        </tr>
                        <tr>
                            <td>Khuyến mãi</td>
                            @if ($order->voucher ?? false)
                                <td> -
                                    {{ number_format(intval(($order->total_money * 100) / (100 - $order->voucher->percent)) - intval($order->total_money)) }}
                                    đ</td>
                            @else
                                <td>0 đ</td>
                            @endif
                        </tr>
                        <tr>
                            <td>Tổng tiền</td>
                            <td>{{ number_format($order->total_money ?? 0) }} đ</td>
                        </tr>
                        @foreach ($order->orderDetails ?? [] as $orderDetail)
                            <tr>
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
        </div>
    </div>
</div>
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
