@extends('layouts.admin')

@section('content')
<div class="container-fluid" style="padding-top: 20px;">
    <div class="row">
        <!-- Main content -->
        <div class="col-md-9 col-lg-10" style="margin-right: 250px; padding-left: 30px;">
            <div class="content" style="background: #f9fafb; padding: 30px; min-height: 100vh; direction: rtl;">
                <h1 class="text-center fw-bold text-primary mb-5">إدارة الحملات</h1>

                <!-- فلتر البحث -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0"><i class="fas fa-filter"></i> فلاتر البحث</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.causes.index') }}" method="GET" id="filter-form">
                            <div class="row">
                                <!-- حقل البحث العام -->
                                <div class="col-md-4 mb-3">
                                    <label for="search" class="form-label">بحث عام</label>
                                    <input type="text" class="form-control" id="search" name="search"
                                           value="{{ request('search') }}" placeholder="ابحث بالعنوان أو الوصف...">
                                </div>

                                <!-- فلتر حسب المبلغ -->
                                <div class="col-md-4 mb-3">
                                    <label for="amount_range" class="form-label">نطاق المبلغ المجموع</label>
                                    <select class="form-select" id="amount_range" name="amount_range">
                                        <option value="">الكل</option>
                                        <option value="0-1000" {{ request('amount_range') == '0-1000' ? 'selected' : '' }}>0 - 1,000 $</option>
                                        <option value="1000-5000" {{ request('amount_range') == '1000-5000' ? 'selected' : '' }}>1,000 - 5,000 $</option>
                                        <option value="5000-10000" {{ request('amount_range') == '5000-10000' ? 'selected' : '' }}>5,000 - 10,000 $</option>
                                        <option value="10000+" {{ request('amount_range') == '10000+' ? 'selected' : '' }}>أكثر من 10,000 $</option>
                                    </select>
                                </div>

                                <!-- فلتر حسب حالة الحملة -->
                                <div class="col-md-4 mb-3">
                                    <label for="status" class="form-label">حالة الحملة</label>
                                    <select class="form-select" id="status" name="status">
                                        <option value="">الكل</option>
                                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>نشطة</option>
                                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>مكتملة</option>
                                        <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>منتهية</option>
                                    </select>
                                </div>

                                <!-- فلتر حسب التاريخ -->
                                <div class="col-md-6 mb-3">
                                    <label for="start_date" class="form-label">من تاريخ</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date"
                                           value="{{ request('start_date') }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="end_date" class="form-label">إلى تاريخ</label>
                                    <input type="date" class="form-control" id="end_date" name="end_date"
                                           value="{{ request('end_date') }}">
                                </div>

                                <!-- أزرار الفلتر -->
                                <div class="col-12">
                                    <div class="d-flex justify-content-between">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-search"></i> تطبيق الفلتر
                                        </button>
                                        <a href="{{ route('admin.causes.index') }}" class="btn btn-outline-secondary">
                                            <i class="fas fa-times"></i> إعادة التعيين
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- To center the table -->
                <div class="d-flex justify-content-center">
                    <div class="table-responsive" style="max-width: 1200px; width: 100%;">
                        <table class="table table-striped table-bordered table-hover text-center align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>الرقم</th>
                                    <th>العنوان</th>
                                    <th>المبلغ المجموع</th>
                                    <th>الهدف المطلوب</th>
                                    <th>حالة الحملة</th>
                                    <th>مسؤول الحملة</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($causes as $cause)
                                    <tr>
                                        <td>{{ $cause->id }}</td>
                                        <td>{{ $cause->title }}</td>
                                        <td>${{ number_format($cause->raised_amount, 2) }}</td>
                                        <td>${{ number_format($cause->goal_amount, 2) }}</td>
                                        <td>
                                            @if($cause->raised_amount >= $cause->goal_amount)
                                                <span class="badge bg-success">مكتملة</span>
                                            @elseif($cause->end_date < now())
                                                <span class="badge bg-danger">منتهية</span>
                                            @else
                                                <span class="badge bg-primary">نشطة</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-start">
                                                <span>{{ $cause->responsible_person_name }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="{{ route('admin.causes.show', $cause->id) }}" class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i> عرض
                                                </a>

                                                <a href="{{ route('admin.causes.edit', $cause->id) }}" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i> تعديل
                                                </a>

                                                <form action="{{ route('admin.causes.destroy', $cause->id) }}" method="POST" class="d-inline delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i> حذف
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">لا توجد حملات حالياً.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <!-- الترقيم -->
                        @if($causes->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            {{ $causes->appends(request()->query())->links() }}
                        </div>
                        @endif
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('admin.causes.create') }}" class="btn btn-success btn-lg fw-bold">
                        <i class="fas fa-plus"></i> إضافة حملة جديدة
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // تأكيد الحذف
        const deleteForms = document.querySelectorAll('.delete-form');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'هل أنت متأكد؟',
                    text: "لا يمكنك التراجع عن هذا القرار!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
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

        // فلتر تلقائي عند تغيير بعض الحقول
        const autoFilterFields = ['amount_range', 'status'];
        autoFilterFields.forEach(field => {
            document.getElementById(field).addEventListener('change', function() {
                document.getElementById('filter-form').submit();
            });
        });
    });
</script>
@endpush

@endsection
