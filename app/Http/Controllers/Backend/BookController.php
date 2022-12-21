<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBookRequest;
use App\Http\Requests\DeleteBookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $paged = config('app.page_count');
        $categorys = Category::all();
        $authors = Author::all();
        $publishers = Publisher::all();
        $bookName = $request->book_name;
        $author = $request->author;
        $publisher = $request->publisher;
        $yearPublish = $request->date;
        $books = Book::when($bookName, function ($query, $bookName) {
            $query->where('book_name', 'like', ["%$bookName%"]);
        })
            ->when($author, function ($query, $author) {
                $query->where('author_id', [$author]);
            })
            ->when($publisher, function ($query, $publisher) {
                $query->where('publisher_id', [$publisher]);
            })
            ->when($yearPublish, function ($query, $yearPublish) {
                $query->where('year_publish', [$yearPublish]);
            })
            ->with('author', 'category', 'publisher')
            ->orderByDesc('created_at')
            ->orderBy('book_name')
            ->paginate($paged);
        return view('backend.book.index')
            ->withBooks($books)
            ->withCategorys($categorys)
            ->withPublishers($publishers)
            ->withAuthors($authors)
            ->withBookName($bookName)
            ->withPublisherId($publisher)
            ->withAuthorId($author)
            ->withYearPublish($yearPublish);
    }
    public function getCreate()
    {
        $categorys = Category::all();
        $authors = Author::all();
        $publishers = Publisher::all();
        return view('backend.book.includes._create_book')
            ->withCategorys($categorys)
            ->withPublishers($publishers)
            ->withAuthors($authors);
    }
    public function create(CreateBookRequest $request)
    {
        if ($request->hasFile('images')) {
            $arrImage = $this->uploadMultiImage($request->images);
        }
        try {
            $data = [
                'book_name' => $request->book_name,
                'category_id' => $request->category,
                'author_id' => $request->author,
                'publisher_id' => $request->publisher,
                'price' => $request->price,
                'is_sale' => $request->is_sale ? Book::SALE : BOOK::UN_SALE,
                'percent' => intval($request->sale),
                'amount' => $request->amount,
                'image' => $arrImage ?? null,
                'status' => $request->status,
                'describe' => $request->describe_book,
                'year_publish' => $request->year_publish,
            ];
            Book::create($data);
            return back()->withFlashSuccess('Thêm sách thành công.');
        } catch (\Exception $e) {
            Log::channel('daily')->error('Thêm sách lỗi' . $e->getMessage());
            return back()->withFlashDanger('Thêm sách không thành công.');
        }
    }

    public function delete(DeleteBookRequest $request)
    {
        $bookIds = $request->delete_book;
        $bookDeletes = Book::whereIn('id', $bookIds)->get();
        if (count($bookIds) != count($bookDeletes)) {
            return back()->withFlashDanger('Có sách đã bị xóa đi.');
        }
        try {
            DB::beginTransaction();
            foreach ($bookDeletes as $book) {
                $book->delete();
                foreach ($book->image ?? [] as $image) {
                    if ($image) {
                        Storage::cloud()->delete($image);
                    }
                }
            }
            DB::commit();
            return back()->withFlashSuccess('Xóa sách thành công.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::channel('daily')->error('Xóa sách lỗi' . $e->getMessage());
            return back()->withFlashDanger('Xóa sách không thành công.');
        }
    }

    public function getUpdate(Request $request, $id)
    {
        $categorys = Category::all();
        $authors = Author::all();
        $publishers = Publisher::all();
        $book = Book::find($id);
        if (!$book) {
            return redirect()
                ->route('admin.book.list')
                ->withFlashSuccess('Sách không tồn tại');
        }
        return view('backend.book.includes._update_book')
            ->withBook($book)
            ->withCategorys($categorys)
            ->withPublishers($publishers)
            ->withAuthors($authors);
    }

    public function update(CreateBookRequest $request, $id)
    {
        $book = Book::find($id);
        if (!$book) {
            return redirect()
                ->route('admin.book.list')
                ->withFlashSuccess('Sách không tồn tại');
        }
        $images = $book->image;
        $imageUpdate = $request->image_update ?? [];
        foreach ($images as $image) {
            if (!in_array($image, $imageUpdate)) {
                Storage::cloud()->delete($image);
            }
        }
        if ($request->hasFile('images')) {
            $imageUpdate = $this->uploadMultiImage($request->images,$imageUpdate);
        }

        try {
            $book->update([
                'book_name' => $request->book_name,
                'category_id' => $request->category,
                'author_id' => $request->author,
                'publisher_id' => $request->publisher,
                'price' => $request->price,
                'is_sale' => $request->is_sale ? Book::SALE : BOOK::UN_SALE,
                'percent' => $request->sale,
                'amount' => $request->amount,
                'image' => $imageUpdate,
                'status' => $request->status,
                'describe' => $request->describe_book,
                'year_publish' => $request->year_publish,
            ]);
            return redirect()
                ->route('admin.book.list')
                ->withFlashSuccess('Cập nhật sách thành công');
        } catch (\Exception $e) {
            Log::channel('daily')->error('Cập nhật sách lỗi ' . $e->getMessage());
            return back()->withFlashSuccess('Sách không tồn tại');
        }
    }

    public function uploadMultiImage($images, $arrayIdImages = [])
    {
        $allowFileExtension = ['jpg', 'png'];
        foreach ($images as $file) {
            $extension = $file->getClientOriginalExtension();
            $filename = time() . Str::random(8) . '.' . $extension;
            $check = in_array($extension, $allowFileExtension);
            if ($check) {
                Storage::cloud()->put($filename, file_get_contents($file->getRealPath()));
                array_push($arrayIdImages, $filename);
            }
        }
        return $arrayIdImages;
    }

    public function getBookById(Request $request, $id) {
        $book = Book::with('author', 'category', 'publisher')->find($id);
        $view = view('backend.book.includes._modal_detail')->withBook($book)->toHtml();
        return response()->json([
            'data' => $view,
        ]); 
    }

    public function exportBook() {
        $book= Book::with('author', 'category:category_name', 'publisher')->get();
        return (new InvoicesExport)->download('books.csv', \Maatwebsite\Excel\Excel::CSV, [
            'Content-Type' => 'text/csv',
      ]);
        return $book->toArray(); 

    }
}
