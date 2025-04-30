@extends('layouts.admin')

@section('content')
<div class="container-fluid" style="padding-top: 20px;">
    <div class="row">
        <div class="col-md-9 col-lg-10" style="margin-right: 250px; padding-left: 30px;">
            <div class="content" style="background: #f9fafb; padding: 30px; min-height: 100vh; direction: rtl;">
                <h1 class="text-center fw-bold text-primary mb-5">إضافة حدث جديد</h1>

                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">تفاصيل الحدث</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <!-- العنوان -->
                                <div class="col-md-6 mb-3">
                                    <label for="title" class="form-label">عنوان الحدث <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>

                                <!-- الوصف -->
                                <div class="col-md-6 mb-3">
                                    <label for="description" class="form-label">الوصف <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="description" name="description" rows="1" required></textarea>
                                </div>

                                <!-- التاريخ والوقت -->
                                <div class="col-md-3 mb-3">
                                    <label for="date" class="form-label">التاريخ <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="date" name="date" required>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="time" class="form-label">الوقت <span class="text-danger">*</span></label>
                                    <input type="time" class="form-control" id="time" name="time" required>
                                </div>

                                <!-- الموقع -->
                                <div class="col-md-6 mb-3">
                                    <label for="location" class="form-label">الموقع <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="location" name="location" required>
                                </div>

                                <!-- رابط الموقع -->
                                <div class="col-md-6 mb-3">
                                    <label for="location_url" class="form-label">رابط الموقع (اختياري)</label>
                                    <input type="url" class="form-control" id="location_url" name="location_url">
                                </div>

                                <!-- خطوط الطول والعرض -->
                                <div class="col-md-3 mb-3">
                                    <label for="latitude" class="form-label">خط العرض (اختياري)</label>
                                    <input type="text" class="form-control" id="latitude" name="latitude">
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="longitude" class="form-label">خط الطول (اختياري)</label>
                                    <input type="text" class="form-control" id="longitude" name="longitude">
                                </div>

                                <!-- عدد المتطوعين المطلوب -->
                                <div class="col-md-6 mb-3">
                                    <label for="volunteers_needed" class="form-label">عدد المتطوعين المطلوب <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="volunteers_needed" name="volunteers_needed" min="1" required>
                                </div>

                                <!-- الصورة -->
                                <div class="col-md-6 mb-3">
                                    <label for="image" class="form-label">صورة الحدث <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                                </div>

                                <!-- المهمة -->
                                <div class="col-md-12 mb-3">
                                    <label for="mission" class="form-label">المهمة الرئيسية <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="mission" name="mission" rows="2" required></textarea>
                                </div>

                                <!-- نقاط المهمة -->
                                <div class="col-md-4 mb-3">
                                    <label for="mission_point_1" class="form-label">نقطة المهمة 1 (اختياري)</label>
                                    <input type="text" class="form-control" id="mission_point_1" name="mission_point_1">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="mission_point_2" class="form-label">نقطة المهمة 2 (اختياري)</label>
                                    <input type="text" class="form-control" id="mission_point_2" name="mission_point_2">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="mission_point_3" class="form-label">نقطة المهمة 3 (اختياري)</label>
                                    <input type="text" class="form-control" id="mission_point_3" name="mission_point_3">
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> رجوع
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> حفظ الحدث
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
