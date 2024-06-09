<?php

namespace App\Services;

use App\Models\Wallet;
use App\Enums\WalletStatus;
use Illuminate\Support\Facades\Auth;

class WalletService
{
    public function listWallets()
    {
        if (Auth::user()->isAdmin()) {
            return $this->listAllWallets();
        } else {
            return $this->listUserWallets();
        }
    }

    private function listUserWallets()
    {
        return Auth::user()->wallets()->select(['id', 'uuid', 'title', 'description', 'status', 'created_at'])->get();
    }

    private function listAllWallets()
    {
        return Wallet::with(['user' => function ($query) {
            $query->select(['id', 'name']);
        }])->select(['uuid', 'user_id', 'title', 'description', 'status', 'created_at'])->get();
    }

    public function createWallet(string $title, string $description, WalletStatus $status)
    {
        return Auth::user()->wallets()->create([
            'title' => $title,
            'description' => $description,
            'status' => $status->value
        ]);
    }

    public function updateWallet(Wallet $wallet,string $title, string $description, WalletStatus $status)
    {
        $wallet->update([
            'title' => $title,
            'description' => $description,
            'status' => $status->value
        ]);
    }
}
