@extends('layouts.app')

@section('title', 'ToothTalk Dental Clinic - Premium Dental Care')

@section('content')
<style>
    .hero {
        width: 100%;
        padding: 120px 0 100px;
        background: linear-gradient(135deg, var(--bg-light) 0%, #E8F6F7 100%);
        position: relative;
        overflow: hidden;
    }

    .hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 70%;
        height: 200%;
        background: linear-gradient(135deg, var(--primary-light), var(--primary));
        opacity: 0.03;
        transform: rotate(12deg);
        border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%;
    }

    .hero-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 80px;
        align-items: center;
    }

    .hero-text {
        position: relative;
        z-index: 2;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(10, 124, 125, 0.1);
        color: var(--primary);
        padding: 8px 16px;
        border-radius: 50px;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 24px;
    }

    .hero-title {
        font-size: 3.8rem;
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 24px;
        color: var(--text);
        letter-spacing: -1px;
    }

    .hero-title span {
        color: var(--primary);
        position: relative;
    }

    .hero-title span::after {
        content: '';
        position: absolute;
        bottom: 8px;
        left: 0;
        width: 100%;
        height: 8px;
        background: rgba(10, 124, 125, 0.2);
        z-index: -1;
        border-radius: 4px;
    }

    .hero-subtitle {
        font-size: 1.3rem;
        color: var(--text-light);
        margin-bottom: 40px;
        max-width: 540px;
        line-height: 1.7;
    }

    .hero-buttons {
        display: flex;
        gap: 20px;
        margin-bottom: 60px;
    }

    .btn-primary {
        background: var(--primary);
        color: var(--white);
        padding: 18px 38px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 12px;
        transition: var(--transition);
        box-shadow: 0 6px 20px rgba(10, 124, 125, 0.3);
        font-size: 16px;
    }

    .btn-primary:hover {
        background: var(--primary-dark);
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(10, 124, 125, 0.4);
    }

    .btn-secondary {
        background: transparent;
        color: var(--primary);
        border: 2px solid var(--primary);
        padding: 18px 38px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 12px;
        transition: var(--transition);
        font-size: 16px;
    }

    .btn-secondary:hover {
        background: rgba(10, 124, 125, 0.08);
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(10, 124, 125, 0.15);
    }

    .hero-stats {
        display: flex;
        gap: 50px;
    }

    .stat {
        text-align: left;
    }

    .stat-number {
        font-size: 2.8rem;
        font-weight: 700;
        color: var(--primary);
        line-height: 1;
        margin-bottom: 8px;
    }

    .stat-label {
        font-size: 1rem;
        color: var(--text-light);
        font-weight: 500;
    }

    .hero-image {
        position: relative;
        z-index: 2;
    }

    .hero-img-container {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--shadow-hover);
        transform: perspective(1000px) rotateY(-5deg) rotateX(5deg);
        transition: var(--transition);
    }

    .hero-img-container:hover {
        transform: perspective(1000px) rotateY(0) rotateX(0);
    }

    .hero-img-placeholder {
        width: 100%;
        height: 500px;
        background: linear-gradient(135deg, var(--primary-light), var(--primary));
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--white);
        font-size: 1.3rem;
        font-weight: 600;
    }

    .floating-elements {
        position: absolute;
        top: 50%;
        right: -30px;
        transform: translateY(-50%);
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .floating-card {
        background: var(--white);
        padding: 20px;
        border-radius: 16px;
        box-shadow: var(--shadow);
        display: flex;
        align-items: center;
        gap: 15px;
        width: 220px;
        transition: var(--transition);
    }

    .floating-card:hover {
        transform: translateX(10px);
        box-shadow: var(--shadow-hover);
    }

    .floating-icon {
        width: 50px;
        height: 50px;
        background: rgba(10, 124, 125, 0.1);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-size: 1.3rem;
    }

    .patient-section {
        width: 100%;
        padding: 100px 0;
        background: var(--white);
        text-align: center;
        position: relative;
    }

    .patient-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--gray), transparent);
    }

    .patient-section p {
        font-size: 1.5rem;
        color: var(--text-light);
        margin-bottom: 40px;
        font-weight: 500;
    }

    .services {
        width: 100%;
        padding: 120px 0;
        background: var(--bg-light);
        position: relative;
    }

    .section-header {
        text-align: center;
        margin-bottom: 80px;
    }

    .section-title {
        font-size: 3rem;
        font-weight: 800;
        color: var(--text);
        margin-bottom: 20px;
        letter-spacing: -1px;
    }

    .section-subtitle {
        font-size: 1.2rem;
        color: var(--text-light);
        max-width: 700px;
        margin: 0 auto;
        line-height: 1.7;
    }

    .services-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 30px;
    }

    .service-card {
        background: var(--white);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: var(--transition);
        height: 100%;
        position: relative;
    }

    .service-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(90deg, var(--primary-light), var(--primary));
    }

    .service-card:hover {
        transform: translateY(-12px);
        box-shadow: var(--shadow-hover);
    }

    .service-icon {
        height: 140px;
        background: linear-gradient(135deg, var(--primary-light), var(--primary));
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3.5rem;
        color: var(--white);
        position: relative;
        overflow: hidden;
    }

    .service-icon::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: rgba(255,255,255,0.1);
        transform: rotate(45deg);
    }

    .service-content {
        padding: 35px 30px;
    }

    .service-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text);
        margin-bottom: 18px;
    }

    .service-description {
        color: var(--text-light);
        margin-bottom: 25px;
        line-height: 1.7;
    }

    .service-features {
        list-style: none;
    }

    .service-features li {
        margin-bottom: 10px;
        padding-left: 26px;
        position: relative;
        color: var(--text-light);
    }

    .service-features li:before {
        content: '✓';
        position: absolute;
        left: 0;
        color: var(--primary);
        font-weight: bold;
        font-size: 1.1rem;
    }

    .footer-wave {
        position: absolute;
        top: -2px;
        left: 0;
        width: 100%;
        overflow: hidden;
        line-height: 0;
    }

    .footer-wave svg {
        position: relative;
        display: block;
        width: calc(100% + 1.3px);
        height: 50px;
    }

    .footer-wave .shape-fill {
        fill: var(--primary-dark);
    }

    .footer-about {
        max-width: 300px;
    }

    .footer-about p {
        color: rgba(255,255,255,0.8);
        margin-bottom: 25px;
        line-height: 1.7;
    }

    .footer-links a {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .footer-links a i {
        font-size: 0.8rem;
        opacity: 0.7;
    }

    .contact-info li {
        display: flex;
        align-items: flex-start;
    }

    .contact-info i {
        margin-right: 12px;
        margin-top: 5px;
        color: var(--primary-light);
        font-size: 1.1rem;
        width: 20px;
    }

    .footer-bottom {
        border-top: 1px solid rgba(255,255,255,0.1);
        padding-top: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }

    .copyright {
        color: rgba(255,255,255,0.7);
        font-size: 0.9rem;
    }

    .footer-legal {
        display: flex;
        gap: 25px;
    }

    .footer-legal a {
        color: rgba(255,255,255,0.7);
        text-decoration: none;
        font-size: 0.9rem;
        transition: var(--transition);
    }

    .footer-legal a:hover {
        color: var(--white);
    }

    .newsletter-form {
        display: flex;
        gap: 10px;
        margin-top: 15px;
    }

    .newsletter-input {
        flex: 1;
        padding: 12px 15px;
        border: 1px solid rgba(255,255,255,0.2);
        border-radius: 8px;
        background: rgba(255,255,255,0.1);
        color: var(--white);
        font-size: 0.9rem;
    }

    .newsletter-input::placeholder {
        color: rgba(255,255,255,0.6);
    }

    .newsletter-btn {
        background: var(--primary-light);
        color: var(--white);
        border: none;
        padding: 12px 20px;
        border-radius: 8px;
        cursor: pointer;
        transition: var(--transition);
        font-weight: 600;
    }

    .newsletter-btn:hover {
        background: var(--accent);
        transform: translateY(-2px);
    }

    @media (max-width: 1200px) {
        .services-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .footer-content {
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }
        
        .hero-content {
            gap: 60px;
        }
    }

    @media (max-width: 992px) {
        .hero-content {
            grid-template-columns: 1fr;
            gap: 60px;
        }
        
        .hero-title {
            font-size: 3.2rem;
        }
        
        .floating-elements {
            display: none;
        }
    }

    @media (max-width: 768px) {
        .services-grid {
            grid-template-columns: 1fr;
        }
        
        .hero-buttons {
            flex-direction: column;
            align-items: center;
        }
        
        .btn-primary, .btn-secondary {
            width: 100%;
            justify-content: center;
        }
        
        .hero-stats {
            justify-content: space-between;
        }
        
        .section-title {
            font-size: 2.5rem;
        }
        
        .footer-bottom {
            flex-direction: column;
            text-align: center;
        }
        
        .footer-legal {
            justify-content: center;
        }
    }

    @media (max-width: 576px) {
        .hero-title {
            font-size: 2.5rem;
        }
        
        .hero-subtitle {
            font-size: 1.1rem;
        }
        
        .stat-number {
            font-size: 2.2rem;
        }
        
        .section-title {
            font-size: 2.2rem;
        }
        
        .newsletter-form {
            flex-direction: column;
        }
    }
</style>

<section class="hero">
    <div class="container">
        <div class="hero-content">
            <div class="hero-text">
                <div class="hero-badge">
                    <i class="fas fa-star"></i>
                    Premium Dental Care Since 2005
                </div>
                <h1 class="hero-title">Have confidence in your <span>SMILE</span> in no time!</h1>
                <p class="hero-subtitle">Experience world-class dental care with cutting-edge technology and a compassionate team dedicated to your oral health and beautiful smile.</p>
                
                <div class="hero-buttons">
                    <a href="{{ route('login') }}" class="btn-primary">
                        <i class="fas fa-user-circle"></i> Patient Portal Login
                    </a>
                    <a href="#" class="btn-secondary">
                        <i class="fas fa-calendar-alt"></i> Book Appointment
                    </a>
                </div>
                
                <div class="hero-stats">
                    <div class="stat">
                        <div class="stat-number">5,000+</div>
                        <div class="stat-label">Happy Patients</div>
                    </div>
                    <div class="stat">
                        <div class="stat-number">15+</div>
                        <div class="stat-label">Years Experience</div>
                    </div>
                    <div class="stat">
                        <div class="stat-number">98%</div>
                        <div class="stat-label">Success Rate</div>
                    </div>
                </div>
            </div>
            
            <div class="hero-image">
                <div class="hero-img-container">
                    <div class="hero-img-placeholder">
                        Advanced Dental Clinic Environment
                    </div>
                </div>
                <div class="floating-elements">
                    <div class="floating-card">
                        <div class="floating-icon">
                            <i class="fas fa-teeth"></i>
                        </div>
                        <div>
                            <h4>Pain-Free</h4>
                            <p>Advanced anesthesia</p>
                        </div>
                    </div>
                    <div class="floating-card">
                        <div class="floating-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div>
                            <h4>Sterile</h4>
                            <p>Highest safety standards</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="patient-section">
    <div class="container">
        <p>If you are seeking for your follow-up care</p>
        <a href="{{ route('login') }}" class="btn-primary">
            <i class="fas fa-user-circle"></i> Sign in with your patient account
        </a>
    </div>
</section>

<section class="services">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">OUR SERVICES</h2>
            <p class="section-subtitle">We offer a comprehensive range of premium dental services using the latest technology and techniques to ensure optimal oral health and beautiful smiles.</p>
        </div>
        
        <div class="services-grid">
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-tooth"></i>
                </div>
                <div class="service-content">
                    <h3 class="service-title">COSMETIC DENTISTRY</h3>
                    <p class="service-description">Transform your smile with our advanced cosmetic procedures designed to enhance aesthetics and boost confidence.</p>
                    <ul class="service-features">
                        <li>Teeth Whitening</li>
                        <li>Veneers & Lumineers</li>
                        <li>Dental Bonding</li>
                        <li>Smile Makeovers</li>
                    </ul>
                </div>
            </div>
            
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-bolt"></i>
                </div>
                <div class="service-content">
                    <h3 class="service-title">LASER DENTISTRY</h3>
                    <p class="service-description">Minimally invasive treatments using advanced laser technology for precision and faster recovery.</p>
                    <ul class="service-features">
                        <li>Painless Procedures</li>
                        <li>Faster Healing</li>
                        <li>Reduced Bleeding</li>
                        <li>Minimal Discomfort</li>
                    </ul>
                </div>
            </div>
            
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-syringe"></i>
                </div>
                <div class="service-content">
                    <h3 class="service-title">ORAL SURGERY</h3>
                    <p class="service-description">Expert surgical care for complex dental issues, performed with precision and patient comfort in mind.</p>
                    <ul class="service-features">
                        <li>Wisdom Teeth Removal</li>
                        <li>Dental Implants</li>
                        <li>Bone Grafting</li>
                        <li>Root Canals</li>
                    </ul>
                </div>
            </div>
            
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-teeth-open"></i>
                </div>
                <div class="service-content">
                    <h3 class="service-title">PERIODONTICS</h3>
                    <p class="service-description">Specialized care for your gums and supporting structures to maintain optimal oral health.</p>
                    <ul class="service-features">
                        <li>Gum Disease Treatment</li>
                        <li>Scaling & Root Planing</li>
                        <li>Gum Grafting</li>
                        <li>Periodontal Maintenance</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection