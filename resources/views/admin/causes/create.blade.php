@extends('layouts.admin')

@section('content')
@push('styles')
<!-- Bootstrap RTL -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<!-- Summernote Editor -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<!-- Custom Styles -->
<style>
    .form-container {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        padding: 30px;
    }
    .form-label {
        font-weight: 600;
        margin-bottom: 8px;
    }
    .required-field::after {
        content: " *";
        color: red;
    }
    .image-preview {
        max-width: 200px;
        max-height: 200px;
        margin-top: 10px;
        display: none;
    }
</style>
@endpush

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="form-container">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold text-primary">
                        <i class="fas fa-plus-circle me-2"></i>إضافة حملة جديدة
                    </h2>
                    <a href="{{ route('admin.causes.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>رجوع
                    </a>
                </div>

                <form action="{{ route('admin.causes.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <!-- العنوان -->
                        <div class="col-md-6 mb-4">
                            <label for="title" class="form-label required-field">عنوان الحملة</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                   id="title" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- الفئة -->
                        <div class="col-md-6 mb-4">
                            <label for="category" class="form-label">الفئة</label>
                            <select class="form-select @error('category') is-invalid @enderror" id="category" name="category">
                                <option value="">اختر الفئة</option>
                                <option value="medical" {{ old('category') == 'medical' ? 'selected' : '' }}>طبية</option>
                                <option value="education" {{ old('category') == 'education' ? 'selected' : '' }}>تعليمية</option>
                                <option value="social" {{ old('category') == 'social' ? 'selected' : '' }}>اجتماعية</option>
                                <option value="emergency" {{ old('category') == 'emergency' ? 'selected' : '' }}>طارئة</option>
                            </select>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- المبلغ المجموع -->
                        <div class="col-md-6 mb-4">
                            <label for="raised_amount" class="form-label required-field">المبلغ المجموع ($)</label>
                            <input type="number" step="0.01" class="form-control @error('raised_amount') is-invalid @enderror"
                                   id="raised_amount" name="raised_amount" value="{{ old('raised_amount', 0) }}" required>
                            @error('raised_amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- الهدف المطلوب -->
                        <div class="col-md-6 mb-4">
                            <label for="goal_amount" class="form-label required-field">الهدف المطلوب ($)</label>
                            <input type="number" step="0.01" class="form-control @error('goal_amount') is-invalid @enderror"
                                   id="goal_amount" name="goal_amount" value="{{ old('goal_amount') }}" required>
                            @error('goal_amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- تاريخ الانتهاء -->
                        <div class="col-md-6 mb-4">
                            <label for="end_date" class="form-label required-field">تاريخ الانتهاء</label>
                            <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                                   id="end_date" name="end_date" value="{{ old('end_date') }}" required>
                            @error('end_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- الموقع -->
                        <div class="col-md-6 mb-4">
                            <label for="location" class="form-label">الموقع</label>
                            <input type="text" class="form-control @error('location') is-invalid @enderror"
                                   id="location" name="location" value="{{ old('location') }}">
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- صورة الحملة -->
                        <div class="col-12 mb-4">
                            <label for="image" class="form-label">صورة الحملة</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror"
                                   id="image" name="image" accept="image/*" onchange="previewImage(this)">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <img id="imagePreview" class="image-preview img-thumbnail" alt="معاينة الصورة">
                        </div>

                        <!-- الوصف -->
                        <div class="col-12 mb-4">
                            <label for="description" class="form-label required-field">الوصف</label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- التفاصيل الإضافية -->
                        <div class="col-12 mb-4">
                            <label for="additional_details" class="form-label">تفاصيل إضافية</label>
                            <textarea class="form-control @error('additional_details') is-invalid @enderror"
                                      id="additional_details" name="additional_details" rows="3">{{ old('additional_details') }}</textarea>
                            @error('additional_details')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- مسؤول الحملة -->
                        <div class="col-md-6 mb-4">
                            <label for="responsible_person_name" class="form-label required-field">اسم المسؤول</label>
                            <input type="text" class="form-control @error('responsible_person_name') is-invalid @enderror"
                                   id="responsible_person_name" name="responsible_person_name" value="{{ old('responsible_person_name') }}" required>
                            @error('responsible_person_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="responsible_person_email" class="form-label required-field">بريد المسؤول</label>
                            <input type="email" class="form-control @error('responsible_person_email') is-invalid @enderror"
                                   id="responsible_person_email" name="responsible_person_email" value="{{ old('responsible_person_email') }}" required>
                            @error('responsible_person_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save me-2"></i>حفظ الحملة
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<!-- Summernote Editor -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<!-- Arabic Language for Summernote -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/lang/summernote-ar-AR.min.js"></script>

<script>
    // معاينة الصورة
    function previewImage(input) {
        const preview = document.getElementById('imagePreview');
        const file = input.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }

        if (file) {
            reader.readAsDataURL(file);
        }
    }

    // تفعيل محرر النصوص للوصف
    $(document).ready(function() {
        $('#description').summernote({
            lang: 'ar-AR',
            height: 200,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        // تفعيل محرر النصوص للتفاصيل الإضافية
        $('#additional_details').summernote({
            lang: 'ar-AR',
            height: 150,
            toolbar: [
                ['style', ['bold', 'italic', 'underline']],
                ['para', ['ul', 'ol']],
                ['view', ['codeview']]
            ]
        });
    });
</script>
@endpush

@endsection
