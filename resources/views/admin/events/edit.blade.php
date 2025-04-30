@extends('layouts.admin')

@section('content')
@if(!isset($event))
    <div class="alert alert-danger">حدث خطأ: لم يتم العثور على الحدث المطلوب</div>
@else
<div class="container-fluid" style="padding-top: 20px;">
    <div class="row">
        <div class="col-md-9 col-lg-10" style="margin-right: 250px; padding-left: 30px;">
            <div class="content" style="background: #f9fafb; padding: 30px; min-height: 100vh; direction: rtl;">
                <h1 class="text-center fw-bold text-primary mb-5">تعديل الحدث</h1>

                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">تفاصيل الحدث</h5>
                    </div>
                    <div class="card-body">
                        <form id="editEventForm" action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="id" value="{{ $event->id }}">

                            <div class="row">
                                <!-- العنوان -->
                                <div class="col-md-6 mb-3">
                                    <label for="title" class="form-label">عنوان الحدث <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="title" name="title"
                                           value="{{ old('title', $event->title) }}" required>
                                </div>

                                <!-- الوصف -->
                                <div class="col-md-6 mb-3">
                                    <label for="description" class="form-label">الوصف <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="description" name="description"
                                              rows="1" required>{{ old('description', $event->description) }}</textarea>
                                </div>

                                <!-- التاريخ والوقت -->
                                <div class="col-md-3 mb-3">
                                    <label for="date" class="form-label">التاريخ <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="date" name="date"
                                           value="{{ old('date', $event->date ? \Carbon\Carbon::parse($event->date)->format('Y-m-d') : '') }}" required>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="time" class="form-label">الوقت <span class="text-danger">*</span></label>
                                    <input type="time" class="form-control" id="time" name="time"
                                           value="{{ old('time', $event->time) }}" required>
                                </div>

                                <!-- الموقع -->
                                <div class="col-md-6 mb-3">
                                    <label for="location" class="form-label">الموقع <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="location" name="location"
                                           value="{{ old('location', $event->location) }}" required>
                                </div>

                                <!-- رابط الموقع -->
                                <div class="col-md-6 mb-3">
                                    <label for="location_url" class="form-label">رابط الموقع</label>
                                    <input type="url" class="form-control" id="location_url" name="location_url"
                                           value="{{ old('location_url', $event->location_url) }}">
                                </div>

                                <!-- الإحداثيات -->
                                <div class="col-md-3 mb-3">
                                    <label for="latitude" class="form-label">خط العرض</label>
                                    <input type="number" step="0.000001" class="form-control" id="latitude" name="latitude"
                                           value="{{ old('latitude', $event->latitude) }}">
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="longitude" class="form-label">خط الطول</label>
                                    <input type="number" step="0.000001" class="form-control" id="longitude" name="longitude"
                                           value="{{ old('longitude', $event->longitude) }}">
                                </div>

                                <!-- عدد المتطوعين -->
                                <div class="col-md-3 mb-3">
                                    <label for="volunteers_needed" class="form-label">عدد المتطوعين المطلوبين <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="volunteers_needed" name="volunteers_needed"
                                           value="{{ old('volunteers_needed', $event->volunteers_needed) }}" min="1" required>
                                </div>

                                <!-- Image Upload -->
                                <div class="col-md-6 mb-3">
                                    <label for="image" class="form-label">صورة الحدث</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                    @if($event->image)
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/' . $event->image) }}" alt="Event Image" style="max-width: 200px;">
                                        </div>
                                    @endif
                                </div>

                                <!-- Mission Fields -->
                                <div class="col-md-6 mb-3">
                                    <label for="mission" class="form-label">المهمة <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="mission" name="mission" required>{{ old('mission', $event->mission) }}</textarea>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="mission_point_1" class="form-label">نقطة المهمة 1</label>
                                    <input type="text" class="form-control" id="mission_point_1" name="mission_point_1"
                                           value="{{ old('mission_point_1', $event->mission_point_1) }}">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="mission_point_2" class="form-label">نقطة المهمة 2</label>
                                    <input type="text" class="form-control" id="mission_point_2" name="mission_point_2"
                                           value="{{ old('mission_point_2', $event->mission_point_2) }}">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="mission_point_3" class="form-label">نقطة المهمة 3</label>
                                    <input type="text" class="form-control" id="mission_point_3" name="mission_point_3"
                                           value="{{ old('mission_point_3', $event->mission_point_3) }}">
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> رجوع
                                </a>
                                <button type="submit" class="btn btn-primary" id="submitBtn">
                                    <i class="fas fa-save"></i> حفظ التعديلات
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('editEventForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const form = this;
        const submitBtn = document.getElementById('submitBtn');

        // التحقق من صحة النموذج قبل عرض SweetAlert
        if (!form.checkValidity()) {
            form.classList.add('was-validated');
            return;
        }

        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري الحفظ...';

        Swal.fire({
            title: 'تأكيد التعديل',
            text: "هل أنت متأكد من أنك تريد حفظ التعديلات؟",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'نعم، احفظ التعديلات',
            cancelButtonText: 'إلغاء',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // إرسال النموذج إذا تم التأكيد
                form.submit();
            } else {
                // إعادة تمكين الزر إذا تم الإلغاء
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fas fa-save"></i> حفظ التعديلات';
            }
        });
    });

    // عرض رسائل SweetAlert من الجلسة
    @if(session('swal'))
        Swal.fire({
            icon: '{{ session('swal')['icon'] }}',
            title: '{{ session('swal')['title'] }}',
            text: '{{ session('swal')['text'] }}',
            confirmButtonText: 'حسناً',
            timer: 3000
        });
    @endif
</script>
@endsection
