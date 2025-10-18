@extends('layouts.app')

@section('title', 'About Us - JValera Dental Clinic | ToothTalk')

@section('content')
<style>
    .page-hero {
        width: 100%;
        padding: 100px 0 80px;
        background: linear-gradient(135deg, var(--bg-light) 0%, #E8F6F7 100%);
        position: relative;
        overflow: hidden;
    }

    .page-hero::before {
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

    .page-hero-content {
        text-align: center;
        max-width: 800px;
        margin: 0 auto;
        position: relative;
        z-index: 2;
    }

    .page-hero-title {
        font-size: 3.5rem;
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 20px;
        color: var(--text);
        letter-spacing: -1px;
    }

    .page-hero-subtitle {
        font-size: 1.3rem;
        color: var(--text-light);
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.7;
    }

    .about-section {
        width: 100%;
        padding: 100px 0;
        background: var(--white);
    }

    .about-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 80px;
        align-items: center;
    }

    .about-text {
        position: relative;
    }

    .section-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(10, 124, 125, 0.1);
        color: var(--primary);
        padding: 8px 20px;
        border-radius: 50px;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 24px;
    }

    .section-title {
        font-size: 2.8rem;
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 16px;
        color: var(--text);
        letter-spacing: -1px;
    }

    .section-subtitle {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 30px;
    }

    .about-description {
        font-size: 1.1rem;
        color: var(--text-light);
        line-height: 1.8;
        margin-bottom: 40px;
    }

    .about-features {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-top: 40px;
    }

    .feature-item {
        display: flex;
        align-items: flex-start;
        gap: 15px;
    }

    .feature-icon {
        width: 50px;
        height: 50px;
        background: rgba(10, 124, 125, 0.1);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-size: 1.3rem;
        flex-shrink: 0;
    }

    .feature-text h4 {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 8px;
        color: var(--text);
    }

    .feature-text p {
        font-size: 0.95rem;
        color: var(--text-light);
        line-height: 1.6;
    }

    .about-image {
        position: relative;
        text-align: center;
    }

    .image-container {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--shadow-hover);
        transform: perspective(1000px) rotateY(5deg) rotateX(5deg);
        transition: var(--transition);
    }

    .image-container:hover {
        transform: perspective(1000px) rotateY(0) rotateX(0);
    }

    .doctor-image {
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

    .image-decoration {
        position: absolute;
        top: -20px;
        right: -20px;
        width: 120px;
        height: 120px;
        background: var(--primary);
        border-radius: 20px;
        transform: rotate(15deg);
        z-index: -1;
        opacity: 0.1;
    }

    .location-section {
        width: 100%;
        padding: 100px 0;
        background: var(--bg-light);
    }

    .location-content {
        max-width: 1000px;
        margin: 0 auto;
    }

    .location-header {
        text-align: center;
        margin-bottom: 60px;
    }

    .location-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--text);
        margin-bottom: 20px;
        letter-spacing: -1px;
    }

    .location-address {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        font-size: 1.2rem;
        color: var(--text-light);
        margin-bottom: 40px;
    }

    .location-address i {
        color: var(--primary);
        font-size: 1.4rem;
    }

    .map-container {
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--shadow);
        border: 4px solid var(--primary);
        transition: var(--transition);
        height: 500px;
    }

    .map-container:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-hover);
    }

    .map-frame {
        width: 100%;
        height: 100%;
        border: none;
    }

    @media (max-width: 1200px) {
        .about-content {
            gap: 60px;
        }
    }

    @media (max-width: 992px) {
        .about-content {
            grid-template-columns: 1fr;
            gap: 60px;
        }
        
        .page-hero-title {
            font-size: 3rem;
        }
    }

    @media (max-width: 768px) {
        .about-features {
            grid-template-columns: 1fr;
        }
        
        .page-hero-title {
            font-size: 2.5rem;
        }
        
        .section-title {
            font-size: 2.2rem;
        }
        
        .map-container {
            height: 400px;
        }
    }

    @media (max-width: 576px) {
        .page-hero-title {
            font-size: 2.2rem;
        }
        
        .page-hero-subtitle {
            font-size: 1.1rem;
        }
        
        .section-title {
            font-size: 2rem;
        }
        
        .section-subtitle {
            font-size: 1.5rem;
        }
        
        .map-container {
            height: 300px;
        }
    }
</style>

<section class="page-hero">
    <div class="container">
        <div class="page-hero-content">
            <h1 class="page-hero-title">About Our Dental Practice</h1>
            <p class="page-hero-subtitle">Learn about our commitment to excellence in dental care and our passion for creating beautiful, healthy smiles.</p>
        </div>
    </div>
</section>

<section class="about-section">
    <div class="container">
        <div class="about-content">
            <div class="about-text">
                <div class="section-badge">
                    <i class="fas fa-heart"></i>
                    Our Story
                </div>
                <h2 class="section-title">ABOUT US</h2>
                <h3 class="section-subtitle">JVALERA DENTAL CLINIC</h3>
                <p class="about-description">
                    We believe in creating smiles that last a lifetime. Located in the heart of Gen. T. De Leon Valenzuela City, our clinic is a place where your comfort and well-being are our top priorities. Our friendly and skilled team takes the time to understand your individual needs and concerns, offering gentle and effective dental care tailored just for you. We're more than just a dental clinic; we're your partners in achieving optimal oral health and a confident smile.
                </p>
                
                <div class="about-features">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <div class="feature-text">
                            <h4>Expert Dental Team</h4>
                            <p>Our skilled professionals are dedicated to providing the highest quality dental care.</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-teeth"></i>
                        </div>
                        <div class="feature-text">
                            <h4>Advanced Technology</h4>
                            <p>We utilize the latest dental technology for precise diagnoses and effective treatments.</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-heartbeat"></i>
                        </div>
                        <div class="feature-text">
                            <h4>Patient-Centered Care</h4>
                            <p>Your comfort and satisfaction are at the heart of everything we do.</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="feature-text">
                            <h4>Sterile Environment</h4>
                            <p>We maintain the highest standards of cleanliness and safety for all our patients.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="about-image">
                <div class="image-container">
                    <div class="doctor-image">
                        Dr. JValera - Lead Dentist
                    </div>
                </div>
                <div class="image-decoration"></div>
            </div>
        </div>
    </div>
</section>

<section class="location-section">
    <div class="container">
        <div class="location-content">
            <div class="location-header">
                <h2 class="location-title">Our Location</h2>
                <div class="location-address">
                    <i class="fas fa-map-marker-alt"></i>
                    Policarpio St. Gen. T. de Leon Valenzuela City, Valenzuela, Philippines
                </div>
            </div>
            
            <div class="map-container">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3860.258901304716!2d120.98422277501995!3d14.632649176087404!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b6055e7b8f3f%3A0xe3d3e5b6d7c4b8e9!2sPolicarpio%20St%2C%20Gen.%20T.%20de%20Leon%2C%20Valenzuela%2C%20Metro%20Manila!5e0!3m2!1sen!2sph!4v1690000000000!5m2!1sen!2sph" 
                    class="map-frame"
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>
</section>
@endsection