@extends('layouts.app')

@section('title', 'Patient Records - ToothTalk Dental Clinic')

@section('content')
<style>
    .main-content {
        padding: 40px 0;
    }

    .page-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .page-title {
        font-size: 32px;
        font-weight: 700;
        color: var(--text);
        margin-bottom: 10px;
    }

    .page-subtitle {
        font-size: 16px;
        color: var(--text-light);
    }

    .records-section {
        background: var(--white);
        border-radius: 15px;
        box-shadow: var(--shadow);
        padding: 30px;
        margin-bottom: 40px;
    }

    .section-title {
        font-size: 24px;
        font-weight: 700;
        color: var(--text);
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .records-table {
        width: 100%;
        border-collapse: collapse;
    }

    .records-table th {
        text-align: left;
        padding: 15px;
        font-weight: 600;
        color: var(--text);
        border-bottom: 2px solid var(--gray);
        font-size: 14px;
    }

    .records-table td {
        padding: 15px;
        border-bottom: 1px solid var(--gray);
        font-size: 14px;
    }

    .records-table tr:last-child td {
        border-bottom: none;
    }

    .records-table tr:hover {
        background: rgba(10, 124, 125, 0.05);
    }

    .action-buttons {
        display: flex;
        gap: 10px;
    }

    .btn {
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        transition: var(--transition);
        border: none;
        text-decoration: none;
    }

    .btn-view {
        background: rgba(10, 124, 125, 0.1);
        color: var(--primary);
    }

    .btn-view:hover {
        background: rgba(10, 124, 125, 0.2);
    }

    .btn-download {
        background: rgba(46, 204, 113, 0.1);
        color: #2ECC71;
    }

    .btn-download:hover {
        background: rgba(46, 204, 113, 0.2);
    }

    .forms-section {
        background: var(--white);
        border-radius: 15px;
        box-shadow: var(--shadow);
        padding: 30px;
        margin-bottom: 40px;
    }

    .form-title {
        font-size: 20px;
        font-weight: 700;
        color: var(--text);
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid var(--gray);
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: var(--text);
        font-size: 14px;
    }

    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid var(--gray);
        border-radius: 10px;
        font-size: 14px;
        transition: var(--transition);
        background: var(--white);
    }

    .form-control:focus {
        border-color: var(--primary);
        outline: none;
        box-shadow: 0 0 0 3px rgba(10, 124, 125, 0.15);
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .checkbox-group {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 15px;
        margin-top: 10px;
    }

    .checkbox-item {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .checkbox-item input {
        width: 18px;
        height: 18px;
    }

    .form-section {
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid var(--gray);
    }

    .form-section:last-child {
        border-bottom: none;
    }

    .section-label {
        font-size: 16px;
        font-weight: 600;
        color: var(--primary);
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-primary {
        background: var(--primary);
        color: var(--white);
        padding: 12px 24px;
        font-size: 16px;
        font-weight: 600;
    }

    .btn-primary:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(10, 124, 125, 0.25);
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

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }
        
        .checkbox-group {
            grid-template-columns: 1fr;
        }
        
        .action-buttons {
            flex-direction: column;
        }
    }

    @media (max-width: 480px) {
        .page-title {
            font-size: 28px;
        }
        
        .records-table {
            display: block;
            overflow-x: auto;
        }
    }
</style>

<div class="main-content">
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">Patient Records Portal</h1>
            <p class="page-subtitle">Access and manage your dental health records and medical forms</p>
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

        <div class="records-section">
            <h2 class="section-title">
                <i class="fas fa-file-medical"></i>
                PATIENT RECORDS
            </h2>
            
            <table class="records-table">
                <thead>
                    <tr>
                        <th>FORM</th>
                        <th>DATE</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($records as $record)
                    <tr>
                        <td>{{ $record->form_name }}</td>
                        <td>{{ $record->date->format('m/d/Y') }}</td>
                        <td class="action-buttons">
                            <button class="btn btn-view" onclick="viewRecord({{ $record->id }})">
                                <i class="fas fa-eye"></i> VIEW
                            </button>
                            <button class="btn btn-download" onclick="downloadRecord({{ $record->id }})">
                                <i class="fas fa-download"></i> DOWNLOAD
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="forms-section">
            <h2 class="form-title">Dental Medical Clearance Form</h2>
            
            <form id="medical-clearance-form" method="POST" action="{{ route('patient.medical-clearance.store') }}">
                @csrf
                
                <div class="form-section">
                    <h3 class="section-label">
                        <i class="fas fa-user"></i>
                        Patient Information
                    </h3>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="patient-name">Name</label>
                            <input type="text" id="patient-name" name="patient_name" class="form-control" value="{{ $patient->name ?? '' }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="patient-grade">Grade</label>
                            <input type="text" id="patient-grade" name="patient_grade" class="form-control" placeholder="Enter grade" value="{{ old('patient_grade') }}">
                            @error('patient_grade')
                                <span style="color: #E74C3C; font-size: 12px; margin-top: 5px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="patient-dob">Date of birth</label>
                            <input type="date" id="patient-dob" name="patient_dob" class="form-control" value="{{ $patient->birthdate ?? old('patient_dob') }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="patient-contact">Contact number</label>
                            <input type="tel" id="patient-contact" name="patient_contact" class="form-control" value="{{ $patient->phone ?? old('patient_contact') }}" readonly>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="patient-address">Address</label>
                        <input type="text" id="patient-address" name="patient_address" class="form-control" value="{{ $patient->address ?? old('patient_address') }}" readonly>
                    </div>
                </div>
                
                <div class="form-section">
                    <h3 class="section-label">
                        <i class="fas fa-file-medical-alt"></i>
                        Reason for Medical Clearance
                    </h3>
                    
                    <div class="form-group">
                        <label>Medical Conditions (Check all that apply)</label>
                        <div class="checkbox-group">
                            @foreach($medicalConditions as $condition)
                            <div class="checkbox-item">
                                <input type="checkbox" id="{{ $condition['id'] }}" name="medical_conditions[]" value="{{ $condition['id'] }}" {{ in_array($condition['id'], old('medical_conditions', [])) ? 'checked' : '' }}>
                                <label for="{{ $condition['id'] }}">{{ $condition['name'] }}</label>
                            </div>
                            @endforeach
                        </div>
                        @error('medical_conditions')
                            <span style="color: #E74C3C; font-size: 12px; margin-top: 5px;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-section">
                    <h3 class="section-label">
                        <i class="fas fa-history"></i>
                        Medical History
                    </h3>
                    
                    <div class="form-group">
                        <label for="medical-conditions">Medical conditions</label>
                        <textarea id="medical-conditions" name="medical_conditions_desc" class="form-control" rows="3" placeholder="Describe any medical conditions">{{ old('medical_conditions_desc') }}</textarea>
                        @error('medical_conditions_desc')
                            <span style="color: #E74C3C; font-size: 12px; margin-top: 5px;">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label>Medical History (Check all that apply)</label>
                        <div class="checkbox-group">
                            @foreach($medicalHistory as $history)
                            <div class="checkbox-item">
                                <input type="checkbox" id="{{ $history['id'] }}" name="medical_history[]" value="{{ $history['id'] }}" {{ in_array($history['id'], old('medical_history', [])) ? 'checked' : '' }}>
                                <label for="{{ $history['id'] }}">{{ $history['name'] }}</label>
                            </div>
                            @endforeach
                        </div>
                        @error('medical_history')
                            <span style="color: #E74C3C; font-size: 12px; margin-top: 5px;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Save Medical Clearance Form
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function viewRecord(recordId) {
        // In a real application, this would open a modal or redirect to view page
        alert(`Opening record ID: ${recordId}`);
        // window.location.href = `/patient/records/${recordId}/view`;
    }

    function downloadRecord(recordId) {
        // In a real application, this would trigger a file download
        alert(`Downloading record ID: ${recordId}`);
        // window.location.href = `/patient/records/${recordId}/download`;
    }

    // Auto-hide alerts after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.style.display = 'none';
            }, 5000);
        });
    });
</script>
@endsection