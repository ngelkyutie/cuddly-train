@extends('layouts.app')

@section('title', 'Admin Dashboard - ToothTalk Dental Clinic')

@section('content')
<style>
    .admin-header {
        background: var(--white);
        padding: 20px 0;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
    }

    .admin-nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .admin-actions {
        display: flex;
        gap: 20px;
        align-items: center;
    }

    .admin-btn {
        background: var(--primary);
        color: var(--white);
        padding: 12px 24px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 15px;
    }

    .admin-btn:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(10, 124, 125, 0.4);
    }

    .admin-btn.secondary {
        background: var(--white);
        color: var(--primary);
        border: 2px solid var(--primary);
    }

    .admin-btn.secondary:hover {
        background: var(--primary);
        color: var(--white);
    }

    /* Profile Dropdown Styles */
    .profile-container {
        position: relative;
    }

    .profile-btn {
        display: flex;
        align-items: center;
        gap: 10px;
        background: var(--bg-light);
        border: none;
        padding: 10px 16px;
        border-radius: 50px;
        cursor: pointer;
        transition: var(--transition);
        font-family: 'Inter', sans-serif;
        font-weight: 500;
    }

    .profile-btn:hover {
        background: var(--primary-light);
        color: var(--white);
    }

    .profile-pic {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--white);
        font-weight: 600;
    }

    .profile-dropdown {
        position: absolute;
        top: 100%;
        right: 0;
        width: 220px;
        background: var(--white);
        border-radius: 12px;
        box-shadow: var(--shadow-hover);
        padding: 20px 0;
        margin-top: 10px;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: var(--transition);
        z-index: 1001;
    }

    .profile-dropdown.active {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .dropdown-header {
        padding: 0 20px 15px;
        border-bottom: 1px solid var(--gray);
        margin-bottom: 10px;
    }

    .dropdown-header h3 {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .dropdown-header p {
        font-size: 0.9rem;
        color: var(--text-light);
    }

    .dropdown-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 20px;
        text-decoration: none;
        color: var(--text);
        transition: var(--transition);
        font-weight: 500;
        border: none;
        background: none;
        width: 100%;
        text-align: left;
        cursor: pointer;
        font-family: 'Inter', sans-serif;
    }

    .dropdown-item:hover {
        background: var(--bg-light);
        color: var(--primary);
    }

    .dropdown-item i {
        width: 20px;
        text-align: center;
        color: var(--primary-light);
    }

    .dropdown-divider {
        height: 1px;
        background: var(--gray);
        margin: 10px 0;
    }

    .dashboard {
        padding: 40px 0;
    }

    .dashboard-header {
        margin-bottom: 40px;
    }

    .dashboard-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--text);
        margin-bottom: 10px;
    }

    .dashboard-subtitle {
        color: var(--text-light);
        font-size: 1.1rem;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        margin-bottom: 50px;
    }

    .dashboard-card {
        background: var(--white);
        border-radius: 20px;
        padding: 30px;
        box-shadow: var(--shadow);
        transition: var(--transition);
        border: 2px solid transparent;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-hover);
        border-color: var(--primary-light);
    }

    .card-header {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
    }

    .card-icon {
        width: 60px;
        height: 60px;
        background: rgba(10, 124, 125, 0.1);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-size: 1.5rem;
    }

    .card-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text);
    }

    .card-content {
        color: var(--text-light);
        margin-bottom: 25px;
        line-height: 1.7;
    }

    .card-stats {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 800;
        color: var(--primary);
    }

    .stat-label {
        color: var(--text-light);
        font-size: 0.9rem;
    }

    .recent-activity {
        background: var(--white);
        border-radius: 20px;
        padding: 30px;
        box-shadow: var(--shadow);
    }

    .section-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--text);
        margin-bottom: 25px;
    }

    .activity-list {
        list-style: none;
    }

    .activity-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px 0;
        border-bottom: 1px solid var(--gray);
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-icon {
        width: 40px;
        height: 40px;
        background: var(--bg-light);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
    }

    .activity-content {
        flex: 1;
    }

    .activity-text {
        font-weight: 500;
        margin-bottom: 5px;
    }

    .activity-time {
        color: var(--text-light);
        font-size: 0.9rem;
    }

    @media (max-width: 768px) {
        .dashboard-grid {
            grid-template-columns: 1fr;
        }
        
        .admin-nav {
            flex-direction: column;
            gap: 20px;
        }
        
        .dashboard-title {
            font-size: 2rem;
        }
        
        .profile-btn span {
            display: none;
        }
        
        .admin-actions {
            flex-wrap: wrap;
            justify-content: center;
        }
    }
</style>

<header class="admin-header">
    <div class="container">
        <div class="admin-nav">
            <div class="logo">
                <div class="logo-img">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="ToothTalk Logo" style="width:100%;height:100%;object-fit:cover;border-radius:12px;">
                </div>
                <div class="logo-text">
                    <h1>ToothTalk</h1>
                    <p>JValera Dental Clinic - Admin</p>
                </div>
            </div>
            <div class="admin-actions">
                <a href="{{ route('admin.patients') }}" class="admin-btn">
                    <i class="fas fa-users"></i> Patient Records
                </a>
                <a href="{{ route('admin.schedule') }}" class="admin-btn secondary">
                    <i class="fas fa-calendar-alt"></i> Schedule
                </a>
                <div class="profile-container">
                    <button class="profile-btn" id="profileBtn">
                        <div class="profile-pic">AD</div>
                        <span>{{ Auth::user()->name ?? 'Admin User' }}</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="profile-dropdown" id="profileDropdown">
                        <div class="dropdown-header">
                            <h3>{{ Auth::user()->name ?? 'Admin User' }}</h3>
                            <p>Administrator</p>
                        </div>
                        <button class="dropdown-item">
                            <i class="fas fa-user-cog"></i>
                            <span>My Profile</span>
                        </button>
                        <button class="dropdown-item">
                            <i class="fas fa-cog"></i>
                            <span>Settings</span>
                        </button>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('admin.logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<main class="dashboard">
    <div class="container">
        <div class="dashboard-header">
            <h1 class="dashboard-title">Admin Dashboard</h1>
            <p class="dashboard-subtitle">Manage your dental clinic operations efficiently</p>
        </div>

        <div class="dashboard-grid">
            <div class="dashboard-card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h2 class="card-title">Appointments</h2>
                </div>
                <p class="card-content">Manage patient appointments, view schedules, and handle rescheduling requests.</p>
                <div class="card-stats">
                    <div>
                        <div class="stat-number">12</div>
                        <div class="stat-label">This Week</div>
                    </div>
                    <a href="{{ route('admin.schedule') }}" class="admin-btn">
                        <i class="fas fa-arrow-right"></i> View
                    </a>
                </div>
            </div>

            <div class="dashboard-card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-user-injured"></i>
                    </div>
                    <h2 class="card-title">Patient Records</h2>
                </div>
                <p class="card-content">Access and manage patient information, medical history, and treatment records.</p>
                <div class="card-stats">
                    <div>
                        <div class="stat-number">156</div>
                        <div class="stat-label">Total Patients</div>
                    </div>
                    <a href="{{ route('admin.patients') }}" class="admin-btn">
                        <i class="fas fa-arrow-right"></i> Manage
                    </a>
                </div>
            </div>

            <div class="dashboard-card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-file-medical"></i>
                    </div>
                    <h2 class="card-title">Post-Procedure</h2>
                </div>
                <p class="card-content">Handle post-procedure forms, progress notes, and patient follow-ups.</p>
                <div class="card-stats">
                    <div>
                        <div class="stat-number">8</div>
                        <div class="stat-label">Pending</div>
                    </div>
                    <a href="{{ route('admin.procedures') }}" class="admin-btn">
                        <i class="fas fa-arrow-right"></i> Process
                    </a>
                </div>
            </div>

            <div class="dashboard-card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-cog"></i>
                    </div>
                    <h2 class="card-title">Content Management</h2>
                </div>
                <p class="card-content">Update services, announcements, and manage patient communication settings.</p>
                <div class="card-stats">
                    <div>
                        <div class="stat-number">6</div>
                        <div class="stat-label">Services</div>
                    </div>
                    <a href="{{ route('admin.content') }}" class="admin-btn">
                        <i class="fas fa-arrow-right"></i> Configure
                    </a>
                </div>
            </div>
        </div>

        <div class="recent-activity">
            <h2 class="section-title">Recent Activity</h2>
            <ul class="activity-list">
                <li class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-calendar-plus"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-text">New appointment scheduled for Mark Castillo</div>
                        <div class="activity-time">2 hours ago</div>
                    </div>
                </li>
                <li class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-file-medical-alt"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-text">Progress notes updated for Angel Cuadernal</div>
                        <div class="activity-time">5 hours ago</div>
                    </div>
                </li>
                <li class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-text">New patient registered: John Roy Lalamacon</div>
                        <div class="activity-time">Yesterday</div>
                    </div>
                </li>
                <li class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-tooth"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-text">Service updated: Zirconia pricing adjusted</div>
                        <div class="activity-time">2 days ago</div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Profile dropdown functionality
        const profileBtn = document.getElementById('profileBtn');
        const profileDropdown = document.getElementById('profileDropdown');

        profileBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            profileDropdown.classList.toggle('active');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function() {
            profileDropdown.classList.remove('active');
        });

        // Simple dashboard interactions
        function updateDateTime() {
            const now = new Date();
            // You can add a datetime display element if needed
        }
        
        updateDateTime();
        setInterval(updateDateTime, 60000); // Update every minute
    });
</script>
@endsection