<div class="modal fade" id="depositModal" tabindex="-1" aria-labelledby="depositModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="depositModalLabel">Deposit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Deposit Form -->
                <form id="depositForm"  method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" required maxlength="255">
                    </div>

                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" class="form-control" name="amount" required min="0.01"  step="any">
                    </div>

                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.querySelectorAll('.btn[data-bs-toggle="modal"]').forEach(button => {
            button.addEventListener('click', function () {
                var walletUuid = this.getAttribute('data-wallet-uuid');

                document.getElementById('depositForm').setAttribute('action', '{{ route("wallets.transactions.deposit", ["wallet" => "walletUuid"]) }}'.replace('walletUuid', walletUuid));
            });
        });
    </script>
@endpush
