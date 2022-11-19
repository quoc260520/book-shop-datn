<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSlider;
use App\Http\Requests\DeleteSlider;
use App\Http\Requests\UpdateSliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('backend.slider.index')->withSliders($sliders);
    }
    public function createSlider(CreateSlider $request)
    {
        $allowFileExtension = ['jpg', 'png', 'jpeg'];
        $file = $request->image;
        if ($request->hasFile('image')) {
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '_slider' . Str::random(4) . '.' . $extension;
            $check = in_array($extension, $allowFileExtension);
            if ($check) {
                Storage::cloud()->put($filename, file_get_contents($file->getRealPath()));
            }
        }
        try {
            $data = [
                'link' => $request->link,
                'image' => $filename,
            ];
            Slider::create($data);
            return back()->withFlashSuccess('Thêm slider thành công.');
        } catch (\Exception $e) {
            Log::channel('daily')->error('Thêm slider lỗi' . $e->getMessage());
            return back()->withFlashDanger('Thêm slider không thành công.');
        }
    }

    public function deleteSlider(DeleteSlider $request)
    {
        $sliderIds = $request->delete_slider;
        $sliderDeletes = Slider::whereIn('id', $sliderIds)->get();
        if (count($sliderIds) != count($sliderDeletes)) {
            return back()->withFlashDanger('Có slider đã bị xóa đi.');
        }
        try {
            DB::beginTransaction();
            foreach ($sliderDeletes as $slider) {
                $slider->delete();
                if ($slider->image) {
                    Storage::cloud()->delete($slider->image);
                }
            }
            DB::commit();
            return back()->withFlashSuccess('Xóa slider thành công.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::channel('daily')->error('Xóa slider lỗi' . $e->getMessage());
            return back()->withFlashDanger('Xóa slider không thành công.');
        }
    }
    public function getUpdateSlider(Request $request, $sliderId) {
        $slider = Slider::find($sliderId);
        if(!$slider) {
            Session::flash('flash_danger','Slider không tồn tại.');
            return response()->json('slider not found', 402);
        }
        $view = view('backend.slider.includes._modal_detail')->withSlider($slider)->toHtml();
        return response()->json($view) ;
    }
    public function updateSlider(UpdateSliderRequest $request) {
        $id = $request->slider_id;
        $imageUpdate = $request->image_old;
        $allowFileExtension = ['jpg', 'png', 'jpeg'];
        $slider = Slider::where('id',$id);
        if(!$slider) {
            $request->session()->flash('flash_danger','Slider không tồn tại.');
            return response()->json('slider not found', 401);
        }
        try {
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '_slider' . Str::random(4) . '.' . $extension;
                $check = in_array($extension, $allowFileExtension);
                if ($check) {
                    Storage::cloud()->delete($imageUpdate);
                    Storage::cloud()->put($filename, file_get_contents($file->getRealPath()));
                    $imageUpdate = $filename;
                }
            }
            $slider->update([
                'link' => $request->link_update,
                'image' => $imageUpdate
            ]);
            $request->session()->flash('flash_success','Cập nhật slider thành công.');
            return response()->json('update slider success');
        } catch(\Exception $e) {
            Log::channel('daily')->error('update slider error: ' . $e->getMessage());
            $request->session()->flash('flash_danger','Cập nhật slider không thành công.');
            return response()->json('update slider error', 401);
        }
    }

}
