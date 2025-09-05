@extends('layouts.app')
@section('content')
    
    <style>
        .login-container {
            background: linear-gradient(135deg, var(--light-bg) 0%, #FFF5F0 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 2rem 0;
        }
        
        .login-card {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-lg);
            overflow: hidden;
            max-width: 900px;
            width: 100%;
        }
        
        .login-header {
            background: linear-gradient(135deg, var(--maroon), var(--golden-orange));
            color: var(--white);
            padding: 3rem 2rem;
            text-align: center;
            position: relative;
        }
        
        .login-header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: url("data:image/svg+xml,%3Csvg viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M50 5 L60 35 L90 35 L68 55 L78 85 L50 65 L22 85 L32 55 L10 35 L40 35 Z' fill='%23FFFFFF' fill-opacity='0.1'/%3E%3C/svg%3E") repeat;
            opacity: 0.3;
        }
        
        .login-welcome {
            position: relative;
            z-index: 1;
        }
        
        .login-form-container {
            padding: 3rem 2rem;
        }
        
        .login-tabs {
            border-bottom: 2px solid #f1f3f4;
            margin-bottom: 2rem;
        }
        
        .login-tab {
            background: none;
            border: none;
            padding: 1rem 2rem;
            font-weight: 500;
            color: var(--muted);
            cursor: pointer;
            position: relative;
            transition: var(--transition);
        }
        
        .login-tab.active {
            color: var(--maroon);
        }
        
        .login-tab.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--maroon);
        }
        
        .login-form {
            display: none;
        }
        
        .login-form.active {
            display: block;
            animation: fadeInUp 0.5s ease;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }
        
        .form-floating .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: var(--transition);
        }
        
        .form-floating .form-control:focus {
            border-color: var(--maroon);
            box-shadow: 0 0 0 0.2rem rgba(128, 0, 0, 0.25);
        }
        
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--muted);
            cursor: pointer;
            z-index: 5;
        }
        
        .login-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .forgot-password {
            color: var(--maroon);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }
        
        .forgot-password:hover {
            color: var(--deep-pink);
            text-decoration: underline;
        }
        
        .social-login {
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #e0e0e0;
        }
        
        .social-login-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 0.75rem;
            margin-bottom: 1rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            background: var(--white);
            color: var(--text-dark);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }
        
        .social-login-btn:hover {
            background: #f8f9fa;
            border-color: var(--maroon);
            color: var(--text-dark);
        }
        
        .social-login-btn i {
            font-size: 1.2rem;
            margin-right: 0.75rem;
        }
        
        .google-btn i {
            color: #4285f4;
        }
        
        .facebook-btn i {
            color: #1877f2;
        }
        
        .register-prompt {
            text-align: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #e0e0e0;
        }
        
        .otp-container {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin: 1.5rem 0;
        }
        
        .otp-input {
            width: 50px;
            height: 50px;
            text-align: center;
            font-size: 1.2rem;
            font-weight: bold;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            transition: var(--transition);
        }
        
        .otp-input:focus {
            border-color: var(--maroon);
            box-shadow: 0 0 0 0.2rem rgba(128, 0, 0, 0.25);
        }
        
        .resend-otp {
            text-align: center;
            margin-top: 1rem;
        }
        
        .resend-otp button {
            background: none;
            border: none;
            color: var(--maroon);
            text-decoration: underline;
            cursor: pointer;
            font-weight: 500;
        }
        
        .demo-credentials {
            background: #e8f5e8;
            border: 1px solid #c3e6cb;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .demo-credentials h6 {
            color: #155724;
            margin-bottom: 0.5rem;
        }
        
        .demo-credentials p {
            color: #155724;
            margin: 0;
            font-size: 0.9rem;
        }
        
        @media (max-width: 768px) {
            .login-card {
                margin: 1rem;
            }
            
            .login-header {
                padding: 2rem 1rem;
            }
            
            .login-form-container {
                padding: 2rem 1rem;
            }
            
            .login-tab {
                padding: 0.75rem 1rem;
                font-size: 0.9rem;
            }
            
            .login-options {
                flex-direction: column;
                align-items: stretch;
                text-align: center;
            }
        }
    </style>

    <!-- Login Container -->
    <div class="login-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="login-card">
                        <div class="row g-0">
                            <!-- Welcome Section -->
                            <div class="col-lg-5">
                                <div class="login-header h-100 d-flex align-items-center">
                                    <div class="login-welcome w-100">
                                        <i class="fas fa-heart fs-1 mb-3"></i>
                                        <h2>Welcome Back!</h2>
                                        <p class="mb-0">Login to continue your journey of finding the perfect life partner</p>
                                    </div>
                                </div>
                            </div>
                            

                            <!-- Login Form Section -->
                            <div class="col-lg-7">

                                <div class="login-form-container">
                                    <!-- Login Tabs -->
                                    <div class="login-tabs">
                                        <button class="login-tab active" data-tab="password">
                                            <i class="fas fa-lock me-2"></i>Login with Email
                                        </button>
                                        <button class="login-tab" data-tab="otp">
                                            <i class="fas fa-mobile-alt me-2"></i>Login with OTP
                                        </button>
                                    </div>
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
                                    <!-- Pass   word Login Form -->
                                    <form id="passwordLoginForm" class="login-form active" method="POST" action="{{ route('send.otp') }}">
                                        @csrf
                                        <div class="form-group">
                                            <div class="form-floating">
                                                <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
                                                <label for="email">Email Address</label>
                                            </div>
                                        </div>
                                        
                                        
                                        
                                        <div class="login-options">
                                            <div class="remember-me">
                                                <input type="checkbox" id="rememberMe" class="form-check-input">
                                                <label for="rememberMe" class="form-check-label">Remember me</label>
                                            </div>
                                            <a href="#" class="forgot-password" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">
                                                Forgot Password?
                                            </a>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary w-100 mb-3">
                                            <i class="fas fa-sign-in-alt me-2"></i>Send OTP
                                        </button>
                                    </form>

                                    <!-- OTP Login Form -->
                                    <form id="otpLoginForm" class="login-form" method="POST" action="{{ route('send.otp.mobile') }}">
                                        @csrf
                                        <div class="form-group">
                                            <div class="form-floating">
                                                <input type="hidden" class="form-control" name="mobileotp" value="Mobile">
                                                <input type="tel" class="form-control" id="mobileOtp" name="mobile" placeholder="Mobile Number" required pattern="[6-9][0-9]{9}">
                                                <label for="mobileOtp">Mobile Number</label>
                                            </div>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-outline-primary w-100 mb-3" id="sendOtpBtn">
                                            <i class="fas fa-paper-plane me-2"></i>Send OTP
                                        </button>
                                    </form>


                                    <!-- Social Login -->
                                    <div class="social-login">
                                        <p class="text-center text-muted mb-3">Or login with</p>
                                        <a href="#" class="social-login-btn google-btn">
                                            <i class="fab fa-google"></i>
                                            Continue with Google
                                        </a>
                                        <a href="#" class="social-login-btn facebook-btn">
                                            <i class="fab fa-facebook-f"></i>
                                            Continue with Facebook
                                        </a>
                                    </div>

                                    <!-- Register Prompt -->
                                    <div class="register-prompt">
                                        <p class="text-muted">
                                            Don't have an account? 
                                            <a href="{{ route('register')}}" class="text-decoration-none fw-bold" style="color: var(--maroon);">
                                                Register Now
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Forgot Password Modal -->
    <div class="modal fade" id="forgotPasswordModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reset Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="forgotPasswordForm" method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="resetEmail" class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" id="resetEmail" required>
                        </div>
                        <div class="mb-3">
                            <div class="border rounded p-3 text-center bg-light">
                                <i class="fas fa-shield-alt text-success fs-2 mb-2"></i>
                                <p class="mb-0"><strong>reCAPTCHA verification</strong></p>
                                <small class="text-muted">Please verify that you are not a robot</small>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" form="forgotPasswordForm" class="btn btn-primary">Send Reset Link</button>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tab switching
            const loginTabs = document.querySelectorAll('.login-tab');
            const loginForms = document.querySelectorAll('.login-form');

            loginTabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    const targetTab = this.dataset.tab;
                    
                    // Update active tab
                    loginTabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Update active form
                    loginForms.forEach(form => {
                        form.classList.remove('active');
                        if (form.id.includes(targetTab)) {
                            form.classList.add('active');
                        }
                    });
                });
            });

            // Password toggle
            window.togglePassword = function(inputId) {
                const input = document.getElementById(inputId);
                const button = input.nextElementSibling.nextElementSibling;
                const icon = button.querySelector('i');
                
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            };

            // OTP functionality
            const sendOtpBtn = document.getElementById('sendOtpBtn');
            const otpSection = document.getElementById('otpSection');
            const otpInputs = document.querySelectorAll('.otp-input');
            const resendOtpBtn = document.getElementById('resendOtpBtn');
            const otpTimer = document.getElementById('otpTimer');
            
            let otpCountdown;

            // OTP input handling
            otpInputs.forEach((input, index) => {
                input.addEventListener('input', function() {
                    if (this.value.length === 1) {
                        if (index < otpInputs.length - 1) {
                            otpInputs[index + 1].focus();
                        }
                    }
                });

                input.addEventListener('keydown', function(e) {
                    if (e.key === 'Backspace' && this.value === '' && index > 0) {
                        otpInputs[index - 1].focus();
                    }
                });
            });

            function startOtpCountdown() {
                let timeLeft = 30;
                resendOtpBtn.disabled = true;
                
                otpCountdown = setInterval(() => {
                    timeLeft--;
                    otpTimer.textContent = timeLeft;
                    
                    if (timeLeft <= 0) {
                        clearInterval(otpCountdown);
                        resendOtpBtn.disabled = false;
                        otpTimer.parentElement.style.display = 'none';
                    }
                }, 1000);
            }

            resendOtpBtn.addEventListener('click', function() {
                window.BandBazaBarat.showNotification('OTP resent successfully', 'success');
                startOtpCountdown();
                otpTimer.parentElement.style.display = 'block';
            });

            // Form submissions
            const passwordLoginForm = document.getElementById('passwordLoginForm');
            const otpLoginForm = document.getElementById('otpLoginForm');
            const forgotPasswordForm = document.getElementById('forgotPasswordForm');

          

            // otpLoginForm.addEventListener('submit', function(e) {
            //     e.preventDefault();
                
            //     const otp = Array.from(otpInputs).map(input => input.value).join('');
                
            //     if (otp.length !== 6) {
            //         window.BandBazaBarat.showNotification('Please enter complete OTP', 'error');
            //         return;
            //     }

            //     // Show loading state
            //     const submitBtn = this.querySelector('button[type="submit"]');
            //     const originalText = submitBtn.innerHTML;
            //     submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Verifying...';
            //     submitBtn.disabled = true;

            //     // Simulate API call
            //     setTimeout(() => {
            //         submitBtn.innerHTML = originalText;
            //         submitBtn.disabled = false;

            //         // Mock OTP verification (any 6-digit number works)
            //         if (otp === '123456' || otp.length === 6) {
            //             localStorage.setItem('isLoggedIn', 'true');
            //             localStorage.setItem('userMobile', document.getElementById('mobileOtp').value);
            //             window.BandBazaBarat.showNotification('Login successful!', 'success');
                        
            //             setTimeout(() => {
            //                 window.location.href = 'dashboard.html';
            //             }, 1000);
            //         } else {
            //             window.BandBazaBarat.showNotification('Invalid OTP. Try 123456 for demo.', 'error');
            //         }
            //     }, 1500);
            // });

            forgotPasswordForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const email = document.getElementById('resetEmail').value;
                
                if (!email) {
                    window.BandBazaBarat.showNotification('Please enter your email address', 'error');
                    return;
                }

                // Show loading state
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Sending...';
                submitBtn.disabled = true;

                // Simulate API call
                setTimeout(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                    
                    window.BandBazaBarat.showNotification('Password reset link sent to your email', 'success');
                    bootstrap.Modal.getInstance(document.getElementById('forgotPasswordModal')).hide();
                    this.reset();
                }, 2000);
            });

            // Auto-fill demo credentials
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            
            emailInput.value = 'demo@bandbazabarat.com';
            passwordInput.value = 'demo123';
        });
    </script>
@endsection
