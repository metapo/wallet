<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Wallet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- edit Form -->
                <form id="editForm" method="POST">
                    @csrf

                    @method('PATCH')

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="edit-title" name="title" required>

                        @error('title')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mt-2">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="edit-description" name="description"></textarea>

                        @error('description')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mt-2">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                        </select>

                    </div>
                    <button type="submit" class="btn btn-primary mt-4">Create Wallet</button>
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
                var walletTitle = this.getAttribute('data-wallet-title');
                var walletDescription = this.getAttribute('data-wallet-description');
                var walletStatus = this.getAttribute('data-wallet-status');

                document.getElementById('editForm').setAttribute('action', '{{ route("wallets.update", ["wallet" => "walletUuid"]) }}'.replace('walletUuid', walletUuid));
                document.getElementById('edit-title').setAttribute('value', walletTitle);
                document.getElementById('edit-description').value = walletDescription;
                document.getElementById('status').value = walletStatus;
            });
        });
    </script>
@endpush

