@extends('layouts.admin')

@section('content')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<!-- SweetAlert2 Styles -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.css" rel="stylesheet">
<style>
    .filter-container {
        background-color: #fff;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }
    .filter-container .form-control, .filter-container .form-select {
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
<!-- SweetAlert2 Script -->

<script>
    $(document).ready(function() {
        $('.delete-form').on('submit', function(e) {
            e.preventDefault(); // Prevent the form from submitting immediately

            var form = $(this); // Store the form for later submission

            // SweetAlert confirmation
            Swal.fire({
                title: 'هل أنت متأكد؟',
                text: "لا يمكنك التراجع عن هذا القرار!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'نعم، حذف!',
                cancelButtonText: 'إلغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Submit the form if confirmed
                }
            });
        });
    });
</script>
@endpush

<div class="container-fluid" style="padding-right: 270px; padding-top: 20px;">
    @include('admin.sidebar')

    <div class="content" style="background: #f4f6f9; padding: 30px; min-height: 100vh; direction: rtl;">
        <h1 class="text-center fw-bold text-primary mb-5">إدارة المستخدمين</h1>

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
                                    <!-- إضافة أيقونات التعديل والحذف -->
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> تعديل
                                    </a>

                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
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

            <!-- زر إضافة مستخدم جديد مع أيقونة -->
            <div class="text-center mt-4">
                <a href="{{ route('admin.users.create') }}" class="btn btn-success btn-lg fw-bold">
                    <i class="fas fa-user-plus"></i> إضافة مستخدم جديد
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
