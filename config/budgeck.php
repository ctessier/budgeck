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
    'version' => '0.1-bêta',
    
    /*
    |--------------------------------------------------------------------------
    | Aheadness
    |--------------------------------------------------------------------------
    |
    | This option defines the amount of months ahead the application must set 
    | up the predefined budgets and incomes for the user to start managing.
    |
    | Example: 0 means budgets and incomes for a specific month are only avai-
    | lable when the month actually starts. 1 means the user can start managing
    | his budgets and incomes of the n+1 month.
    |
    */
    
    'aheadness' => 1,
    
];
