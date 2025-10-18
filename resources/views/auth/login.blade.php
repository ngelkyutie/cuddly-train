@extends('layouts.app')

@section('title', 'Patient Login - ToothTalk Dental Clinic')

@section('content')
<!-- all your HTML, CSS, and form here -->
@endsection

<div style="text-align: center; margin-top: 15px;">
    <a href="{{ route('password.change') }}" style="color: var(--primary); text-decoration: none; font-size: 0.9rem;">
        <i class="fas fa-key"></i> Forgot Password?
    </a>
</div>
