<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Review;
use App\Models\Voucher;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class BookController extends Controller
{
    public function detail(Request $request, $id)
    {
        $now = Carbon::now();
        $vouchers = Voucher::where('end_date', '>', $now)
            ->where('start_date', '<', $now)
            ->get();

        $book = Book::with('author', 'category', 'publisher', 'reviews.user')->find($id);
        if (!$book) {
            return back()->withFlashDanger('Sách này khồng tồn tại');
        }
        if (count($book->reviews)) {
            $totalRate = array_reduce(
                $book->reviews->toArray(),
                function ($total, $item) {
                    return $total + intval($item['star']);
                },
                0,
            );
        }

        $arrayRate = [
            '5_sao' => count($book->reviews->where('star', 5)),
            '4_sao' => count($book->reviews->where('star', 4)),
            '3_sao' => count($book->reviews->where('star', 3)),
            '2_sao' => count($book->reviews->where('star', 2)),
            '1_sao' => count($book->reviews->where('star', 1)),
        ];

        $avgRate = $totalRate ?? false ? round($totalRate / count($book->reviews), 1) : 0;

        return view('frontend.book.detail')
            ->withBook($book)
            ->withVouchers($vouchers)
            ->withAvgRate($avgRate)
            ->withArrayRate($arrayRate);
    }

    public function checkAmount(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        if ($book->amount && intval($book->amount) < intval($request->amount)) {
            return response()->json(
                [
                    'message' => 'over',
                ],
                400,
            );
        }
        return response()->json([
            'message' => 'oke',
        ]);
    }

    public function comment(Request $request, $id)
    {
        try {
            $book = Book::findOrFail($id);
            if (!auth()->user()) {
                Session::flash('flash_danger', 'Bạn chưa đăng nhập');
                return 'comment fail';
            }
            $checkComment = Review::where('user_id', auth()->user()->id)
                ->where('book_id', $id)
                ->count();
            if ($checkComment) {
                Session::flash('flash_danger', 'Bạn đã bình luận về sản phẩm');
                return 'comment fail';
            }
            Review::create([
                'user_id' => auth()->user()->id,
                'book_id' => $id,
                'star' => $request->star,
                'content' => $request->content,
            ]);
            $request->session()->flash('flash_success', 'Bình luận thành công');
            return 'comment success';
        } catch (\Exception $e) {
            Session::flash('flash_danger', 'Đã có lỗi xảy ra');
            return 'comment fail';
        }
    }
}
