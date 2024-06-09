@extends('layouts.app')

@section('title', 'wallets list')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <table id="wallets_table" class="display">
        <thead>
        <tr>
            <th>Wallet</th>
            <th>Creation Date</th>
            <th>Last Transaction Date</th>
            <th>Balance</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($listWallets as $wallet)
            <tr>
                <td>{{ $wallet->title }}</td>
                <td>{{ $wallet->created_at }}</td>
                <td>{{ $wallet->lastTransactionDate() }}</td>
                <td>{{ $wallet->balance }}</td>
                <td>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#depositModal"
                            data-toggle="tooltip" data-placement="top" title="Deposit" data-wallet-uuid="{{$wallet->uuid}}">
                        <i class="bi bi-arrow-down-circle"></i>
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#withdrawModal"
                            data-toggle="tooltip" data-placement="top" title="Withdraw" data-wallet-uuid="{{$wallet->uuid}}">
                        <i class="bi bi-arrow-up-circle"></i>
                    </button>
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editModal"
                            data-toggle="tooltip" data-placement="top" title="Edit Wallet"
                            data-wallet-uuid="{{$wallet->uuid}}" data-wallet-title="{{$wallet->title}}"
                            data-wallet-description="{{$wallet->description}}" data-wallet-status="{{$wallet->status}}">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#transactionsModal"
                            data-toggle="tooltip" data-placement="top" title="Transactions List" data-wallet-uuid="{{$wallet->uuid}}">
                        <i class="bi bi-list"></i>
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


    @include('pages.wallets.transactions.deposit')
    @include('pages.wallets.transactions.withdraw')
    @include('pages.wallets.transactions.list')
    @include('pages.wallets.edit')

@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#wallets_table').DataTable({
                "pageLength": 5,
                "lengthChange": false
            });
        });
    </script>
@endpush
