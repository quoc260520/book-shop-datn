<div class="card m-3">
    <form action="" method="get">
        <div class="d-flex flex-column">
            <div class="d-flex flex-row col-12">
                <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start col-6">
                    <div class="label col-3">Họ tên khách</div>
                    <input class="form-control col-6" name="name" placeholder="Họ tên " type="text"
                        value="{{ old('name') ?? ($name ?? '') }}">
                </div>
                <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start col-6">
                    <div class="label col-3">Trạng thái</div>
                    <select class="form-control col-6" name="status">
                        <option value=""> -- </option>
                        <option {{ $status == 0 ? 'selected' : '' }} value="0"> Chờ xác nhận </option>
                        <option {{ $status == 1 ? 'selected' : '' }} value="1"> Đang giao hàng </option>
                        <option {{ $status == 2 ? 'selected' : '' }} value="2"> Giao hàng thành công </option>
                        <option {{ $status == 3 ? 'selected' : '' }} value="3"> Đơn hàng đã hủy </option>
                    </select>
                </div>
            </div>
            <div class="d-flex flex-row col-12 mt-5">
                <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start col-6">
                    <div class="label col-3">Số điện thoại</div>
                    <input class="form-control col-6" name="phone" placeholder="Số điện thoại" type="text"
                        value="{{ old('phone') ?? ($phone ?? '') }}">
                </div>
                <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start col-6 date-order-wrap">
                    <div class="label col-3">Ngày đặt hàng</div>
                    <input class="form-control col-6 date-order" name="date_order" type="date"
                        value="{{ old('date_order') ?? ($dateOrder ?? '') }}">
                    <span class="deleteicon"
                        onclick="var input = this.previousElementSibling; input.value = ''; ">x</span>
                </div>
            </div>
        </div>

        <div class="d-flex flex-row align-items-center justify-content-end mt-3">
            <button class="btn btn-primary btn-xl" type="submit">
                <i class="fa-solid fa-magnifying-glass"></i>
                Tìm kiếm
            </button>
        </div>
    </form>
</div>

<div class="card m-3">
    <div class="d-flex flex-row m-3 align-items-center justify-content-end">
        <a class="btn btn-success btn-xl mr-2" href="{{ route('admin.publisher.create') }}" type="button">
            <i class="fa-solid fa-plus"></i>
            Thêm
        </a>
    </div>
    <div class="table-responsive">
        <table class="table caption-top">
            <thead>
                <tr>
                    <th class="no-wrap-keep" scope="col" width="5%">STT</th>
                    <th class="no-wrap-keep" scope="col" width="10%">Mã đơn</th>
                    <th class="no-wrap-keep" scope="col" width="15%">Tên khách hàng</th>
                    <th class="no-wrap-keep" scope="col" width="25%">Địa chỉ</th>
                    <th class="no-wrap-keep" scope="col" width="10%">Tổng tiền</th>
                    <th class="no-wrap-keep" scope="col" width="15%">Trạng thái</th>
                    <th class="no-wrap-keep" scope="col" width="15%">Cập nhật trạng thái</th>
                    <th class="no-wrap-keep" scope="col" width="5%">Chi tiết</th>
                </tr>
            </thead>
            <tbody>
                @if (count($orders))
                    @foreach ($orders ?? [] as $key => $order)
                        @php
                            $status = $order->status;
                            if ($status == app('app\Models\Order')::STATUS_PENDING) {
                                $textOrder = 'Chờ xác nhận';
                                $btnOrder = 'btn-warning';
                                $textUpdate = 'Xác nhận';
                                $btnUpdate = 'btn-primary';
                            } elseif ($status == app('app\Models\Order')::STATUS_SHIP) {
                                $textOrder = 'Đang vận chuyển';
                                $btnOrder = 'btn-primary';
                                $textUpdate = 'Thành công';
                                $btnUpdate = 'btn-success';
                            } elseif ($status == app('app\Models\Order')::STATUS_SUCCESS) {
                                $textOrder = 'Giao hàng thanh công';
                                $btnOrder = 'btn-success';
                                $textUpdate = '';
                                $btnUpdate = '';
                            } else {
                                $textOrder = 'Đơn hàng bị hủy';
                                $btnOrder = 'btn-danger';
                                $textUpdate = '';
                                $btnUpdate = '';
                            }
                            
                        @endphp
                        <tr>
                            <input name="" type="hidden"value="{{ $order->id }}">
                            <td>{{ $key }}</td>
                            <td>{{ str_pad($order->id, 8, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $order->full_name }}</td>
                            <td>{{ $order->address }}</td>
                            <td>{{ $order->total_money }}</td>
                            <td>
                                <div class="btn {{ $btnOrder }}">{{ $textOrder }}</div>
                            </td>
                            <td>
                                @if ($btnUpdate)
                                    <button class="btn {{ $btnUpdate }}"
                                        onclick="updateOrder({{ $order->id }})">{{ $textUpdate }}</button>
                                    <button class="btn btn-danger ms-2"
                                        onclick="cancelOrder({{ $order->id }})">Hủy</button>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex flex-row justify-content-start">
                                    <button class="btn border-0" id="update-author" type="button">
                                        <a class="text-black" onclick="detailOrder({{ $order->id }})">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                    </button>
                                </div>

                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="text-center" colspan="8">Danh sách trống</td>
                    </tr>
                @endif

            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-end">
        {{ $orders->withQueryString()->links() }}
    </div>
</div>
<style>
    .deleteicon {
        width: 20px;
        height: 20px;
        background-color: #ccc;
        position: absolute;
        right: 30%;
        top: 25%;
        display: none;
        align-items: center;
        justify-content:center;
        align-self: center;
        border-radius: 50%;
        line-height: 20px;
        cursor: pointer;
    }
    .date-order-wrap .date-order:hover + .deleteicon,
    .date-order:focus + .deleteicon{
        display: flex;
        z-index: 10;
    }
</style>