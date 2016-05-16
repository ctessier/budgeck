<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application
    |--------------------------------------------------------------------------
    |
    | These options let you set up the name you want for the application and
    | the currently running version.
    |
    */

    'appName' => 'Budgeck',
    'version' => '0.2',

    /*
    |--------------------------------------------------------------------------
    | Aheadness
    |--------------------------------------------------------------------------
    |
    | This option defines the amount of months ahead the application must set
    | up the predefined budgets for the user to start managing.
    |
    | Example: 0 means budgets for a specific month are only available when
    | the month actually starts. 1 means the user can start managing
    | his budgets of the n+1 month.
    |
    */

    'aheadness' => 1,
];
