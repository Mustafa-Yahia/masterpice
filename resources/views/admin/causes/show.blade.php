@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">تفاصيل الحملة</h4>
                        <a href="{{ route('admin.causes.index') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left"></i> رجوع
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <!-- الصورة -->
                        <div class="col-md-4 mb-4">
                            @if($cause->image)
                                <img src="{{ asset('storage/' . $cause->image) }}" alt="صورة الحملة" class="img-fluid rounded">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                    <span class="text-muted">لا توجد صورة</span>
                                </div>
                            @endif
                        </div>

                        <!-- التفاصيل -->
                        <div class="col-md-8">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th width="30%" class="bg-light">العنوان</th>
                                            <td>{{ $cause->title }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">الوصف</th>
                                            <td>{{ $cause->description }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">المبلغ المجموع</th>
                                            <td>${{ number_format($cause->raised_amount, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">الهدف المطلوب</th>
                                            <td>${{ number_format($cause->goal_amount, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">الفئة</th>
                                            <td>{{ $cause->category ?? 'غير محدد' }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">الموقع</th>
                                            <td>{{ $cause->location ?? 'غير محدد' }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">مسؤول الحملة</th>
                                            <td>{{ $cause->responsible_person_name }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">بريد المسؤول</th>
                                            <td>{{ $cause->responsible_person_email }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">تفاصيل إضافية</th>
                                            <td>{{ $cause->additional_details ?? 'لا توجد تفاصيل إضافية' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-end mt-3">
                                <a href="{{ route('admin.causes.edit', $cause->id) }}" class="btn btn-warning mx-2">
                                    <i class="fas fa-edit"></i> تعديل
                                </a>

                                <form action="{{ route('admin.causes.destroy', $cause->id) }}" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash"></i> حذف
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
