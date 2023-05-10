<x-text-group name="name" label="نام" :model="$model ?? null" />
<textarea  name="description" label="توضیح کوتاه" requierd></textarea>
<x-text-group name="slug" label="نام کوتاه انگلیسی (تنها a تا z و عدد و - مورد قبول)" :model="$model ?? null" />
@include('dashboard.admin.partials.form.select', [
    'name' => 'type',
    'label' => __('نوع دسته بندی'),
    'options' => [
        'product' => __('محصول'),
        'post' => __('بلاگ'),
        'movie' => __('فیلم'),
    ]
]) 

<x-select-group name="show" label="قابل نمایش" :model="$model ?? null">
    <x-select-item value="1">نمایش در دسته بندی ها</x-select-item>
    <x-select-item value="0">عدم نمایش در دسته بندی ها</x-select-item>
</x-select-group>

<x-text-group  label="اولویت " name="priority" :model="$model ?? null"  />   

<x-select-group name="parent_id" label="دسته‌بندی مادر" :model="$model ?? null">
    <x-select-item value="">بدون مادر</x-select-item>
    @foreach($categories->reject(function($value, $key) { return !empty($model) ? $value->is($model) : false; }) as $category)
        <x-select-item :value="$category->id">@if(!empty($category->parent_id))@for($i = 2; $i <= $category->level; $i ++)&nbsp;&nbsp;&nbsp;@endfor&#x2500;&#x251c; @endif{{ $category->name }}</x-select-item>
    @endforeach
</x-select-group>