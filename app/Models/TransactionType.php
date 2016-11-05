<?php

namespace Budgeck\Models;

class TransactionType extends BaseModel
{
    /**
     * Constant for transaction of type expense.
     *
     * @var int
     */
    const EXPENSE = 1;

    /**
     * Constant for transaction of type income.
     *
     * @var int
     */
    const INCOME = 2;
}
