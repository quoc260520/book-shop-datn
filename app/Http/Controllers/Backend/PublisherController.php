<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePublisherRequest;
use App\Http\Requests\DeletePublisherRequest;
use App\Http\Requests\UpdatePublisherRequest;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PublisherController extends Controller
{
    public function index(Request $request)
    {
        $paged = config('app.page_count');
        $publisherName = $request->publisher_name;
        $email = $request->email_search;
        $phone = $request->phone;
        $address = $request->address;
        $publishers = Publisher::when($publisherName, function ($query, $publisherName) {
            $query->where('publisher_name', 'like', ["%$publisherName%"]);
        })
            ->when($email, function ($query, $email) {
                $query->where('email', 'like', ["%$email%"]);
            })
            ->when($phone, function ($query, $phone) {
                $query->where('phone', 'like', ["%$phone%"]);
            })
            ->when($address, function ($query, $address) {
                $query->where('address', 'like', ["%$address%"]);
            })
            ->orderBy('publisher_name')
            ->paginate($paged);
        return view('backend.publisher.includes._list')
            ->withPublishers($publishers)
            ->withPublisherName($publisherName)
            ->withEmail($email)
            ->withPhone($phone)
            ->withAddress($address);
    }

    public function getCreate(Request $request)
    {
        return view('backend.publisher.includes._create');
    }

    public function create(CreatePublisherRequest $request)
    {
        try {
            Publisher::create([
                'publisher_name' => $request->publisher_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'more_info' => $request->info,
            ]);
            return back()->withFlashSuccess('Thêm nhà xuất bản thành công');
        } catch (\Exception $e) {
            Log::channel('daily')->error('Thêm nhà xuất bản không thành công' . $e->getMessage());
            return back()->withFlashDanger('Thêm nhà xuất bản không thành công');
        }
    }

    public function getUpdate(Request $request, $id)
    {
        $publisher = Publisher::find($id);
        if (!$publisher) {
            return back()->withFlashDanger('Nhà xuất bản không tồn tại');
        }
        return view('backend.publisher.includes._update')->withPublisher($publisher);
    }

    public function update(UpdatePublisherRequest $request)
    {
        $publisher = Publisher::where('id', $request->publisher_id);
        if (!count($publisher->get())) {
            return redirect()
                ->route('admin.publisher.list')
                ->withFlashDanger('Nhà xuất bản không tồn tại');
        }
        try {
            $publisher->update([
                'publisher_name' => $request->publisher_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'more_info' => $request->info,
            ]);
            return redirect()
                ->route('admin.publisher.list')
                ->withFlashSuccess('Cập nhật thành công');
        } catch (\Exception $e) {
            log::channel('daily')->error('Cập nhật ncb lỗi:' . $e->getMessage());
            return back()->withFlashDanger('Cập nhật không thành công');
        }
    }

    public function deletePublishers(DeletePublisherRequest $request)
    {
        $publishers = Publisher::whereIn('id', $request->delete_publisher);
        if (count($publishers->get()) != count($request->delete_publisher)) {
            return back()->withFlashDanger('Một số nhà xuất bản không tồn tại');
        }
        try {
            $publishers->delete();
            return back()->withFlashSuccess('Xóa nhà xuất bản thành công');
        } catch (\Exception $e) {
            Log::channel('daily')->error('Xóa nhà xuất bản lỗi:' . $e->getMessage());
            return back()->withFlashDanger('Xóa nhà xuất bản không thành công');
        }
    }
}
