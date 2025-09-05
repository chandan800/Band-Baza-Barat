@extends('layouts.app')
@section('content')

<style>
    .otp-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #fff5f0, #fde8e4);
        padding: 2rem;
    }
    .otp-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        padding: 2rem;
        max-width: 500px;
        width: 100%;
        text-align: center;
    }
    .otp-card h3 {
        color: var(--maroon);
        font-weight: 600;
        margin-bottom: 1rem;
    }
    .otp-card p {
        color: #666;
        font-size: 0.95rem;
    }
    .otp-container {
        display: flex;
        justify-content: center;
        gap: 0.75rem;
        margin: 2rem 0;
    }
    .otp-input {
        width: 55px;
        height: 55px;
        text-align: center;
        font-size: 1.25rem;
        font-weight: 600;
        border: 2px solid #ddd;
        border-radius: 10px;
        transition: 0.2s;
    }
    .otp-input:focus {
        border-color: var(--maroon);
        box-shadow: 0 0 0 3px rgba(128,0,0,0.2);
        outline: none;
    }
    .resend-otp {
        margin-top: 1rem;
    }
    .resend-otp button {
        background: none;
        border: none;
        color: var(--maroon);
        font-weight: 500;
        text-decoration: underline;
        cursor: pointer;
    }
</style>

<div class="otp-wrapper">
    <div class="otp-card">
        <h3>Phone Verification</h3>
        <p>Enter the 6-digit OTP we sent to your phone</p>

          {{-- Success Message --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- Error Messages --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <!-- OTP Form -->
        <form method="POST" action="{{ route('verify.otp') }}">
            @csrf

            <div class="otp-container">
                  <input type="hidden" name="mobile" value="{{ session('otp_mobile') }}">
                <input type="text" class="otp-input" maxlength="1" data-index="0">
                <input type="text" class="otp-input" maxlength="1" data-index="1">
                <input type="text" class="otp-input" maxlength="1" data-index="2">
                <input type="text" class="otp-input" maxlength="1" data-index="3">
                <input type="text" class="otp-input" maxlength="1" data-index="4">
                <input type="text" class="otp-input" maxlength="1" data-index="5">
            </div>

            <!-- Hidden field (final OTP value) -->
            <input type="hidden" name="otp" id="otpHidden">

            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-check me-2"></i> Verify & Login
            </button>

            <div class="resend-otp">
                <p class="text-muted mb-2">
                    Didn’t receive OTP? 
                    <button type="button" id="resendOtpBtn" disabled>Resend OTP</button>
                </p>
                <small class="text-muted">Resend available in <span id="otpTimer">30</span> seconds</small>
            </div>
        </form>
    </div>
</div>

<script>
// auto move to next input + build OTP value
document.querySelectorAll('.otp-input').forEach((input, index, arr) => {
    input.addEventListener('input', () => {
        if (input.value.length === 1 && index < arr.length - 1) {
            arr[index + 1].focus();
        }
        document.getElementById("otpHidden").value = 
            Array.from(arr).map(i => i.value).join('');
    });
});

// resend countdown
let timer = 30;
const otpTimer = document.getElementById('otpTimer');
const resendBtn = document.getElementById('resendOtpBtn');
const interval = setInterval(() => {
    timer--;
    otpTimer.textContent = timer;
    if (timer <= 0) {
        clearInterval(interval);
        resendBtn.disabled = false;
    }
}, 1000);
</script>

@endsection
