@extends('layouts.admin')

@section('content')
<div class="admin-container">
    @include('admin.sidebar')

    <div class="admin-content">
        <!-- Header Section -->
        <div class="content-header">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="page-title">
                    <i class="fas fa-calendar-plus"></i> إنشاء حدث جديد
                </h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.events.index') }}">الأحداث</a></li>
                        <li class="breadcrumb-item active" aria-current="page">إنشاء جديد</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Create Event Form -->
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">معلومات الحدث الأساسية</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" id="eventForm">
                    @csrf

                    <div class="row g-3">
                        <!-- Title -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="title" class="form-label">عنوان الحدث <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                       id="title" name="title" value="{{ old('title') }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description" class="form-label">وصف الحدث <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                          id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Date & Time -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="date" class="form-label">تاريخ البدء <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('date') is-invalid @enderror"
                                       id="date" name="date" value="{{ old('date') }}" min="{{ date('Y-m-d') }}" required>
                                @error('date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="time" class="form-label">وقت البدء <span class="text-danger">*</span></label>
                                <input type="time" class="form-control @error('time') is-invalid @enderror"
                                       id="time" name="time" value="{{ old('time') }}" required>
                                @error('time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="end_time" class="form-label">وقت الانتهاء <span class="text-danger">*</span></label>
                                <input type="time" class="form-control @error('end_time') is-invalid @enderror"
                                       id="end_time" name="end_time" value="{{ old('end_time') }}" required>
                                @error('end_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Location -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="location" class="form-label">الموقع <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('location') is-invalid @enderror"
                                       id="location" name="location" value="{{ old('location') }}" required>
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Location URL -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="location_url" class="form-label">رابط الموقع (خرائط) <span class="text-danger">*</span></label>
                                <input type="url" class="form-control @error('location_url') is-invalid @enderror"
                                       id="location_url" name="location_url" value="{{ old('location_url') }}" placeholder="https://maps.google.com/..." required>
                                @error('location_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Coordinates -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="latitude" class="form-label">خط العرض <span class="text-danger">*</span></label>
                                <input type="number" step="any" class="form-control @error('latitude') is-invalid @enderror"
                                       id="latitude" name="latitude" value="{{ old('latitude') }}" required>
                                @error('latitude')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="longitude" class="form-label">خط الطول <span class="text-danger">*</span></label>
                                <input type="number" step="any" class="form-control @error('longitude') is-invalid @enderror"
                                       id="longitude" name="longitude" value="{{ old('longitude') }}" required>
                                @error('longitude')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Volunteers -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="volunteers_needed" class="form-label">عدد المتطوعين المطلوب <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('volunteers_needed') is-invalid @enderror"
                                       id="volunteers_needed" name="volunteers_needed" value="{{ old('volunteers_needed', 1) }}" min="1" required>
                                @error('volunteers_needed')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Image Upload -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="image" class="form-label">صورة الحدث <span class="text-danger">*</span></label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                       id="image" name="image" accept="image/*" required>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">الصيغ المسموحة: JPEG, PNG, JPG - الحد الأقصى للحجم: 2MB</small>
                            </div>
                        </div>

                        <!-- Mission -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="mission" class="form-label">الهدف الرئيسي <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('mission') is-invalid @enderror"
                                          id="mission" name="mission" rows="2" required>{{ old('mission') }}</textarea>
                                @error('mission')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Mission Points -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mission_point_1" class="form-label">نقطة المهمة 1 <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('mission_point_1') is-invalid @enderror"
                                       id="mission_point_1" name="mission_point_1" value="{{ old('mission_point_1') }}" required>
                                @error('mission_point_1')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mission_point_2" class="form-label">نقطة المهمة 2 <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('mission_point_2') is-invalid @enderror"
                                       id="mission_point_2" name="mission_point_2" value="{{ old('mission_point_2') }}" required>
                                @error('mission_point_2')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mission_point_3" class="form-label">نقطة المهمة 3 <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('mission_point_3') is-invalid @enderror"
                                       id="mission_point_3" name="mission_point_3" value="{{ old('mission_point_3') }}" required>
                                @error('mission_point_3')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-12">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times me-2"></i> إلغاء
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i> حفظ الحدث
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
:root {
    --primary-color: #3cc88f;
    --primary-hover: #34b181;
}

.form-label {
    font-weight: 500;
    margin-bottom: 0.5rem;
}

.form-control {
    border-radius: 0.375rem;
}

.card {
    border: none;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}

.btn-primary {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
}

.btn-primary:hover {
    background-color: var(--primary-hover);
    border-color: var(--primary-hover);
}

.page-title {
    color: var(--primary-color);
}

.breadcrumb-item.active {
    color: var(--primary-color);
}

.invalid-feedback {
    color: #dc3545;
    font-size: 0.875rem;
}

.is-invalid {
    border-color: #dc3545;
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation
    const form = document.getElementById('eventForm');

    form.addEventListener('submit', function(e) {
        let isValid = true;
        let errorMessage = '';

        // Check required fields
        const requiredFields = form.querySelectorAll('[required]');
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('is-invalid');
                isValid = false;
                const fieldName = field.closest('.form-group').querySelector('.form-label').textContent.trim();
                errorMessage += `- ${fieldName} مطلوب<br>`;
            } else {
                field.classList.remove('is-invalid');
            }
        });

        // Validate image file
        const imageInput = document.getElementById('image');
        if (imageInput.files.length > 0) {
            const file = imageInput.files[0];
            const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];

            if (!validTypes.includes(file.type)) {
                imageInput.classList.add('is-invalid');
                isValid = false;
                errorMessage += '- نوع الملف غير مسموح به (يجب أن يكون صورة)<br>';
            }

            if (file.size > 2 * 1024 * 1024) {
                imageInput.classList.add('is-invalid');
                isValid = false;
                errorMessage += '- حجم الصورة يجب أن لا يتجاوز 2MB<br>';
            }
        }

        // Validate URL format
        const urlInput = document.getElementById('location_url');
        if (urlInput.value && !/^https?:\/\/.+\..+/.test(urlInput.value)) {
            urlInput.classList.add('is-invalid');
            isValid = false;
            errorMessage += '- رابط الموقع غير صحيح<br>';
        }

        if (!isValid) {
            e.preventDefault();
            Swal.fire({
                title: 'خطأ في الإدخال',
                html: errorMessage || 'الرجاء تعبئة جميع الحقول المطلوبة بشكل صحيح',
                icon: 'error',
                confirmButtonColor: '#3cc88f',
                confirmButtonText: 'حسناً',
                customClass: {
                    popup: 'text-right'
                }
            });
        }
    });

    // Show success message if exists
    @if(session('success'))
    Swal.fire({
        title: 'تم بنجاح!',
        text: '{{ session('success') }}',
        icon: 'success',
        confirmButtonColor: '#3cc88f',
        confirmButtonText: 'حسناً',
        customClass: {
            popup: 'text-right'
        }
    });
    @endif

    // Show error message if exists
    @if($errors->any())
    Swal.fire({
        title: 'خطأ!',
        html: `@foreach ($errors->all() as $error)
                <div>- {{ $error }}</div>
              @endforeach`,
        icon: 'error',
        confirmButtonColor: '#3cc88f',
        confirmButtonText: 'حسناً',
        customClass: {
            popup: 'text-right'
        }
    });
    @endif
});
</script>
@endpush
