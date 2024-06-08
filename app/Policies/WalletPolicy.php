<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Wallet;

class WalletPolicy
{
    public function withdraw(User $user, Wallet $wallet, float $amount)
    {
        return $wallet->balance >= $amount;
    }

    public function deposit(User $user, Wallet $wallet)
    {
        return true;
    }
}
