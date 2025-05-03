@extends('layouts.admin')

@section('content')
<div class="admin-container">
    @include('admin.sidebar')

    <div class="admin-content">
        <!-- Header Section -->
        <div class="content-header">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="page-title">
                    <i class="fas fa-users"></i> إدارة المستخدمين
                </h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item active" aria-current="page">المستخدمين</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Alerts -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Filters Card -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form id="filterForm">
                    <div class="row g-3">
                        <div class="col-md-5">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                <input type="text" name="search" class="form-control" placeholder="ابحث بالاسم أو البريد..." value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <select name="role" class="form-select">
                                <option value="">جميع المستخدمين</option>
                                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>مشرف</option>
                                <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>مستخدم</option>
                            </select>
                        </div>
                        <div class="col-md-2 d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-filter me-2"></i>تصفية
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Users Table Card -->
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">قائمة المستخدمين</h3>
                <a href="{{ route('admin.users.create') }}" class="btn btn-success">
                    <i class="fas fa-user-plus me-2"></i>إضافة مستخدم
                </a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">#</th>
                                <th>الاسم</th>
                                <th>البريد الإلكتروني</th>
                                <th>رقم الهاتف</th>
                                <th>نوع المستخدم</th>
                                <th>تاريخ التسجيل</th>
                                <th width="15%">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar me-3">
                                            <img src="{{ $user->avatar ?? 'https://ui-avatars.com/api/?name='.$user->name.'&background=random' }}"
                                                 alt="{{ $user->name }}"
                                                 class="rounded-circle"
                                                 width="40"
                                                 height="40">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">{{ $user->name }}</h6>
                                            <small class="text-muted">{{ '@'.$user->username }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone ?? '--' }}</td>
                                <td>
                                    @if($user->role == 'admin')
                                        <span class="badge bg-primary rounded-pill">
                                            <i class="fas fa-shield-alt me-1"></i> مشرف
                                        </span>
                                    @else
                                        <span class="badge bg-secondary rounded-pill">
                                            <i class="fas fa-user me-1"></i> متبرع
                                        </span>
                                    @endif
                                </td>
                                <td>{{ $user->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.users.edit', $user->id) }}"
                                           class="btn btn-sm btn-outline-primary"
                                           data-bs-toggle="tooltip"
                                           title="تعديل">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger delete-btn"
                                                    data-bs-toggle="tooltip"
                                                    title="حذف">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>

                                        <a href="{{ route('admin.users.show', $user->id) }}"
                                           class="btn btn-sm btn-outline-info"
                                           data-bs-toggle="tooltip"
                                           title="عرض التفاصيل">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($users->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $users->withQueryString()->links() }}
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
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const form = this.closest('form');

            Swal.fire({
                title: 'هل أنت متأكد؟',
                text: "لن تتمكن من استعادة هذا المستخدم!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'نعم، احذف!',
                cancelButtonText: 'إلغاء',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    // Filter form submission
    document.getElementById('filterForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const params = new URLSearchParams(new FormData(this));
        window.location.href = "{{ route('admin.users.index') }}?" + params.toString();
    });
});
</script>
@endpush

{{-- @extends('layouts.admin')

@section('content')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.css" rel="stylesheet">
<style>
    .filter-container {
        background-color: #fff;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }
    .filter-container .form-control,
    .filter-container .form-select {
        border-radius: 8px;
    }
    .filter-container button {
        border-radius: 8px;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.all.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        // تأكيد الحذف مع SweetAlert2
        $('.delete-btn').click(function(e) {
            e.preventDefault();
            var form = $(this).closest('form');

            Swal.fire({
                title: 'هل أنت متأكد؟',
                text: "لا يمكنك التراجع عن هذا الإجراء!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'نعم، احذف!',
                cancelButtonText: 'إلغاء',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });

        // فلترة البيانات
        $('#filterForm').submit(function(e) {
            e.preventDefault();
            window.location.href = "{{ route('admin.users.index') }}?" + $(this).serialize();
        });
    });
</script>
@endpush

<div class="container-fluid" style="padding-right: 270px; padding-top: 20px;">
    <div class="content" style="background: #f4f6f9; padding: 30px; min-height: 100vh; direction: rtl;">
        <h1 class="text-center fw-bold text-primary mb-5">إدارة المستخدمين</h1>

        <!-- عرض رسائل التنبيه -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- فلتر البيانات -->
        <div class="filter-container mb-4">
            <form id="filterForm">
                <div class="row g-3">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="ابحث بالاسم أو البريد..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-4">
                        <select name="role" class="form-select">
                            <option value="">كل الأدوار</option>
                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>مشرف</option>
                            <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>مستخدم</option>
                        </select>
                    </div>
                    <div class="col-md-4 d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-filter"></i> تصفية
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="bg-white p-4 rounded-4 shadow-sm">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered text-center align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>الرقم</th>
                            <th>الاسم الكامل</th>
                            <th>البريد الإلكتروني</th>
                            <th>رقم الهاتف</th>
                            <th>الدور الوظيفي</th>
                            <th>تاريخ التسجيل</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>

                    <tbody id="usersTableBody">
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>
                                @if($user->role == 'admin')
                                    <span class="badge bg-primary">مشرف</span>
                                @else
                                    <span class="badge bg-secondary">مستخدم</span>
                                @endif
                            </td>
                            <td>{{ $user->created_at->format('Y-m-d') }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> تعديل
                                    </a>

                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger delete-btn">
                                            <i class="fas fa-trash"></i> حذف
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('admin.users.create') }}" class="btn btn-success btn-lg fw-bold">
                    <i class="fas fa-user-plus"></i> إضافة مستخدم جديد
                </a>
            </div>
        </div>
    </div>
</div>

@endsection --}}
