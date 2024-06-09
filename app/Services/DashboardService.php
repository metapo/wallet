<?php

namespace App\Services;

class DashboardService
{
    public function __construct(protected WalletService $walletService)
    {
    }
    public function getDashboardView($user)
    {
        if ($user->isAdmin()) {
            $view = view('pages.dashboards.admin');
        } else {
            $userWallets = $this->walletService->listWallets();
            $view = view('pages.dashboards.user', compact('userWallets'));
        }

        return $view;
    }
}
