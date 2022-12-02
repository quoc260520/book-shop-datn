<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Cart;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IndexController extends Controller
{
    public function index()
    {
        $paged = config('app.page_count');
        $books = Book::with('author', 'category', 'publisher', 'orderDetails')->paginate($paged);
        $sliders = Slider::all();
        return view('frontend.index')
            ->withBooks($books)
            ->withSliders($sliders);
    }
    public function search(Request $request)
    {
        $sort = $request->sort;
        $paged = intval($request->show) ?? 12;
        $bookName = $request->book_name;
        $validated = $request->validate([
            'book_name' => 'nullable|string|max:255',
        ]);
        if (!$bookName) {
            return back();
        }
        $books = Book::where('book_name', 'like', ["%$bookName%"])
            ->with('author', 'category', 'publisher')
            ->when($sort, function ($q) use ($sort) {
                $q->orderBy('price', $sort);
            })
            ->orderByDesc('created_at')
            ->orderBy('book_name')
            ->paginate($paged);
        return view('frontend.search')->withBooks($books);
    }
}
