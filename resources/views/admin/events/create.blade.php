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
                                       id="title" name="title" value="{{ old('title') }}"
                                       required minlength="5" maxlength="255">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="validation-message text-muted small mt-1">
                                    <i class="fas fa-info-circle"></i> يجب أن يكون بين 5-255 حرفاً
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description" class="form-label">وصف الحدث <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                          id="description" name="description" rows="3"
                                          required minlength="20">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="validation-message text-muted small mt-1">
                                    <i class="fas fa-info-circle"></i> يجب أن يحتوي على الأقل على 20 حرفاً
                                </div>
                            </div>
                        </div>

                        <!-- Date & Time Section -->
                        <div class="col-12 mt-4">
                            <h5 class="section-title mb-3" style="color: #3cc88f">
                                <i class="fas fa-clock me-2"></i> التاريخ والوقت
                            </h5>
                            <div class="section-divider"></div>
                        </div>

                        <!-- Date -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="date" class="form-label">تاريخ البدء <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('date') is-invalid @enderror"
                                       id="date" name="date" value="{{ old('date') }}"
                                       min="{{ date('Y-m-d') }}" required>
                                @error('date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="validation-message text-muted small mt-1">
                                    <i class="fas fa-info-circle"></i> لا يمكن اختيار تاريخ ماضي
                                </div>
                            </div>
                        </div>

                        <!-- Start Time -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="time" class="form-label">وقت البدء <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control time-picker @error('time') is-invalid @enderror"
                                       id="time"
                                       name="time"
                                       value="{{ old('time') }}"
                                       placeholder="08:30 AM"
                                       required
                                       autocomplete="off">
                                @error('time')
                                    <div class="invalid-feedback">
                                        {{ $message == 'validation.regex' ? 'صيغة وقت البدء غير صالحة. استخدم مثل: 08:30 AM' : $message }}
                                    </div>
                                @enderror
                                <div class="validation-message text-muted small mt-1">
                                    <i class="fas fa-info-circle"></i> التنسيق المطلوب: ساعة:دقيقة AM/PM
                                </div>
                            </div>
                        </div>

                        <!-- End Time -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="end_time" class="form-label">وقت الانتهاء <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control time-picker @error('end_time') is-invalid @enderror"
                                       id="end_time"
                                       name="end_time"
                                       value="{{ old('end_time') }}"
                                       placeholder="05:30 PM"
                                       required
                                       autocomplete="off">
                                @error('end_time')
                                    <div class="invalid-feedback">
                                        {{ $message == 'validation.regex' ? 'صيغة وقت الانتهاء غير صالحة. استخدم مثل: 05:30 PM' : $message }}
                                    </div>
                                @enderror
                                <div class="validation-message text-muted small mt-1">
                                    <i class="fas fa-info-circle"></i> يجب أن يكون بعد وقت البدء
                                </div>
                            </div>
                        </div>

                        <!-- Location Section -->
                        <div class="col-12 mt-4">
                            <h5 class="section-title mb-3" style="color: #3cc88f">
                                <i class="fas fa-map-marker-alt me-2"></i> معلومات الموقع
                            </h5>
                            <div class="section-divider"></div>
                        </div>

                        <!-- Location -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="location" class="form-label">الموقع <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('location') is-invalid @enderror"
                                       id="location" name="location" value="{{ old('location') }}"
                                       required minlength="5" maxlength="255">
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="validation-message text-muted small mt-1">
                                    <i class="fas fa-info-circle"></i> مثال: قاعة المؤتمرات - الرياض
                                </div>
                            </div>
                        </div>

                        <!-- Location URL -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="location_url" class="form-label">رابط الموقع <span class="text-danger">*</span></label>
                                <input type="url" class="form-control @error('location_url') is-invalid @enderror"
                                       id="location_url" name="location_url"
                                       value="{{ old('location_url') }}"
                                       placeholder="https://maps.google.com/..."
                                       required pattern="https?://.+">
                                @error('location_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="validation-message text-muted small mt-1">
                                    <i class="fas fa-info-circle"></i> يجب أن يبدأ بـ http:// أو https://
                                </div>
                            </div>
                        </div>

                        <!-- Coordinates -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="latitude" class="form-label">خط العرض <span class="text-danger">*</span></label>
                                <input type="number" step="any" class="form-control @error('latitude') is-invalid @enderror"
                                       id="latitude" name="latitude" value="{{ old('latitude') }}"
                                       required min="-90" max="90">
                                @error('latitude')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="validation-message text-muted small mt-1">
                                    <i class="fas fa-info-circle"></i> يجب أن يكون بين -90 و 90
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="longitude" class="form-label">خط الطول <span class="text-danger">*</span></label>
                                <input type="number" step="any" class="form-control @error('longitude') is-invalid @enderror"
                                       id="longitude" name="longitude" value="{{ old('longitude') }}"
                                       required min="-180" max="180">
                                @error('longitude')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="validation-message text-muted small mt-1">
                                    <i class="fas fa-info-circle"></i> يجب أن يكون بين -180 و 180
                                </div>
                            </div>
                        </div>

                        <!-- Volunteers & Image Section -->
                        <div class="col-12 mt-4">
                            <h5 class="section-title mb-3" style="color: #3cc88f">
                                <i class="fas fa-users me-2"></i> المتطوعون والصورة
                            </h5>
                            <div class="section-divider"></div>
                        </div>

                        <!-- Volunteers -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="volunteers_needed" class="form-label">عدد المتطوعين <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('volunteers_needed') is-invalid @enderror"
                                       id="volunteers_needed" name="volunteers_needed"
                                       value="{{ old('volunteers_needed', 1) }}"
                                       min="1" max="1000" required>
                                @error('volunteers_needed')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="validation-message text-muted small mt-1">
                                    <i class="fas fa-info-circle"></i> يجب أن يكون بين 1 و 1000
                                </div>
                            </div>
                        </div>

                        <!-- Image Upload -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">صورة الحدث <span class="text-danger">*</span></label>
                                <div class="custom-file-upload border rounded p-3 text-center"
                                     style="border: 2px dashed #3cc88f; background-color: #f8f9fc;">
                                    <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/jpg"
                                           class="d-none @error('image') is-invalid @enderror" required>
                                    <label for="image" class="file-upload-label d-flex flex-column align-items-center justify-content-center"
                                           style="cursor: pointer; height: 100%;">
                                        <div class="file-upload-icon mb-2">
                                            <i class="fas fa-cloud-upload-alt fa-2x" style="color:#3cc88f"></i>
                                        </div>
                                        <div class="file-upload-text text-center">
                                            <h6 class="mb-1" style="font-weight: 600; color:#3cc88f">إرفاق صورة</h6>
                                            <p class="text-muted small mb-1">اضغط هنا لاختيار صورة</p>
                                            <p class="text-muted small">JPEG, PNG - الحد الأقصى 2MB</p>
                                        </div>
                                    </label>
                                    @error('image')
                                        <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div id="image-preview" class="mt-3 text-center" style="display: none;">
                                    <img id="preview-image" src="#" alt="Preview"
                                         class="img-thumbnail rounded" style="max-height: 150px; border: 1px solid #ddd;">
                                    <button type="button" id="remove-image" class="btn btn-sm btn-danger mt-2">
                                        <i class="fas fa-trash me-1"></i> إزالة الصورة
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Mission Section -->
                        <div class="col-12 mt-4">
                            <h5 class="section-title mb-3" style="color: #3cc88f">
                                <i class="fas fa-bullseye me-2"></i> أهداف الحدث
                            </h5>
                            <div class="section-divider"></div>
                        </div>

                        <!-- Mission -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="mission" class="form-label">الهدف الرئيسي <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('mission') is-invalid @enderror"
                                          id="mission" name="mission" rows="2"
                                          required minlength="10">{{ old('mission') }}</textarea>
                                @error('mission')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="validation-message text-muted small mt-1">
                                    <i class="fas fa-info-circle"></i> اكتب الهدف الرئيسي للحدث
                                </div>
                            </div>
                        </div>

                        <!-- Mission Points -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mission_point_1" class="form-label">نقطة المهمة 1 <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('mission_point_1') is-invalid @enderror"
                                       id="mission_point_1" name="mission_point_1"
                                       value="{{ old('mission_point_1') }}"
                                       required minlength="5" maxlength="255">
                                @error('mission_point_1')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mission_point_2" class="form-label">نقطة المهمة 2 <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('mission_point_2') is-invalid @enderror"
                                       id="mission_point_2" name="mission_point_2"
                                       value="{{ old('mission_point_2') }}"
                                       required minlength="5" maxlength="255">
                                @error('mission_point_2')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mission_point_3" class="form-label">نقطة المهمة 3 <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('mission_point_3') is-invalid @enderror"
                                       id="mission_point_3" name="mission_point_3"
                                       value="{{ old('mission_point_3') }}"
                                       required minlength="5" maxlength="255">
                                @error('mission_point_3')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-12 mt-4">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times me-2"></i> إلغاء
                                </a>
                                <button type="submit" class="btn" style="background-color: #3cc88f; color: white">
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
    padding: 0.5rem 0.75rem;
}

.card {
    border: none;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}

.page-title {
    color: var(--primary-color);
    font-weight: 600;
}

.breadcrumb-item.active {
    color: var(--primary-color);
    font-weight: 500;
}

.invalid-feedback {
    color: #dc3545;
    font-size: 0.875rem;
    display: block;
}

.is-invalid {
    border-color: #dc3545;
}

.validation-message {
    font-size: 0.8rem;
    color: #6c757d;
}

.time-picker {
    background-color: #fff;
}

.section-title {
    font-size: 1.1rem;
    font-weight: 600;
}

.section-divider {
    height: 1px;
    background: linear-gradient(to right, transparent, #ddd, transparent);
    margin: 0.5rem 0 1.5rem;
}

.custom-file-upload {
    transition: all 0.3s;
    border: 2px dashed #3cc88f;
    background-color: #f8f9fc;
}

.custom-file-upload:hover {
    background-color: rgba(60, 200, 143, 0.05);
}

.file-upload-label {
    cursor: pointer;
}

.btn {
    font-weight: 500;
    padding: 0.5rem 1.5rem;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .section-title {
        font-size: 1rem;
    }

    .d-flex.justify-content-between {
        flex-direction: column-reverse;
        gap: 1rem;
    }

    .d-flex.justify-content-between > div {
        width: 100%;
    }

    .btn {
        width: 100%;
        margin-bottom: 0.5rem;
    }
}
</style>
@endpush

@push('scripts')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize time picker
    flatpickr(".time-picker", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "h:i K",
        time_24hr: false,
        minuteIncrement: 30,
        locale: {
            firstDayOfWeek: 6,
            weekdays: {
                shorthand: ["أحد", "اثنين", "ثلاثاء", "أربعاء", "خميس", "جمعة", "سبت"],
                longhand: ["الأحد", "الاثنين", "الثلاثاء", "الأربعاء", "الخميس", "الجمعة", "السبت"]
            },
            months: {
                shorthand: ["يناير", "فبراير", "مارس", "أبريل", "مايو", "يونيو", "يوليو", "أغسطس", "سبتمبر", "أكتوبر", "نوفمبر", "ديسمبر"],
                longhand: ["يناير", "فبراير", "مارس", "أبريل", "مايو", "يونيو", "يوليو", "أغسطس", "سبتمبر", "أكتوبر", "نوفمبر", "ديسمبر"]
            }
        }
    });

    // Image preview functionality
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('image-preview');
    const previewImage = document.getElementById('preview-image');
    const removeImageBtn = document.getElementById('remove-image');

    if (imageInput) {
        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    imagePreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    }

    if (removeImageBtn) {
        removeImageBtn.addEventListener('click', function() {
            imageInput.value = '';
            previewImage.src = '#';
            imagePreview.style.display = 'none';
        });
    }

    // Form validation
    const form = document.getElementById('eventForm');
    const timeRegex = /^(1[0-2]|0?[1-9]):[0-5][0-9] (AM|PM)$/i;

    form.addEventListener('submit', function(e) {
        let isValid = true;
        let errorMessage = '';

        // Validate time format
        const timeInput = document.getElementById('time');
        const endTimeInput = document.getElementById('end_time');

        if (!timeRegex.test(timeInput.value)) {
            timeInput.classList.add('is-invalid');
            isValid = false;
            errorMessage += '- صيغة وقت البدء غير صالحة. استخدم مثل: 08:30 AM<br>';
        } else {
            timeInput.classList.remove('is-invalid');
        }

        if (!timeRegex.test(endTimeInput.value)) {
            endTimeInput.classList.add('is-invalid');
            isValid = false;
            errorMessage += '- صيغة وقت الانتهاء غير صالحة. استخدم مثل: 05:30 PM<br>';
        } else {
            endTimeInput.classList.remove('is-invalid');
        }

        // Validate time sequence
        if (isValid) {
            const startTime = timeInput.value;
            const endTime = endTimeInput.value;

            const start = new Date(`2000-01-01 ${startTime}`);
            const end = new Date(`2000-01-01 ${endTime}`);

            if (end <= start) {
                endTimeInput.classList.add('is-invalid');
                isValid = false;
                errorMessage += '- وقت الانتهاء يجب أن يكون بعد وقت البدء<br>';
            }

            const duration = (end - start) / (1000 * 60 * 60);
            if (duration > 6) {
                endTimeInput.classList.add('is-invalid');
                isValid = false;
                errorMessage += '- مدة الحدث يجب ألا تزيد عن 6 ساعات<br>';
            }
        }

        // Validate image file
        const imageInput = document.getElementById('image');
        if (imageInput.files.length === 0) {
            imageInput.classList.add('is-invalid');
            isValid = false;
            errorMessage += '- صورة الحدث مطلوبة<br>';
        } else {
            const file = imageInput.files[0];
            const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];

            if (!validTypes.includes(file.type)) {
                imageInput.classList.add('is-invalid');
                isValid = false;
                errorMessage += '- نوع الملف غير مسموح به (يجب أن يكون صورة بصيغة JPEG أو PNG أو JPG)<br>';
            }

            if (file.size > 2 * 1024 * 1024) {
                imageInput.classList.add('is-invalid');
                isValid = false;
                errorMessage += '- حجم الصورة يجب أن لا يتجاوز 2MB<br>';
            }
        }

        if (!isValid) {
            e.preventDefault();
            Swal.fire({
                title: 'خطأ في الإدخال',
                html: errorMessage,
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
