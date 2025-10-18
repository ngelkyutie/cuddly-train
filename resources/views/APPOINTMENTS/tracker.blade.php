@extends('layouts.app')

@section('title', 'Appointment Tracker - ToothTalk Dental Clinic')

@section('content')
<style>
    .page-hero {
        width: 100%;
        padding: 80px 0 60px;
        background: linear-gradient(135deg, var(--bg-light) 0%, #E8F6F7 100%);
        position: relative;
        overflow: hidden;
    }

    .page-hero-content {
        text-align: center;
        max-width: 800px;
        margin: 0 auto;
        position: relative;
        z-index: 2;
    }

    .page-hero-title {
        font-size: 3.2rem;
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 20px;
        color: var(--text);
        letter-spacing: -1px;
    }

    .page-hero-subtitle {
        font-size: 1.2rem;
        color: var(--text-light);
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.7;
    }

    .appointment-tracker {
        width: 100%;
        padding: 60px 0;
        background: var(--white);
    }

    .tracker-container {
        display: flex;
        gap: 40px;
        max-width: 1200px;
        margin: 0 auto;
    }

    /* Professional Appointment Overview */
    .appointment-overview {
        flex: 1;
        background: var(--white);
        border-radius: 20px;
        padding: 30px;
        box-shadow: var(--shadow);
        border: 2px solid var(--primary);
    }

    .appointment-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        padding-bottom: 20px;
        border-bottom: 2px solid var(--gray);
    }

    .appointment-title {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--primary);
    }

    .appointment-status {
        background: var(--primary-light);
        color: var(--white);
        padding: 6px 15px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
    }

    .appointment-details {
        margin-bottom: 30px;
    }

    .detail-card {
        background: var(--bg-light);
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 15px;
        border-left: 4px solid var(--primary);
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
    }

    .detail-label {
        font-weight: 600;
        color: var(--text-light);
        font-size: 0.9rem;
    }

    .detail-value {
        font-weight: 600;
        color: var(--text);
    }

    .appointment-date {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--text);
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .appointment-date i {
        color: var(--primary);
    }

    .appointment-description {
        background: var(--bg-light);
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 20px;
        border-left: 4px solid var(--primary);
    }

    .appointment-nature {
        margin-top: 20px;
    }

    .appointment-nature h3 {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--text);
        margin-bottom: 10px;
    }

    .nature-list {
        list-style-type: none;
        padding-left: 0;
    }

    .nature-list li {
        padding: 8px 0;
        display: flex;
        align-items: center;
    }

    .nature-list li:before {
        content: "•";
        color: var(--primary);
        font-weight: bold;
        margin-right: 10px;
        font-size: 1.2rem;
    }

    .calendar-section {
        flex: 2;
        display: flex;
        flex-direction: column;
        gap: 30px;
    }

    .calendar-container {
        background: var(--white);
        border-radius: 20px;
        padding: 30px;
        box-shadow: var(--shadow);
        border: 2px solid var(--primary);
    }

    .calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .calendar-title {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--text);
    }

    .calendar-nav {
        display: flex;
        gap: 10px;
    }

    .nav-btn {
        background: var(--bg-light);
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: var(--transition);
        color: var(--primary);
        font-size: 1rem;
    }

    .nav-btn:hover {
        background: var(--primary);
        color: var(--white);
    }

    .calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 8px;
        margin-top: 15px;
    }

    .calendar-day {
        text-align: center;
        padding: 15px 5px;
        font-weight: 600;
        color: var(--text-light);
        font-size: 0.9rem;
    }

    .calendar-date {
        text-align: center;
        padding: 15px 5px;
        border-radius: 12px;
        cursor: pointer;
        transition: var(--transition);
        font-weight: 500;
        position: relative;
    }

    .calendar-date:hover {
        background-color: var(--bg-light);
    }

    .current-month {
        color: var(--text);
    }

    .other-month {
        color: var(--text-light);
        opacity: 0.5;
    }

    .appointment-date-highlight {
        background-color: #E6F2FF;
        color: var(--primary-dark);
        font-weight: 700;
        border: 2px solid var(--primary-light);
    }

    .today {
        background-color: var(--primary);
        color: var(--white);
    }

    .reschedule-form-container {
        background: var(--white);
        border-radius: 20px;
        padding: 30px;
        box-shadow: var(--shadow);
        border: 2px solid var(--primary);
    }

    .reschedule-title {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--text);
        margin-bottom: 25px;
    }

    .form-group {
        margin-bottom: 25px;
    }

    label {
        display: block;
        margin-bottom: 10px;
        font-weight: 600;
        color: var(--text);
    }

    textarea, select {
        width: 100%;
        padding: 15px;
        border: 1px solid var(--gray);
        border-radius: 12px;
        font-size: 16px;
        transition: var(--transition);
        font-family: 'Inter', sans-serif;
    }

    textarea:focus, select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(10, 124, 125, 0.1);
    }

    textarea {
        min-height: 120px;
        resize: vertical;
    }

    .date-time-selector {
        display: flex;
        gap: 20px;
    }

    .date-time-selector .form-group {
        flex: 1;
    }

    .submit-btn {
        background: linear-gradient(135deg, var(--primary), var(--primary-light));
        color: var(--white);
        border: none;
        padding: 16px 30px;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        width: 100%;
        margin-top: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .submit-btn:hover {
        background: linear-gradient(135deg, var(--primary-dark), var(--primary));
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(10, 124, 125, 0.3);
    }

    @media (max-width: 1200px) {
        .tracker-container {
            flex-direction: column;
        }
    }

    @media (max-width: 992px) {
        .page-hero-title {
            font-size: 2.8rem;
        }
    }

    @media (max-width: 768px) {
        .page-hero-title {
            font-size: 2.3rem;
        }
        
        .date-time-selector {
            flex-direction: column;
            gap: 0;
        }
        
        .calendar-grid {
            gap: 5px;
        }
        
        .calendar-date, .calendar-day {
            padding: 10px 2px;
            font-size: 0.85rem;
        }
    }

    @media (max-width: 576px) {
        .page-hero-title {
            font-size: 2rem;
        }
        
        .page-hero-subtitle {
            font-size: 1.1rem;
        }
        
        .appointment-overview, .calendar-container, .reschedule-form-container {
            padding: 20px;
        }
        
        .appointment-title {
            font-size: 1.5rem;
        }
    }
</style>

<section class="page-hero">
    <div class="container">
        <div class="page-hero-content">
            <h1 class="page-hero-title">Appointment Tracker</h1>
            <p class="page-hero-subtitle">Manage your dental appointments, view your schedule, and request changes when needed.</p>
        </div>
    </div>
</section>

<section class="appointment-tracker">
    <div class="container">
        <div class="tracker-container">
            <div class="appointment-overview">
                <div class="appointment-header">
                    <h2 class="appointment-title">Appointment Overview</h2>
                    <div class="appointment-status">Confirmed</div>
                </div>
                
                <div class="appointment-details">
                    <div class="detail-card">
                        <div class="detail-row">
                            <span class="detail-label">Date & Time:</span>
                            <span class="detail-value">April 8, 2025 | 10:30 AM</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Duration:</span>
                            <span class="detail-value">45 minutes</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Dentist:</span>
                            <span class="detail-value">Dr. Maria Santos</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Room:</span>
                            <span class="detail-value">Treatment Room 3</span>
                        </div>
                    </div>
                    
                    <div class="appointment-nature">
                        <h3>Treatment Plan:</h3>
                        <ul class="nature-list">
                            <li>Flexible dentures follow-up</li>
                            <li>Oral examination</li>
                            <li>Adjustment if needed</li>
                        </ul>
                    </div>
                    
                    <div class="appointment-description">
                        <p><strong>Preparation Notes:</strong> Please arrive 15 minutes early. Bring your current dentures and any concerns you'd like to discuss with the dentist.</p>
                    </div>
                </div>
            </div>
            
            <div class="calendar-section">
                <div class="calendar-container">
                    <div class="calendar-header">
                        <h2 class="calendar-title">APRIL 2025</h2>
                        <div class="calendar-nav">
                            <button class="nav-btn" id="prevMonth"><i class="fas fa-chevron-left"></i></button>
                            <button class="nav-btn" id="nextMonth"><i class="fas fa-chevron-right"></i></button>
                        </div>
                    </div>
                    
                    <div class="calendar-grid" id="calendarGrid">
                        <!-- Calendar will be populated by JavaScript -->
                    </div>
                </div>
                
                <div class="reschedule-form-container">
                    <h2 class="reschedule-title">Request Reschedule</h2>
                    <form id="rescheduleForm" method="POST" action="{{ route('appointments.reschedule') }}">
                        @csrf
                        <input type="hidden" name="appointment_id" value="1">
                        <div class="form-group">
                            <label for="reason">Reason for Rescheduling:</label>
                            <textarea id="reason" name="reason" placeholder="Please provide a reason for rescheduling..."></textarea>
                            @error('reason')
                                <span style="color: #FF4757; font-size: 0.9rem;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="date-time-selector">
                            <div class="form-group">
                                <label for="date">Preferred Date:</label>
                                <select id="date" name="preferred_date">
                                    <option value="">Select a date</option>
                                    <option value="2025-04-10">April 10, 2025</option>
                                    <option value="2025-04-11">April 11, 2025</option>
                                    <option value="2025-04-12">April 12, 2025</option>
                                    <option value="2025-04-15">April 15, 2025</option>
                                    <option value="2025-04-16">April 16, 2025</option>
                                </select>
                                @error('preferred_date')
                                    <span style="color: #FF4757; font-size: 0.9rem;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="time">Preferred Time:</label>
                                <select id="time" name="preferred_time">
                                    <option value="">Select a time</option>
                                    <option value="09:00">9:00 AM</option>
                                    <option value="10:00">10:00 AM</option>
                                    <option value="11:00">11:00 AM</option>
                                    <option value="14:00">2:00 PM</option>
                                    <option value="15:00">3:00 PM</option>
                                    <option value="16:00">4:00 PM</option>
                                </select>
                                @error('preferred_time')
                                    <span style="color: #FF4757; font-size: 0.9rem;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="submit-btn">
                            <i class="fas fa-paper-plane"></i> Submit Request
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Calendar functionality
        let currentDate = new Date(2025, 3, 1); // April 2025
        
        function generateCalendar(date) {
            const calendarGrid = document.getElementById('calendarGrid');
            calendarGrid.innerHTML = '';
            
            // Add day headers
            const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
            days.forEach(day => {
                const dayElement = document.createElement('div');
                dayElement.className = 'calendar-day';
                dayElement.textContent = day;
                calendarGrid.appendChild(dayElement);
            });
            
            const year = date.getFullYear();
            const month = date.getMonth();
            
            // Get first day of month and last date of month
            const firstDay = new Date(year, month, 1);
            const lastDate = new Date(year, month + 1, 0);
            
            // Get last date of previous month
            const prevLastDate = new Date(year, month, 0);
            
            // Fill in previous month's dates
            for (let i = firstDay.getDay(); i > 0; i--) {
                const dateElement = document.createElement('div');
                dateElement.className = 'calendar-date other-month';
                dateElement.textContent = prevLastDate.getDate() - i + 1;
                calendarGrid.appendChild(dateElement);
            }
            
            // Fill in current month's dates
            const today = new Date();
            const appointmentDate = 8; // April 8, 2025
            
            for (let i = 1; i <= lastDate.getDate(); i++) {
                const dateElement = document.createElement('div');
                dateElement.className = 'calendar-date current-month';
                dateElement.textContent = i;
                
                // Highlight today
                if (i === today.getDate() && month === today.getMonth() && year === today.getFullYear()) {
                    dateElement.classList.add('today');
                }
                
                // Highlight appointment date
                if (i === appointmentDate) {
                    dateElement.classList.add('appointment-date-highlight');
                }
                
                dateElement.addEventListener('click', function() {
                    document.querySelectorAll('.calendar-date').forEach(d => d.classList.remove('today'));
                    this.classList.add('today');
                    
                    if (this.classList.contains('appointment-date-highlight')) {
                        document.getElementById('reason').value = "I would like to reschedule my flexible dentures appointment.";
                    }
                });
                
                calendarGrid.appendChild(dateElement);
            }
            
            // Fill in next month's dates
            const totalCells = 42; // 6 rows * 7 days
            const remainingCells = totalCells - (firstDay.getDay() + lastDate.getDate());
            
            for (let i = 1; i <= remainingCells; i++) {
                const dateElement = document.createElement('div');
                dateElement.className = 'calendar-date other-month';
                dateElement.textContent = i;
                calendarGrid.appendChild(dateElement);
            }
            
            // Update calendar title
            document.querySelector('.calendar-title').textContent = 
                date.toLocaleString('default', { month: 'long' }).toUpperCase() + ' ' + year;
        }
        
        // Initialize calendar
        generateCalendar(currentDate);
        
        // Calendar navigation
        document.getElementById('prevMonth').addEventListener('click', function() {
            currentDate.setMonth(currentDate.getMonth() - 1);
            generateCalendar(currentDate);
        });
        
        document.getElementById('nextMonth').addEventListener('click', function() {
            currentDate.setMonth(currentDate.getMonth() + 1);
            generateCalendar(currentDate);
        });
        
        // Form submission
        const rescheduleForm = document.getElementById('rescheduleForm');
        rescheduleForm.addEventListener('submit', function(e) {
            const reason = document.getElementById('reason').value;
            const date = document.getElementById('date').value;
            const time = document.getElementById('time').value;
            
            if (!reason || !date || !time) {
                e.preventDefault();
                alert('Please fill in all fields before submitting.');
                return;
            }
            
            // In a real application, this would be handled by Laravel
            // For now, we'll just show a success message
            e.preventDefault();
            alert('Reschedule request submitted successfully! Our team will contact you to confirm the new appointment.');
        });
        
        // Auto-fill reason when clicking on appointment date
        document.querySelectorAll('.appointment-date-highlight').forEach(date => {
            date.addEventListener('click', function() {
                document.getElementById('reason').value = "I would like to reschedule my flexible dentures appointment.";
            });
        });
    });
</script>
@endsection