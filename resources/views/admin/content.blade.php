@extends('layouts.app')

@section('title', 'Content Management - ToothTalk Dental Clinic')

@section('content')
<style>
    .admin-header {
        background: var(--white);
        padding: 20px 0;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        margin-bottom: 30px;
    }

    .admin-nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .nav-actions {
        display: flex;
        gap: 15px;
    }

    .nav-btn {
        background: var(--primary);
        color: var(--white);
        padding: 10px 20px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
    }

    .nav-btn:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
    }

    .nav-btn.secondary {
        background: var(--white);
        color: var(--primary);
        border: 2px solid var(--primary);
    }

    .nav-btn.secondary:hover {
        background: var(--primary);
        color: var(--white);
    }

    .page-title {
        font-size: 2.2rem;
        font-weight: 800;
        margin-bottom: 10px;
        color: var(--text);
    }

    .page-subtitle {
        color: var(--text-light);
        margin-bottom: 30px;
        font-size: 1.1rem;
    }

    .content-section {
        background: var(--white);
        border-radius: 15px;
        padding: 30px;
        box-shadow: var(--shadow);
        margin-bottom: 30px;
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 20px;
        color: var(--text);
        padding-bottom: 10px;
        border-bottom: 2px solid var(--gray);
    }

    .services-table {
        width: 100%;
        border-collapse: collapse;
    }

    .services-table th {
        background: var(--primary);
        color: var(--white);
        padding: 15px;
        text-align: left;
        font-weight: 600;
    }

    .services-table td {
        padding: 15px;
        border-bottom: 1px solid var(--gray);
    }

    .services-table tr:last-child td {
        border-bottom: none;
    }

    .services-table tr:hover {
        background: var(--bg-light);
    }

    .service-icon {
        width: 50px;
        height: 50px;
        background: var(--bg-light);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-size: 1.2rem;
    }

    .action-btn {
        padding: 6px 12px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: var(--transition);
        font-size: 0.85rem;
        font-weight: 500;
        margin-right: 5px;
    }

    .edit-btn {
        background: var(--accent);
        color: var(--white);
    }

    .delete-btn {
        background: #FF4757;
        color: var(--white);
    }

    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .mail-settings {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
    }

    .mail-types {
        background: var(--bg-light);
        padding: 20px;
        border-radius: 10px;
    }

    .mail-type {
        padding: 12px 15px;
        margin-bottom: 10px;
        border-radius: 8px;
        cursor: pointer;
        transition: var(--transition);
        font-weight: 500;
    }

    .mail-type:hover {
        background: var(--primary-light);
        color: var(--white);
    }

    .mail-type.active {
        background: var(--primary);
        color: var(--white);
    }

    .mail-preview {
        background: var(--bg-light);
        padding: 20px;
        border-radius: 10px;
    }

    .mail-template textarea {
        width: 100%;
        padding: 15px;
        border: 1px solid var(--gray);
        border-radius: 8px;
        font-family: 'Inter', sans-serif;
        font-size: 1rem;
        min-height: 150px;
        margin-bottom: 15px;
    }

    .template-btn {
        background: var(--primary);
        color: var(--white);
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        cursor: pointer;
        transition: var(--transition);
        font-family: 'Inter', sans-serif;
        font-weight: 600;
    }

    .template-btn:hover {
        background: var(--primary-dark);
    }

    .image-upload {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .image-preview {
        width: 150px;
        height: 150px;
        background: var(--bg-light);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-light);
        border: 2px dashed var(--gray);
    }

    .upload-controls {
        flex: 1;
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

    @media (max-width: 1024px) {
        .mail-settings {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .admin-nav {
            flex-direction: column;
            gap: 15px;
        }
        
        .services-table {
            display: block;
            overflow-x: auto;
        }
        
        .image-upload {
            flex-direction: column;
            text-align: center;
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
                    <p>JValera Dental Clinic</p>
                </div>
            </div>
            <div class="nav-actions">
                <a href="{{ route('admin.dashboard') }}" class="nav-btn secondary">
                    <i class="fas fa-arrow-left"></i> Dashboard
                </a>
                <a href="{{ route('admin.procedures') }}" class="nav-btn">
                    <i class="fas fa-file-medical"></i> Procedures
                </a>
            </div>
        </div>
    </div>
</header>

<main class="container">
    <div>
        <h1 class="page-title">Content Management</h1>
        <p class="page-subtitle">Manage services, announcements, and patient communications</p>
    </div>

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

    <!-- Announcement Section -->
    <div class="content-section">
        <h2 class="section-title">Update Announcement</h2>
        <form method="POST" action="{{ route('admin.announcement.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="image-upload">
                <div class="image-preview" id="imagePreview">
                    <span>Current Announcement</span>
                </div>
                <div class="upload-controls">
                    <p style="margin-bottom: 10px; color: var(--text-light);">Upload a new announcement image</p>
                    <input type="file" id="announcementImage" name="announcement_image" accept="image/*" style="display: none;" onchange="previewImage(this)">
                    <button type="button" class="action-btn edit-btn" onclick="document.getElementById('announcementImage').click()">
                        <i class="fas fa-upload"></i> Upload Image
                    </button>
                </div>
            </div>
            <div style="margin-top: 20px;">
                <button type="submit" class="template-btn">
                    <i class="fas fa-save"></i> Save Announcement
                </button>
            </div>
        </form>
    </div>

    <!-- Services Section -->
    <div class="content-section">
        <h2 class="section-title">Services</h2>
        <table class="services-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Icon</th>
                    <th>Service</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($services as $service)
                <tr>
                    <td>{{ $service->id }}</td>
                    <td>
                        <div class="service-icon">
                            <i class="{{ $service->icon }}"></i>
                        </div>
                        <button type="button" class="action-btn edit-btn" style="margin-top: 5px;" onclick="editService({{ $service->id }})">
                            Change
                        </button>
                    </td>
                    <td>{{ $service->name }}</td>
                    <td>₱{{ number_format($service->price, 2) }}</td>
                    <td>{{ Str::limit($service->description, 80) }}</td>
                    <td>
                        <button type="button" class="action-btn edit-btn" onclick="editService({{ $service->id }})">
                            Edit
                        </button>
                        <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn delete-btn" onclick="return confirm('Are you sure you want to delete this service?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button type="button" class="action-btn edit-btn" style="margin-top: 20px;" onclick="addNewService()">
            <i class="fas fa-plus"></i> Add New Service
        </button>
    </div>

    <!-- Email Templates Section -->
    <div class="content-section">
        <h2 class="section-title">Patient Mail Settings</h2>
        <div class="mail-settings">
            <div class="mail-types">
                @foreach($mailTypes as $type)
                <div class="mail-type {{ $loop->first ? 'active' : '' }}" data-type="{{ $type['key'] }}" onclick="loadMailTemplate('{{ $type['key'] }}')">
                    {{ $type['name'] }}
                </div>
                @endforeach
            </div>
            <div class="mail-preview">
                <h3 style="margin-bottom: 15px;">Mail Structure</h3>
                <form method="POST" action="{{ route('admin.mail-templates.update') }}" id="mailTemplateForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="template_type" id="templateType" value="{{ $mailTypes[0]['key'] }}">
                    <div class="mail-template">
                        <textarea name="template_content" id="templateContent" placeholder="Enter mail template content...">{{ $mailTemplates[$mailTypes[0]['key']] ?? '' }}</textarea>
                        <button type="submit" class="template-btn">
                            <i class="fas fa-save"></i> Save Template
                        </button>
                    </div>
                </form>
                <h3 style="margin-bottom: 15px;">Mail Preview</h3>
                <div style="background: white; padding: 20px; border-radius: 8px; border: 1px solid var(--gray);">
                    <p id="mailPreview">JValera Dental Clinic Good Day! Angel Cuadernal, you have a schedule appointment on April 15, 2025 3:00 PM with Dr. Justin Valera regarding on your Flexible Dentures treatment.</p>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Service Modal (would be implemented with dynamic content) -->
<div id="serviceModal" style="display: none;">
    <!-- Service form would go here -->
</div>

<script>
    // Image preview functionality
    function previewImage(input) {
        const preview = document.getElementById('imagePreview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `<img src="${e.target.result}" alt="Preview" style="width:100%;height:100%;object-fit:cover;border-radius:10px;">`;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Mail template functionality
    function loadMailTemplate(type) {
        // Update active state
        document.querySelectorAll('.mail-type').forEach(t => t.classList.remove('active'));
        event.target.classList.add('active');
        
        // Update form
        document.getElementById('templateType').value = type;
        
        // In a real application, you would fetch the template via AJAX
        // For now, we'll just show a loading message
        document.getElementById('templateContent').value = 'Loading template...';
        document.getElementById('mailPreview').textContent = 'Loading preview...';
        
        // Simulate API call
        setTimeout(() => {
            const templates = {
                'initial-confirmation': 'JValera Dental Clinic Good Day! %first% %last%, you have a schedule appointment on %datetime% with Dr. Justin Valera regarding on your %service% treatment.',
                'reminders': 'Reminder: Your dental appointment is scheduled for %datetime%. Please arrive 15 minutes early.',
                'cancellation': 'Your appointment scheduled for %datetime% has been cancelled as requested.',
                'rescheduling': 'Your appointment has been rescheduled to %datetime%.',
                'follow-ups': 'Follow-up: How are you feeling after your %service% treatment?'
            };
            
            document.getElementById('templateContent').value = templates[type] || '';
            updateMailPreview();
        }, 500);
    }

    function updateMailPreview() {
        const content = document.getElementById('templateContent').value;
        // Replace placeholders with sample data
        const preview = content
            .replace('%first%', 'Angel')
            .replace('%last%', 'Cuadernal')
            .replace('%datetime%', 'April 15, 2025 3:00 PM')
            .replace('%service%', 'Flexible Dentures');
        document.getElementById('mailPreview').textContent = preview;
    }

    // Service management functions
    function addNewService() {
        alert('Opening new service form...');
        // In a real application, this would open a modal with a service form
    }

    function editService(serviceId) {
        alert(`Editing service ID: ${serviceId}`);
        // In a real application, this would open a modal with the service data
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        updateMailPreview();
        
        // Update preview when template content changes
        document.getElementById('templateContent').addEventListener('input', updateMailPreview);
    });
</script>
@endsection