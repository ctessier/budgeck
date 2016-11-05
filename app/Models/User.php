<?php

namespace Budgeck\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;

class User extends BaseModel implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['email', 'firstname', 'lastname'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Returns collection of user's accounts.
     *
     * @return Collection
     */
    public function accounts()
    {
        return $this->hasMany($this->getBaseNamespace().'\Account');
    }

    /**
     * Return user's accounts as a list.
     *
     * @return array
     */
    public function getAccountsList()
    {
        return Account::where('user_id', $this->id)
            ->lists('name', 'id');
    }

    /**
     * Returns the default account of the user.
     *
     * @return Account
     */
    public function defaultAccount()
    {
        return Account::where('user_id', $this->id)
            ->where('is_default', true)
            ->firstOrFail();
    }

    /**
     * Returns the total balance of the user (all accounts included).
     *
     * @return float
     */
    public function getTotalBalance()
    {
        $totalBalance = 0;

        foreach ($this->accounts as $account) {
            $totalBalance += $account->getBalance();
        }

        return $totalBalance;
    }
}
