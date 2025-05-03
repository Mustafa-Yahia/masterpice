@extends('layouts.admin')

@section('content')
<div class="admin-container">
    @include('admin.sidebar')

    <div class="admin-content">
        <!-- Header Section -->
        <div class="content-header">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="page-title">
                    <i class="fas fa-calendar-alt"></i> تفاصيل الحدث
                </h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.events.index') }}">الأحداث</a></li>
                        <li class="breadcrumb-item active" aria-current="page">تفاصيل الحدث</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Event Details Card -->
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">معلومات الحدث</h5>
                <div class="actions">
                    <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit me-1"></i> تعديل
                    </a>
                    <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="d-inline delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash me-1"></i> حذف
                        </button>
                    </form>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <!-- Event Image -->
                    <div class="col-md-4 mb-4">
                        <div class="event-image-container">
                            @if($event->image)
                                <img src="{{ asset('storage/'.$event->image) }}" alt="{{ $event->title }}" class="img-fluid rounded">
                            @else
                                <div class="no-image bg-light d-flex align-items-center justify-content-center rounded" style="height: 250px;">
                                    <i class="fas fa-calendar-alt fa-4x text-muted"></i>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Event Details -->
                    <div class="col-md-8">
                        <div class="event-details">
                            <h3 class="event-title mb-3">{{ $event->title }}</h3>

                            <div class="detail-item mb-3">
                                <h6 class="detail-label">
                                    <i class="fas fa-info-circle me-2 text-primary"></i> الوصف
                                </h6>
                                <p class="detail-value">{{ $event->description }}</p>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="detail-item mb-3">
                                        <h6 class="detail-label">
                                            <i class="fas fa-calendar-day me-2 text-primary"></i> التاريخ
                                        </h6>
                                        <p class="detail-value">{{ \Carbon\Carbon::parse($event->date)->format('Y-m-d') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail-item mb-3">
                                        <h6 class="detail-label">
                                            <i class="fas fa-clock me-2 text-primary"></i> الوقت
                                        </h6>
                                        <p class="detail-value">{{ $event->time }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="detail-item mb-3">
                                <h6 class="detail-label">
                                    <i class="fas fa-map-marker-alt me-2 text-primary"></i> الموقع
                                </h6>
                                <p class="detail-value">{{ $event->location }}</p>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="detail-item mb-3">
                                        <h6 class="detail-label">
                                            <i class="fas fa-users me-2 text-primary"></i> المتطوعون المطلوبون
                                        </h6>
                                        <p class="detail-value">
                                            <span class="badge bg-primary rounded-pill">{{ $event->volunteers_needed }}</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail-item mb-3">
                                        <h6 class="detail-label">
                                            <i class="fas fa-user-check me-2 text-primary"></i> المتطوعون المسجلون
                                        </h6>
                                        <p class="detail-value">
                                            <span class="badge bg-success rounded-pill">{{ $event->volunteers()->count() }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="detail-item">
                                <h6 class="detail-label">
                                    <i class="fas fa-calendar-plus me-2 text-primary"></i> تاريخ الإنشاء
                                </h6>
                                <p class="detail-value">{{ $event->created_at?->format('Y-m-d H:i') ?? 'غير محدد' }}</p>                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Volunteers List Card -->
        <div class="card shadow-sm mt-4">
            <div class="card-header bg-white">
                <h5 class="mb-0">
                    <i class="fas fa-users me-2"></i> قائمة المتطوعين
                    <span class="badge bg-primary rounded-pill ms-2">{{ $event->volunteers()->count() }}</span>
                </h5>
            </div>

            <div class="card-body">
                @if($event->volunteers()->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>الصورة</th>
                                <th>الاسم</th>
                                <th>البريد الإلكتروني</th>
                                <th>الهاتف</th>
                                <th>تاريخ التسجيل</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($event->volunteers as $volunteer)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if($volunteer->profile_photo)
                                        <img src="{{ asset('storage/'.$volunteer->profile_photo) }}" alt="{{ $volunteer->name }}" class="rounded-circle" width="40" height="40">
                                    @else
                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width:40px;height:40px;">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>{{ $volunteer->name }}</td>
                                <td>{{ $volunteer->email }}</td>
                                <td>{{ $volunteer->phone ?? 'غير متوفر' }}</td>
                                <td>{{ $volunteer->pivot->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <a href="{{ route('admin.users.show', $volunteer->id) }}" class="btn btn-sm btn-outline-primary" title="عرض الملف الشخصي">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.events.removeVolunteer', ['event' => $event->id, 'volunteer' => $volunteer->id]) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="إزالة من الحدث"
                                                onclick="return confirm('هل أنت متأكد من إزالة هذا المتطوع من الحدث؟')">
                                            <i class="fas fa-user-minus"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="empty-state text-center py-4">
                    <i class="fas fa-users-slash fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">لا يوجد متطوعون مسجلون في هذا الحدث</h5>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.event-image-container {
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    height: 250px;
    background-color: #f8f9fa;
}

.event-image-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.no-image {
    width: 100%;
}

.event-title {
    color: #2d3748;
    font-weight: 600;
    border-bottom: 2px solid #e2e8f0;
    padding-bottom: 10px;
}

.detail-label {
    color: #4a5568;
    font-weight: 600;
    margin-bottom: 5px;
}

.detail-value {
    color: #718096;
    margin-bottom: 0;
}

.card-header {
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

.table th {
    font-weight: 600;
    color: #2d3748;
    border-top: none;
}

.empty-state {
    opacity: 0.7;
}

.badge {
    font-size: 0.9rem;
    padding: 0.35em 0.65em;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Delete confirmation
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
                    this.submit();
                }
            });
        });
    });

    // Volunteer removal confirmation
    document.querySelectorAll('[data-remove-volunteer]').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'إزالة المتطوع',
                text: "هل تريد حقاً إزالة هذا المتطوع من الحدث؟",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'نعم، أزل',
                cancelButtonText: 'إلغاء',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    this.closest('form').submit();
                }
            });
        });
    });
});
</script>
@endpush
