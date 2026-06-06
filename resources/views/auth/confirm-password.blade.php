<x-guest-layout>
    <p class="login-box-msg">
        This is a secure area of the application. Please confirm your password before continuing.
    </p>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="input-group mb-3">
            <input id="password"
                   type="password"
                   name="password"
                   class="form-control @error('password') is-invalid @enderror"
                   placeholder="Password"
                   required
                   autocomplete="current-password">

            <span class="input-group-text">
                <i class="bi bi-lock"></i>
            </span>

            @error('password')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100">
            Confirm
        </button>
    </form>
</x-guest-layout>
