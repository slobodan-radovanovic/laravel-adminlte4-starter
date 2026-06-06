<section>
    <header class="mb-4">
        <h2 class="h5 mb-1">Profile Information</h2>
        <p class="text-muted mb-0">
            Update your account's profile information and email address.
        </p>
    </header>

    <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>

            <input id="name"
                   name="name"
                   type="text"
                   class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $user->name) }}"
                   required
                   autofocus
                   autocomplete="name">

            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>

            <input id="email"
                   name="email"
                   type="email"
                   class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email', $user->email) }}"
                   required
                   autocomplete="username">

            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3">
                    <p class="text-muted mb-2">
                        Your email address is unverified.
                    </p>

                    <button form="send-verification" class="btn btn-link p-0">
                        Click here to re-send the verification email.
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <div class="text-success mt-2">
                            A new verification link has been sent to your email address.
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary">
                Save
            </button>

            @if (session('status') === 'profile-updated')
                <span class="text-success">
                    Saved.
                </span>
            @endif
        </div>
    </form>
</section>
