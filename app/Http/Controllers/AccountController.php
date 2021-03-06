<?php

namespace Budgeck\Http\Controllers;

use Budgeck\Http\Requests\AccountRequest;
use Budgeck\Models\Account;
use Illuminate\Http\Request;

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
     * @param \Budgeck\Http\Requests\AccountRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AccountRequest $request)
    {
        $account = new Account();
        $account->fill($request->all());
        $account->user_id = $this->user->id;
        $account->save();

        return response()->json([
            'redirect' => route('accounts.show', ['account_id' => $account->id]),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Account $account
     *
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
     * @param Account $account
     *
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
     * @param \Budgeck\Http\Requests\AccountRequest $request
     * @param Account                               $account
     *
     * @return \Illuminate\Http\Response
     */
    public function update(AccountRequest $request, $account)
    {
        $account->update($request->all());

        return response()->json([
            'success' => 'Les informations du compte ont été mises à jour.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Account                  $account
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $account)
    {
        // Delete account only if not default
        if (!$account->is_default) {
            $account->delete();
            $request->session()->set('account', $this->user->defaultAccount());
        } else {
            $request->session()->flash('message', [
                'type'    => 'error',
                'header'  => 'Vous n\'êtes pas autorisé(e) à supprimer ce compte.',
                'content' => 'Pour le supprimer, modifiez votre compte par défaut.',
            ]);
        }

        return redirect()->route('accounts.index');
    }

    /**
     * Switch to a given account.
     *
     * @param \Illuminate\Http\Request $request
     * @param Account                  $account
     *
     * @return \Illuminate\Http\Response
     */
    public function change(Request $request, $account)
    {
        // Set new current account
        $request->session()->set('account', $account);

        // Redirect to previous page
        return redirect()->back();
    }
}
