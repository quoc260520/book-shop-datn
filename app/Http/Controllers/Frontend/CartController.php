<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApplyPaymentRequest;
use App\Jobs\SendMailOrderJob;
use App\Models\Book;
use App\Models\Cart as ModelsCart;
use App\Models\CartDetail;
use App\Models\Order;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Cart;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $totalCart = 0;
        $cartUser = [];
        if (!auth()->user()) {
            $cart = Cart::content()->toArray();
            if (count($cart)) {
                $ids = array_map(function ($item) {
                    return $item['id'];
                }, $cart);
                $books = Book::whereIn('id', array_values($ids))
                    ->withTrashed()
                    ->get();
                foreach ($cart as $item) {
                    $book = $books->find($item['id']);
                    $itemCart = [
                        'id' => $book->id,
                        'image' => $book->image,
                        'name' => $book->book_name,
                        'price' => $book->price,
                        'amount' => $item['qty'],
                        'percent' => $book->percent,
                        'is_sale' => $book->is_sale,
                    ];
                    if (!$book || $book->deleted_at || $book->amount == 0 || intval($book->amount) < intval($item['qty'])) {
                        $itemCart['delete'] = true;
                    }
                    array_push($cartUser, $itemCart);
                    $totalCart += (intval($book->price) / 100) * (100 - intval($book->percent)) * intval($item['qty']);
                }
                $cartUser['total'] = $totalCart;
            }
        }

        if (auth()->user()) {
            $userId = auth()->user()->id;
            $cart = ModelsCart::where('user_id', $userId)
                ->with('CartDetails.book', function ($q) {
                    $q->withTrashed();
                })
                ->first();
            foreach ($cart->CartDetails as $cartDetail) {
                $book = $cartDetail->book;
                $itemCart = [
                    'id' => $book->id,
                    'image' => $book->image,
                    'name' => $book->book_name,
                    'price' => $book->price,
                    'amount' => $cartDetail->amount,
                    'percent' => $book->percent,
                    'is_sale' => $book->is_sale,
                ];
                if (!$book || $book->deleted_at || $book->amount == 0 || intval($book->amount) < intval($cartDetail->amount)) {
                    $itemCart['delete'] = true;
                }
                array_push($cartUser, $itemCart);
                $totalCart += (intval($book->price) / 100) * (100 - intval($book->percent)) * intval($cartDetail->amount);
            }
            $cartUser['total'] = $totalCart;
        }
        return view('frontend.cart.index')->withCarts($cartUser);
    }
    public function addToCart(Request $request, $id)
    {
        $book = Book::find($id);
        $amount = $request->amount ?? 1;
        if (!$book) {
            throw new HttpResponseException(response()->json(['message' => 'Sản phẩm không còn tồn tại', 'reload' => true], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
        }
        if ($book->amount && $book->amount == 0) {
            throw new HttpResponseException(response()->json(['message' => 'Số lượng sản phẩm không đủ', 'reload' => true], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
        }
        if (!auth()->user()) {
            $rowIdExit = Cart::search(function ($cartItem, $rowId) use ($id) {
                return $cartItem->id == $id;
            });

            if (count($rowIdExit)) {
                foreach ($rowIdExit as $item) {
                    if (intval($amount) + intval($item->qty) > $book->amount) {
                        throw new HttpResponseException(response()->json(['message' => 'over', 'reload' => true], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
                    }
                    Cart::update($item->rowId, intval($amount) + intval($item->qty));
                }
            } else {
                Cart::add($id, $book->book_name, $amount, $book->price);
            }
        } else {
            $cart = ModelsCart::where('user_id', auth()->user()->id)->first()->id;
            $cartDetail = CartDetail::where([
                'cart_id' => $cart,
                'book_id' => $book->id,
            ])->first();
            if (intval($amount) + intval($cartDetail->amount ?? 0) > $book->amount) {
                throw new HttpResponseException(response()->json(['message' => 'over', 'reload' => true], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
            }
            if ($cartDetail) {
                $cartDetail->increment('amount', $amount);
            } else {
                CartDetail::create([
                    'cart_id' => $cart,
                    'book_id' => $book->id,
                    'amount' => $amount,
                ]);
            }
        }
        return response()->json(['message' => 'add cart success']);
    }

    public function updateCart(Request $request, $id)
    {
        $book = Book::find($id);
        $amount = $request->amount ?? 1;
        if (!$book) {
            throw new HttpResponseException(response()->json(['message' => 'Sản phẩm không còn tồn tại', 'reload' => true], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
        }
        if ($book->amount && ($book->amount == 0 || $book->amount < $amount)) {
            throw new HttpResponseException(response()->json(['message' => 'Số lượng sản phẩm không đủ', 'reload' => true], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
        }
        if (!auth()->user()) {
            $rowIdExit = Cart::search(function ($cartItem, $rowId) use ($id) {
                return $cartItem->id == $id;
            });

            if (count($rowIdExit)) {
                foreach ($rowIdExit as $item) {
                    Cart::update($item->rowId, intval($amount));
                }
            }
        } else {
            $cart = ModelsCart::where('user_id', auth()->user()->id)->first()->id;
            $cartDetail = CartDetail::where([
                'cart_id' => $cart,
                'book_id' => $book->id,
            ]);
            if ($cartDetail) {
                $cartDetail->update(['amount' => $amount]);
            }
        }
        return response()->json(['message' => 'update success']);
    }

    public function deleteCart(Request $request, $id)
    {
        $book = Book::find($id);

        if (!auth()->user()) {
            $rowIdExit = Cart::search(function ($cartItem, $rowId) use ($id) {
                return $cartItem->id == $id;
            });
            if (count($rowIdExit)) {
                foreach ($rowIdExit as $item) {
                    Cart::remove($item->rowId);
                }
            }
        } else {
            $cart = ModelsCart::where('user_id', auth()->user()->id)->first()->id;
            $cartDetail = CartDetail::where([
                'cart_id' => $cart,
                'book_id' => $book->id,
            ])->first();
            if ($cartDetail) {
                $cartDetail->delete();
            }
        }
        return response()->json(['message' => 'delete success']);
    }
    public function checkPayment(Request $request)
    {
        $totalCart = 0;
        $cartUser = [];
        $cartUser['total'] = $totalCart;
        $ids = $request->payment_items;

        if ($request->code) {
            $voucher = $this->checkVoucher($request->code);
        }

        if (!auth()->user() && count($ids ?? [])) {
            $cart = Cart::content()->toArray();
            if (count($cart)) {
                $books = Book::whereIn('id', $ids)
                    ->withTrashed()
                    ->get();
                foreach ($cart as $item) {
                    $book = $books->find($item['id']);
                    if ($book) {
                        if (!$book || $book->deleted_at || $book->amount == 0 || intval($book->amount) < intval($item['qty'])) {
                            $itemCart['delete'] = true;
                        }
                        $totalCart += (intval($book->price) / 100) * (100 - intval($book->percent)) * intval($item['qty']);
                    }
                }
                $cartUser['total'] = ($totalCart / 100) * (100 - intval($voucher->percent ?? 0));
            }
        }

        if (auth()->user() && count($ids ?? [])) {
            $userId = auth()->user()->id;
            $cart = ModelsCart::where('user_id', $userId)
                ->with('CartDetails.book', function ($q) {
                    $q->withTrashed();
                })
                ->first();
            foreach ($cart->CartDetails as $cartDetail) {
                if (in_array($cartDetail->book_id, $ids)) {
                    $book = $cartDetail->book;
                    if (!$book || $book->deleted_at || $book->amount == 0 || intval($book->amount) < intval($cartDetail->amount)) {
                        $itemCart['delete'] = true;
                    }
                    $totalCart += (intval($book->price) / 100) * (100 - intval($book->percent)) * intval($cartDetail->amount);
                }
            }
            $cartUser['total'] = ($totalCart / 100) * (100 - intval($voucher->percent ?? 0));
        }

        return $cartUser;
    }

    public function applyVoucher(Request $request)
    {
        $voucher = $this->checkVoucher($request->code);
        return $voucher;
    }

    public function checkVoucher($code)
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $voucher = Voucher::where('code', $code)
            ->where('start_date', '<=', $now)
            ->where('end_date', '>=', $now)
            ->first();
        if (!auth()->user()) {
            throw new HttpResponseException(response()->json(['message' => 'Bạn cần đăng nhập để sử dụng voucher'], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
        }
        if (!$voucher) {
            throw new HttpResponseException(response()->json(['message' => 'Voucher không khả dụng'], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
        }
        $totalVoucherUsed = Order::where('voucher_id', $voucher->id)
            ->where('user_id', auth()->user() ? auth()->user()->id : null)
            ->where('status', '!=', Order::STATUS_ERROR)
            ->count();
        if ($voucher->amount < $totalVoucherUsed || $totalVoucherUsed >= $voucher->amount) {
            throw new HttpResponseException(response()->json(['message' => 'Voucher đã hết'], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
        }
        return $voucher;
    }

    public function payment(Request $request)
    {
        $ids = $request->is_check;
        if (!count($ids ?? [])) {
            return back();
        }

        if ($request->code) {
            try {
                $voucher = $this->checkVoucher($request->code);
            } catch(HttpResponseException $e) {
                Session::flash('flash_danger', $e->getResponse()->original['message']);
                return back();
            }
        }
        $cartUser = $this->formatCart($ids, $request->code);

        return view('frontend.payment')
            ->withCarts($cartUser)
            ->withCode($request->code);
    }

    public function formatCart($ids, $code)
    {
        $totalCart = 0;
        $cartUser = [];
        $cartUser['total'] = $totalCart;

        if ($code) {
            $voucher = $this->checkVoucher($code);
        }

        if (!auth()->user() && count($ids ?? [])) {
            $cart = Cart::content()->toArray();
            if (count($cart)) {
                $books = Book::whereIn('id', $ids)
                    ->withTrashed()
                    ->get();
                foreach ($cart as $item) {
                    $book = $books->find($item['id']);
                    if ($book) {
                        if (!$book || $book->deleted_at || $book->amount == 0 || intval($book->amount) < intval($item['qty'])) {
                            $itemCart['delete'] = true;
                        } else {
                            $itemCart = [
                                'book' => $book,
                                'qty' => $item['qty'],
                            ];
                            array_push($cartUser, $itemCart);
                        }
                        $totalCart += (intval($book->price) / 100) * (100 - intval($book->percent)) * intval($item['qty']);
                    }
                }
                $cartUser['total'] = ($totalCart / 100) * (100 - intval($voucher->percent ?? 0));
            }
        }

        if (auth()->user() && count($ids ?? [])) {
            $userId = auth()->user()->id;
            $cart = ModelsCart::where('user_id', $userId)
                ->with('CartDetails.book', function ($q) {
                    $q->withTrashed();
                })
                ->first();
            foreach ($cart->CartDetails as $cartDetail) {
                if (in_array($cartDetail->book_id, $ids)) {
                    $book = $cartDetail->book;
                    if (!$book || $book->deleted_at || $book->amount == 0 || intval($book->amount) < intval($cartDetail->amount)) {
                        $itemCart['delete'] = true;
                    } else {
                        $itemCart = [
                            'book' => $book,
                            'qty' => $cartDetail->amount,
                        ];
                        array_push($cartUser, $itemCart);
                    }
                    $totalCart += (intval($book->price) / 100) * (100 - intval($book->percent)) * intval($cartDetail->amount);
                }
            }
            $cartUser['total'] = ($totalCart / 100) * (100 - intval($voucher->percent ?? 0));
        }
        return $cartUser;
    }

    public function applyPayment(ApplyPaymentRequest $request)
    {
        $ids = $request->id;
        $voucher = null;
        if (!count($ids)) {
            return back();
        }

        if ($request->code) {
            $voucher = $this->checkVoucher($request->code);
        }
        $cartUser = $this->formatCart($ids, $request->code);

        try {
            DB::beginTransaction();
            $order = Order::create([
                'user_id' => auth()->user() ? auth()->user()->id : null,
                'full_name' => $request->full_name,
                'voucher_id' => $voucher->id ?? null,
                'address' => $request->address . ',' . $request->province . ',' . $request->district . ',' . $request->ward,
                'phone' => $request->phone,
                'email' => $request->email,
                'status' => Order::STATUS_PENDING,
                'total_money' => intval($cartUser['total']),
            ]);
            foreach ($cartUser as $key => $cart) {
                if ($key != 'total') {
                    $order->orderDetails()->create([
                        'book_id' => $cart['book']->id,
                        'amount' => $cart['qty'],
                        'price' => $cart['book']->is_sale ? (intval($cart['book']->price) / 100) * (100 - intval($cart['book']->percent)) : $cart['book']->price,
                    ]);
                }
            }
            DB::commit();
            foreach ($ids as $id) {
                $this->deleteCart($request, $id);
            }
            SendMailOrderJob::dispatch($cartUser, $voucher, $request->all());
            return redirect(route('payment-success'));
        } catch (\Exception $e) {
            Log::channel('daily')->error('Order fail:' . $e->getMessage());
            DB::rollBack();
            return redirect('cart');
        }
    }

    public function paymentSuccess()
    {
        return view('frontend.order_success');
    }
}
