<x-guest-layout>
    <p class="login-box-msg">Register a new membership</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="input-group mb-3">
            <input id="name"
                   type="text"
                   name="name"
                   class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name') }}"
                   placeholder="Name"
                   required
                   autofocus
                   autocomplete="name">

            <span class="input-group-text">
                <i class="bi bi-person"></i>
            </span>

            @error('name')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="input-group mb-3">
            <input id="email"
                   type="email"
                   name="email"
                   class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}"
                   placeholder="Email"
                   required
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
                   autocomplete="new-password">

            <span class="input-group-text">
                <i class="bi bi-lock"></i>
            </span>

            @error('password')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="input-group mb-3">
            <input id="password_confirmation"
                   type="password"
                   name="password_confirmation"
                   class="form-control @error('password_confirmation') is-invalid @enderror"
                   placeholder="Confirm Password"
                   required
                   autocomplete="new-password">

            <span class="input-group-text">
                <i class="bi bi-lock-fill"></i>
            </span>

            @error('password_confirmation')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="row">
            <div class="col-8">
                <a href="{{ route('login') }}">
                    I already have a membership
                </a>
            </div>

            <div class="col-4">
                <button type="submit" class="btn btn-primary w-100">
                    Register
                </button>
            </div>
        </div>
    </form>
</x-guest-layout>
