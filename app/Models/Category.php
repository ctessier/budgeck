<?php

namespace Budgeck\Models;

use Illuminate\Support\Facades\Auth;

class Category extends BaseModel
{
    /**
     *
     */
    public static function getList($category_type)
    {
        $parentCategories = self::where('category_type_id', $category_type)
            ->whereNull('parent_category_id')
            ->where(function ($query) {
                $query->whereNull('user_id');
                $query->orWhere('user_id', Auth::user()->id);
            })
            ->get();

        $categories = [];
        foreach ($parentCategories as $parentCategory)
        {
            $categories[$parentCategory->name] = $parentCategory->getChildren();
        }

        array_unshift($categories, 'Sélectionner une catégorie');
        return $categories;
    }

    public function getChildren()
    {
        return self::where('parent_category_id', $this->id)
            ->where(function ($query) {
                $query->whereNull('user_id');
                $query->orWhere('user_id', Auth::user()->id);
            })
            ->lists('name', 'id')
            ->toArray();
    }
}
