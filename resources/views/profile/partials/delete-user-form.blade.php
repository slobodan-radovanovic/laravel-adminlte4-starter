<section>
    <header class="mb-4">
        <h2 class="h5 mb-1 text-danger">Delete Account</h2>
        <p class="text-muted mb-0">
            Once your account is deleted, all of its resources and data will be permanently deleted.
        </p>
    </header>

    <button type="button"
            class="btn btn-danger"
            data-bs-toggle="modal"
            data-bs-target="#confirm-user-deletion">
        Delete Account
    </button>

    <div class="modal fade"
         id="confirm-user-deletion"
         tabindex="-1"
         aria-labelledby="confirm-user-deletion-label"
         aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('profile.destroy') }}" class="modal-content">
                @csrf
                @method('DELETE')

                <div class="modal-header">
                    <h5 class="modal-title" id="confirm-user-deletion-label">
                        Are you sure you want to delete your account?
                    </h5>

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <p class="text-muted">
                        Once your account is deleted, all of its resources and data will be permanently deleted.
                        Please enter your password to confirm you would like to permanently delete your account.
                    </p>

                    <div class="mb-3">
                        <label for="delete_user_password" class="form-label">
                            Password
                        </label>

                        <input id="delete_user_password"
                               name="password"
                               type="password"
                               class="form-control @error('password', 'userDeletion') is-invalid @enderror"
                               placeholder="Password">

                        @error('password', 'userDeletion')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit" class="btn btn-danger">
                        Delete Account
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
