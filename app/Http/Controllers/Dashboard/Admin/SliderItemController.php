<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\SliderItemStoreRequest;
use App\Http\Requests\Dashboard\Admin\SliderItemUpdateRequest;
use Illuminate\Support\Facades\Storage;
use App\SliderItem;

class SliderItemController extends Controller
{
    public function __construct()
    {
//        $this->authorizeResource(SliderItem::class, 'slider-item');
    }

    public function index() {
        
        return view('dashboard.admin.slider-items.index', [
            'sliderItems' => SliderItem::orderBy('priority', 'desc')->get()
        ]);
    }

    public function create() {
        return view('dashboard.admin.slider-items.create');
    }

    public function store(SliderItemStoreRequest $request) {
        $item = SliderItem::create($request->validated());
        if($request->hasfile('image'))
         {
              $uploadedFile = $request->file('image');
              $filename = $uploadedFile->getClientOriginalName();
      
              Storage::disk('local')->putFileAs($filename, $uploadedFile, $filename);
              $item->image = $filename;
         }
        $item->save();
        return redirect()->route('dashboard.admin.slider-items.index')
            ->with('success', 'اسلایدر با موفقیت ساخته شد!');
    }

    public function edit(SliderItem $sliderItem) {
        return view('dashboard.admin.slider-items.edit', ['item' => $sliderItem]);
    }

    public function update(SliderItemUpdateRequest $request, SliderItem $sliderItem) {
        $sliderItem->update($request->validated());
        if ($request->hasFile('image') && $request->file('image')->isValid())
            if($request->hasfile('image'))
             {
                  $uploadedFile = $request->file('image');
                  $filename = $uploadedFile->getClientOriginalName();
          
                  Storage::disk('local')->putFileAs($filename, $uploadedFile, $filename);
                  $sliderItem->image = $filename;
             }
        $sliderItem->save();

        return redirect()->route('dashboard.admin.slider-items.index')
            ->with('success', 'اسلایدر با موفقیت ویرایش شد!');
    }

    public function destroy(SliderItem $sliderItem) {
        $sliderItem->delete();
        return redirect()->route('dashboard.admin.slider-items.index')
            ->with('success', 'اسلایدر با موفقیت حذف شد!');
    }
}
