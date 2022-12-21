<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function list(Request $request) {
        $paged = config('app.page_count');
        $orders = Order::where('user_id', auth()->user()->id)->with(['orderDetails.book', 'voucher'])->paginate($paged);
        return view('frontend.order.index')->with('orders', $orders);
    }
}
