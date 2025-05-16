@extends('layouts.admin')

@section('content')
<div class="admin-container">
    @include('admin.sidebar')

    <div class="admin-content">
        <!-- Header Section -->
        <div class="content-header">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="page-title">
                    <i class="fas fa-calendar-alt"></i> إدارة الأحداث
                </h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item active" aria-current="page">الأحداث</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card shadow-sm border-start border-primary border-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1">الأحداث القادمة</h6>
                                <h4 class="mb-0">{{ $upcomingEventsCount }}</h4>
                            </div>
                            <div class=" bg-opacity-10 p-3 rounded" style="background-color: rgba(0, 123, 255, 0.1);">
                                <i class="fas fa-calendar-check text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-start border-success border-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1">الأحداث المنتهية</h6>
                                <h4 class="mb-0">{{ $pastEventsCount }}</h4>
                            </div>
                            <div class="bg-success bg-opacity-10 p-3 rounded">
                                <i class="fas fa-calendar-times text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-start border-info border-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1">إجمالي الأحداث</h6>
                                <h4 class="mb-0">{{ $totalEventsCount }}</h4>
                            </div>
                            <div class="bg-info bg-opacity-10 p-3 rounded">
                                <i class="fas fa-calendar-alt text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-start border-warning border-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1">متطوعون مسجلون</h6>
                                <h4 class="mb-0">{{ $totalVolunteers }}</h4>
                            </div>
                            <div class="bg-warning bg-opacity-10 p-3 rounded">
                                <i class="fas fa-users text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters Card -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-gradient-primary text-white">
                <h5 class="mb-0">
                    <i class="fas fa-filter"></i> فلاتر البحث
                    <button class="btn btn-sm btn-light float-left" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse">
                        <i class="fas fa-sliders-h"></i>
                    </button>
                </h5>
            </div>
            <div class="card-body collapse show" id="filterCollapse">
                <form action="{{ route('admin.events.index') }}" method="GET" id="filterForm">
                    <div class="row g-3">
                        <!-- Search Field -->
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text  text-white" style="background-color: #3cc88f;">
                                    <i class="fas fa-search"></i>
                                </span>
                                <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="ابحث بالعنوان أو الوصف...">
                            </div>
                        </div>

                        <!-- Location Filter -->
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text  text-white" style="background-color: #3cc88f;">
                                    <i class="fas fa-map-marker-alt"></i>
                                </span>
                                <input type="text" class="form-control" name="location" value="{{ request('location') }}" placeholder="ابحث بالموقع...">
                            </div>
                        </div>

                        <!-- Status Filter -->
                        <div class="col-md-4">
                            <select class="form-select" name="status">
                                <option value="">حالة الحدث</option>
                                <option value="upcoming" {{ request('status') == 'upcoming' ? 'selected' : '' }}>قادمة</option>
                                <option value="past" {{ request('status') == 'past' ? 'selected' : '' }}>منتهية</option>
                            </select>
                        </div>

                        <!-- Volunteers Filter -->
                        <div class="col-md-4 mt-5">
                            <select class="form-select" name="volunteers_needed">
                                <option value="">عدد المتطوعين المطلوب</option>
                                <option value="1-10" {{ request('volunteers_needed') == '1-10' ? 'selected' : '' }}>1 - 10 متطوعين</option>
                                <option value="10-50" {{ request('volunteers_needed') == '10-50' ? 'selected' : '' }}>10 - 50 متطوع</option>
                                <option value="50+" {{ request('volunteers_needed') == '50+' ? 'selected' : '' }}>أكثر من 50 متطوع</option>
                            </select>
                        </div>

                        <!-- Date Range -->
                        <div class="col-md-4">
                                <label for="start_date" class="form-label fw-bold">📅 تاريخ بدء الحملة</label>
                            <div class="input-group">
                                <span class="input-group-text  text-white" style="background-color: #3cc88f;">
                                    <i class="fas fa-calendar-day"></i>
                                </span>
                                <input type="date" class="form-control" name="start_date" value="{{ request('start_date') }}" placeholder="من تاريخ">
                            </div>
                        </div>

                        <div class="col-md-4">
                                <label for="end_date" class="form-label fw-bold">📅 تاريخ انتهاء الحملة</label>
                            <div class="input-group">
                                <span class="input-group-text  text-white" style="background-color: #3cc88f;">
                                    <i class="fas fa-calendar-day"></i>
                                </span>
                                <input type="date" class="form-control" name="end_date" value="{{ request('end_date') }}" placeholder="إلى تاريخ">
                            </div>
                        </div>

                        <!-- Filter Buttons -->
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn  px-4" style="background-color: #3cc88f; color: white;">
                                    <i class="fas fa-filter me-2"></i> تطبيق الفلتر
                                </button>
                                <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-redo me-2"></i> إعادة التعيين
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Events Table -->
      <!-- Events Table -->
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center bg-white">
        <h5 class="mb-0">قائمة الأحداث</h5>
        <div>
{{-- <a href="{{ route('export.excel') }}" class="btn btn-outline-info me-2" data-bs-toggle="tooltip" title="تصدير إلى Excel" id="exportExcelBtn">
    <i class="fas fa-file-excel"></i>
</a> --}}

            <a href="{{ route('admin.events.create') }}" class="btn text-white" style="background-color: #3cc88f; color: white;" data-bs-toggle="tooltip" title="إضافة حدث جديد">
                <i class="fas fa-plus me-2"></i> إضافة حدث جديد
            </a>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead class="table-light">
                    <tr>
                        <th width="5%">#</th>
                        <th>العنوان</th>
                        <th>التاريخ والوقت</th>
                        <th>الموقع</th>
                        <th>المتطوعون</th>
                        <th>الحالة</th>
                        <th width="15%">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($events as $event)
                    @php
                        $eventDate = \Carbon\Carbon::parse($event->date);
                        $startDateTime = \Carbon\Carbon::parse($event->date . ' ' . $event->time);
                        $endDateTime = \Carbon\Carbon::parse($event->date . ' ' . $event->end_time);
                        $now = \Carbon\Carbon::now();

                        $isPastEvent = $endDateTime->isPast();
                        $isTodayEvent = $eventDate->isToday();
                        $isUpcomingEvent = $startDateTime->isFuture();
                        $isOngoingEvent = $now->between($startDateTime, $endDateTime);
                    @endphp
                    <tr>
                        <td>{{ $event->id }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar me-3">
                                    @if($event->image)
                                        <img src="{{ asset('storage/'.$event->image) }}" alt="{{ $event->title }}" class="rounded" width="40" height="40">
                                    @else
                                        <div class="bg-primary text-white rounded d-flex align-items-center justify-content-center" style="width:40px;height:40px;">
                                            <i class="fas fa-calendar"></i>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <h6 class="mb-0">{{ $event->title }}</h6>
                                    <small class="text-muted">{{ Str::limit($event->description, 30) }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div>{{ $eventDate->translatedFormat('l، j F Y') }}</div>
                            <small class="text-muted">
                                من {{ \Carbon\Carbon::parse($event->time)->format('h:i A') }}
                                إلى {{ \Carbon\Carbon::parse($event->end_time)->format('h:i A') }}
                            </small>
                        </td>
                        <td>{{ $event->location }}</td>
                        <td>
                            <span class="badge rounded-pill" style="background-color: #3cc88f;">
                                <i class="fas fa-users me-1"></i>
                                {{ $event->volunteers_needed }}
                            </span>
                        </td>
                        <td>
                            @if($isPastEvent)
                                <span class="badge bg-secondary">منتهي</span>
                            @elseif($isOngoingEvent)
                                <span class="badge bg-primary">جاري الآن</span>
                            @elseif($isTodayEvent)
                                <span class="badge bg-info">قريباً اليوم</span>
                            @elseif($isUpcomingEvent)
                                <span class="badge bg-success">قادم</span>
                            @else
                                <span class="badge bg-warning">مجدول</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.events.show', $event->id) }}" class="btn btn-sm btn-outline-info" data-bs-toggle="tooltip" title="عرض التفاصيل">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-sm btn-outline-warning" data-bs-toggle="tooltip" title="تعديل">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" data-bs-toggle="tooltip" title="حذف">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            <div class="empty-state">
                                <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">لا توجد أحداث مسجلة</h5>
                                <a href="{{ route('admin.events.create') }}" class="btn mt-3" style="background-color: #3cc88f; color: white;">
                                    <i class="fas fa-plus me-2"></i> إنشاء حدث جديد
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($events->hasPages())
        <nav aria-label="تصفح النتائج" dir="rtl">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 mt-5">
                <!-- Pagination Info -->
                <div class="pagination-info text-center text-md-start">
                    <p class="text-muted mb-0">
                        <i class="fas fa-list-ol me-2"></i>
                        عرض
                        <span class="fw-semibold">{{ $events->firstItem() }}</span>
                        إلى
                        <span class="fw-semibold">{{ $events->lastItem() }}</span>
                        من
                        <span class="fw-semibold">{{ $events->total() }}</span>
                        نتيجة
                    </p>
                </div>

                <!-- Pagination Links -->
                <ul class="pagination justify-content-center mb-0">
                    <!-- Previous Page -->
                    <li class="page-item {{ $events->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link"
                           href="{{ $events->previousPageUrl() }}"
                           aria-label="السابق"
                           @if($events->onFirstPage()) tabindex="-1" aria-disabled="true" @endif>
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>

                    <!-- Page Numbers -->
                    @foreach($events->getUrlRange(max(1, $events->currentPage() - 2), min($events->lastPage(), $events->currentPage() + 2)) as $page => $url)
                        <li class="page-item {{ $page == $events->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach

                    <!-- Next Page -->
                    <li class="page-item {{ !$events->hasMorePages() ? 'disabled' : '' }}">
                        <a class="page-link"
                           href="{{ $events->nextPageUrl() }}"
                           aria-label="التالي"
                           @if(!$events->hasMorePages()) tabindex="-1" aria-disabled="true" @endif>
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        @endif
    </div>
</div>
@endsection

@push('styles')
<style>

    .pagination {
    --primary-color: #3cc88f;
    --primary-hover: #2da876;
    --text-color: #555;
    --disabled-color: #ddd;
}

.pagination-info {
    font-size: 0.9rem;
    color: #6c757d;
}

.page-item {
    margin: 0 3px;
    border-radius: 4px;
    overflow: hidden;
}

.page-link {
    color: var(--text-color);
    border: 1px solid #e0e0e0;
    padding: 8px 14px;
    font-size: 15px;
    font-weight: 500;
    transition: all 0.3s ease;
    position: relative;
    border-radius: 4px !important;
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 40px;
}

.page-link:hover {
    background-color: #f5f5f5;
    border-color: #e0e0e0;
    color: var(--primary-hover);
    transform: translateY(-1px);
}

.page-item.active .page-link {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
    color: white;
    box-shadow: 0 2px 8px rgba(60, 200, 143, 0.3);
    font-weight: 600;
}

.page-item.disabled .page-link {
    color: var(--disabled-color);
    pointer-events: none;
    background-color: #f9f9f9;
    border-color: #e0e0e0;
}

/* أيقونات الأسهم */
.page-link span[aria-hidden="true"] {
    font-size: 16px;
    font-weight: bold;
}

/* تأثيرات إضافية */
.page-link:focus {
    box-shadow: 0 0 0 0.25rem rgba(60, 200, 143, 0.25);
    z-index: 1;
}

/* للأجهزة الصغيرة */
@media (max-width: 768px) {
    .page-link {
        padding: 6px 10px;
        font-size: 14px;
        min-width: 36px;
    }

    .pagination-info {
        font-size: 0.85rem;
    }
}

@media (max-width: 576px) {
    .page-item {
        margin: 0 2px;
    }

    .page-link {
        padding: 5px 8px;
        min-width: 32px;
    }
}
.avatar img {
    object-fit: cover;
}

.table th {
    font-weight: 600;
    color: var(--dark);
    border-top: none;
    border-bottom: 1px solid var(--gray-200);
}

.table td {
    vertical-align: middle;
}

.btn-sm {
    padding: 0.35rem 0.65rem;
    font-size: 0.875rem;
}

.badge {
    font-weight: 500;
    padding: 0.35em 0.65em;
}

.empty-state {
    text-align: center;
    padding: 2rem;
}

.card-header.bg-gradient-primary {
    background: linear-gradient(87deg, #5e72e4 0, #825ee4 100%) !important;
}

.table-hover tbody tr:hover {
    background-color: rgba(94, 114, 228, 0.05);
    transform: translateX(5px);
    transition: all 0.3s ease;
}

.page-item.active .page-link {
    background-color: var(--primary);
    border-color: var(--primary);
}

.page-link {
    color: var(--primary);
}

/* Stats Cards */
.border-3 {
    border-width: 3px !important;
}

.bg-opacity-10 {
    background-color: rgba(var(--bs-primary-rgb), 0.1) !important;
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl, {
            trigger: 'hover'
        });
    });

    // Enhanced Delete confirmation with SweetAlert2
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'هل أنت متأكد؟',
                text: "لن تتمكن من استعادة هذا الحدث!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'نعم، احذف!',
                cancelButtonText: 'إلغاء',
                reverseButtons: true,
                customClass: {
                    confirmButton: 'btn btn-danger mx-2',
                    cancelButton: 'btn btn-secondary mx-2'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading indicator
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: 'btn btn-success mx-2',
                            cancelButton: 'btn btn-danger mx-2'
                        },
                        buttonsStyling: false
                    });

                    swalWithBootstrapButtons.fire({
                        title: 'جاري الحذف...',
                        html: 'الرجاء الانتظار بينما نقوم بحذف الحدث',
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading();
                        },
                        willClose: () => {
                            // Submit the form after showing loading
                            form.submit();
                        }
                    });
                }
            });
        });
    });

    // Auto submit filter form when some fields change
    const autoFilterFields = ['status', 'volunteers_needed'];
    autoFilterFields.forEach(field => {
        const element = document.querySelector(`[name="${field}"]`);
        if (element) {
            element.addEventListener('change', function() {
                document.getElementById('filterForm').submit();
            });
        }
    });

    // Collapse filter panel toggle with animation
    const filterCollapse = document.getElementById('filterCollapse');
    const filterToggle = document.querySelector('[data-bs-target="#filterCollapse"]');
    if (filterToggle) {
        filterToggle.addEventListener('click', function() {
            const icon = this.querySelector('i');
            if (filterCollapse.classList.contains('show')) {
                icon.classList.remove('fa-sliders-h');
                icon.classList.add('fa-filter');
            } else {
                icon.classList.remove('fa-filter');
                icon.classList.add('fa-sliders-h');
            }
        });
    }

    // Show success message if exists
    @if(session('success'))
    Swal.fire({
        title: 'نجاح!',
        text: '{{ session('success') }}',
        icon: 'success',
        confirmButtonText: 'حسناً',
        timer: 3000,
        timerProgressBar: true,
        toast: true,
        position: 'top-end',
        showConfirmButton: false
    });
    @endif

    // Show error message if exists
    @if(session('error'))
    Swal.fire({
        title: 'خطأ!',
        text: '{{ session('error') }}',
        icon: 'error',
        confirmButtonText: 'حسناً'
    });
    @endif
});
</script>
@endpush
