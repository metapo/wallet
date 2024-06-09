<div class="modal fade" id="transactionsModal" tabindex="-1" aria-labelledby="transactionsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="transactionsModalLabel">Transactions List</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span class="summary-box">
                    <span class="px-2"><strong>Deposit Transactions:</strong><span id="depositCount"></span></span>
                    <span class="px-2"><strong>Withdraw Transactions:</strong> <span id="withdrawCount"></span></span>
                    <span class="px-2"><strong>Total Amount:</strong> <span id="totalAmount"></span></span>
                </span>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Type</th>
                    </tr>
                    </thead>
                    <tbody id="transactions_body">
                    <!-- Transactions will be appended here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.querySelectorAll('.btn[data-bs-toggle="modal"]').forEach(button => {
            button.addEventListener('click', function () {
                var walletUuid = this.getAttribute('data-wallet-uuid');

                // Clear the table body
                $('#transactions_body').empty();

                $.ajax({
                    url: '{{ route("wallets.transactions.index", ["wallet" => "walletUuid"]) }}'.replace('walletUuid', walletUuid),
                    method: 'GET',
                    success: function(response) {
                        $('#transactions_body').empty();

                        $('#depositCount').text(response.depositCount);
                        $('#withdrawCount').text(response.withdrawCount);
                        $('#totalAmount').text(response.totalAmount);

                        // Populate the table body with the received data
                        response.transactions.forEach(function(transaction) {
                            var row = '<tr>' +
                                '<td>' + transaction.title + '</td>' +
                                '<td>' + transaction.created_at + '</td>' +
                                '<td>' + transaction.amount + '</td>' +
                                '<td>' + transaction.type + '</td>' +
                                '</tr>';
                            $('#transactions_body').append(row);
                        });
                    },
                    error: function() {
                        alert('Failed to load transactions.');
                    }
                });
            });
        });
    </script>
@endpush
