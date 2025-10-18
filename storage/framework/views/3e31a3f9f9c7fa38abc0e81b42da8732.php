<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Login - ToothTalk Dental Clinic</title>
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

        .logo {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 30px;
        }

        .logo-img {
            width: 70px;
            height: 70px;
            background: var(--primary);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-weight: 800;
            font-size: 24px;
        }

        .logo-text h1 {
            font-size: 24px;
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 5px;
        }

        .logo-text p {
            font-size: 14px;
            color: var(--text-light);
            font-weight: 500;
        }

        .login-header {
            margin-bottom: 30px;
        }

        .login-header h2 {
            font-size: 32px;
            color: var(--text);
            font-weight: 700;
            margin-bottom: 10px;
        }

        .login-header p {
            color: var(--text-light);
            font-size: 16px;
        }

        .login-form {
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

        .password-container {
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

        .forgot-link {
            text-align: right;
            margin-bottom: 10px;
        }

        .forgot-link a {
            color: var(--primary);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
        }

        .forgot-link a:hover {
            text-decoration: underline;
        }

        .login-btn {
            background: var(--primary);
            color: var(--white);
            border: none;
            padding: 15px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
        }

        .login-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        .employee-login-btn {
            background: var(--accent);
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

        .employee-login-btn:hover {
            background: var(--primary);
            transform: translateY(-2px);
        }

        .register-link {
            text-align: center;
            margin-top: 20px;
            color: var(--text-light);
        }

        .register-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

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

        .image-content {
            text-align: center;
            z-index: 2;
            position: relative;
        }

        .image-content h3 {
            font-size: 28px;
            margin-bottom: 15px;
            font-weight: 700;
        }

        .image-content p {
            font-size: 16px;
            opacity: 0.9;
        }

        .back-home {
            position: absolute;
            top: 20px;
            left: 20px;
        }

        .back-home a {
            color: var(--white);
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .alert {
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .text-danger {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
            display: block;
        }

        .form-check {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 10px 0;
        }

        .form-check-input {
            width: 16px;
            height: 16px;
        }

        .form-check-label {
            font-size: 14px;
            color: var(--text);
        }

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
            }
            
            .image-section {
                display: none;
            }
            
            .login-section {
                padding: 30px 25px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-section">
            <div class="logo">
                <div class="logo-img">TT</div>
                <div class="logo-text">
                    <h1>ToothTalk</h1>
                    <p>JValera Dental Clinic</p>
                </div>
            </div>

            <div class="login-header">
                <h2>Patient Login</h2>
                <p>Access your patient portal to manage appointments and view records</p>
            </div>

            <?php if(session('success')): ?>
                <div class="alert alert-success"><?php echo e(session('success')); ?></div>
            <?php endif; ?>

            <form class="login-form" method="POST" action="<?php echo e(route('patient.login')); ?>">
                <?php echo csrf_field(); ?>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" value="<?php echo e(old('username')); ?>" placeholder="Enter your username" required>
                    <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="password-container">
                        <input type="password" name="password" id="password" placeholder="Enter your password" required>
                        <button type="button" class="toggle-password" onclick="togglePassword()">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-check">
                    <input type="checkbox" name="remember" id="remember" class="form-check-input" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                    <label for="remember" class="form-check-label">Remember me</label>
                </div>

                <div class="forgot-link">
                    <a href="<?php echo e(route('patient.password.request')); ?>">Forgot Password?</a>
                </div>

                <button type="submit" class="login-btn">Login to Patient Portal</button>
                
                <button type="button" class="employee-login-btn" onclick="redirectToEmployeeLogin()">
                    Employee Login
                </button>

                <div class="register-link">
                    <p>New patient? <a href="<?php echo e(route('patient.registration')); ?>">Register here</a></p>
                </div>
            </form>
        </div>

        <div class="image-section">
            <div class="back-home">
                <a href="<?php echo e(url('/')); ?>">
                    <i class="fas fa-arrow-left"></i>
                    Back to Home
                </a>
            </div>
            <div class="image-content">
                <h3>Your Dental Health Journey</h3>
                <p>Access your treatment history, upcoming appointments, and personalized care plans</p>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const password = document.getElementById("password");
            const icon = document.querySelector(".toggle-password i");
            
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

        function redirectToEmployeeLogin() {
            window.location.href = "<?php echo e(route('staff.login')); ?>";
        }

        // Add logo integration
        document.addEventListener('DOMContentLoaded', function() {
            const logoImg = document.querySelector('.logo-img');
            // If you have a logo image, you can replace the TT text with it
            // logoImg.innerHTML = '<img src="<?php echo e(asset('images/logo.png')); ?>" alt="ToothTalk Logo" style="width:100%;height:100%;object-fit:cover;border-radius:12px;">';
        });
    </script>
</body>
</html><?php /**PATH C:\xampp\htdocs\TOOTHTALK_FIXED\resources\views/patient/login.blade.php ENDPATH**/ ?>