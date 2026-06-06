<x-guest-layout>
    <p class="login-box-msg">Sign in to start your session</p>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="input-group mb-3">
            <input id="email"
                   type="email"
                   name="email"
                   class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}"
                   placeholder="Email"
                   required
                   autofocus
                   autocomplete="username">

            <span class="input-group-text">
                <i class="bi bi-envelope"></i>
            </span>

            @error('email')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

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

        <div class="row mb-3">
            <div class="col-8">
                <div class="form-check">
                    <input id="remember_me"
                           type="checkbox"
                           class="form-check-input"
                           name="remember">

                    <label class="form-check-label" for="remember_me">
                        Remember me
                    </label>
                </div>
            </div>

            <div class="col-4">
                <button type="submit" class="btn btn-primary w-100">
                    Sign In
                </button>
            </div>
        </div>
    </form>

    @if (Route::has('password.request'))
        <p class="mb-1">
            <a href="{{ route('password.request') }}">
                I forgot my password
            </a>
        </p>
    @endif

    @if (Route::has('register'))
        <p class="mb-0">
            <a href="{{ route('register') }}" class="text-center">
                Register a new membership
            </a>
        </p>
    @endif
</x-guest-layout>
