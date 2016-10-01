<?php

namespace Budgeck\Http\Controllers;

use Illuminate\Http\Request;

use Budgeck\Http\Requests\AccountRequest;
use Budgeck\Http\Controllers\Controller;
use Budgeck\Models\Account;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('accounts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('accounts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Budgeck\Http\Requests\AccountRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AccountRequest $request)
    {
        $account = new Account();
        $account->fill($request->all());
        $account->user_id = $this->user->id;
        $account->save();

        return response()->json([
            'redirect' => route('accounts.show', ['account_id' => $account->id])
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        return view('accounts.show')
            ->with('account', $account);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit($account)
    {
        return view('accounts.edit')
            ->with('account', $account);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Budgeck\Http\Requests\AccountRequest $request
     * @param  Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(AccountRequest $request, $account)
    {
        $account->update($request->all());

        return response()->json([
            'success' => 'Les informations du compte ont été mises à jour.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy($account)
    {
        //TODO: nested delete and make sure to keep one default (compte courant)
        $account->delete();

        return redirect()->route('accounts.index');
    }

    /**
     * Switch to a given account
     *
     * @param \Illuminate\Http\Request  $request
     * @param  Account  $account
     * @return \Illuminate\Http\Response
     */
    public function switch(Request $request, $account)
    {
        // Set new current account
        $request->session()->set('account', $account);

        // Redirect to previous page
        return redirect()->back();
    }
}
