@extends('layouts.admin')

@section('content')
<div class="admin-container">
    @include('admin.sidebar')

    <div class="admin-content">
        <!-- Header Section -->
        <div class="content-header">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="page-title">
                    <i class="fas fa-hands-helping"></i> إدارة الحملات
                </h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item active" aria-current="page">الحملات</li>
                    </ol>
                </nav>
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
                <form action="{{ route('admin.causes.index') }}" method="GET" id="filterForm">
                    <div class="row g-3">
                        <!-- Search Field -->
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text text-white" style="background-color: #3cc88f;">
                                    <i class="fas fa-search"></i>
                                </span>
                                <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="ابحث بالعنوان أو الوصف...">
                            </div>
                        </div>

                        <!-- Amount Range Filter -->
                        <div class="col-md-4">
                            <select class="form-select" name="amount_range">
                                <option value="">نطاق المبلغ المجموع</option>
                                <option value="0-1000" {{ request('amount_range') == '0-1000' ? 'selected' : '' }}>0 - 1,000 $</option>
                                <option value="1000-5000" {{ request('amount_range') == '1000-5000' ? 'selected' : '' }}>1,000 - 5,000 $</option>
                                <option value="5000-10000" {{ request('amount_range') == '5000-10000' ? 'selected' : '' }}>5,000 - 10,000 $</option>
                                <option value="10000+" {{ request('amount_range') == '10000+' ? 'selected' : '' }}>أكثر من 10,000 $</option>
                            </select>
                        </div>

                        <!-- Status Filter -->
                        <div class="col-md-4">
                            <select class="form-select" name="status">
                                <option value="">حالة الحملة</option>
                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>نشطة</option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>مكتملة</option>
                                <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>منتهية</option>
                            </select>
                        </div>

                        <!-- Date Range -->
                        <div class="col-md-6">
                            <label for="start_date" class="form-label fw-bold">📅 تاريخ بدء الحملة</label>
                            <div class="input-group">
                                <span class="input-group-text text-white" style="background-color: #3cc88f;">
                                    <i class="fas fa-calendar-day"></i>
                                </span>
                                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ request('start_date') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="end_date" class="form-label fw-bold">📅 تاريخ انتهاء الحملة</label>
                            <div class="input-group">
                                <span class="input-group-text text-white" style="background-color: #3cc88f;">
                                    <i class="fas fa-calendar-day"></i>
                                </span>
                                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ request('end_date') }}">
                            </div>
                        </div>

                        <!-- Filter Buttons -->
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn px-4" style="background-color: #3cc88f; color: white;">
                                    <i class="fas fa-filter me-2"></i> تطبيق الفلتر
                                </button>
                                <a href="{{ route('admin.causes.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-redo me-2"></i> إعادة التعيين
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Causes Table -->
        <!-- Causes Table -->
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center bg-white">
        <h5 class="mb-0">قائمة الحملات</h5>
        <a href="{{ route('admin.causes.create') }}" class="btn" style="background-color: #3cc88f; color: white;">
            <i class="fas fa-plus me-2"></i> إضافة حملة جديدة
        </a>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead class="table-light">
                    <tr>
                        <th width="5%">#</th>
                        <th>الحملة</th>
                        <th>التقدم</th>
                        <th>المبلغ</th>
                        <th>الحالة</th>
                        <th>المسؤول</th>
                        <th width="15%">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($causes as $cause)
                    <tr>
                        <td>{{ $cause->id }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar me-3">
                                    @if($cause->image)
                                        <img src="{{ asset('storage/'.$cause->image) }}" alt="{{ $cause->title }}" class="rounded" width="40" height="40">
                                    @else
                                        <div class="text-white rounded d-flex align-items-center justify-content-center" style="width:40px;height:40px; background-color: #3cc88f;">
                                            {{ strtoupper(substr($cause->title, 0, 1)) }}
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <h6 class="mb-0">{{ $cause->title }}</h6>
                                    <small class="text-muted">{{ Str::limit($cause->description, 30) }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            @php
                                // حساب النسبة المئوية
                                $percentage = ($cause->raised_amount / $cause->goal_amount) * 100;
                                $percentage = min($percentage, 100);

                                // تحديد حالة الحملة (الأولوية لتاريخ الانتهاء)
                                $isExpired = $cause->end_date && now()->gt($cause->end_date);
                                $isCompleted = !$isExpired && ($cause->raised_amount >= $cause->goal_amount);

                                // تحديد لون شريط التقدم
                                $progressBarClass = 'bg-primary';
                                if ($isCompleted) {
                                    $progressBarClass = 'bg-success';
                                } elseif ($isExpired) {
                                    $progressBarClass = 'bg-danger';
                                }
                            @endphp
                            <div class="progress" style="height: 20px;">
                                <div class="progress-bar {{ $progressBarClass }} @if(!$isExpired && !$isCompleted) progress-bar-striped progress-bar-animated @endif"
                                    role="progressbar"
                                    style="width: {{ $percentage }}%"
                                    aria-valuenow="{{ $percentage }}"
                                    aria-valuemin="0"
                                    aria-valuemax="100">
                                    {{ round($percentage) }}%
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-column">
                                <span class="fw-bold text-success">${{ number_format($cause->raised_amount, 2) }}</span>
                                <small class="text-muted">من ${{ number_format($cause->goal_amount, 2) }}</small>
                            </div>
                        </td>
                        <td>
                           @if($isExpired)
    <span class="badge bg-danger rounded-pill"
          @if($cause->end_date)
          data-bs-toggle="tooltip"
          title="انتهت في {{ \Carbon\Carbon::parse($cause->end_date)->format('Y-m-d') }}"
          @endif>
        <i class="fas fa-times-circle me-1"></i> منتهية
    </span>
@elseif($isCompleted)
    <span class="badge bg-success rounded-pill">
        <i class="fas fa-check-circle me-1"></i> مكتملة
    </span>
@else
    <span class="badge rounded-pill" style="background-color: #3cc88f;">
        <i class="fas fa-spinner me-1"></i> نشطة
    </span>
@endif
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar me-2">
                                    <span class="avatar-initial bg-secondary rounded-circle">
                                        {{ strtoupper(substr($cause->responsible_person_name, 0, 1)) }}
                                    </span>
                                </div>
                                <span>{{ $cause->responsible_person_name }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.causes.show', $cause->id) }}" class="btn btn-sm btn-outline-info" data-bs-toggle="tooltip" title="عرض التفاصيل">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.causes.edit', $cause->id) }}" class="btn btn-sm btn-outline-warning" data-bs-toggle="tooltip" title="تعديل">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.causes.destroy', $cause->id) }}" method="POST" class="d-inline delete-form">
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
                                <i class="fas fa-hands-helping fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">لا توجد حملات مسجلة</h5>
                                <a href="{{ route('admin.causes.create') }}" class="btn mt-3" style="background-color: #3cc88f; color: white;">
                                    <i class="fas fa-plus me-2"></i> إنشاء حملة جديدة
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($causes->hasPages())
        <nav aria-label="تصفح النتائج" dir="rtl">
            <ul class="pagination justify-content-center mt-5">
                <!-- Previous Page -->
                <li class="page-item {{ $causes->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link"
                       href="{{ $causes->previousPageUrl() }}"
                       aria-label="السابق"
                       @if($causes->onFirstPage()) tabindex="-1" aria-disabled="true" @endif>
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>

                <!-- Page Numbers -->
                @foreach($causes->getUrlRange(max(1, $causes->currentPage() - 2), min($causes->lastPage(), $causes->currentPage() + 2)) as $page => $url)
                    <li class="page-item {{ $page == $causes->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach

                <!-- Next Page -->
                <li class="page-item {{ !$causes->hasMorePages() ? 'disabled' : '' }}">
                    <a class="page-link"
                       href="{{ $causes->nextPageUrl() }}"
                       aria-label="التالي"
                       @if(!$causes->hasMorePages()) tabindex="-1" aria-disabled="true" @endif>
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
        @endif
    </div>
</div>

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
    }

    .page-link:hover {
        background-color: #f5f5f5;
        border-color: #e0e0e0;
        color: var(--primary-hover);
    }

    .page-item.active .page-link {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
        box-shadow: 0 2px 5px rgba(60, 200, 143, 0.3);
    }

    .page-item.disabled .page-link {
        color: var(--disabled-color);
        pointer-events: none;
        background-color: #f9f9f9;
        border-color: #e0e0e0;
    }

    /* أيقونات الأسهم */
    .page-link span[aria-hidden="true"] {
        font-size: 14px;
        vertical-align: middle;
    }

    /* للأجهزة الصغيرة */
    @media (max-width: 576px) {
        .page-link {
            padding: 6px 10px;
            font-size: 14px;
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

    .progress {
        border-radius: 10px;
        background-color: #f0f0f0;
    }

    .progress-bar {
        border-radius: 10px;
        transition: width 0.6s ease;
    }

    .avatar-initial {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl, {
            trigger: 'hover'
        });
    });

    // Delete confirmation with SweetAlert2
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'هل أنت متأكد؟',
                text: "لن تتمكن من استعادة هذه الحملة!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'نعم، احذف!',
                cancelButtonText: 'إلغاء',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'جاري الحذف...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    this.submit();
                }
            });
        });
    });

    // Auto submit filter form when some fields change
    const autoFilterFields = ['amount_range', 'status'];
    autoFilterFields.forEach(field => {
        const element = document.querySelector(`[name="${field}"]`);
        if (element) {
            element.addEventListener('change', function() {
                document.getElementById('filterForm').submit();
            });
        }
    });

    // Collapse filter panel toggle
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
});
</script>
@endpush
