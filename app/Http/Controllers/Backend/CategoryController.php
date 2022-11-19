<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\DeleteCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function index()
    {
        $categorys = Category::orderBy('parent_id')
            ->orderBy('category_name')
            ->with('category')
            ->get();
        return view('backend.category.index')->withCategorys($categorys);
    }

    public function createCategory(CreateCategoryRequest $request)
    {
        try {
            Category::create([
                'category_name' => $request->category_name,
                'parent_id' => $request->category_parent,
            ]);
            return back()->withFlashSuccess('Thêm danh mục thành công');
        } catch (\Exception $e) {
            Log::channel('daily')->error('Thêm danh mục lỗi' . $e->getMessage());
            return back()->withFlashDanger('Thêm danh mục không thành công');
        }
    }

    public function getUpdate($id)
    {
        $listCategory = Category::with('category')->get();
        $category = $listCategory->where('id', $id)->first();
        $categorys = $listCategory->where('id', '<>', $id);
        $view = view('backend.category.includes._modal_detail')
            ->withCategory($category)->withCategorys($categorys)
            ->toHtml();
        return response()->json($view);
    }

    public function update(CreateCategoryRequest $request)
    {
        try {
            Category::where('id', $request->category_id)->update([
                'category_name' => $request->category_name,
                'parent_id' => $request->category_parent
            ]);
            return back()->withFlashSuccess('Cập nhật danh mục thành công');
        } catch(\Exception $e) {
            Log::channel('daily')->error($e->getMessage());
            return back()->withFlashDanger('Cập nhật danh mục không thành công');
        }
    }

    public function deleteCategorys(DeleteCategoryRequest $request)
    {
        $categoryDelete = Category::whereIn('id', $request->delete_category)->get();
        try {
            DB::beginTransaction();
            foreach ($categoryDelete as $category) {
                $category->delete();
            }
            DB::commit();
            return back()->withFlashSuccess('Xóa danh mục thành công');
        } catch (\Exception $e) {
            Db::rollBack();
            Log::channel('daily')->error('Xóa danh mục lỗi' . $e->getMessage());
            return back()->withFlashDanger('Xóa danh mục không thành công');
        }
    }
}
