<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Portal - ToothTalk Dental Clinic</title>
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
            --error: #E74C3C;
            --success: #2ECC71;
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

        .auth-container {
            max-width: 480px;
            width: 100%;
            background: var(--white);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow);
            border: 1px solid rgba(10, 124, 125, 0.1);
        }

        .auth-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: var(--white);
            padding: 45px 35px;
            text-align: center;
            position: relative;
        }

        .auth-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--accent), var(--primary-light));
        }

        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .logo-img {
            width: 65px;
            height: 65px;
            background: var(--white);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-weight: 800;
            font-size: 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .logo-text h1 {
            font-size: 24px;
            color: var(--white);
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .logo-text p {
            font-size: 13px;
            color: rgba(255,255,255,0.9);
            font-weight: 500;
        }

        .auth-header h2 {
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 12px;
            letter-spacing: -0.5px;
        }

        .auth-header p {
            opacity: 0.9;
            font-size: 15px;
            font-weight: 400;
        }

        .auth-section {
            padding: 45px 35px;
        }

        .role-selection {
            margin-bottom: 30px;
        }

        .role-selection label {
            display: block;
            margin-bottom: 12px;
            font-weight: 600;
            color: var(--text);
            font-size: 15px;
        }

        .role-select {
            width: 100%;
            padding: 16px;
            border: 2px solid var(--gray);
            border-radius: 12px;
            font-size: 16px;
            background: var(--white);
            cursor: pointer;
            transition: var(--transition);
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%230A7C7D' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 16px center;
            background-size: 16px;
        }

        .role-select:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(10, 124, 125, 0.15);
        }

        .auth-form {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .form-group label {
            font-weight: 600;
            color: var(--text);
            font-size: 15px;
        }

        .form-group input {
            padding: 16px;
            border: 2px solid var(--gray);
            border-radius: 12px;
            font-size: 16px;
            transition: var(--transition);
            background: var(--white);
        }

        .form-group input:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(10, 124, 125, 0.15);
            background: var(--white);
        }

        .password-container {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--primary);
            cursor: pointer;
            font-size: 18px;
            transition: var(--transition);
            padding: 4px;
            border-radius: 4px;
        }

        .toggle-password:hover {
            background: rgba(10, 124, 125, 0.1);
        }

        .auth-btn {
            background: var(--primary);
            color: var(--white);
            border: none;
            padding: 17px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            margin-top: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            letter-spacing: 0.5px;
        }

        .auth-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(10, 124, 125, 0.25);
        }

        .auth-btn:active {
            transform: translateY(0);
        }

        .back-link {
            text-align: center;
            margin-top: 25px;
        }

        .back-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition);
            padding: 8px 16px;
            border-radius: 8px;
        }

        .back-link a:hover {
            background: rgba(10, 124, 125, 0.1);
            transform: translateX(-2px);
        }

        .security-notice {
            background: rgba(10, 124, 125, 0.08);
            padding: 20px;
            border-radius: 12px;
            margin-top: 25px;
            border-left: 4px solid var(--primary);
            border: 1px solid rgba(10, 124, 125, 0.2);
        }

        .security-notice h4 {
            color: var(--primary);
            margin-bottom: 10px;
            font-size: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
        }

        .security-notice p {
            color: var(--text-light);
            font-size: 13px;
            line-height: 1.5;
            font-weight: 400;
        }

        .error-message {
            background: rgba(231, 76, 60, 0.1);
            color: var(--error);
            padding: 14px;
            border-radius: 10px;
            font-size: 14px;
            margin-bottom: 20px;
            border-left: 4px solid var(--error);
            font-weight: 500;
            display: none;
        }

        .alert {
            padding: 14px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: 500;
        }

        .alert-success {
            background: rgba(46, 204, 113, 0.1);
            color: var(--success);
            border-left: 4px solid var(--success);
        }

        .alert-error {
            background: rgba(231, 76, 60, 0.1);
            color: var(--error);
            border-left: 4px solid var(--error);
        }

        .loading {
            display: none;
            text-align: center;
            margin-top: 15px;
        }

        .loading-spinner {
            width: 24px;
            height: 24px;
            border: 3px solid rgba(10, 124, 125, 0.3);
            border-radius: 50%;
            border-top-color: var(--primary);
            animation: spin 1s linear infinite;
            display: inline-block;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .session-info {
            background: rgba(243, 156, 18, 0.1);
            color: #F39C12;
            padding: 12px;
            border-radius: 10px;
            font-size: 12px;
            text-align: center;
            margin-top: 20px;
            border-left: 4px solid #F39C12;
            font-weight: 500;
        }

        @media (max-width: 480px) {
            .auth-container {
                margin: 10px;
                border-radius: 16px;
            }
            
            .auth-header {
                padding: 35px 25px;
            }
            
            .auth-section {
                padding: 35px 25px;
            }
            
            .logo {
                gap: 12px;
            }
            
            .logo-img {
                width: 55px;
                height: 55px;
            }
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-header">
            <div class="logo">
                <div class="logo-img">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="ToothTalk Logo" style="width:100%;height:100%;object-fit:cover;border-radius:12px;">
                </div>
                <div class="logo-text">
                    <h1>ToothTalk</h1>
                    <p>JValera Dental Clinic</p>
                </div>
            </div>
            <h2>Staff Portal</h2>
            <p>Secure access to clinic management system</p>
        </div>

        <div class="auth-section">
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    @foreach($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif

            <div class="error-message" id="errorMessage">
                <i class="fas fa-exclamation-circle"></i>
                <span id="errorText">Please select your role and enter credentials</span>
            </div>

            <form class="auth-form" id="authLoginForm" method="POST" action="{{ route('staff.login') }}">
                @csrf
                
                <div class="role-selection">
                    <label for="userRole">Select Your Role</label>
                    <select id="userRole" name="role" class="role-select" required>
                        <option value="">Choose your role</option>
                        <option value="dentist" {{ old('role') == 'dentist' ? 'selected' : '' }}>Dentist</option>
                        <option value="assistant" {{ old('role') == 'assistant' ? 'selected' : '' }}>Dental Assistant</option>
                        <option value="hygienist" {{ old('role') == 'hygienist' ? 'selected' : '' }}>Dental Hygienist</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrator</option>
                        <option value="reception" {{ old('role') == 'reception' ? 'selected' : '' }}>Receptionist</option>
                    </select>
                    @error('role')
                        <span style="color: var(--error); font-size: 12px; margin-top: 5px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username" value="{{ old('username') }}" required>
                    @error('username')
                        <span style="color: var(--error); font-size: 12px; margin-top: 5px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="authPassword">Password</label>
                    <div class="password-container">
                        <input type="password" id="authPassword" name="password" placeholder="Enter your password" required>
                        <button type="button" class="toggle-password" onclick="toggleAuthPassword()">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <span style="color: var(--error); font-size: 12px; margin-top: 5px;">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="auth-btn" id="submitBtn">
                    <i class="fas fa-lock"></i>
                    Authenticate & Login
                </button>
            </form>

            <div class="loading" id="loadingIndicator">
                <div class="loading-spinner"></div>
                <p style="margin-top: 10px; color: var(--text-light); font-size: 14px;">Verifying credentials...</p>
            </div>

            <div class="security-notice">
                <h4><i class="fas fa-shield-alt"></i> Security Notice</h4>
                <p>This system contains confidential patient information. Unauthorized access is strictly prohibited and monitored. All activities are logged for security compliance.</p>
            </div>

            <div class="session-info">
                <i class="fas fa-clock"></i> Session timeout: 15 minutes of inactivity
            </div>

            <div class="back-link">
                <a href="{{ route('login') }}">
                    <i class="fas fa-arrow-left"></i>
                    Back to Patient Login
                </a>
            </div>
        </div>
    </div>

    <script>
        function toggleAuthPassword() {
            const password = document.getElementById("authPassword");
            const icon = document.querySelector("#authPassword + .toggle-password i");
            
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

        function showError(message) {
            const errorElement = document.getElementById('errorMessage');
            const errorText = document.getElementById('errorText');
            errorText.textContent = message;
            errorElement.style.display = 'block';
        }

        function showLoading() {
            document.getElementById('loadingIndicator').style.display = 'block';
            document.getElementById('submitBtn').disabled = true;
        }

        function hideLoading() {
            document.getElementById('loadingIndicator').style.display = 'none';
            document.getElementById('submitBtn').disabled = false;
        }

        document.getElementById("authLoginForm").addEventListener("submit", function(e) {
            const role = document.getElementById("userRole").value;
            const username = document.getElementById("username").value;
            const password = document.getElementById("authPassword").value;
            
            document.getElementById('errorMessage').style.display = 'none';
            
            if (!role) {
                e.preventDefault();
                showError("Please select your role to continue");
                return;
            }
            
            if (!username || !password) {
                e.preventDefault();
                showError("Please enter both username and password");
                return;
            }
            
            showLoading();
        });

        // Clear validation errors when user starts typing
        document.querySelectorAll('input, select').forEach(element => {
            element.addEventListener('input', function() {
                document.getElementById('errorMessage').style.display = 'none';
            });
        });

        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.display = 'none';
                }, 5000);
            });
        });
    </script>
</body>
</html>