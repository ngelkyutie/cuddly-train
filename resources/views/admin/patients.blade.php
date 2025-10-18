@extends('layouts.app')

@section('title', 'Patient Records - ToothTalk Dental Clinic')

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

    .tabs {
        display: flex;
        gap: 10px;
        margin-bottom: 30px;
        border-bottom: 1px solid var(--gray);
        padding-bottom: 10px;
    }

    .tab {
        padding: 12px 24px;
        background: var(--bg-light);
        border: none;
        border-radius: 8px 8px 0 0;
        cursor: pointer;
        transition: var(--transition);
        font-family: 'Inter', sans-serif;
        font-weight: 500;
    }

    .tab.active {
        background: var(--primary);
        color: var(--white);
    }

    .tab:hover:not(.active) {
        background: var(--primary-light);
        color: var(--white);
    }

    .records-table {
        background: var(--white);
        border-radius: 15px;
        overflow: hidden;
        box-shadow: var(--shadow);
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        background: var(--primary);
        color: var(--white);
        padding: 15px;
        text-align: left;
        font-weight: 600;
    }

    td {
        padding: 15px;
        border-bottom: 1px solid var(--gray);
    }

    tr:last-child td {
        border-bottom: none;
    }

    tr:hover {
        background: var(--bg-light);
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

    .view-btn {
        background: var(--primary-light);
        color: var(--white);
    }

    .edit-btn {
        background: var(--accent);
        color: var(--white);
    }

    .update-btn {
        background: var(--primary);
        color: var(--white);
    }

    .clear-btn {
        background: #FF6B6B;
        color: var(--white);
    }

    .remove-btn {
        background: #FF4757;
        color: var(--white);
    }

    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .alert {
        padding: 12px 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 14px;
        font-weight: 500;
    }

    .alert-success {
        background: rgba(46, 204, 113, 0.1);
        color: #2ECC71;
        border-left: 4px solid #2ECC71;
    }

    .alert-error {
        background: rgba(231, 76, 60, 0.1);
        color: #E74C3C;
        border-left: 4px solid #E74C3C;
    }

    .search-bar {
        margin-bottom: 20px;
        display: flex;
        gap: 10px;
    }

    .search-input {
        flex: 1;
        padding: 12px 15px;
        border: 1px solid var(--gray);
        border-radius: 8px;
        font-size: 14px;
    }

    .search-btn {
        background: var(--primary);
        color: var(--white);
        border: none;
        padding: 12px 20px;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 500;
    }

    @media (max-width: 768px) {
        .admin-nav {
            flex-direction: column;
            gap: 15px;
        }
        
        .tabs {
            flex-wrap: wrap;
        }
        
        table {
            display: block;
            overflow-x: auto;
        }
        
        .search-bar {
            flex-direction: column;
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
                <a href="{{ route('admin.schedule') }}" class="nav-btn">
                    <i class="fas fa-calendar-alt"></i> Schedule
                </a>
            </div>
        </div>
    </div>
</header>

<main class="container">
    <div>
        <h1 class="page-title">Patient Records</h1>
        <p class="page-subtitle">Manage patient information and treatment records</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i>
            @foreach($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif

    <div class="search-bar">
        <input type="text" class="search-input" placeholder="Search patients by name, ID, or treatment..." id="searchInput">
        <button class="search-btn" onclick="searchPatients()">
            <i class="fas fa-search"></i> Search
        </button>
    </div>

    <div class="tabs">
        <button class="tab active" data-tab="patient-record">Patient Record</button>
        <button class="tab" data-tab="patient-history">Patient History</button>
        <button class="tab" data-tab="progress-notes">Progress Notes</button>
    </div>

    <div class="records-table">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Patient Number</th>
                    <th>Patient Name</th>
                    <th>Treatment</th>
                    <th>Patient Information Record</th>
                    <th>Patient History</th>
                    <th>Progress Notes</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="patientsTable">
                @foreach($patients as $patient)
                <tr data-patient-id="{{ $patient->id }}">
                    <td>{{ $patient->id }}</td>
                    <td>{{ $patient->patient_number }}</td>
                    <td>{{ $patient->name }}</td>
                    <td>{{ $patient->treatment }}</td>
                    <td>
                        <button class="action-btn view-btn" onclick="viewRecord('info', {{ $patient->id }})">
                            <i class="fas fa-eye"></i> View
                        </button>
                        <button class="action-btn edit-btn" onclick="editRecord('info', {{ $patient->id }})">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                    </td>
                    <td>
                        <button class="action-btn view-btn" onclick="viewRecord('history', {{ $patient->id }})">
                            <i class="fas fa-eye"></i> View
                        </button>
                        <button class="action-btn edit-btn" onclick="editRecord('history', {{ $patient->id }})">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                    </td>
                    <td>
                        <button class="action-btn view-btn" onclick="viewRecord('progress', {{ $patient->id }})">
                            <i class="fas fa-eye"></i> View
                        </button>
                        <button class="action-btn update-btn" onclick="updateProgress({{ $patient->id }})">
                            <i class="fas fa-plus"></i> Update
                        </button>
                    </td>
                    <td>
                        <form action="{{ route('admin.patients.clear', $patient->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn clear-btn" onclick="return confirm('Are you sure you want to clear all files for {{ $patient->name }}?')">
                                <i class="fas fa-trash"></i> Clear All Files
                            </button>
                        </form>
                        <form action="{{ route('admin.patients.destroy', $patient->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn remove-btn" onclick="return confirm('Are you sure you want to remove {{ $patient->name }} from the system?')">
                                <i class="fas fa-times"></i> Remove
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>

<script>
    // Tab functionality
    document.querySelectorAll('.tab').forEach(tab => {
        tab.addEventListener('click', function() {
            // Remove active class from all tabs
            document.querySelectorAll('.tab').forEach(t => {
                t.classList.remove('active');
            });
            // Add active class to clicked tab
            this.classList.add('active');
            
            const tabType = this.getAttribute('data-tab');
            filterTableByTab(tabType);
        });
    });

    function filterTableByTab(tabType) {
        // In a real application, this would filter the table content
        // For now, we'll just show a message
        console.log(`Filtering by tab: ${tabType}`);
    }

    function viewRecord(type, patientId) {
        // In a real application, this would open a modal or redirect to view page
        const patientName = document.querySelector(`tr[data-patient-id="${patientId}"] td:nth-child(3)`).textContent;
        alert(`Viewing ${type} record for ${patientName}`);
        // window.location.href = `/admin/patients/${patientId}/${type}/view`;
    }

    function editRecord(type, patientId) {
        // In a real application, this would open an edit form
        const patientName = document.querySelector(`tr[data-patient-id="${patientId}"] td:nth-child(3)`).textContent;
        alert(`Opening ${type} edit form for ${patientName}`);
        // window.location.href = `/admin/patients/${patientId}/${type}/edit`;
    }

    function updateProgress(patientId) {
        // In a real application, this would open a progress notes update form
        const patientName = document.querySelector(`tr[data-patient-id="${patientId}"] td:nth-child(3)`).textContent;
        alert(`Updating progress notes for ${patientName}`);
        // window.location.href = `/admin/patients/${patientId}/progress/update`;
    }

    function searchPatients() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const rows = document.querySelectorAll('#patientsTable tr');
        
        rows.forEach(row => {
            const patientName = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
            const patientNumber = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            const treatment = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
            
            if (patientName.includes(searchTerm) || patientNumber.includes(searchTerm) || treatment.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Auto-hide alerts after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.style.display = 'none';
            }, 5000);
        });

        // Enable search on Enter key
        document.getElementById('searchInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                searchPatients();
            }
        });
    });
</script>
@endsection