<?php

namespace Budgeck\Models;

use Illuminate\Support\Facades\Auth;

class Category extends BaseModel
{
    /**
     * Return the list of categories according to a given category type.
     *
     * @param CategoryType $category_type
     *
     * @return array
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
        foreach ($parentCategories as $parentCategory) {
            $categories[$parentCategory->name] = $parentCategory->getChildren();
        }

        return $categories;
    }

    /**
     * Return the children categories of self.
     *
     * @return array
     */
    protected function getChildren()
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
