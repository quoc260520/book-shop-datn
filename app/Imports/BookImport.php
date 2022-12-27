<?php

namespace App\Imports;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BookImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $category = Category::pluck('id')->toArray();
        $author = Author::pluck('id')->toArray();
        $publisher = Publisher::pluck('id')->toArray();

        foreach ($collection as $row) {
            $data = [
                'book_name' => $row['book_name'],
                'category_id' => $category[array_rand($category,1)],
                'author_id' => $author[array_rand($author,1)],
                'publisher_id' => $publisher[array_rand($publisher,1)],
                'price' => 100000,
                'is_sale' => Book::SALE ,
                'percent' => intval(15),
                'amount' => 100,
                'image' => [
                    "16692994078sVVGFaa.jpg",
                    "1669424173MRkzJdWW.jpg"
                ],
                'status' => 1,
                'describe' => $row['category'],
                'year_publish' => 2020,
            ];
            Book::create($data);
        }
    }
}
