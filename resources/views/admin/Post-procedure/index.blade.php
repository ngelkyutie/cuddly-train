@extends('layouts.app')

@section('title', 'Post-Procedure Forms - ToothTalk Dental Clinic')

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

    /* Table Styles */
    .table-container {
        background: var(--white);
        border-radius: 15px;
        padding: 30px;
        box-shadow: var(--shadow);
        margin-bottom: 30px;
    }

    .table-header {
        display: flex;
        justify-content: between;
        align-items: center;
        margin-bottom: 25px;
    }

    .table-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text);
    }

    .action-buttons {
        display: flex;
        gap: 10px;
    }

    .btn {
        padding: 8px 16px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 500;
        font-size: 14px;
        transition: var(--transition);
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .btn-primary {
        background: var(--primary);
        color: var(--white);
    }

    .btn-primary:hover {
        background: var(--primary-dark);
    }

    .btn-secondary {
        background: var(--primary-light);
        color: var(--white);
    }

    .btn-danger {
        background: #dc3545;
        color: var(--white);
    }

    .btn-danger:hover {
        background: #c82333;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid var(--gray);
    }

    th {
        background: var(--bg-light);
        font-weight: 600;
        color: var(--text);
    }

    tr:hover {
        background: var(--bg-light);
    }

    .no-forms {
        text-align: center;
        padding: 40px;
        color: var(--text-light);
    }

    @media (max-width: 768px) {
        .table-header {
            flex-direction: column;
            gap: 15px;
            align-items: flex-start;
        }
        
        .action-buttons {
            width: 100%;
            justify-content: flex-start;
        }
        
        table {
            display: block;
            overflow-x: auto;
        }
    }
</style>

<header class="admin-header">
    <div class="container">
        <div class="admin-nav">
            <div class="logo">
                <div class="logo-img">TT</div>
                <div class="logo-text">
                    <h1>ToothTalk</h1>
                    <p>JValera Dental Clinic</p>
                </div>
            </div>
            <div class="nav-actions">
                <a href="{{ url('/admin/dashboard') }}" class="nav-btn secondary">
                    <i class="fas fa-arrow-left"></i> Dashboard
                </a>
                <a href="{{ route('admin.post-procedure.create') }}" class="nav-btn">
                    <i class="fas fa-plus"></i> New Form
                </a>
            </div>
        </div>
    </div>
</header>

<main class="container">
    <div>
        <h1 class="page-title">Post-Procedure Forms</h1>
        <p class="page-subtitle">Manage patient post-procedure forms and progress notes</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div class="table-container">
        <div class="table-header">
            <h2 class="table-title">All Forms</h2>
            <div class="action-buttons">
                <a href="{{ route('admin.post-procedure.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Create New
                </a>
            </div>
        </div>

        @if($forms->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Patient Name</th>
                        <th>Last Dental Visit</th>
                        <th>Physician</th>
                        <th>Health Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($forms as $form)
                    <tr>
                        <td>{{ $form->patient_name }}</td>
                        <td>{{ $form->last_dental_visit ? $form->last_dental_visit->format('M d, Y') : 'N/A' }}</td>
                        <td>{{ $form->physician_name ?? 'N/A' }}</td>
                        <td>
                            @if($form->good_health)
                                <span style="color: green;"><i class="fas fa-check-circle"></i> Good</span>
                            @else
                                <span style="color: orange;"><i class="fas fa-exclamation-circle"></i> Needs Attention</span>
                            @endif
                        </td>
                        <td>{{ $form->created_at->format('M d, Y') }}</td>
                        <td>
                            <div style="display: flex; gap: 8px;">
                                <a href="{{ route('admin.post-procedure.show', $form->id) }}" class="btn btn-secondary">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.post-procedure.edit', $form->id) }}" class="btn btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.post-procedure.destroy', $form->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this form?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="no-forms">
                <i class="fas fa-file-medical" style="font-size: 3rem; margin-bottom: 15px; color: var(--primary-light);"></i>
                <h3>No Post-Procedure Forms Found</h3>
                <p>Create your first post-procedure form to get started.</p>
                <a href="{{ route('admin.post-procedure.create') }}" class="btn btn-primary" style="margin-top: 15px;">
                    <i class="fas fa-plus"></i> Create First Form
                </a>
            </div>
        @endif
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    });
</script>
@endsection