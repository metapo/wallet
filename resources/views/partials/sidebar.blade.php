<aside class="col-md-3 col-lg-2 d-md-block bg-light sidebar vh-100" id="sidebar">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">

            @can('dashboard')
                <li class="nav-item">
                    <a class="nav-link  {{ Route::currentRouteName() == 'dashboard' ? 'text-black' : '' }}"
                       aria-current="page" href="{{ route('dashboard') }}">
                        <i class="bi bi-house-door"></i>
                        Dashboard
                    </a>
                </li>
            @endcan

            @can('wallets')
                <li class="nav-item">
                    <a class="nav-link" href="#" >
                        <i class="bi bi-wallet"></i>
                        Wallet
                    </a>
                    <ul>
                        <li><a class="nav-link {{ Route::currentRouteName() == 'wallets.index' ? 'text-black' : '' }}"
                               href="{{ route('wallets.index') }}">List</a></li>
                        <li><a class="nav-link {{ Route::currentRouteName() == 'wallets.create' ? 'text-black' : '' }}"
                               href="{{ route('wallets.create') }}">New Wallet</a></li>
                    </ul>
                </li>
            @endcan

        </ul>
    </div>
</aside>
