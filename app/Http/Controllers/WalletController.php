<?php

namespace App\Http\Controllers;

use App\Enums\WalletStatus;
use App\Http\Requests\WalletRequest;
use App\Models\Wallet;
use App\Services\WalletService;
use Illuminate\Support\Facades\Gate;

class WalletController extends Controller
{
    public function __construct(protected WalletService $walletService)
    {
    }

    public function index()
    {
        $listWallets = $this->walletService->listWallets();

        return view('pages.wallets.index', compact('listWallets'));
    }

    public function create()
    {
        return view('pages.wallets.create');
    }

    public function store(WalletRequest $request)
    {
        $this->walletService->createWallet(
            $request->input('title'),
            $request->input('description'),
            WalletStatus::tryFrom($request->input('status')));

        return redirect()->back()->with('success', 'Wallet created successfully.');
    }

//    public function edit(Wallet $wallet) {
//        Gate::authorize('update', $wallet);
//
//        return view('tests.wallet.form', compact('wallet'));
//    }

    public function update(Wallet $wallet, WalletRequest $request)
    {
        Gate::authorize('update', $wallet);

        $this->walletService->updateWallet(
            $wallet,
            $request->input('title'),
            $request->input('description'),
            WalletStatus::tryFrom($request->input('status'))
        );

        return redirect()->back()->with('success', 'Wallet updated successfully.');
    }
}
