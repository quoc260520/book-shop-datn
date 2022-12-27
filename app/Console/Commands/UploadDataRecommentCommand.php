<?php

namespace App\Console\Commands;

use App\Exports\BookExport;
use App\Models\Book;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Http;


class UploadDataRecommentCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'upload:data-recomment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upload data recomment when export data to python recomment serve';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $books = Book::query()
        ->join('categorys', 'categorys.id', '=', 'books.category_id')
        ->join('publishers', 'publishers.id', '=', 'books.publisher_id')
        ->join('authors', 'books.author_id', '=', 'authors.id')
        ->select('books.id', 'book_name', 'authors.name as author_name', 'categorys.category_name', 'publishers.publisher_name')
        ->get();
        Excel::store(new BookExport($books->toArray()), 'recomment/recomment.xlsx', 'local');
        $response = Http::attach(
            'file', file_get_contents(storage_path('/app/recomment/recomment.xlsx')), 'recomment.xlsx'
        )->post(env('URL_UPLOAD_DATA_RECOMMENT'));
        // return json_decode($response->getBody()->getContents());
        return 0;
    }
}
