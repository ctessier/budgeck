<?php

namespace Budgeck;

class BudgetType extends BaseModel
{
    const SINGLE = 1;
    const MULTIPLE = 2;
    
    /**
     * Get budget types list
    */
    public static function getList()
    {
        return self::lists('name', 'id');
    }
}
