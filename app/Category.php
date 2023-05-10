<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['name', 'slug', 'description','type','priority','show' ];

    protected $cascadeDeletes = ['product', 'discount', 'children'];


    public function product() {
        return $this->hasMany('App\product');
    }

    
    public function post() {
        return $this->hasMany('App\Post');
    }
    
    public function movie() {
        return $this->hasMany('App\movies');
    }

    public function discount() {
        return $this->hasMany('App\discounts');
    }

    public function parent() {
        return $this->belongsTo('App\Category', 'parent_id');
    }

    public function children() {
        return $this->hasMany('App\Category', 'parent_id');
    }

    public function allParent()
    {
        return $this->parent()->with('allParent');
    }


    public function allChildren()
    {
        return $this->children()->with('allChildren');
    }


    public static function hierarchy($type = null)
    {
        $query = self::whereRaw('1=1');
        if ($type != null)
            $query = $query->whereIn('type', \Arr::wrap($type));

        return $query
            ->with('allParent')
            ->get()
            ->sortBy(function (Category $category, $key) {
                $sort = $category->id;
                $level = 1;
                $upCategory = $category;
                while (true) {
                    $upCategory = $upCategory->allParent;
                    if (empty($upCategory))
                        break;
                    $sort += $upCategory->id * (1000 ** $level);
                    $level ++;
                }
                $sort *= 1000 ** (3 - $level); // 3 Levels - Change 3 to another number to change deepness
                $category->level = $level;
                return $sort;
            });
    }
}
