@extends('layouts.app')
@section('content')
<style>
    .auth-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #FFF5F0;
        padding: 2rem;
    }

    .auth-card {
        display: flex;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        max-width: 950px;
        width: 100%;
    }

    .auth-left {
        background: linear-gradient(135deg, #8B0000, #E37300);
        color: #fff;
        padding: 3rem 2rem;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .auth-left h2 {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 1rem;
    }

    .auth-left p {
        max-width: 280px;
        font-size: 1rem;
        opacity: 0.9;
    }

    .auth-right {
        flex: 1;
        background: #fff;
        padding: 3rem 2rem;
    }

    .auth-tabs {
        display: flex;
        border-bottom: 1px solid #eee;
        margin-bottom: 2rem;
    }

    .auth-tab {
        flex: 1;
        text-align: center;
        padding: 0.75rem;
        font-weight: 600;
        color: #777;
        cursor: pointer;
        transition: 0.3s;
    }

    .auth-tab.active {
        color: #8B0000;
        border-bottom: 3px solid #8B0000;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        font-weight: 500;
        margin-bottom: 0.5rem;
        display: block;
    }

    .form-control {
        width: 100%;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 0.75rem 1rem;
        font-size: 1rem;
        transition: 0.3s;
    }

    .form-control:focus {
        border-color: #8B0000;
        box-shadow: 0 0 0 0.2rem rgba(139,0,0,0.2);
    }

    .btn-reset {
        background: linear-gradient(90deg, #8B0000, #E37300);
        border: none;
        color: #fff;
        font-weight: 600;
        padding: 0.9rem;
        border-radius: 8px;
        width: 100%;
        transition: 0.3s;
    }

    .btn-reset:hover {
        opacity: 0.9;
    }

    .back-to-login {
        text-align: center;
        margin-top: 1.5rem;
    }

    .back-to-login a {
        color: #8B0000;
        font-weight: 500;
        text-decoration: none;
    }
</style>

<div class="auth-container">
    <div class="auth-card">
        <!-- Left -->
        <div class="auth-left">
            <h2>Reset Password</h2>
            <p>Enter your new password and confirm it to regain access to your account.</p>
        </div>

        <!-- Right -->
        <div class="auth-right">
            <div class="auth-tabs">
                <div class="auth-tab active">🔒 Reset Password</div>
            </div>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">

                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" name="password" class="form-control" required>
                    @error('password') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>Confirm New Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <button type="submit" class="btn-reset">Reset Password</button>
            </form>

            <div class="back-to-login">
                <p>Remember your password? <a href="{{ route('login') }}">Back to Login</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
