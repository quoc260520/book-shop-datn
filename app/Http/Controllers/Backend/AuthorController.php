<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAuthorRequest;
use App\Http\Requests\DeleteAuthorRequest;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthorController extends Controller
{
    public function index(Request $request)
    {
        $paged = config('app.page_count');
        $authorName = $request->author_name;
        $authors = Author::when($authorName, function ($query, $authorName) {
            $query->where('name', 'like', ["%$authorName%"]);
        })
            ->orderBy('name')
            ->paginate($paged);
        return view('backend.author.includes._list')
            ->withAuthors($authors)
            ->withAuthorName($authorName);
    }

    public function getCreate()
    {
        return view('backend.author.includes._create');
    }
    public function create(CreateAuthorRequest $request)
    {
        try {
            Author::create([
                'name' => $request->get('author_name'),
                'date_of_birth' => $request->get('date_of_birth'),
                'address' => $request->get('address'),
            ]);
            return back()->withFlashSuccess('Thêm tác giả thành công');
        } catch (\Exception $e) {
            Log::channel('daily')->error('Thêm tác giả lỗi' . $e->getMessage());
            return back()->withFlashDanger('Thêm tác giả không thành công');
        }
    }

    public function getUpdate(Request $request, $id)
    {
        $author = Author::find($id);
        if (!$author) {
            return back()->withFlashDanger('Tác giả không tồn tại');
        }
        return view('backend.author.includes._update')->withAuthor($author);
    }

    public function update(CreateAuthorRequest $request, $id)
    {
        $author = Author::where('id', $id)->first();
        if (!$author) {
            return back()->withFlashDanger('Tác giả không tồn tại');
        }
        try {
            $author->update([
                'name' => $request->get('author_name'),
                'date_of_birth' => $request->get('date_of_birth'),
                'address' => $request->get('address'),
            ]);
            return back()->withFlashSuccess('Cập nhật tác giả thành công');
        } catch (\Exception $e) {
            Log::channel('daily')->error('Cập nhật tác giả lỗi' . $e->getMessage());
            return back()->withFlashDanger('TCập nhật tác giả không thành công');
        }
    }

    public function delete(DeleteAuthorRequest $request)
    {
        $authors = Author::whereIn( 'id', $request->delete_author);
        if (count($authors->get()) != count($request->delete_author)) {
            return back()->withFlashDanger('Một số tác giả không tồn tại');
        }
        try {
            $authors->delete();
            return back()->withFlashSuccess('Xóa tác giả thành công');
        } catch (\Exception $e) {
            Log::channel('daily')->error('Xóa tác giả lỗi:' . $e->getMessage());
            return back()->withFlashDanger('Xóa tác giả không thành công');
        }
    }
}
