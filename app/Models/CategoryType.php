<?php

namespace Budgeck\Models;

class CategoryType extends BaseModel
{
    /**
     * Constant for category type of expense.
     *
     * @var int
     */
    const EXPENSE = 1;

    /**
     * Constant for category type of income.
     *
     * @var int
     */
    const INCOME = 2;
}
