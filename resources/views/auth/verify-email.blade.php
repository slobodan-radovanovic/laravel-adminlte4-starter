<x-guest-layout>
    <p class="login-box-msg">
        Thanks for signing up! Before getting started, please verify your email address by clicking the link we just emailed to you.
    </p>

    @if (session('status') === 'verification-link-sent')
        <div class="alert alert-success">
            A new verification link has been sent to the email address you provided during registration.
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}" class="mb-3">
        @csrf

        <button type="submit" class="btn btn-primary w-100">
            Resend Verification Email
        </button>
    </form>

    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <button type="submit" class="btn btn-outline-secondary w-100">
            Log Out
        </button>
    </form>
</x-guest-layout>
