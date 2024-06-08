<?php

namespace App\Services;

use App\Enums\TransactionType;
use App\Models\Transaction;
use App\Models\Wallet;

class TransactionService
{
    public function performTransaction(Wallet $wallet, TransactionType $type, string $title, float $amount)
    {
        $transaction = Transaction::create([
            'wallet_id' => $wallet->id,
            'title' => $title,
            'amount' => $amount,
            'type' => $type->value,
        ]);

        return $transaction;
    }
}
