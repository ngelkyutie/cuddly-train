@extends('layouts.app')

@section('title', 'Staff Dashboard - ToothTalk Dental Clinic')

@section('content')
<style>
    .staff-dashboard {
        padding: 40px 0;
    }
    
    .welcome-card {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: var(--white);
        padding: 30px;
        border-radius: 15px;
        margin-bottom: 30px;
    }
    
    .welcome-card h1 {
        font-size: 2rem;
        margin-bottom: 10px;
    }
    
    .role-badge {
        background: rgba(255,255,255,0.2);
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.9rem;
        display: inline-block;
    }
</style>

<div class="staff-dashboard">
    <div class="container">
        <div class="welcome-card">
            <h1>Welcome, {{ $staffData['name'] }}!</h1>
            <div class="role-badge">{{ ucfirst($staffData['role']) }}</div>
            <p style="margin-top: 15px; opacity: 0.9;">Staff Dashboard - ToothTalk Dental Clinic</p>
        </div>
        
        <div class="content-section">
            <h2 class="section-title">Quick Actions</h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
                <a href="{{ route('staff.schedule') }}" class="admin-btn">
                    <i class="fas fa-calendar-alt"></i> View Schedule
                </a>
                <a href="{{ route('staff.patients') }}" class="admin-btn">
                    <i class="fas fa-users"></i> Patient List
                </a>
                <form method="POST" action="{{ route('staff.logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="admin-btn secondary">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection