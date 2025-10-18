@extends('layouts.app')

@section('title', 'Announcements - JValera Dental Clinic | ToothTalk')

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

    .announcements-section {
        width: 100%;
        padding: 100px 0;
        background: var(--white);
    }

    .announcements-content {
        max-width: 1000px;
        margin: 0 auto;
    }

    .announcements-header {
        text-align: center;
        margin-bottom: 60px;
    }

    .announcements-title {
        font-size: 2.8rem;
        font-weight: 800;
        color: var(--text);
        margin-bottom: 20px;
        letter-spacing: -1px;
    }

    .announcements-subtitle {
        font-size: 1.2rem;
        color: var(--text-light);
        max-width: 700px;
        margin: 0 auto;
        line-height: 1.7;
    }

    .announcement-card {
        background: var(--white);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: var(--transition);
        margin-bottom: 40px;
        border: 3px solid var(--primary);
    }

    .announcement-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-hover);
    }

    .announcement-image {
        width: 100%;
        height: 300px;
        background: linear-gradient(135deg, var(--primary-light), var(--primary));
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--white);
        font-size: 1.3rem;
        font-weight: 600;
    }

    .announcement-content {
        padding: 40px;
    }

    .announcement-title {
        font-size: 2rem;
        font-weight: 800;
        color: var(--primary);
        margin-bottom: 20px;
        line-height: 1.2;
    }

    .announcement-text {
        font-size: 1.1rem;
        color: var(--text-light);
        line-height: 1.7;
        margin-bottom: 25px;
    }

    .announcement-details {
        display: flex;
        gap: 30px;
        margin-bottom: 25px;
        flex-wrap: wrap;
    }

    .detail-item {
        display: flex;
        align-items: center;
        gap: 10px;
        color: var(--text);
        font-weight: 500;
    }

    .detail-item i {
        color: var(--primary);
        font-size: 1.1rem;
    }

    .urgent-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #FF6B6B;
        color: var(--white);
        padding: 8px 16px;
        border-radius: 50px;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .upcoming-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #4ECDC4;
        color: var(--white);
        padding: 8px 16px;
        border-radius: 50px;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .info-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #45B7D1;
        color: var(--white);
        padding: 8px 16px;
        border-radius: 50px;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .archive-section {
        width: 100%;
        padding: 80px 0;
        background: var(--bg-light);
    }

    .archive-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .archive-title {
        font-size: 2.2rem;
        font-weight: 800;
        color: var(--text);
        margin-bottom: 20px;
        letter-spacing: -1px;
    }

    .archive-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 30px;
    }

    .archive-card {
        background: var(--white);
        border-radius: 16px;
        padding: 30px;
        box-shadow: var(--shadow);
        transition: var(--transition);
        border-left: 4px solid var(--primary);
    }

    .archive-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-hover);
    }

    .archive-date {
        font-size: 0.9rem;
        color: var(--text-light);
        margin-bottom: 12px;
        font-weight: 500;
    }

    .archive-title-small {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--text);
        margin-bottom: 15px;
        line-height: 1.3;
    }

    .archive-excerpt {
        font-size: 1rem;
        color: var(--text-light);
        line-height: 1.6;
    }

    @media (max-width: 992px) {
        .page-hero-title {
            font-size: 3rem;
        }
    }

    @media (max-width: 768px) {
        .page-hero-title {
            font-size: 2.5rem;
        }
        
        .announcements-title {
            font-size: 2.2rem;
        }
        
        .announcement-details {
            flex-direction: column;
            gap: 15px;
        }
        
        .archive-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 576px) {
        .page-hero-title {
            font-size: 2.2rem;
        }
        
        .page-hero-subtitle {
            font-size: 1.1rem;
        }
        
        .announcements-title {
            font-size: 2rem;
        }
        
        .announcement-content {
            padding: 25px;
        }
        
        .announcement-title {
            font-size: 1.6rem;
        }
    }
</style>

<section class="page-hero">
    <div class="container">
        <div class="page-hero-content">
            <h1 class="page-hero-title">Clinic Announcements</h1>
            <p class="page-hero-subtitle">Stay updated with the latest news, schedule changes, and important information from ToothTalk Dental Clinic.</p>
        </div>
    </div>
</section>

<section class="announcements-section">
    <div class="container">
        <div class="announcements-content">
            <div class="announcements-header">
                <h2 class="announcements-title">Current Announcements</h2>
                <p class="announcements-subtitle">Important updates about our clinic operations, schedule changes, and special events.</p>
            </div>
            
            <div class="announcement-card">
                <div class="urgent-badge">
                    <i class="fas fa-exclamation-circle"></i>
                    URGENT NOTICE
                </div>
                <div class="announcement-image">
                    Holiday Closure Notice
                </div>
                <div class="announcement-content">
                    <h3 class="announcement-title">IT'S A CELEBRATION!</h3>
                    <p class="announcement-text">We are closed on April 9, 2025. Clinical Operations Resume on April 10, 2025.</p>
                    
                    <div class="announcement-details">
                        <div class="detail-item">
                            <i class="fas fa-calendar-alt"></i>
                            <span>April 9, 2025</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-clock"></i>
                            <span>All Day Closure</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Main Clinic</span>
                        </div>
                    </div>
                    
                    <p class="announcement-text">Our dental clinic will be closed in observance of a regular non-working holiday. We apologize for any inconvenience this may cause and look forward to serving you when we resume operations on April 10, 2025.</p>
                </div>
            </div>
            
            <div class="announcement-card">
                <div class="upcoming-badge">
                    <i class="fas fa-calendar-check"></i>
                    UPCOMING EVENT
                </div>
                <div class="announcement-image">
                    Free Dental Check-up Event
                </div>
                <div class="announcement-content">
                    <h3 class="announcement-title">Community Dental Health Week</h3>
                    <p class="announcement-text">Join us for our annual community dental health event featuring free check-ups and oral health education.</p>
                    
                    <div class="announcement-details">
                        <div class="detail-item">
                            <i class="fas fa-calendar-alt"></i>
                            <span>May 15-20, 2025</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-clock"></i>
                            <span>9:00 AM - 4:00 PM</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-users"></i>
                            <span>Open to All Ages</span>
                        </div>
                    </div>
                    
                    <p class="announcement-text">As part of our commitment to community health, we're offering free dental check-ups, oral cancer screenings, and educational sessions. No appointment necessary during event hours.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="archive-section">
    <div class="container">
        <div class="archive-header">
            <h2 class="archive-title">Announcement Archive</h2>
            <p class="announcements-subtitle">Previous announcements and updates from our clinic.</p>
        </div>
        
        <div class="archive-grid">
            <div class="archive-card">
                <div class="archive-date">March 15, 2025</div>
                <h3 class="archive-title-small">New Dental Technology Implementation</h3>
                <p class="archive-excerpt">We've upgraded our equipment with the latest digital imaging technology for more accurate diagnoses and comfortable treatments.</p>
            </div>
            
            <div class="archive-card">
                <div class="archive-date">February 28, 2025</div>
                <h3 class="archive-title-small">Extended Hours for February</h3>
                <p class="archive-excerpt">To accommodate more patients, we extended our clinic hours throughout February. Regular hours resume in March.</p>
            </div>
            
            <div class="archive-card">
                <div class="archive-date">January 10, 2025</div>
                <h3 class="archive-title-small">New Dental Hygienist Joins Our Team</h3>
                <p class="archive-excerpt">We're excited to welcome our new dental hygienist who brings 8 years of experience in preventive dental care.</p>
            </div>
        </div>
    </div>
</section>
@endsection