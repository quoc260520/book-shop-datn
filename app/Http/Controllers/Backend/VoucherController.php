<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateVoucherRequest;
use App\Http\Requests\DeleteVoucherRequest;
use App\Http\Requests\UpdateVoucherRequest;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VoucherController extends Controller
{
    public function index(Request $request)
    {
        $paged = config('app.page_count');
        $startTime = $request->start_time;
        $endTime = $request->end_time;
        $vouchers = Voucher::when($startTime, function ($query, $startTime) {
            $query->whereDate('start_date', format_date($startTime));
        })
            ->when($endTime, function ($query, $endTime) {
                $query->whereDate('end_date', format_date($endTime));
            })
            ->paginate($paged);
        return view('backend.voucher.includes._list')
            ->withVouchers($vouchers)
            ->withStartTime($startTime)
            ->withEndTime($endTime);
    }

    public function getCreate(Request $request)
    {
        return view('backend.voucher.includes._create');
    }

    public function create(CreateVoucherRequest $request)
    {
        try {
            Voucher::create([
                'code' => $request->code,
                'amount' => $request->amount,
                'percent' => $request->percent,
                'start_date' => $request->time_start,
                'end_date' => $request->time_end,
            ]);
            return back()->withFlashSuccess('Thêm mã giảm giá thành công');
        } catch (\Exception $e) {
            Log::channel('daily')->error('Thêm mgg lỗi:' . $e->getMessage());
            return back()->withFlashDanger('Thêm mã giảm giá lỗi');
        }
        return view('backend.voucher.includes._create');
    }

    public function getUpdate($id)
    {
        $voucher = Voucher::find($id);
        if (!$voucher) {
            return back()->withFlashDanger('Mã giảm giá không tồn tại');
        }
        return view('backend.voucher.includes._update')->withVoucher($voucher);
    }

    public function update(UpdateVoucherRequest $request)
    {
        $voucher = Voucher::where('id', $request->id);
        if (!$voucher) {
            return back()->withFlashDanger('Mã giảm giá không tồn tại');
        }
        try {
            $voucher->update([
                'code' => $request->code,
                'amount' => $request->amount,
                'percent' => $request->percent,
                'start_date' => $request->time_start,
                'end_date' => $request->time_end,
            ]);
        } catch (\Exception $e) {
            Log::channel('daily')->error('Cập nhật mgg lỗi:' . $e->getMessage());
            return back()->withFlashDanger('Cập nhật mã giảm giá lỗi');
        }

        return back()->withFlashSuccess('Cập nhật mã giảm giá thành công');
    }

    public function deleteVouchers(DeleteVoucherRequest $request)
    {
        $vouchers = Voucher::whereIn('id', $request->delete_voucher);
        if (count($vouchers->get()) != count($request->delete_voucher)) {
            return back()->withFlashDanger('Một số mã giảm giá không tồn tại');
        }

        try {
            $vouchers->delete();
        } catch (\Exception $e) {
            Log::channel('daily')->error('Xóa mgg lỗi:' . $e->getMessage());
            return back()->withFlashDanger('Xóa mã giảm giá không thành công');
        }
        return back()->withFlashSuccess('Xóa mã giảm giá thành công');
    }
}
