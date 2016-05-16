<?php

namespace Budgeck\Models;

class Category extends BaseModel
{
    /**
     * Get list of spending categories
    */
    public static function getExpenseCategoriesList()
    {
        $collection = self::select('categories.name', 'categories.id')
            ->where('category_type_id', CategoryType::EXPENSE)
            ->lists('name', 'id');

        $collection->prepend('-- Sélectionner --', 0);
        return $collection;
    }

    /**
     * Get list of income categories
    */
    public static function getIncomeCategoriesList()
    {
        $collection = self::where('category_type_id', CategoryType::INCOME)
            ->lists('name', 'id');

        $collection->prepend('-- Sélectionner --', 0);
        return $collection;
    }
}