<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $paged = config('app.page_count');
        $name = $request->name ?? '';
        $phone = $request->phone ?? '';
        $dateOrder = $request->date_order ?? '';
        $status = $request->status ?? null;
        $orders = Order::with(['orderDetails.book', 'voucher'])
            ->when($name, function ($q) use ($name) {
                $q->where('full_name', 'like', ["%$name%"]);
            })
            ->when($phone, function ($q) use ($phone) {
                $q->where('phone', 'like', ["%$phone%"]);
            })
            ->when($dateOrder, function ($q) use ($dateOrder) {
                $q->whereDate('created_at', format_date($dateOrder));
            })
            ->when(!is_null($status), function ($q) use ($status) {
                $q->where('status', $status);
            })
            ->orderBy('created_at', 'desc')
            ->paginate($paged);

        return view('backend.order.index')
            ->withOrders($orders)
            ->withName($name)
            ->withPhone($phone)
            ->withDateOrder($dateOrder)
            ->withStatus($status);
    }
    public function getOrderById($id)
    {
        $order = Order::with(['orderDetails.book', 'voucher'])->find($id);
        if (!$order) {
            Session::flash('flash_danger', 'Đơn hàng không tồn tại');
            return response()->json('Error order not found', 400);
        }
        $view = view('backend.order.includes._modal_detail')
            ->withOrder($order)
            ->toHtml();
        return response()->json($view);
    }

    public function updateOrder(Request $request)
    {
        $id = $request->id;
        $order = Order::find($id);
        if (!$order) {
            Session::flash('flash_danger', 'Đơn hàng không tồn tại');
            return response()->json('Error order not found', 400);
        }
        if ($order->status == Order::STATUS_SUCCESS || $order->status == Order::STATUS_ERROR) {
            Session::flash('flash_danger', 'Không thể cập nhật trạng thái');
            return response()->json('Do not update', 400);
        }
        $order->increment('status', 1);
        Session::flash('flash_success', 'Cập nhật thành công');
        return response()->json('Update success', 200);
    }

    public function cancelOrder(Request $request)
    {
        $id = $request->id;
        $order = Order::find($id);
        if (!$order) {
            Session::flash('flash_danger', 'Đơn hàng không tồn tại');
            return response()->json('Error order not found', 400);
        }
        if ($order->status == Order::STATUS_SUCCESS) {
            Session::flash('flash_danger', 'Không thể hủy trạng thái');
            return response()->json('Do not update', 400);
        }
        $order->update(['status' => Order::STATUS_ERROR]);
        Session::flash('flash_success', 'Cập nhật thành công');
        return response()->json('Update success', 200);
    }
}
