@extends('layouts.app')

@section('title', 'Create Post-Procedure Form - ToothTalk Dental Clinic')

@section('content')
<style>
    /* Add all the CSS styles from your original HTML here */
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

    .form-container {
        display: grid;
        grid-template-columns: 250px 1fr;
        gap: 30px;
    }

    .form-sidebar {
        background: var(--white);
        border-radius: 15px;
        padding: 25px;
        box-shadow: var(--shadow);
        height: fit-content;
    }

    .sidebar-title {
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 20px;
        color: var(--text);
    }

    .form-list {
        list-style: none;
    }

    .form-item {
        padding: 12px 15px;
        margin-bottom: 10px;
        border-radius: 8px;
        cursor: pointer;
        transition: var(--transition);
        font-weight: 500;
    }

    .form-item:hover {
        background: var(--primary-light);
        color: var(--white);
    }

    .form-item.active {
        background: var(--primary);
        color: var(--white);
    }

    .form-content {
        background: var(--white);
        border-radius: 15px;
        padding: 30px;
        box-shadow: var(--shadow);
    }

    .form-section {
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

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
    }

    .form-group input, .form-group textarea, .form-group select {
        width: 100%;
        padding: 12px;
        border: 1px solid var(--gray);
        border-radius: 8px;
        font-family: 'Inter', sans-serif;
        font-size: 1rem;
    }

    .form-group textarea {
        min-height: 100px;
        resize: vertical;
    }

    .checkbox-group {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 10px;
    }

    .checkbox-group input {
        width: auto;
    }

    .yes-no-group {
        display: flex;
        gap: 20px;
        margin-bottom: 15px;
    }

    .yes-no-option {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .submit-section {
        background: var(--bg-light);
        padding: 20px;
        border-radius: 10px;
        margin-top: 30px;
    }

    .submit-btn {
        background: var(--primary);
        color: var(--white);
        border: none;
        padding: 15px 30px;
        border-radius: 8px;
        cursor: pointer;
        transition: var(--transition);
        font-family: 'Inter', sans-serif;
        font-weight: 600;
        font-size: 1rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .submit-btn:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
    }

    @media (max-width: 1024px) {
        .form-container {
            grid-template-columns: 1fr;
        }
        
        .form-sidebar {
            order: 2;
        }
        
        .form-content {
            order: 1;
        }
    }

    @media (max-width: 768px) {
        .container {
            padding: 0 20px;
        }
        
        .admin-nav {
            flex-direction: column;
            gap: 15px;
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
                <a href="{{ route('admin.post-procedure.index') }}" class="nav-btn secondary">
                    <i class="fas fa-arrow-left"></i> Back to Forms
                </a>
                <a href="{{ url('/admin/dashboard') }}" class="nav-btn">
                    <i class="fas fa-home"></i> Dashboard
                </a>
            </div>
        </div>
    </div>
</header>

<main class="container">
    <div>
        <h1 class="page-title">Create Post-Procedure Form</h1>
        <p class="page-subtitle">Add new patient post-procedure information</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.post-procedure.store') }}" method="POST">
        @csrf
        <div class="form-container">
            <div class="form-sidebar">
                <h2 class="sidebar-title">Form List</h2>
                <ul class="form-list">
                    <li class="form-item">Patient Record</li>
                    <li class="form-item">Patient History</li>
                    <li class="form-item active">Progress Notes</li>
                </ul>
            </div>

            <div class="form-content">
                <div class="form-section">
                    <h2 class="section-title">DENTAL HISTORY</h2>
                    <div class="form-group">
                        <label for="previous_dentist">Previous Dentist</label>
                        <input type="text" id="previous_dentist" name="previous_dentist" value="{{ old('previous_dentist') }}">
                    </div>
                    <div class="form-group">
                        <label for="last_dental_visit">Last dental visit</label>
                        <input type="date" id="last_dental_visit" name="last_dental_visit" value="{{ old('last_dental_visit') }}">
                    </div>
                    <div class="form-group">
                        <label for="treatment_done">Treatment done</label>
                        <textarea id="treatment_done" name="treatment_done">{{ old('treatment_done') }}</textarea>
                    </div>
                </div>

                <div class="form-section">
                    <h2 class="section-title">MEDICAL HISTORY</h2>
                    <div class="form-group">
                        <label for="physician_name">Name of Physician</label>
                        <input type="text" id="physician_name" name="physician_name" value="{{ old('physician_name') }}">
                    </div>
                    <div class="form-group">
                        <label for="specialty">Specialty</label>
                        <input type="text" id="specialty" name="specialty" value="{{ old('specialty') }}">
                    </div>
                    <div class="form-group">
                        <label for="office_address">Office address</label>
                        <input type="text" id="office_address" name="office_address" value="{{ old('office_address') }}">
                    </div>
                    <div class="form-group">
                        <label for="contact_no">Contact No.</label>
                        <input type="text" id="contact_no" name="contact_no" value="{{ old('contact_no') }}">
                    </div>

                    <div class="form-group">
                        <label>1. Are you in good health?</label>
                        <div class="yes-no-group">
                            <div class="yes-no-option">
                                <input type="radio" id="good_health_yes" name="good_health" value="1" {{ old('good_health') == '1' ? 'checked' : '' }}>
                                <label for="good_health_yes">YES</label>
                            </div>
                            <div class="yes-no-option">
                                <input type="radio" id="good_health_no" name="good_health" value="0" {{ old('good_health') == '0' ? 'checked' : '' }}>
                                <label for="good_health_no">NO</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>2. Are you under any medical treatment now?</label>
                        <div class="yes-no-group">
                            <div class="yes-no-option">
                                <input type="radio" id="under_treatment_yes" name="under_treatment" value="1" {{ old('under_treatment') == '1' ? 'checked' : '' }}>
                                <label for="under_treatment_yes">YES</label>
                            </div>
                            <div class="yes-no-option">
                                <input type="radio" id="under_treatment_no" name="under_treatment" value="0" {{ old('under_treatment') == '0' ? 'checked' : '' }}>
                                <label for="under_treatment_no">NO</label>
                            </div>
                        </div>
                        <label for="treatment_condition">If yes, what condition is being treated?</label>
                        <input type="text" id="treatment_condition" name="treatment_condition" value="{{ old('treatment_condition') }}">
                    </div>

                    <div class="form-group">
                        <label>9. Are you allergic to any of the following?</label>
                        <div class="checkbox-group">
                            <input type="checkbox" id="allergy_anesthesia" name="allergy_anesthesia" value="1" {{ old('allergy_anesthesia') ? 'checked' : '' }}>
                            <label for="allergy_anesthesia">Local Anesthesia (e.g., Lidocaine)</label>
                        </div>
                        <div class="checkbox-group">
                            <input type="checkbox" id="allergy_antibiotics" name="allergy_antibiotics" value="1" {{ old('allergy_antibiotics') ? 'checked' : '' }}>
                            <label for="allergy_antibiotics">Antibiotics (e.g., Amoxicillin)</label>
                        </div>
                        <div class="checkbox-group">
                            <input type="checkbox" id="allergy_analgesics" name="allergy_analgesics" value="1" {{ old('allergy_analgesics') ? 'checked' : '' }}>
                            <label for="allergy_analgesics">Analgesics (e.g., Mefenamic Acid)</label>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h2 class="section-title">Other Notes</h2>
                    <div class="form-group">
                        <textarea name="other_notes" placeholder="Add any additional notes here...">{{ old('other_notes') }}</textarea>
                    </div>
                </div>

                <div class="submit-section">
                    <div class="form-group">
                        <label for="patient_name">Sent to:</label>
                        <input type="text" id="patient_name" name="patient_name" placeholder="Patient Name*" value="{{ old('patient_name') }}" required>
                    </div>
                    <button type="submit" class="submit-btn">
                        <i class="fas fa-paper-plane"></i> CREATE FORM
                    </button>
                </div>
            </div>
        </div>
    </form>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Form navigation
        document.querySelectorAll('.form-item').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.form-item').forEach(i => {
                    i.classList.remove('active');
                });
                this.classList.add('active');
            });
        });

        // Show/hide treatment condition based on radio selection
        const treatmentRadios = document.querySelectorAll('input[name="under_treatment"]');
        const treatmentCondition = document.getElementById('treatment_condition');
        
        function updateTreatmentConditionVisibility() {
            const underTreatmentYes = document.getElementById('under_treatment_yes').checked;
            treatmentCondition.disabled = !underTreatmentYes;
            if (!underTreatmentYes) {
                treatmentCondition.value = '';
            }
        }
        
        treatmentRadios.forEach(radio => {
            radio.addEventListener('change', updateTreatmentConditionVisibility);
        });
        
        updateTreatmentConditionVisibility();
    });
</script>
@endsection