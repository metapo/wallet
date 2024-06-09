@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<table id="user_table" class="display">
    <thead>
    <tr>
        <th>Wallet</th>
        <th>Balance</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
        @foreach($userWallets as $userWallet)
            <tr>
                <td>{{ $userWallet->title }}</td>
                <td>{{ $userWallet->balance }}</td>
                <td>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#depositModal"
                            data-toggle="tooltip" data-placement="top" title="Deposit" data-wallet-uuid="{{$userWallet->uuid}}">
                        <i class="bi bi-arrow-down-circle"></i>
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#withdrawModal"
                            data-toggle="tooltip" data-placement="top" title="Withdraw" data-wallet-uuid="{{$userWallet->uuid}}">
                        <i class="bi bi-arrow-up-circle"></i>
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@include('pages.wallets.transactions.deposit')
@include('pages.wallets.transactions.withdraw')
