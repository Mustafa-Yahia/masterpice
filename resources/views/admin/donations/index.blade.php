@extends('layouts.admin')

@section('content')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.net/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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

    .table-striped tbody tr:nth-child(odd) {
        background-color: #f2f2f2;
    }

    .table-striped tbody tr:nth-child(even) {
        background-color: #ffffff;
    }

    .table td, .table th {
        vertical-align: middle;
        padding: 12px 15px;
    }

    .table-bordered th, .table-bordered td {
        border: 1px solid #dee2e6;
    }

    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
    }

    .table th {
        font-size: 1.1rem;
        font-weight: bold;
        background-color: #007bff;
        color: white;
    }

    .table .btn {
        font-size: 0.9rem;
        padding: 6px 12px;
        border-radius: 4px;
    }

    .table .btn-info {
        background-color: #17a2b8;
        color: white;
    }

    .table .btn-warning {
        background-color: #ffc107;
        color: white;
    }

    .table .btn-danger {
        background-color: #dc3545;
        color: white;
    }

    .table .btn:hover {
        opacity: 0.8;
    }

    .table th, .table td {
        padding-left: 20px;
        padding-right: 20px;
    }

    /* تنسيق الأيقونات بجانب النص */
    .btn i {
        margin-right: 8px; /* إضافة مسافة بين الأيقونة والنص */
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.all.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        $('.delete-form').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
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
                    form.submit();
                }
            });
        });
    });
</script>
@endpush

<div class="container-fluid" style="padding-right: 270px; padding-top: 20px;">
    @include('admin.sidebar')

    <div class="content" style="background: #f4f6f9; padding: 30px; min-height: 100vh; direction: rtl;">
        <h1 class="text-center fw-bold text-primary mb-5">إدارة التبرعات</h1>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover text-center align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>الرقم</th>
                        <th>العنوان</th>
                        <th>المبلغ المجموع</th>
                        <th>الهدف المجموع</th>
                        <th>مسؤول</th>
                        <th>البريد الإلكتروني للمسؤول</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($donations as $donation)
                    <tr>
                        <td>{{ $donation->id }}</td>
                        <td>{{ $donation->title }}</td>
                        <td>${{ number_format($donation->raised_amount, 2) }}</td>
                        <td>${{ number_format($donation->goal_amount, 2) }}</td>
                        <td>{{ $donation->responsible_person_name }}</td>
                        <td>{{ $donation->responsible_person_email }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <!-- زر عرض التفاصيل -->
                                <a href="{{ route('admin.donations.show', $donation->id) }}" class="btn btn-sm btn-info d-flex align-items-center">
                                    <i class="fas fa-eye me-1"></i> عرض
                                </a>

                                <!-- زر تعديل -->
                                <a href="{{ route('admin.donations.edit', $donation->id) }}" class="btn btn-sm btn-warning d-flex align-items-center">
                                    <i class="fas fa-edit me-1"></i> تعديل
                                </a>

                                <!-- زر حذف -->
                                <form action="{{ route('admin.donations.destroy', $donation->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger d-flex align-items-center">
                                        <i class="fas fa-trash me-1"></i> حذف
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
            <a href="{{ route('admin.donations.create') }}" class="btn btn-success btn-lg fw-bold">
                <i class="fas fa-plus"></i> إضافة تبرع جديد
            </a>
        </div>
    </div>
</div>

@endsection
