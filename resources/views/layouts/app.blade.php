<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'JValera Dental Clinic | ToothTalk')</title>
    
    <!-- Fonts & Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Custom Styles -->
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
            --shadow-hover: 0 15px 40px rgba(0,0,0,0.12);
            --transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-light);
            color: var(--text);
            line-height: 1.6;
            overflow-x: hidden;
            scroll-behavior: smooth;
        }

        .container { width: 100%; max-width: 1400px; margin: 0 auto; padding: 0 40px; }

        /* Announcement Bar */
        .announcement {
            background: linear-gradient(90deg, var(--primary), var(--primary-light));
            color: var(--white);
            padding: 14px 0;
            text-align: center;
            font-size: 15px;
            font-weight: 500;
            width: 100%;
            position: relative;
            overflow: hidden;
        }

        .announcement::before {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: url("data:image/svg+xml,...") /* keep your SVG */;
        }

        /* Navigation */
        nav {
            background: var(--white);
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            backdrop-filter: blur(10px);
        }

        .nav-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 0;
        }

        .logo { display: flex; align-items: center; gap: 16px; }
        .logo-img { width: 60px; height: 60px; border-radius: 12px; overflow: hidden; }
        .logo-img img { width: 100%; height: 100%; object-fit: cover; }
        .logo-text h1 { font-size: 26px; color: var(--primary); margin:0; font-weight:700; }
        .logo-text p { font-size:13px; margin:0; opacity:0.8; font-weight:500; }

        .nav-links { display: flex; list-style: none; gap: 40px; }
        .nav-links a {
            color: var(--text);
            text-decoration: none;
            font-weight: 500;
            padding: 10px 0;
            position: relative;
            transition: var(--transition);
            font-size: 16px;
        }
        .nav-links a::after {
            content: '';
            position: absolute; bottom: 0; left: 0; width: 0; height: 3px;
            background: var(--primary); border-radius:2px; transition: var(--transition);
        }
        .nav-links a:hover, .nav-links a.active { color: var(--primary); }
        .nav-links a:hover::after, .nav-links a.active::after { width: 100%; }

        .nav-actions .btn-login {
            background: var(--primary); color: var(--white); padding: 12px 32px;
            border-radius: 50px; text-decoration:none; font-weight:600; display:flex;
            align-items:center; gap:10px; box-shadow:0 4px 15px rgba(10,124,125,0.3);
            transition: var(--transition); font-size:15px;
        }
        .nav-actions .btn-login:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow:0 6px 20px rgba(10,124,125,0.4);
        }

        /* Footer */
        footer { width:100%; background: var(--primary-dark); color: var(--white); padding:100px 0 40px; }
        .footer-content { display:grid; grid-template-columns:repeat(4,1fr); gap:50px; margin-bottom:70px; }
        .footer-column h3 { font-size:1.4rem; margin-bottom:30px; font-weight:700; position:relative; padding-bottom:15px; }
        .footer-column h3:after { content:''; position:absolute; left:0; bottom:0; width:40px; height:3px; background:var(--primary-light); border-radius:2px; }
        .footer-links, .contact-info { list-style:none; padding:0; }
        .footer-links li, .contact-info li { margin-bottom:14px; display:flex; align-items:flex-start; }
        .footer-links a { color:rgba(255,255,255,0.8); text-decoration:none; font-weight:500; transition:var(--transition); }
        .footer-links a:hover { color:var(--white); padding-left:8px; }
        .contact-info i { margin-right:12px; margin-top:5px; color:var(--primary-light); font-size:1.1rem; }
        .social-links { display:flex; gap:15px; margin-top:25px; }
        .social-links a { display:flex; align-items:center; justify-content:center; width:44px; height:44px; background:rgba(255,255,255,0.1); border-radius:12px; color:var(--white); font-size:1.1rem; transition:var(--transition); }
        .social-links a:hover { background: var(--primary-light); transform:translateY(-3px); }
        .copyright { text-align:center; padding-top:40px; border-top:1px solid rgba(255,255,255,0.1); color:rgba(255,255,255,0.7); font-size:0.95rem; }

        @media (max-width: 1200px) { .footer-content { grid-template-columns:repeat(2,1fr); } }
        @media (max-width: 768px) { 
            .container { padding:0 24px; } 
            .nav-links { display:none; } 
            .footer-content { grid-template-columns:1fr; gap:40px; } 
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Announcement Bar -->
    <div class="announcement">
        <div class="container">
            📢 Announcement: Clinic is Unavailable on April 9, 2025 due to a Regular Non-working Holiday! 😊
        </div>
    </div>

    <!-- Navigation -->
    <nav>
        <div class="container">
            <div class="nav-container">
                <div class="logo">
                    <div class="logo-img">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="ToothTalk Logo">
                    </div>
                    <div class="logo-text">
                        <h1>ToothTalk</h1>
                        <p>JValera Dental Clinic</p>
                    </div>
                </div>
                <ul class="nav-links">
                    <li><a href="{{ route('clinic') }}" class="{{ request()->routeIs('clinic') ? 'active' : '' }}">Clinic</a></li>
                    <li><a href="{{ route('announcement') }}" class="{{ request()->routeIs('announcement') ? 'active' : '' }}">Announcement</a></li>
                    <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About Us</a></li>
                </ul>
                <div class="nav-actions">
                    <a href="{{ route('login') }}" class="btn-login">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>ToothTalk Dental</h3>
                    <p>Providing exceptional dental services with compassion and cutting-edge technology since 2005. Your smile is our priority.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Dentists</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Our Services</h3>
                    <ul class="footer-links">
                        <li><a href="#">Cosmetic Dentistry</a></li>
                        <li><a href="#">Laser Dentistry</a></li>
                        <li><a href="#">Oral Surgery</a></li>
                        <li><a href="#">Periodontics</a></li>
                        <li><a href="#">Preventive Care</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Contact Info</h3>
                    <ul class="contact-info">
                        <li><i class="fas fa-map-marker-alt"></i> Policarpio St. Gen. T. de Leon Valenzuela City</li>
                        <li><i class="fas fa-phone"></i> (555) 123-4567</li>
                        <li><i class="fas fa-envelope"></i> info@toothtalk.com</li>
                        <li><i class="fas fa-clock"></i> Mon-Fri: 8am-6pm, Sat: 9am-2pm</li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; {{ date('Y') }} ToothTalk Dental Care. All rights reserved. | Privacy Policy | Terms of Service</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
