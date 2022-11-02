<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index() {
        return view('backend.book.index');
    }
    public function getCreate() {
        return view('backend.book.includes._create_book');
    }
}
