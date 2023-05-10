<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\CategoryStoreRequest;
use App\Http\Requests\Dashboard\Admin\CategoryUpdateRequest;

class CategoryController extends Controller
{

    public function index() {
        return view('dashboard.admin.categories.index', [
            'categories' => Category::hierarchy(),
        ]);
    }
    
    public function delete($id) {
        $post = category::find($id);
        $post->delete();
        return redirect()->route('dashboard.admin.categories.index')
            ->with('success', 'دسته بندی حذف شد!');
    }

    public function create() {
        return view('dashboard.admin.categories.create', [
            'categories' => Category::hierarchy(),
        ]);
    }

    public function store(CategoryStoreRequest $request) {
        $category = new Category($data = $request->validated());
        $category->parent_id = $data['parent_id'];
        $category->save();
        return redirect()->route('dashboard.admin.categories.index')
            ->with('success', 'دسته‌بندی با موفقیت ساخته شد!');
    }

    public function edit(Category $category) {
        return view('dashboard.admin.categories.edit', [
            'category' => $category,
            'categories' => Category::hierarchy(),
        ]);
    }

    public function update(CategoryUpdateRequest $request, Category $category) {
        $category->fill($data = $request->validated());
        $category->parent_id = $data['parent_id'];
        $category->save();
        return redirect()->route('dashboard.admin.categories.index')
            ->with('success', 'دسته‌بندی با موفقیت ویرایش شد!');
    }

}
