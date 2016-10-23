<?php

namespace Budgeck\Http\Controllers;

class DefaultAccountController extends Controller
{
    /**
     * Update default account.
     *
     * @param \Budgeck\Models\Account $account
     *
     * @return \Illuminate\Http\Response
     */
    public function update($account)
    {
        $account->makeDefault();

        return redirect()->route('accounts.index');
    }
}
