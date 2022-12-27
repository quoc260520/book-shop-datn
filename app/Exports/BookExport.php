<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BookExport implements FromArray, WithHeadings
{
    protected $books;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($books)
    {
        $this->books = $books;
    }

    public function array(): array
    {
        return $this->books;
    }

    public function headings() :array {
    	return ["id", "book_name", "author",  "category", "publisher"];
    }
}
