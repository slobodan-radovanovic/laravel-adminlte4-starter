<x-guest-layout>
    <p class="login-box-msg">
        Forgot your password? Enter your email and we will send you a reset link.
    </p>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="input-group mb-3">
            <input id="email"
                   type="email"
                   name="email"
                   class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}"
                   placeholder="Email"
                   required
                   autofocus>

            <span class="input-group-text">
                <i class="bi bi-envelope"></i>
            </span>

            @error('email')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100 mb-3">
            Email Password Reset Link
        </button>
    </form>

    <p class="mb-0">
        <a href="{{ route('login') }}">
            Back to login
        </a>
    </p>
</x-guest-layout>
