<?php

namespace Budgeck;

class Category extends BaseModel
{   
    /**
     * Get list of spending categories
    */
    public static function getSpendingCategoriesList()
    {
        return self::where('category_type_id', CategoryType::SPENDING)
            ->lists('name', 'id');
    }
    
    /**
     * Get list of income categories
    */
    public static function getIncomeCategoriesList()
    {
        return self::where('category_type_id', CategoryType::INCOME)
            ->lists('name', 'id');
    }
}