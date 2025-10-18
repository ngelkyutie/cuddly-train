@extends('layouts.app')

@section('title', 'Patient Registration - ToothTalk Dental Clinic')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    :root {
        --primary: #0A7C7D;
        --primary-dark: #065A5C;
        --primary-light: #4DAFB0;
        --accent: #00C2C3;
        --text: #1A2E35;
        --text-light: #5A6D74;
        --bg-light: #F8FCFD;
        --white: #FFFFFF;
        --gray: #E8F0F1;
        --shadow: 0 8px 30px rgba(0,0,0,0.08);
        --transition: all 0.3s ease;
    }

    .patient-login-container {
        font-family: 'Inter', sans-serif;
        background: linear-gradient(135deg, var(--bg-light) 0%, #E8F6F7 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .login-container {
        display: flex;
        max-width: 1000px;
        width: 100%;
        background: var(--white);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--shadow);
    }

    .login-section {
        flex: 1;
        padding: 50px 40px;
    }

    .logo { display: flex; align-items: center; gap: 15px; margin-bottom: 30px; }
    .logo-img { width: 70px; height: 70px; background: var(--primary); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--white); font-weight: 800; font-size: 24px; }
    .logo-text h1 { font-size: 24px; color: var(--primary); font-weight: 700; margin-bottom: 5px; }
    .logo-text p { font-size: 14px; color: var(--text-light); font-weight: 500; }

    .login-header h2 { font-size: 32px; color: var(--text); font-weight: 700; margin-bottom: 10px; }
    .login-header p { color: var(--text-light); font-size: 16px; }

    .login-form { display: flex; flex-direction: column; gap: 20px; }
    .form-group { display: flex; flex-direction: column; gap: 8px; }
    .form-group label { font-weight: 600; color: var(--text); font-size: 14px; }
    .form-group input, .form-group select, .form-group textarea { padding: 15px; border: 2px solid var(--gray); border-radius: 10px; font-size: 16px; transition: var(--transition); }
    .form-group input:focus, .form-group select:focus, .form-group textarea:focus { border-color: var(--primary); outline: none; box-shadow: 0 0 0 3px rgba(10, 124, 125, 0.1); }

    .toggle-password { position: absolute; right: 15px; top: 50%; transform: translateY(-50%); background: none; border: none; color: var(--primary); cursor: pointer; font-size: 18px; }

    .register-btn { background: var(--primary); color: var(--white); border: none; padding: 15px; border-radius: 10px; font-size: 16px; font-weight: 600; cursor: pointer; transition: var(--transition); }
    .register-btn:hover { background: var(--primary-dark); transform: translateY(-2px); }

    .login-link { text-align: center; margin-top: 20px; color: var(--text-light); }
    .login-link a { color: var(--primary); text-decoration: none; font-weight: 600; }
    .login-link a:hover { text-decoration: underline; }

    .image-section {
        flex: 1;
        background: linear-gradient(135deg, var(--primary-light), var(--primary));
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--white);
        padding: 40px;
        position: relative;
        overflow: hidden;
    }

    .image-content { text-align: center; z-index: 2; position: relative; }
    .image-content h3 { font-size: 28px; margin-bottom: 15px; font-weight: 700; }
    .image-content p { font-size: 16px; opacity: 0.9; }

    .back-home { position: absolute; top: 20px; left: 20px; }
    .back-home a { color: var(--white); text-decoration: none; font-weight: 500; display: flex; align-items: center; gap: 8px; }

    @media (max-width: 768px) {
        .login-container { flex-direction: column; }
        .image-section { display: none; }
        .login-section { padding: 30px 25px; }
    }
</style>

<div class="patient-login-container">
    <div class="login-container">
        <div class="login-section">
            <div class="logo">
                <div class="logo-img">
                    @if(file_exists(public_path('images/logo.png')))
                        <img src="{{ asset('images/logo.png') }}" alt="ToothTalk Logo" style="width:100%;height:100%;object-fit:cover;border-radius:12px;">
                    @else
                        TT
                    @endif
                </div>
                <div class="logo-text">
                    <h1>ToothTalk</h1>
                    <p>JValera Dental Clinic</p>
                </div>
            </div>

            <div class="login-header">
                <h2>Patient Registration</h2>
                <p>Create a new patient account to access your portal</p>
            </div>

            <form class="login-form" method="POST" action="{{ route('patient.storeAdvanced') }}" enctype="multipart/form-data">
                @csrf

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if ($errors->any())
                    <div class="text-red-500 mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                </div>

                <div class="form-group">
                    <label for="date_of_birth">Date of Birth</label>
                    <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" required>
                </div>

                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender" required>
                        <option value="">Select Gender</option>
                        <option value="male" {{ old('gender')=='male'?'selected':'' }}>Male</option>
                        <option value="female" {{ old('gender')=='female'?'selected':'' }}>Female</option>
                        <option value="other" {{ old('gender')=='other'?'selected':'' }}>Other</option>
                        <option value="prefer-not-to-say" {{ old('gender')=='prefer-not-to-say'?'selected':'' }}>Prefer not to say</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required>
                </div>

                <div class="form-group">
                    <label for="emergency_contact">Emergency Contact (Optional)</label>
                    <input type="text" id="emergency_contact" name="emergency_contact" value="{{ old('emergency_contact') }}">
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea id="address" name="address">{{ old('address') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="{{ old('username') }}" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="password-container">
                        <input type="password" id="password" name="password" required>
                        <button type="button" class="toggle-password"><i class="fas fa-eye"></i></button>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                </div>

                <div class="form-group">
                    <label for="profile_image">Profile Image (Optional)</label>
                    <input type="file" id="profile_image" name="profile_image">
                </div>

                <div class="form-check">
                    <input type="checkbox" id="terms" name="terms" {{ old('terms')?'checked':'' }}>
                    <label for="terms">I accept the terms and conditions</label>
                </div>

                <button type="submit" class="register-btn">Register</button>

                <div class="login-link">
                    <p>Already have an account? <a href="{{ route('patient.showLogin') }}">Login here</a></p>
                </div>
            </form>
        </div>

        <div class="image-section">
            <div class="back-home">
                <a href="{{ route('home') }}">
                    <i class="fas fa-arrow-left"></i>
                    Back to Home
                </a>
            </div>
            <div class="image-content">
                <h3>Welcome to ToothTalk</h3>
                <p>Start your dental health journey and manage your appointments online</p>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const togglePassword = document.querySelector('.toggle-password');
    if (togglePassword) {
        togglePassword.addEventListener('click', function() {
            const password = document.getElementById('password');
            const icon = this.querySelector('i');
            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                password.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    }
});
</script>
@endsection
