<?php

namespace App\Http\Controllers;

use App\Enums\TransactionType;
use App\Http\Requests\TransactionRequest;
use App\Models\Wallet;
use App\Services\TransactionService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TransactionController extends Controller
{
    public function __construct(protected TransactionService $transactionService)
    {
    }

    public function deposit(TransactionRequest $request, Wallet $wallet)
    {
        if (Gate::denies('deposit', $wallet)) {
            return redirect()->back()->withErrors(['message' => 'You are not authorized to make a deposit.']);
        }

        $this->transactionService->performTransaction(
            $wallet,
            TransactionType::Deposit,
            $request->input('title'),
            $request->input('amount')
        );

        return redirect()->back()->with('success', 'Deposit successful.');
    }

    public function withdraw(TransactionRequest $request, Wallet $wallet)
    {
        if (Gate::denies('withdraw', [$wallet, $request->input('amount')])) {
            return redirect()->back()->withErrors(['message' => 'Insufficient funds for withdrawal.']);
        }

        $this->transactionService->performTransaction(
            $wallet,
            TransactionType::Withdraw,
            $request->input('title'),
            $request->input('amount')
        );

        return redirect()->back()->with('success', 'Withdrawal successful.');
    }

    public function index(Wallet $wallet)
    {
        $transactions = $wallet->transactions()->select(['title', 'created_at', 'amount', 'type'])->get();

        $depositCount = $transactions->where('type', 'deposit')->count();
        $withdrawalCount = $transactions->where('type', 'withdraw')->count();

        return response()->json([
            'transactions' => $transactions,
            'depositCount' => $depositCount,
            'withdrawCount' => $withdrawalCount,
            'totalAmount' => $wallet->balance
        ]);
    }
}
