<!-- resources/views/designer/dashboard.blade.php -->
@extends('layouts.designer')

@section('title', 'لوحة تحكم المصمم')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="fw-bold"><i class="fas fa-tachometer-alt me-2"></i>لوحة التحكم</h2>
            <p class="text-muted">مرحباً بك {{ Auth::user()->name }}, لديك 3 مشاريع قيد التنفيذ</p>
        </div>
    </div>

    <div class="row">
        <!-- إحصائيات سريعة -->
        <div class="col-md-4">
            <div class="card designer-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">المشاريع النشطة</h6>
                            <h3 class="mb-0">5</h3>
                        </div>
                        <div class="bg-primary bg-opacity-10 p-3 rounded">
                            <i class="fas fa-paint-brush text-primary fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card designer-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">العملاء</h6>
                            <h3 class="mb-0">12</h3>
                        </div>
                        <div class="bg-success bg-opacity-10 p-3 rounded">
                            <i class="fas fa-users text-success fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card designer-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">المهام المكتملة</h6>
                            <h3 class="mb-0">24</h3>
                        </div>
                        <div class="bg-info bg-opacity-10 p-3 rounded">
                            <i class="fas fa-check-circle text-info fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- مشاريع حالية -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card designer-card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-tasks me-2"></i>مشاريعي الحالية</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>اسم المشروع</th>
                                    <th>العميل</th>
                                    <th>تاريخ التسليم</th>
                                    <th>الحالة</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>تصميم شعار جديد</td>
                                    <td>شركة التقنية</td>
                                    <td>15/10/2023</td>
                                    <td><span class="badge bg-warning text-dark">قيد العمل</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">عرض</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>واجهة موقع إلكتروني</td>
                                    <td>متجر إلكتروني</td>
                                    <td>25/10/2023</td>
                                    <td><span class="badge bg-info">قيد المراجعة</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">عرض</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>تصميم بروشور</td>
                                    <td>مطعم الأصالة</td>
                                    <td>05/11/2023</td>
                                    <td><span class="badge bg-secondary">لم يبدأ</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">عرض</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- المهام القادمة -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card designer-card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-calendar-alt me-2"></i>المهام القادمة</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            اجتماع مع عميل جديد
                            <span class="badge bg-primary rounded-pill">غداً 10 ص</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            تسليم النسخة الأولى من التصميم
                            <span class="badge bg-danger rounded-pill">بعد غد</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            تحديث ملف المحفظة
                            <span class="badge bg-success rounded-pill">هذا الأسبوع</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- إحصائيات سريعة -->
        <div class="col-md-6">
            <div class="card designer-card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i>إحصائيات سريعة</h5>
                </div>
                <div class="card-body">
                    <canvas id="statsChart" height="200"></canvas>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const ctx = document.getElementById('statsChart').getContext('2d');
                            new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو'],
                                    datasets: [{
                                        label: 'مشاريع مكتملة',
                                        data: [12, 19, 3, 5, 2],
                                        backgroundColor: 'rgba(108, 92, 231, 0.7)',
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
