@extends('layouts.admin')

@section('content')
<div class="admin-container">
    @include('admin.sidebar')

    <div class="admin-content">
        <!-- Header Section -->
        <div class="content-header">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="page-title">
                    <i class="fas fa-user-circle"></i> تفاصيل المستخدم
                </h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">المستخدمين</a></li>
                        <li class="breadcrumb-item active" aria-current="page">تفاصيل</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- User Profile Section -->
        <div class="row">
            <!-- User Info Card -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <div class="avatar-xxl mb-4 mx-auto">
                            <div class="avatar-img rounded-circle bg-light">
                                <span class="text-primary display-4">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                            </div>
                        </div>

                        <h3 class="mb-3">{{ $user->name }}</h3>

                        <div class="d-flex justify-content-center gap-2 mb-4">
                            <span class="badge bg-{{ $user->role == 'admin' ? 'primary' : 'success' }} rounded-pill p-2">
                                <i class="fas fa-{{ $user->role == 'admin' ? 'shield-alt' : 'user' }} me-1"></i>
                                {{ $user->role == 'admin' ? 'مشرف' : ($user->role == 'donor' ? 'متبرع' : 'مستخدم') }}
                            </span>
                        </div>

                        <div class="user-details">
                            <div class="detail-item mb-3">
                                <i class="fas fa-envelope me-2 text-muted"></i>
                                <span>{{ $user->email }}</span>
                            </div>

                            <div class="detail-item mb-3">
                                <i class="fas fa-phone me-2 text-muted"></i>
                                <span>{{ $user->phone ?? 'غير متوفر' }}</span>
                            </div>

                            <div class="detail-item">
                                <i class="fas fa-calendar-alt me-2 text-muted"></i>
                                <span>مسجل منذ: {{ $user->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Activities -->
            <div class="col-md-8">
                <!-- Tabs Navigation -->
                <ul class="nav nav-tabs mb-4" id="userTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="donations-tab" data-bs-toggle="tab" data-bs-target="#donations" type="button" role="tab">
                            <i class="fas fa-hand-holding-heart me-2"></i> التبرعات
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="events-tab" data-bs-toggle="tab" data-bs-target="#events" type="button" role="tab">
                            <i class="fas fa-calendar-check me-2"></i> الأحداث
                        </button>
                    </li>
                </ul>

                <!-- Tabs Content -->
                <div class="tab-content" id="userTabsContent">
                    <!-- Donations Tab -->
                    <div class="tab-pane fade show active" id="donations" role="tabpanel">
                        @if($user->donations->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>السبب</th>
                                            <th>المبلغ</th>
                                            <th>طريقة الدفع</th>
                                            <th>التاريخ</th>
                                            <th>الحالة</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($user->donations as $donation)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if($donation->cause)
                                                    @if($donation->cause->trashed())
                                                        <span class="text-muted">{{ $donation->cause->title }} (محذوف)</span>
                                                    @else
                                                        <a href="{{ route('admin.causes.show', $donation->cause_id) }}">
                                                            {{ $donation->cause->title }}
                                                        </a>
                                                    @endif
                                                @else
                                                    <span class="text-muted">سبب غير معروف</span>
                                                @endif
                                            </td>
                                            <td class="text-success">
                                                {{ number_format($donation->amount) }} {{ $donation->currency }}
                                            </td>
                                            <td>
                                                {{ $donation->paymentMethod->name ?? 'غير معروف' }}
                                            </td>
                                            <td>{{ $donation->created_at->format('Y-m-d') }}</td>
                                            <td>
                                                <span class="badge bg-success">مكتمل</span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-info-circle fa-2x text-muted mb-3"></i>
                                <p class="text-muted">لا يوجد تبرعات مسجلة لهذا المستخدم</p>
                            </div>
                        @endif
                    </div>

                    <!-- Events Tab -->
                    <div class="tab-pane fade" id="events" role="tabpanel">
                        @if($user->events->count() > 0)
                            <div class="row">
                                @foreach($user->events as $event)
                                <div class="col-md-6 mb-3">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $event->title }}</h5>
                                            <div class="d-flex align-items-center mb-2">
                                                <i class="fas fa-map-marker-alt text-muted me-2"></i>
                                                <small>{{ $event->location }}</small>
                                            </div>
                                            <div class="d-flex align-items-center mb-2">
                                                <i class="fas fa-calendar-day text-muted me-2"></i>
                                                <small>{{ \Carbon\Carbon::parse($event->date)->format('Y-m-d') }}</small>                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="badge bg-primary">
                                                    <i class="fas fa-users me-1"></i>
                                                    {{ $event->volunteers_count ?? $event->volunteers->count() }} متطوع
                                                </span>
                                                <a href="{{ route('admin.events.show', $event->id) }}" class="btn btn-sm btn-outline-primary">
                                                    التفاصيل
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-info-circle fa-2x text-muted mb-3"></i>
                                <p class="text-muted">لا يوجد مشاركات في أحداث</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.avatar-xxl {
    width: 120px;
    height: 120px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.avatar-img {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 3px solid #e9ecef;
}

.user-details {
    background-color: #f8f9fa;
    border-radius: 8px;
    padding: 15px;
}

.detail-item {
    display: flex;
    align-items: center;
}

.nav-tabs .nav-link {
    border: none;
    color: #6c757d;
    font-weight: 500;
    padding: 0.75rem 1.5rem;
}

.nav-tabs .nav-link.active {
    color: #0d6efd;
    background-color: transparent;
    border-bottom: 3px solid #0d6efd;
}

.card {
    transition: transform 0.2s;
    border: none;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}

.table th {
    font-weight: 600;
    background-color: #f8f9fa;
}

.badge {
    font-weight: 500;
    padding: 0.5em 0.75em;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap tabs
    var tabEls = document.querySelectorAll('button[data-bs-toggle="tab"]');
    tabEls.forEach(function(tabEl) {
        tabEl.addEventListener('click', function (event) {
            event.preventDefault();
            var tab = new bootstrap.Tab(tabEl);
            tab.show();
        });
    });
});
</script>
@endpush
