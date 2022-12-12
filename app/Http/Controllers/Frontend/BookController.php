<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BookController extends Controller
{
    public function detail(Request $request, $id) {
        $now = Carbon::now();
        $vouchers = Voucher::where('end_date','>', $now)->where('start_date','<', $now)->get();

        $book = Book::with('author', 'category', 'publisher')->find($id);
        if(!$book) {
            return back()->withFlashDanger('Sách này khồng tồn tại');
        }
        return view('frontend.book.detail')->withBook($book)->withVouchers($vouchers);
    }

    public function checkAmount(Request $request,$id) {
        $book = Book::findOrFail($id);
        if($book->amount && intval($book->amount) < intval($request->amount)) {
            return response()->json([
                'message' => 'over',
            ],400); 
        }
        return response()->json([
            'message' => 'oke',
        ]); 
    }
}
