<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password - ToothTalk Dental Clinic</title>
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

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, var(--bg-light) 0%, #E8F6F7 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .password-container {
            max-width: 500px;
            width: 100%;
            background: var(--white);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .password-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: var(--white);
            padding: 40px 30px;
            text-align: center;
        }

        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .logo-img {
            width: 60px;
            height: 60px;
            background: var(--white);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-weight: 800;
            font-size: 20px;
        }

        .logo-text h1 {
            font-size: 22px;
            color: var(--white);
            font-weight: 700;
        }

        .logo-text p {
            font-size: 13px;
            color: rgba(255,255,255,0.9);
        }

        .password-header h2 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .password-header p {
            opacity: 0.9;
            font-size: 14px;
        }

        .password-section {
            padding: 40px 30px;
        }

        .password-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group label {
            font-weight: 600;
            color: var(--text);
            font-size: 14px;
        }

        .form-group input {
            padding: 15px;
            border: 2px solid var(--gray);
            border-radius: 10px;
            font-size: 16px;
            transition: var(--transition);
        }

        .form-group input:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(10, 124, 125, 0.1);
        }

        .password-container-group {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--primary);
            cursor: pointer;
            font-size: 18px;
        }

        .password-strength {
            margin-top: 5px;
        }

        .strength-bar {
            height: 4px;
            background: var(--gray);
            border-radius: 2px;
            overflow: hidden;
            margin-bottom: 5px;
        }

        .strength-fill {
            height: 100%;
            width: 0%;
            transition: var(--transition);
            border-radius: 2px;
        }

        .strength-text {
            font-size: 12px;
            color: var(--text-light);
        }

        .password-requirements {
            background: rgba(10, 124, 125, 0.05);
            padding: 15px;
            border-radius: 10px;
            margin: 15px 0;
            border-left: 4px solid var(--primary);
        }

        .password-requirements h4 {
            color: var(--primary);
            margin-bottom: 10px;
            font-size: 14px;
        }

        .requirements-list {
            list-style: none;
            font-size: 12px;
            color: var(--text-light);
        }

        .requirements-list li {
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .requirements-list li.valid {
            color: var(--primary);
        }

        .requirements-list li i {
            font-size: 10px;
        }

        .submit-btn {
            background: var(--primary);
            color: var(--white);
            border: none;
            padding: 15px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            margin-top: 10px;
        }

        .submit-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        .submit-btn:disabled {
            background: var(--gray);
            cursor: not-allowed;
            transform: none;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .alert {
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .text-danger {
            color: #dc3545;
            font-size: 12px;
            margin-top: 5px;
        }

        @media (max-width: 480px) {
            .password-container {
                margin: 10px;
            }
            
            .password-header {
                padding: 30px 20px;
            }
            
            .password-section {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="password-container">
        <div class="password-header">
            <div class="logo">
                <div class="logo-img">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="ToothTalk Logo" style="width:100%;height:100%;object-fit:cover;border-radius:12px;">
                </div>
                <div class="logo-text">
                    <h1>ToothTalk</h1>
                    <p>JValera Dental Clinic</p>
                </div>
            </div>
            <h2>Change Password</h2>
            <p>Create a new secure password for your account</p>
        </div>

        <div class="password-section">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    <ul style="margin: 0; padding-left: 15px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="password-form" id="changePasswordForm" method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="currentPassword">Current Password</label>
                    <div class="password-container-group">
                        <input type="password" id="currentPassword" name="current_password" placeholder="Enter current password" required>
                        <button type="button" class="toggle-password" onclick="togglePassword('currentPassword')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('current_password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="newPassword">New Password</label>
                    <div class="password-container-group">
                        <input type="password" id="newPassword" name="password" placeholder="Enter new password" required oninput="checkPasswordStrength()">
                        <button type="button" class="toggle-password" onclick="togglePassword('newPassword')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="password-strength">
                        <div class="strength-bar">
                            <div class="strength-fill" id="strengthFill"></div>
                        </div>
                        <div class="strength-text" id="strengthText">Password strength</div>
                    </div>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="confirmPassword">Confirm New Password</label>
                    <div class="password-container-group">
                        <input type="password" id="confirmPassword" name="password_confirmation" placeholder="Confirm new password" required oninput="checkPasswordMatch()">
                        <button type="button" class="toggle-password" onclick="togglePassword('confirmPassword')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div id="passwordMatch" style="font-size: 12px; margin-top: 5px;"></div>
                </div>

                <div class="password-requirements">
                    <h4><i class="fas fa-list-check"></i> Password Requirements</h4>
                    <ul class="requirements-list" id="requirementsList">
                        <li id="reqLength"><i class="fas fa-circle"></i> At least 8 characters</li>
                        <li id="reqUppercase"><i class="fas fa-circle"></i> One uppercase letter</li>
                        <li id="reqLowercase"><i class="fas fa-circle"></i> One lowercase letter</li>
                        <li id="reqNumber"><i class="fas fa-circle"></i> One number</li>
                        <li id="reqSpecial"><i class="fas fa-circle"></i> One special character</li>
                    </ul>
                </div>

                <button type="submit" class="submit-btn" id="submitBtn" disabled>Update Password</button>
            </form>

            <div class="back-link">
                <a href="{{ route('login') }}">
                    <i class="fas fa-arrow-left"></i>
                    Back to Login
                </a>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            const password = document.getElementById(fieldId);
            const icon = password.nextElementSibling.querySelector('i');
            
            if (password.type === "password") {
                password.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                password.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }

        function checkPasswordStrength() {
            const password = document.getElementById('newPassword').value;
            const strengthFill = document.getElementById('strengthFill');
            const strengthText = document.getElementById('strengthText');
            
            let strength = 0;
            let requirements = {
                length: false,
                uppercase: false,
                lowercase: false,
                number: false,
                special: false
            };

            // Check length
            if (password.length >= 8) {
                strength += 20;
                requirements.length = true;
                document.getElementById('reqLength').classList.add('valid');
                document.getElementById('reqLength').innerHTML = '<i class="fas fa-check"></i> At least 8 characters';
            } else {
                document.getElementById('reqLength').classList.remove('valid');
                document.getElementById('reqLength').innerHTML = '<i class="fas fa-circle"></i> At least 8 characters';
            }

            // Check uppercase
            if (/[A-Z]/.test(password)) {
                strength += 20;
                requirements.uppercase = true;
                document.getElementById('reqUppercase').classList.add('valid');
                document.getElementById('reqUppercase').innerHTML = '<i class="fas fa-check"></i> One uppercase letter';
            } else {
                document.getElementById('reqUppercase').classList.remove('valid');
                document.getElementById('reqUppercase').innerHTML = '<i class="fas fa-circle"></i> One uppercase letter';
            }

            // Check lowercase
            if (/[a-z]/.test(password)) {
                strength += 20;
                requirements.lowercase = true;
                document.getElementById('reqLowercase').classList.add('valid');
                document.getElementById('reqLowercase').innerHTML = '<i class="fas fa-check"></i> One lowercase letter';
            } else {
                document.getElementById('reqLowercase').classList.remove('valid');
                document.getElementById('reqLowercase').innerHTML = '<i class="fas fa-circle"></i> One lowercase letter';
            }

            // Check numbers
            if (/[0-9]/.test(password)) {
                strength += 20;
                requirements.number = true;
                document.getElementById('reqNumber').classList.add('valid');
                document.getElementById('reqNumber').innerHTML = '<i class="fas fa-check"></i> One number';
            } else {
                document.getElementById('reqNumber').classList.remove('valid');
                document.getElementById('reqNumber').innerHTML = '<i class="fas fa-circle"></i> One number';
            }

            // Check special characters
            if (/[^A-Za-z0-9]/.test(password)) {
                strength += 20;
                requirements.special = true;
                document.getElementById('reqSpecial').classList.add('valid');
                document.getElementById('reqSpecial').innerHTML = '<i class="fas fa-check"></i> One special character';
            } else {
                document.getElementById('reqSpecial').classList.remove('valid');
                document.getElementById('reqSpecial').innerHTML = '<i class="fas fa-circle"></i> One special character';
            }

            strengthFill.style.width = strength + '%';
            
            // Set color and text based on strength
            if (strength < 40) {
                strengthFill.style.background = '#ff4757';
                strengthText.textContent = 'Weak password';
                strengthText.style.color = '#ff4757';
            } else if (strength < 80) {
                strengthFill.style.background = '#ffa502';
                strengthText.textContent = 'Medium password';
                strengthText.style.color = '#ffa502';
            } else {
                strengthFill.style.background = '#2ed573';
                strengthText.textContent = 'Strong password';
                strengthText.style.color = '#2ed573';
            }

            checkFormValidity();
        }

        function checkPasswordMatch() {
            const newPassword = document.getElementById('newPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            const matchElement = document.getElementById('passwordMatch');

            if (confirmPassword === '') {
                matchElement.textContent = '';
                matchElement.style.color = '';
            } else if (newPassword === confirmPassword) {
                matchElement.textContent = '✓ Passwords match';
                matchElement.style.color = '#2ed573';
            } else {
                matchElement.textContent = '✗ Passwords do not match';
                matchElement.style.color = '#ff4757';
            }

            checkFormValidity();
        }

        function checkFormValidity() {
            const newPassword = document.getElementById('newPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            const currentPassword = document.getElementById('currentPassword').value;
            const submitBtn = document.getElementById('submitBtn');

            const isStrong = document.getElementById('strengthText').textContent === 'Strong password';
            const passwordsMatch = newPassword === confirmPassword && newPassword !== '';
            const hasCurrentPassword = currentPassword !== '';

            submitBtn.disabled = !(isStrong && passwordsMatch && hasCurrentPassword);
        }

        // Initialize form validation on page load
        document.addEventListener('DOMContentLoaded', function() {
            checkPasswordStrength();
            checkPasswordMatch();
        });
    </script>
</body>
</html>