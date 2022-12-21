<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Cart;
use App\Models\Category;
use App\Models\OrderDetail;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class IndexController extends Controller
{
    public function index()
    {
        $bookNews = Book::with('author', 'category', 'publisher', 'orderDetails', 'reviews')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();
        $bookSales = Book::with('author', 'category', 'publisher', 'orderDetails', 'reviews')
            ->where('is_sale', Book::SALE)
            ->orderBy('percent', 'desc')
            ->take(6)
            ->get();
        $order = OrderDetail::select('book_id', DB::raw('count(*) as total'))
            ->groupBy('book_id')
            ->orderBy('total', 'desc')
            ->take(6)
            ->get();
        $bookBestSelling = Book::with('author', 'category', 'publisher', 'orderDetails', 'reviews')
            ->whereIn('id', $order->pluck('book_id'))
            ->get();
        $books = Book::with('author', 'category', 'publisher', 'orderDetails', 'reviews')
            ->orderBy('created_at', 'desc')
            ->whereNotIn('id', array_merge($bookNews->pluck('id')->toArray(), $order->pluck('book_id')->toArray()))
            ->take(30)
            ->get();

        $sliders = Slider::all();
        $categorys = Category::where('parent_id', 0)->get();
        return view('frontend.index')
            ->withSliders($sliders)
            ->withCategorys($categorys)
            ->withBooks($books)
            ->withBookNews($bookNews)
            ->withBookSales($bookSales)
            ->withBookBestSelling($bookBestSelling);
    }

    public function indexLoadMore(Request $request)
    {
        $paged = 48;
        $books = Book::with('author', 'category', 'publisher', 'orderDetails', 'reviews')->paginate($paged);
        return view('frontend.index_load_more')->withBooks($books);
    }
    public function search(Request $request)
    {
        $sort = $request->sort;
        $paged = intval($request->show) ?? 12;
        $bookName = $request->book_name;
        $categoryId = $request->category_id;
        if (!$categoryId) {
            $validated = $request->validate([
                'book_name' => 'nullable|string|max:255',
            ]);
            if (!$bookName) {
                return back();
            }
        }
        $books = Book::where('book_name', 'like', ["%$bookName%"])
            ->with('author', 'category', 'publisher')
            ->when($categoryId, function ($q) use ($categoryId) {
                $q->where('category_id', $categoryId);
            })
            ->when($sort, function ($q) use ($sort) {
                $q->orderBy('price', $sort);
            })
            ->orderByDesc('created_at')
            ->orderBy('book_name')
            ->paginate($paged);
        return view('frontend.search')->withBooks($books);
    }

    public function getAllCategory(Request $request) {
        return response()->json(Category::all()); 
    }
}
