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
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fas fa-search"></i>
                                </span>
                                <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="ابحث بالعنوان أو الوصف...">
                            </div>
                        </div>

                        <!-- Location Filter -->
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fas fa-map-marker-alt"></i>
                                </span>
                                <input type="text" class="form-control" name="location" value="{{ request('location') }}" placeholder="ابحث بالموقع...">
                            </div>
                        </div>

                        <!-- Volunteers Filter -->
                        <div class="col-md-4">
                            <select class="form-select" name="volunteers_needed">
                                <option value="">عدد المتطوعين المطلوب</option>
                                <option value="1-10" {{ request('volunteers_needed') == '1-10' ? 'selected' : '' }}>1 - 10 متطوعين</option>
                                <option value="10-50" {{ request('volunteers_needed') == '10-50' ? 'selected' : '' }}>10 - 50 متطوع</option>
                                <option value="50+" {{ request('volunteers_needed') == '50+' ? 'selected' : '' }}>أكثر من 50 متطوع</option>
                            </select>
                        </div>

                        <!-- Date Range -->
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fas fa-calendar-day"></i>
                                </span>
                                <input type="date" class="form-control" name="start_date" value="{{ request('start_date') }}" placeholder="من تاريخ">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="fas fa-calendar-day"></i>
                                </span>
                                <input type="date" class="form-control" name="end_date" value="{{ request('end_date') }}" placeholder="إلى تاريخ">
                            </div>
                        </div>

                        <!-- Filter Buttons -->
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary px-4">
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
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center bg-white">
                <h5 class="mb-0">قائمة الأحداث</h5>
                <a href="{{ route('admin.events.create') }}" class="btn btn-success">
                    <i class="fas fa-plus me-2"></i> إضافة حدث جديد
                </a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">#</th>
                                <th>العنوان</th>
                                <th>التاريخ</th>
                                <th>الوقت</th>
                                <th>الموقع</th>
                                <th>المتطوعون</th>
                                <th width="15%">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($events as $event)
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
                                <td>{{ \Carbon\Carbon::parse($event->date)->format('Y-m-d') }}</td>
                                <td>{{ $event->time }}</td>
                                <td>{{ $event->location }}</td>
                                <td>
                                    <span class="badge bg-primary rounded-pill">
                                        <i class="fas fa-users me-1"></i>
                                        {{ $event->volunteers_needed }}
                                    </span>
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
                                        <a href="{{ route('admin.events.create') }}" class="btn btn-primary mt-3">
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
                <div class="d-flex justify-content-center mt-4">
                    {{ $events->withQueryString()->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
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
                text: "لن تتمكن من استعادة هذا الحدث!",
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
    const autoFilterFields = ['volunteers_needed'];
    autoFilterFields.forEach(field => {
        document.querySelector(`[name="${field}"]`).addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });
    });

    // Collapse filter panel toggle
    const filterCollapse = document.getElementById('filterCollapse');
    const filterToggle = document.querySelector('[data-bs-target="#filterCollapse"]');
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
});
</script>
@endpush
