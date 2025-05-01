@extends('layouts.admin')

@section('content')
<div class="container-fluid" style="padding-top: 20px;">
    <div class="row">
        <!-- Main content -->
        <div class="col-md-9 col-lg-10" style="margin-right: 250px; padding-left: 30px;">
            <div class="content" style="background: #f9fafb; padding: 30px; min-height: 100vh; direction: rtl;">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title mb-0">
                            <i class="fas fa-plus-circle"></i> إضافة حملة تبرعات جديدة
                        </h3>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.causes.store') }}" method="POST" enctype="multipart/form-data" id="create-cause-form">
                            @csrf

                            <div class="row">
                                <!-- معلومات أساسية -->
                                <div class="col-md-12 mb-4">
                                    <h5 class="text-primary border-bottom pb-2 mb-3">
                                        <i class="fas fa-info-circle"></i> المعلومات الأساسية
                                    </h5>

                                    <div class="row">
                                        <!-- عنوان الحملة -->
                                        <div class="col-md-6 mb-3">
                                            <label for="title" class="form-label">عنوان الحملة <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                                   id="title" name="title" value="{{ old('title') }}" required>
                                            @error('title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- الفئة -->
                                        <div class="col-md-6 mb-3">
                                            <label for="category" class="form-label">الفئة</label>
                                            <input type="text" class="form-control @error('category') is-invalid @enderror"
                                                   id="category" name="category" value="{{ old('category') }}">
                                            @error('category')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- الوصف -->
                                    <div class="mb-3">
                                        <label for="description" class="form-label">وصف الحملة <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('description') is-invalid @enderror"
                                                  id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- المعلومات المالية -->
                                <div class="col-md-12 mb-4">
                                    <h5 class="text-primary border-bottom pb-2 mb-3">
                                        <i class="fas fa-money-bill-wave"></i> المعلومات المالية
                                    </h5>

                                    <div class="row">
                                        <!-- المبلغ المجموع -->
                                        <div class="col-md-4 mb-3">
                                            <label for="raised_amount" class="form-label">المبلغ المجموع ($) <span class="text-danger">*</span></label>
                                            <input type="number" step="0.01" class="form-control @error('raised_amount') is-invalid @enderror"
                                                   id="raised_amount" name="raised_amount" value="{{ old('raised_amount', 0) }}" required>
                                            @error('raised_amount')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- الهدف المطلوب -->
                                        <div class="col-md-4 mb-3">
                                            <label for="goal_amount" class="form-label">الهدف المطلوب ($) <span class="text-danger">*</span></label>
                                            <input type="number" step="0.01" class="form-control @error('goal_amount') is-invalid @enderror"
                                                   id="goal_amount" name="goal_amount" value="{{ old('goal_amount') }}" required>
                                            @error('goal_amount')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- مبلغ إضافي -->
                                        <div class="col-md-4 mb-3">
                                            <label for="extra_raised_amount" class="form-label">مبلغ إضافي ($)</label>
                                            <input type="number" step="0.01" class="form-control @error('extra_raised_amount') is-invalid @enderror"
                                                   id="extra_raised_amount" name="extra_raised_amount" value="{{ old('extra_raised_amount', 0) }}">
                                            @error('extra_raised_amount')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- معلومات الموقع والمسؤول -->
                                <div class="col-md-12 mb-4">
                                    <h5 class="text-primary border-bottom pb-2 mb-3">
                                        <i class="fas fa-map-marker-alt"></i> معلومات الموقع والمسؤول
                                    </h5>

                                    <div class="row">
                                        <!-- الموقع -->
                                        <div class="col-md-6 mb-3">
                                            <label for="location" class="form-label">الموقع</label>
                                            <input type="text" class="form-control @error('location') is-invalid @enderror"
                                                   id="location" name="location" value="{{ old('location') }}">
                                            @error('location')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- اسم المسؤول -->
                                        <div class="col-md-6 mb-3">
                                            <label for="responsible_person_name" class="form-label">اسم المسؤول</label>
                                            <input type="text" class="form-control @error('responsible_person_name') is-invalid @enderror"
                                                   id="responsible_person_name" name="responsible_person_name" value="{{ old('responsible_person_name') }}">
                                            @error('responsible_person_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- بريد المسؤول -->
                                        <div class="col-md-6 mb-3">
                                            <label for="responsible_person_email" class="form-label">بريد المسؤول</label>
                                            <input type="email" class="form-control @error('responsible_person_email') is-invalid @enderror"
                                                   id="responsible_person_email" name="responsible_person_email" value="{{ old('responsible_person_email') }}">
                                            @error('responsible_person_email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- تاريخ الانتهاء -->
                                        <div class="col-md-6 mb-3">
                                            <label for="end_date" class="form-label">تاريخ الانتهاء</label>
                                            <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                                                   id="end_date" name="end_date" value="{{ old('end_date') }}">
                                            @error('end_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- الصورة -->
                                <div class="col-md-12 mb-4">
                                    <h5 class="text-primary border-bottom pb-2 mb-3">
                                        <i class="fas fa-image"></i> صورة الحملة
                                    </h5>

                                    <div class="mb-3">
                                        <label for="image" class="form-label">اختر صورة للحملة</label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror"
                                               id="image" name="image" accept="image/*">
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">سيتم حفظ الصورة في: public/storage/causes/</div>
                                    </div>

                                    <div id="image-preview" class="mt-2 text-center" style="display: none;">
                                        <img id="preview-image" src="#" alt="Preview" class="img-thumbnail" style="max-height: 200px;">
                                    </div>
                                </div>

                                <!-- تفاصيل إضافية -->
                                <div class="col-md-12 mb-4">
                                    <h5 class="text-primary border-bottom pb-2 mb-3">
                                        <i class="fas fa-ellipsis-h"></i> تفاصيل إضافية
                                    </h5>

                                    <div class="mb-3">
                                        <label for="additional_details" class="form-label">تفاصيل إضافية</label>
                                        <textarea class="form-control @error('additional_details') is-invalid @enderror"
                                                  id="additional_details" name="additional_details" rows="3">{{ old('additional_details') }}</textarea>
                                        @error('additional_details')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- أزرار الحفظ والإلغاء -->
                            <div class="d-flex justify-content-between mt-4">
                                <button type="submit" class="btn btn-success px-4 py-2">
                                    <i class="fas fa-save"></i> حفظ الحملة
                                </button>

                                <a href="{{ route('admin.causes.index') }}" class="btn btn-outline-secondary px-4 py-2">
                                    <i class="fas fa-times"></i> إلغاء
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // معاينة الصورة قبل الرفع
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('image-preview');
        const previewImage = document.getElementById('preview-image');

        if (imageInput && previewImage) {
            imageInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();

                    reader.addEventListener('load', function() {
                        previewImage.src = this.result;
                        imagePreview.style.display = 'block';
                    });

                    reader.readAsDataURL(file);
                } else {
                    imagePreview.style.display = 'none';
                }
            });
        }

        // تأكيد الحفظ
        const form = document.getElementById('create-cause-form');
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'هل أنت متأكد؟',
                    text: "سيتم إضافة الحملة الجديدة إلى النظام",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'نعم، أضف الحملة',
                    cancelButtonText: 'إلغاء',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });
        }
    });
</script>
@endpush
