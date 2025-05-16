@extends('layouts.admin')

@section('content')
<div class="admin-container" style="background-color: #f8f9fa;">
    @include('admin.sidebar')

    <div class="admin-content" style="background-color: white; border-radius: 10px; margin: 20px; box-shadow: 0 0 20px rgba(0,0,0,0.05);">
        <!-- Header Section -->
        <div class="content-header" style="padding: 20px; border-bottom: 1px solid #eee;">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="page-title" style="color: #3cc88f; font-weight: 700;">
                    <i class="fas fa-user-circle" style="color: #3cc88f;"></i> تفاصيل المستخدم
                </h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb" style="background-color: transparent; padding: 0;">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="color: #6c757d;">الرئيسية</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}" style="color: #6c757d;">المستخدمين</a></li>
                        <li class="breadcrumb-item active" aria-current="page" style="color: #3cc88f;">تفاصيل</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- User Profile Section -->
        <div class="row" style="padding: 20px;">
            <!-- User Info Card -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100" style="border: none; border-radius: 10px;">
                    <div class="card-body text-center" style="padding: 30px;">
                        <div class="avatar-xxl mb-4 mx-auto">
                            {{-- <div class="avatar-img rounded-circle" style="background-color: rgba(60, 200, 143, 0.1); border: 3px solid #3cc88f;">
                                <span class="display-4" style="color: #3cc88f;">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                            </div> --}}
                        </div>

                        <h3 class="mb-3" style="color: #2c3e50;">{{ $user->name }}</h3>

                        <div class="d-flex justify-content-center gap-2 mb-4">
                            <span class="badge rounded-pill p-2" style="background-color: {{ $user->role == 'admin' ? '#3cc88f' : '#2c3e50' }}; color: white;">
                                <i class="fas fa-{{ $user->role == 'admin' ? 'shield-alt' : 'user' }} me-1"></i>
                                {{ $user->role == 'admin' ? 'مشرف' : ($user->role == 'donor' ? 'متبرع' : 'مستخدم') }}
                            </span>
                        </div>

                        <div class="user-details" style="
    background-color: rgba(60, 200, 143, 0.05);
    border-radius: 8px;
    padding: 5px;
    text-align: right;
    min-width: 250px;  ">
    <div class="detail-item mb-3 d-flex align-items-center">
        <i class="fas fa-envelope me-3" style="color: #3cc88f;"></i>
        <span>{{ $user->email }}</span>
    </div>

    <div class="detail-item mb-3 d-flex align-items-center">
        <i class="fas fa-phone me-3" style="color: #3cc88f;"></i>
        <span>{{ $user->phone ?? 'غير متوفر' }}</span>
    </div>

    <div class="detail-item d-flex align-items-center">
        <i class="fas fa-calendar-alt me-3" style="color: #3cc88f;"></i>
        <span>مسجل منذ: {{ $user->created_at->diffForHumans() }}</span>
    </div>
</div>
                    </div>
                </div>
            </div>

            <!-- User Activities -->
            <div class="col-md-8">
                <!-- Tabs Navigation -->
                <ul class="nav nav-tabs mb-4" id="userTabs" role="tablist" style="border-bottom: 2px solid #eee;">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="donations-tab" data-bs-toggle="tab" data-bs-target="#donations" type="button" role="tab" style="color: #6c757d; border: none; padding: 12px 20px; font-weight: 600;">
                            <i class="fas fa-hand-holding-heart me-2" style="color: #3cc88f;"></i> التبرعات
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="events-tab" data-bs-toggle="tab" data-bs-target="#events" type="button" role="tab" style="color: #6c757d; border: none; padding: 12px 20px; font-weight: 600;">
                            <i class="fas fa-calendar-check me-2" style="color: #3cc88f;"></i> الأحداث
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
                                        <tr style="background-color: rgba(60, 200, 143, 0.1);">
                                            <th style="color: #2c3e50;">#</th>
                                            <th style="color: #2c3e50;">السبب</th>
                                            <th style="color: #2c3e50;">المبلغ</th>
                                            <th style="color: #2c3e50;">طريقة الدفع</th>
                                            <th style="color: #2c3e50;">التاريخ</th>
                                            <th style="color: #2c3e50;">الحالة</th>
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
                                                        <a href="{{ route('admin.causes.show', $donation->cause_id) }}" style="color: #3cc88f;">
                                                            {{ $donation->cause->title }}
                                                        </a>
                                                    @endif
                                                @else
                                                    <span class="text-muted">سبب غير معروف</span>
                                                @endif
                                            </td>
                                            <td style="color: #3cc88f; font-weight: 600;">
                                                {{ number_format($donation->amount) }} {{ $donation->currency }}
                                            </td>
                                            <td>
                                                {{ $donation->paymentMethod->name ?? 'غير معروف' }}
                                            </td>
                                            <td>{{ $donation->created_at->format('Y-m-d') }}</td>
                                            <td>
                                                <span class="badge" style="background-color: #3cc88f; color: white;">مكتمل</span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-info-circle fa-2x mb-3" style="color: #3cc88f;"></i>
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
                                    <div class="card h-100" style="border: none; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); transition: all 0.3s ease;">
                                        <div class="card-body">
                                            <h5 class="card-title" style="color: #2c3e50;">{{ $event->title }}</h5>
                                            <div class="d-flex align-items-center mb-2">
                                                <i class="fas fa-map-marker-alt me-2" style="color: #3cc88f;"></i>
                                                <small>{{ $event->location }}</small>
                                            </div>
                                            <div class="d-flex align-items-center mb-2">
                                                <i class="fas fa-calendar-day me-2" style="color: #3cc88f;"></i>
                                                <small>{{ \Carbon\Carbon::parse($event->date)->format('Y-m-d') }}</small>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="badge" style="background-color: #3cc88f; color: white;">
                                                    <i class="fas fa-users me-1"></i>
                                                    {{ $event->volunteers_count ?? $event->volunteers->count() }} متطوع
                                                </span>
                                                <a href="{{ route('admin.events.show', $event->id) }}" class="btn btn-sm" style="background-color: white; color: #3cc88f; border: 1px solid #3cc88f;">
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
                                <i class="fas fa-info-circle fa-2x mb-3" style="color: #3cc88f;"></i>
                                <p class="text-muted">لا يوجد مشاركات في أعمل تطوع</p>
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

.nav-tabs .nav-link.active {
    color: #3cc88f !important;
    background-color: transparent !important;
    border-bottom: 3px solid #3cc88f !important;
}

.nav-tabs .nav-link:hover {
    color: #3cc88f !important;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(60, 200, 143, 0.2) !important;
}

.table th {
    font-weight: 600;
}

.badge {
    font-weight: 500;
    padding: 0.5em 0.75em;
}

.btn-outline-primary {
    color: #3cc88f;
    border-color: #3cc88f;
}

.btn-outline-primary:hover {
    background-color: #3cc88f;
    color: white;
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
