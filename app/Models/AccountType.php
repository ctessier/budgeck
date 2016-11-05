<?php

namespace Budgeck\Models;

class AccountType extends BaseModel
{
    /**
     * Constant for checking account.
     *
     * @var int
     */
    const CHECKING = 1;

    /**
     * Constant for savings account.
     *
     * @var int
     */
    const SAVINGS = 2;
}
