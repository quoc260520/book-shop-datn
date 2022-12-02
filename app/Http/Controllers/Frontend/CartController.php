<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Cart as ModelsCart;
use App\Models\CartDetail;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        $book = Book::find($id);
        $amount = $request->amount ?? 1;
        if (!$book) {
            throw new HttpResponseException(response()->json(['message' => 'Sản phẩm không còn tồn tại', 'reload' => true], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
        }
        if ($book->amount == 0) {
            throw new HttpResponseException(response()->json(['message' => 'Số lượng sản phẩm không đủ', 'reload' => true], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
        }
        if (!auth()->user()) {
            $rowIdExit = Cart::search(function ($cartItem, $rowId) use ($id) {
                return $cartItem->id == $id;
            });

            if (count($rowIdExit)) {
                foreach ($rowIdExit as $item) {
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
        return response()->json(['message' => 'oke']);
    }

    public function updateCart(Request $request, $id)
    {
        $book = Book::find($id);
        $amount = $request->amount ?? 1;
        if (!$book) {
            throw new HttpResponseException(response()->json(['message' => 'Sản phẩm không còn tồn tại', 'reload' => true], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
        }
        if ($book->amount == 0) {
            throw new HttpResponseException(response()->json(['message' => 'Số lượng sản phẩm không đủ', 'reload' => true], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
        }
        if (!auth()->user()) {
            $rowIdExit = Cart::search(function ($cartItem, $rowId) use ($id) {
                return $cartItem->id == $id;
            });

            if (count($rowIdExit)) {
                foreach ($rowIdExit as $item) {
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
        return response()->json(['message' => 'oke']);
    }

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
                    if (!$book || $book->deleted_at || $book->amount == 0) {
                        $itemCart['delete'] = true;
                    }
                    $itemCart = [
                        'id' => $book->id,
                        'image' => $book->image,
                        'name' => $book->book_name,
                        'price' => $book->price,
                        'amount' => $item['qty'],
                        'percent' => $book->percent,
                        'is_sale' => $book->is_sale,
                    ];
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
                $book = $books->find($item['id']);
                if (!$book || $book->deleted_at || $book->amount == 0) {
                    $itemCart['delete'] = true;
                }
                $itemCart = [
                    'id' => $book->id,
                    'image' => $book->image,
                    'name' => $book->book_name,
                    'price' => $book->price,
                    'amount' => $item['qty'],
                    'percent' => $book->percent,
                    'is_sale' => $book->is_sale,
                ];
                array_push($cartUser, $itemCart);
                $totalCart += (intval($book->price) / 100) * (100 - intval($book->percent)) * intval($item['qty']);
            }
            $cartUser['total'] = $totalCart;
        }
        return view('frontend.cart.index')->withCarts($cartUser);
    }
}
