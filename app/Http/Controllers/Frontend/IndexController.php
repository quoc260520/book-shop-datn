<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IndexController extends Controller
{
    public function index() {
        $paged = config('app.page_count');
        $books = Book::with('author', 'category', 'publisher')->paginate($paged);
        return view('frontend.index')->withBooks($books);   
    }
}