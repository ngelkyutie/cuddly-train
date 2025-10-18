@extends('layouts.app')

@section('title', 'Admin Login - ToothTalk Dental Clinic')

@section('content')
<style>
    .login-modal {
        display: flex;
        min-height: 100vh;
        background: linear-gradient(135deg, var(--bg-light) 0%, #E8F6F7 100%);
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
    }

    .login-content {
        background-color: var(--white);
        padding: 40px;
        border-radius: 20px;
        box-shadow: var(--shadow-hover);
        width: 100%;
        max-width: 450px;
        position: relative;
    }

    .login-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .login-title {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 10px;
    }

    .login-subtitle {
        color: var(--text-light);
        font-size: 1rem;
    }

    .login-form .form-group {
        margin-bottom: 20px;
    }

    .login-form label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: var(--text);
    }

    .login-form input {
        width: 100%;
        padding: 15px;
        border: 1px solid var(--gray);
        border-radius: 12px;
        font-size: 16px;
        transition: var(--transition);
        font-family: 'Inter', sans-serif;
    }

    .login-form input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(10, 124, 125, 0.1);
    }

    .login-btn {
        background: linear-gradient(135deg, var(--primary), var(--primary-light));
        color: var(--white);
        border: none;
        padding: 16px 30px;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        width: 100%;
        margin-top: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .login-btn:hover {
        background: linear-gradient(135deg, var(--primary-dark), var(--primary));
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(10, 124, 125, 0.3);
    }

    .login-error {
        color: #FF4757;
        text-align: center;
        margin-top: 15px;
        font-size: 0.9rem;
        display: none;
    }

    .back-to-home {
        text-align: center;
        margin-top: 20px;
    }

    .back-to-home a {
        color: var(--primary);
        text-decoration: none;
        font-weight: 500;
        transition: var(--transition);
    }

    .back-to-home a:hover {
        text-decoration: underline;
    }
</style>

<section class="login-modal">
    <div class="login-content">
        <div class="login-header">
            <h2 class="login-title">Admin Login</h2>
            <p class="login-subtitle">Access the ToothTalk Dental Clinic Admin Dashboard</p>
        </div>
        <form class="login-form" id="loginForm" method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
                @error('username')
                    <span style="color: #FF4757; font-size: 0.9rem;">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
                @error('password')
                    <span style="color: #FF4757; font-size: 0.9rem;">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="login-btn">
                <i class="fas fa-sign-in-alt"></i> Login
            </button>
            @if(session('error'))
                <div class="login-error" style="display: block;">
                    {{ session('error') }}
                </div>
            @endif
        </form>
        <div class="back-to-home">
            <a href="{{ route('home') }}">← Back to Homepage</a>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const loginForm = document.getElementById('loginForm');
        const loginError = document.getElementById('loginError');

        // Clear error messages when user starts typing
        const inputs = loginForm.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                if (loginError.style.display === 'block') {
                    loginError.style.display = 'none';
                }
            });
        });
    });
</script>
@endsection