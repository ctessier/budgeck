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
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getList($category_type)
    {
        $categories = self::where('category_type_id', $category_type)
            ->whereNull('parent_category_id')
            ->where(function ($query) {
                $query->whereNull('user_id');
                $query->orWhere('user_id', Auth::user()->id);
            })
            ->get();

        return $categories;
    }

    /**
     * Return the children categories.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function children()
    {
        return $this->hasMany($this->getBaseNamespace().'\Category', 'parent_category_id');
    }
}
