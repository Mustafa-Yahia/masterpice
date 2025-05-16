@extends('layouts.designer')

@section('title', 'لوحة تحكم المصمم')

@section('content')
<div class="designer-dashboard">
    <!-- Header Section -->
    <div class="dashboard-header text-center mb-5" >
        <h1 class="display-4 text-gradient">مرحباً بك، {{ Auth::user()->name }}</h1>
        {{-- <p class="lead text-muted">إليك أهم المهام القادمة</p> --}}
    </div>

    {{-- <!-- Upcoming Tasks Section -->
    <div class="upcoming-tasks">
        <div class="task-card">
            <div class="task-icon">
                <i class="fas fa-handshake"></i>
            </div>
            <div class="task-details">
                <h3>اجتماع مع عميل جديد</h3>
                <div class="task-time">
                    <i class="far fa-clock"></i>
                    <span>غداً 10 ص</span>
                </div>
            </div>
        </div>

        <div class="task-card">
            <div class="task-icon">
                <i class="fas fa-file-export"></i>
            </div>
            <div class="task-details">
                <h3>تسليم النسخة الأولى من التصميم</h3>
                <div class="task-time">
                    <i class="far fa-clock"></i>
                    <span>بعد غد</span>
                </div>
            </div>
        </div>

        <div class="task-card">
            <div class="task-icon">
                <i class="fas fa-folder-open"></i>
            </div>
            <div class="task-details">
                <h3>تحديث ملف المحفظة</h3>
                <div class="task-time">
                    <i class="far fa-clock"></i>
                    <span>هذا الأسبوع</span>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Empty State Illustration -->
    {{-- <div class="empty-state text-center mt-5"> --}}
        {{-- <img src="{{ asset('images/designer-dashboard.svg') }}" alt="Designer Dashboard" class="img-fluid" style="max-width: 400px;">
        <h4 class="mt-3">لا توجد مهام أخرى حالياً</h4>
        <p class="text-muted">استمتع بيومك الإبداعي!</p> --}}
    {{-- </div> --}}
</div>

<style>
    .designer-dashboard {
        padding: 2rem;
        max-width: 800px;
        margin: 0 auto;
    }

    .text-gradient {
        background: linear-gradient(45deg, #6C5CE7, #00CEFF);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .upcoming-tasks {
        margin-top: 3rem;
    }

    .task-card {
        display: flex;
        align-items: center;
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        transition: transform 0.3s ease;
    }

    .task-card:hover {
        transform: translateY(-5px);
    }

    .task-icon {
        width: 60px;
        height: 60px;
        background: rgba(108, 92, 231, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-left: 1.5rem;
    }

    .task-icon i {
        font-size: 1.5rem;
        color: #6C5CE7;
    }

    .task-details {
        flex: 1;
    }

    .task-details h3 {
        margin-bottom: 0.5rem;
        color: #2d3436;
    }

    .task-time {
        display: flex;
        align-items: center;
        color: #636e72;
    }

    .task-time i {
        margin-left: 0.5rem;
    }

    .empty-state {
        opacity: 0.7;
        margin-top: 4rem;
    }
</style>
@endsection
