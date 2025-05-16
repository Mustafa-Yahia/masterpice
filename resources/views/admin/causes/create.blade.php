@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <!-- Page Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-plus-circle me-2" style="color:#3cc88f"></i> إنشاء حملة تبرعات جديدة
        </h1>
        <a href="{{ route('admin.causes.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-times fa-sm text-white-50"></i> إلغاء
        </a>
    </div>

    <!-- Form Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background-color: #3cc88f">
            <h6 class="m-0 font-weight-bold text-white">
                <i class="fas fa-plus-circle me-2"></i> نموذج إنشاء حملة جديدة
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.causes.store') }}" method="POST" enctype="multipart/form-data" id="create-cause-form">
                @csrf

                <!-- Basic Information Section -->
                <div class="row mb-5">
                    <div class="col-12 mb-4">
                        <h5 class="section-title mb-3" style="color:#3cc88f">
                            <i class="fas fa-info-circle me-2"></i> المعلومات الأساسية
                        </h5>
                        <div class="section-divider"></div>
                    </div>

                    <!-- Campaign Title -->
                    <div class="col-md-6 mb-4">
                        <label for="title" class="form-label">عنوان الحملة <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                               id="title" name="title" value="{{ old('title') }}"
                               required minlength="5" maxlength="100">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">يجب أن يكون العنوان بين 5 و100 حرف</small>
                    </div>

                    <!-- Category -->
                    <div class="col-md-6 mb-4">
                        <label for="category" class="form-label">فئة الحملة <span class="text-danger">*</span></label>
                        <select class="form-select @error('category') is-invalid @enderror"
                                id="category" name="category" required>
                            <option value="">اختر الفئة</option>
                            <option value="تعليم" @if(old('category') == 'تعليم') selected @endif>تعليم</option>
                            <option value="صحة" @if(old('category') == 'صحة') selected @endif>صحة</option>
                            <option value="إغاثة" @if(old('category') == 'إغاثة') selected @endif>إغاثة</option>
                            <option value="تنمية" @if(old('category') == 'تنمية') selected @endif>تنمية</option>
                        </select>
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="col-12 mb-4">
                        <label for="description" class="form-label">وصف الحملة <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  id="description" name="description" rows="5"
                                  required minlength="20" maxlength="2000">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">يجب أن يكون الوصف بين 20 و2000 حرف</small>
                    </div>
                </div>

                <!-- Financial Information Section -->
                <div class="row mb-5">
                    <div class="col-12 mb-4">
                        <h5 class="section-title mb-3 " style="color:#3cc88f">
                            <i class="fas fa-money-bill-wave me-2"></i> المعلومات المالية
                        </h5>
                        <div class="section-divider"></div>
                    </div>

                    <!-- Goal Amount -->
                    <div class="col-md-6 mb-4">
                        <label for="goal_amount" class="form-label">الهدف المطلوب ($) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('goal_amount') is-invalid @enderror"
                               id="goal_amount" name="goal_amount" value="{{ old('goal_amount') }}"
                               min="100" max="1000000" step="100" required>
                        @error('goal_amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">يجب أن يكون المبلغ بين 100 و1,000,000 دولار</small>
                    </div>

                    <!-- Raised Amount (Readonly) -->
                    <div class="col-md-6 mb-4">
                        <label for="raised_amount" class="form-label">المبلغ المجموع ($)</label>
                        <input type="number" class="form-control @error('raised_amount') is-invalid @enderror"
                               id="raised_amount" name="raised_amount" value="0"
                               min="0" step="100" readonly>
                        @error('raised_amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Progress Bar Preview -->
                    <div class="col-12 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold  text-uppercase mb-1" style="color:#3cc88f">
                                            تقدم الحملة
                                        </div>
                                        <div class="progress mb-2">
                                            <div class="progress-bar progress-bar-striped bg-success"
                                                 id="progress-preview" role="progressbar" style="width: 0%">
                                                <span class="progress-text">0%</span>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <small class="text-muted">$<span id="raised-preview">0</span> محصل</small>
                                            <small class="text-muted">$<span id="goal-preview">0</span> مطلوب</small>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Location & Responsible Section -->
                <div class="row mb-5">
                    <div class="col-12 mb-4">
                        <h5 class="section-title mb-3 " style="color:#3cc88f">
                            <i class="fas fa-map-marker-alt me-2"></i> الموقع والمسؤول
                        </h5>
                        <div class="section-divider"></div>
                    </div>

                    <!-- Location -->
                    <div class="col-md-6 mb-4">
                        <label for="location" class="form-label">موقع الحملة <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('location') is-invalid @enderror"
                               id="location" name="location" value="{{ old('location') }}"
                               required minlength="3" maxlength="100">
                        @error('location')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">يجب أن يكون الموقع بين 3 و100 حرف</small>
                    </div>

                    <!-- End Date -->
                    <div class="col-md-6 mb-4">
                        <label for="end_date" class="form-label">تاريخ الانتهاء <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                               id="end_date" name="end_date" value="{{ old('end_date') }}"
                               min="{{ date('Y-m-d') }}" required>
                        @error('end_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Responsible Person -->
                    <div class="col-md-6 mb-4">
                        <label for="responsible_person_name" class="form-label">اسم المسؤول <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('responsible_person_name') is-invalid @enderror"
                               id="responsible_person_name" name="responsible_person_name"
                               value="{{ old('responsible_person_name') }}"
                               required minlength="3" maxlength="50">
                        @error('responsible_person_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">يجب أن يكون الاسم بين 3 و50 حرف</small>
                    </div>

                    <!-- Responsible Email -->
                    <div class="col-md-6 mb-4">
                        <label for="responsible_person_email" class="form-label">بريد المسؤول <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('responsible_person_email') is-invalid @enderror"
                               id="responsible_person_email" name="responsible_person_email"
                               value="{{ old('responsible_person_email') }}" required>
                        @error('responsible_person_email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Image & Additional Details Section -->
                <div class="row">
                    <div class="col-12 mb-4">
                        <h5 class="section-title mb-3" style="color:#3cc88f">
                            <i class="fas fa-image me-2"></i> الصورة والتفاصيل
                        </h5>
                        <div class="section-divider"></div>
                    </div>

                    <!-- Image Upload -->
<div class="col-md-6 mb-4">
    <label class="form-label">صورة الحملة <span class="text-danger">*</span></label>
    <div class="custom-file-upload border rounded p-4 text-center"
         style="border: 2px dashed #4e73df; background-color: #f8f9fc;">
        <input type="file" id="image" name="image" accept="image/*"
               class="d-none @error('image') is-invalid @enderror" required>
        <label for="image" class="file-upload-label d-flex flex-column align-items-center justify-content-center"
               style="cursor: pointer; height: 100%;">
            <div class="file-upload-icon mb-3">
                <i class="fas fa-cloud-upload-alt fa-3x" style="color: #3cc88f"></i>
            </div>
            <div class="file-upload-text text-center">
                <h5 class="mb-2 " style="font-weight: 600; color:#3cc88f">ارفاق صورة</h5>
                <p class="text-muted mb-1">اضغط هنا لاختيار صورة</p>
                <p class="text-muted small">JPEG, PNG - الحد الأقصى 5MB</p>
            </div>
        </label>
        @error('image')
            <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
        @enderror
    </div>

    <div id="image-preview" class="mt-3 text-center" style="display: none;">
        <img id="preview-image" src="#" alt="Preview"
             class="img-thumbnail rounded" style="max-height: 200px; border: 1px solid #ddd;">
        <button type="button" id="remove-image" class="btn btn-sm btn-danger mt-2">
            <i class="fas fa-trash me-1"></i> إزالة الصورة
        </button>
    </div>
</div>

                    <!-- Additional Details -->
                    <div class="col-md-6 mb-4">
                        <label for="additional_details" class="form-label">تفاصيل إضافية</label>
                        <textarea class="form-control @error('additional_details') is-invalid @enderror"
                                  id="additional_details" name="additional_details"
                                  rows="8" maxlength="1000">{{ old('additional_details') }}</textarea>
                        @error('additional_details')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">حد أقصى 1000 حرف</small>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="d-flex justify-content-end mt-4 pt-3 border-top">
                    <button type="submit" class="btn  btn-icon-split" style="background-color: #3cc88f; color: white;">
                        <span class="icon text-white-50">
                            <i class="fas fa-save"></i>
                        </span>
                        <span class="text">حفظ الحملة</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Custom Styles to Match Sidebar Theme */
    .section-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--dark);
    }

    .section-divider {
        height: 1px;
        background: linear-gradient(to right, transparent, #ddd, transparent);
        margin: 0.5rem 0 1.5rem;
    }

    .custom-file-upload {
        border: 2px dashed #ddd;
        border-radius: 0.35rem;
        padding: 2rem;
        text-align: center;
        transition: all 0.3s;
        background-color: #f8f9fc;
    }

    .custom-file-upload:hover {
        border-color: var(--primary);
        background-color: rgba(78, 115, 223, 0.05);
    }

    .file-upload-label {
        cursor: pointer;
    }

    .file-upload-icon {
        margin-bottom: 1rem;
    }

    .file-upload-text h6 {
        color: var(--dark);
        margin-bottom: 0.25rem;
    }

    .progress {
        height: 1rem;
        border-radius: 0.35rem;
    }

    .progress-bar {
        position: relative;
        border-radius: 0.35rem;
    }

    .progress-text {
        position: absolute;
        right: 0.5rem;
        top: 50%;
        transform: translateY(-50%);
        font-size: 0.65rem;
        color: white;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .section-title {
            font-size: 1rem;
        }

        .custom-file-upload {
            padding: 1.5rem;
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Image preview functionality
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('image-preview');
        const previewImage = document.getElementById('preview-image');
        const removeImageBtn = document.getElementById('remove-image');

        if (imageInput) {
            imageInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    // Validate file type
                    const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                    if (!validTypes.includes(file.type)) {
                        Swal.fire({
                            icon: 'error',
                            title: 'نوع ملف غير مدعوم',
                            text: 'الرجاء اختيار صورة بصيغة JPEG أو PNG فقط',
                        });
                        this.value = '';
                        return;
                    }

                    // Validate file size (5MB max)
                    if (file.size > 5 * 1024 * 1024) {
                        Swal.fire({
                            icon: 'error',
                            title: 'حجم الملف كبير جدًا',
                            text: 'حجم الصورة يجب أن يكون أقل من 5MB',
                        });
                        this.value = '';
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        imagePreview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        // Remove image
        if (removeImageBtn) {
            removeImageBtn.addEventListener('click', function() {
                imageInput.value = '';
                previewImage.src = '#';
                imagePreview.style.display = 'none';
                // Add error class to maintain validation state
                imageInput.classList.add('is-invalid');
            });
        }

        // Progress bar preview
        const goalAmountInput = document.getElementById('goal_amount');
        const raisedAmountInput = document.getElementById('raised_amount');
        const progressBar = document.getElementById('progress-preview');
        const progressText = document.querySelector('.progress-text');
        const raisedPreview = document.getElementById('raised-preview');
        const goalPreview = document.getElementById('goal-preview');

        function updateProgressBar() {
            const goal = parseFloat(goalAmountInput.value) || 0;
            const raised = 0; // Always 0 as per requirements

            let percentage = 0;

            if (goal > 0) {
                percentage = Math.min((raised / goal) * 100, 100);
            }

            progressBar.style.width = `${percentage}%`;
            progressText.textContent = `${percentage.toFixed(0)}%`;
            raisedPreview.textContent = raised.toLocaleString();
            goalPreview.textContent = goal.toLocaleString();

            // Change color based on percentage
            progressBar.classList.remove('bg-warning', 'bg-danger');
            progressBar.classList.add('bg-success');
        }

        if (goalAmountInput) {
            goalAmountInput.addEventListener('input', updateProgressBar);
            updateProgressBar(); // Initial update
        }

        // Form validation
        const form = document.getElementById('create-cause-form');
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                // Reset validation
                form.querySelectorAll('.is-invalid').forEach(el => {
                    el.classList.remove('is-invalid');
                });

                // Validate required fields
                let isValid = true;
                const requiredFields = form.querySelectorAll('[required]');

                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        field.classList.add('is-invalid');
                        isValid = false;

                        // Add error message if not exists
                        if (!field.nextElementSibling || !field.nextElementSibling.classList.contains('invalid-feedback')) {
                            const errorDiv = document.createElement('div');
                            errorDiv.className = 'invalid-feedback';
                            errorDiv.textContent = 'هذا الحقل مطلوب';
                            field.parentNode.appendChild(errorDiv);
                        }
                    }
                });

                // Validate email format if provided
                const emailField = document.getElementById('responsible_person_email');
                if (emailField.value && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailField.value)) {
                    emailField.classList.add('is-invalid');
                    isValid = false;

                    if (!emailField.nextElementSibling || !emailField.nextElementSibling.classList.contains('invalid-feedback')) {
                        const errorDiv = document.createElement('div');
                        errorDiv.className = 'invalid-feedback';
                        errorDiv.textContent = 'البريد الإلكتروني غير صالح';
                        emailField.parentNode.appendChild(errorDiv);
                    }
                }

                // Validate image
                if (imageInput.files.length === 0) {
                    imageInput.classList.add('is-invalid');
                    isValid = false;

                    if (!imageInput.nextElementSibling || !imageInput.nextElementSibling.classList.contains('invalid-feedback')) {
                        const errorDiv = document.createElement('div');
                        errorDiv.className = 'invalid-feedback';
                        errorDiv.textContent = 'صورة الحملة مطلوبة';
                        imageInput.parentNode.appendChild(errorDiv);
                    }
                }

                if (isValid) {
                    Swal.fire({
                        title: 'هل أنت متأكد؟',
                        text: "سيتم إضافة الحملة الجديدة إلى النظام",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#4e73df',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'نعم، أضف الحملة',
                        cancelButtonText: 'إلغاء',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                        }
                    });
                } else {
                    // Scroll to first invalid field
                    const firstInvalid = form.querySelector('.is-invalid');
                    if (firstInvalid) {
                        firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        firstInvalid.focus();
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'خطأ',
                        text: 'الرجاء إكمال جميع الحقول المطلوبة بشكل صحيح',
                    });
                }
            });
        }

        // Real-time validation for fields
        form.querySelectorAll('input, textarea, select').forEach(field => {
            field.addEventListener('input', function() {
                if (this.value.trim()) {
                    this.classList.remove('is-invalid');
                }
            });
        });
    });
</script>
@endpush

{{-- @extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <!-- Page Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-plus-circle text-primary me-2"></i> إنشاء حملة تبرعات جديدة
        </h1>
        <a href="{{ route('admin.causes.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-times fa-sm text-white-50"></i> إلغاء
        </a>
    </div>

    <!-- Form Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-primary">
            <h6 class="m-0 font-weight-bold text-white">
                <i class="fas fa-plus-circle me-2"></i> نموذج إنشاء حملة جديدة
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.causes.store') }}" method="POST" enctype="multipart/form-data" id="create-cause-form">
                @csrf

                <!-- Basic Information Section -->
                <div class="row mb-5">
                    <div class="col-12 mb-4">
                        <h5 class="section-title mb-3 text-primary">
                            <i class="fas fa-info-circle me-2"></i> المعلومات الأساسية
                        </h5>
                        <div class="section-divider"></div>
                    </div>

                    <!-- Campaign Title -->
                    <div class="col-md-6 mb-4">
                        <label for="title" class="form-label">عنوان الحملة <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                               id="title" name="title" value="{{ old('title') }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">يجب أن يكون العنوان واضحًا وجذابًا</small>
                    </div>

                    <!-- Category -->
                    <div class="col-md-6 mb-4">
                        <label for="category" class="form-label">فئة الحملة</label>
                        <select class="form-select @error('category') is-invalid @enderror"
                                id="category" name="category">
                            <option value="">اختر الفئة</option>
                            <option value="تعليم" @if(old('category') == 'تعليم') selected @endif>تعليم</option>
                            <option value="صحة" @if(old('category') == 'صحة') selected @endif>صحة</option>
                            <option value="إغاثة" @if(old('category') == 'إغاثة') selected @endif>إغاثة</option>
                            <option value="تنمية" @if(old('category') == 'تنمية') selected @endif>تنمية</option>
                        </select>
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="col-12 mb-4">
                        <label for="description" class="form-label">وصف الحملة <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">صف الحملة بشكل مفصل وأهدافها ومستفيديها</small>
                    </div>
                </div>

                <!-- Financial Information Section -->
                <div class="row mb-5">
                    <div class="col-12 mb-4">
                        <h5 class="section-title mb-3 text-primary">
                            <i class="fas fa-money-bill-wave me-2"></i> المعلومات المالية
                        </h5>
                        <div class="section-divider"></div>
                    </div>

                    <!-- Goal Amount -->
                    <div class="col-md-4 mb-4">
                        <label for="goal_amount" class="form-label">الهدف المطلوب ($) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('goal_amount') is-invalid @enderror"
                               id="goal_amount" name="goal_amount" value="{{ old('goal_amount') }}"
                               min="100" step="100" required>
                        @error('goal_amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Raised Amount -->
                    <div class="col-md-4 mb-4">
                        <label for="raised_amount" class="form-label">المبلغ المجموع ($)</label>
                        <input type="number" class="form-control @error('raised_amount') is-invalid @enderror"
                               id="raised_amount" name="raised_amount" value="{{ old('raised_amount', 0) }}"
                               min="0" step="100">
                        @error('raised_amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Extra Raised Amount -->
                    <div class="col-md-4 mb-4">
                        <label for="extra_raised_amount" class="form-label">مبلغ إضافي ($)</label>
                        <input type="number" class="form-control @error('extra_raised_amount') is-invalid @enderror"
                               id="extra_raised_amount" name="extra_raised_amount" value="{{ old('extra_raised_amount', 0) }}"
                               min="0" step="100">
                        @error('extra_raised_amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Progress Bar Preview -->
                    <div class="col-12 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            تقدم الحملة
                                        </div>
                                        <div class="progress mb-2">
                                            <div class="progress-bar progress-bar-striped bg-success"
                                                 id="progress-preview" role="progressbar" style="width: 0%">
                                                <span class="progress-text">0%</span>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <small class="text-muted">$<span id="raised-preview">0</span> محصل</small>
                                            <small class="text-muted">$<span id="goal-preview">0</span> مطلوب</small>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Location & Responsible Section -->
                <div class="row mb-5">
                    <div class="col-12 mb-4">
                        <h5 class="section-title mb-3 text-primary">
                            <i class="fas fa-map-marker-alt me-2"></i> الموقع والمسؤول
                        </h5>
                        <div class="section-divider"></div>
                    </div>

                    <!-- Location -->
                    <div class="col-md-6 mb-4">
                        <label for="location" class="form-label">موقع الحملة</label>
                        <input type="text" class="form-control @error('location') is-invalid @enderror"
                               id="location" name="location" value="{{ old('location') }}">
                        @error('location')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- End Date -->
                    <div class="col-md-6 mb-4">
                        <label for="end_date" class="form-label">تاريخ الانتهاء</label>
                        <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                               id="end_date" name="end_date" value="{{ old('end_date') }}"
                               min="{{ date('Y-m-d') }}">
                        @error('end_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Responsible Person -->
                    <div class="col-md-6 mb-4">
                        <label for="responsible_person_name" class="form-label">اسم المسؤول</label>
                        <input type="text" class="form-control @error('responsible_person_name') is-invalid @enderror"
                               id="responsible_person_name" name="responsible_person_name"
                               value="{{ old('responsible_person_name') }}">
                        @error('responsible_person_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Responsible Email -->
                    <div class="col-md-6 mb-4">
                        <label for="responsible_person_email" class="form-label">بريد المسؤول</label>
                        <input type="email" class="form-control @error('responsible_person_email') is-invalid @enderror"
                               id="responsible_person_email" name="responsible_person_email"
                               value="{{ old('responsible_person_email') }}">
                        @error('responsible_person_email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Image & Additional Details Section -->
                <div class="row">
                    <div class="col-12 mb-4">
                        <h5 class="section-title mb-3 text-primary">
                            <i class="fas fa-image me-2"></i> الصورة والتفاصيل
                        </h5>
                        <div class="section-divider"></div>
                    </div>

                    <!-- Image Upload -->
                    <div class="col-md-6 mb-4">
                        <label class="form-label">صورة الحملة</label>
                        <div class="custom-file-upload">
                            <input type="file" id="image" name="image" accept="image/*"
                                   class="d-none @error('image') is-invalid @enderror">
                            <label for="image" class="file-upload-label">
                                <div class="file-upload-icon">
                                    <i class="fas fa-cloud-upload-alt fa-2x text-gray-400"></i>
                                </div>
                                <div class="file-upload-text">
                                    <h6 class="mb-1">اضغط لرفع صورة</h6>
                                    <p class="text-muted small mb-0">JPEG, PNG - الحد الأقصى 5MB</p>
                                </div>
                            </label>
                            @error('image')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div id="image-preview" class="mt-3 text-center" style="display: none;">
                            <img id="preview-image" src="#" alt="Preview"
                                 class="img-thumbnail rounded" style="max-height: 200px;">
                            <button type="button" id="remove-image" class="btn btn-sm btn-danger mt-2">
                                <i class="fas fa-trash me-1"></i> إزالة الصورة
                            </button>
                        </div>
                    </div>

                    <!-- Additional Details -->
                    <div class="col-md-6 mb-4">
                        <label for="additional_details" class="form-label">تفاصيل إضافية</label>
                        <textarea class="form-control @error('additional_details') is-invalid @enderror"
                                  id="additional_details" name="additional_details"
                                  rows="8">{{ old('additional_details') }}</textarea>
                        @error('additional_details')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="d-flex justify-content-end mt-4 pt-3 border-top">
                    <button type="submit" class="btn btn-primary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-save"></i>
                        </span>
                        <span class="text">حفظ الحملة</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Custom Styles to Match Sidebar Theme */
    .section-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--dark);
    }

    .section-divider {
        height: 1px;
        background: linear-gradient(to right, transparent, #ddd, transparent);
        margin: 0.5rem 0 1.5rem;
    }

    .custom-file-upload {
        border: 2px dashed #ddd;
        border-radius: 0.35rem;
        padding: 2rem;
        text-align: center;
        transition: all 0.3s;
        background-color: #f8f9fc;
    }

    .custom-file-upload:hover {
        border-color: var(--primary);
        background-color: rgba(78, 115, 223, 0.05);
    }

    .file-upload-label {
        cursor: pointer;
    }

    .file-upload-icon {
        margin-bottom: 1rem;
    }

    .file-upload-text h6 {
        color: var(--dark);
        margin-bottom: 0.25rem;
    }

    .progress {
        height: 1rem;
        border-radius: 0.35rem;
    }

    .progress-bar {
        position: relative;
        border-radius: 0.35rem;
    }

    .progress-text {
        position: absolute;
        right: 0.5rem;
        top: 50%;
        transform: translateY(-50%);
        font-size: 0.65rem;
        color: white;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .section-title {
            font-size: 1rem;
        }

        .custom-file-upload {
            padding: 1.5rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Image preview functionality
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('image-preview');
        const previewImage = document.getElementById('preview-image');
        const removeImageBtn = document.getElementById('remove-image');

        if (imageInput) {
            imageInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    if (file.size > 5 * 1024 * 1024) { // 5MB limit
                        Swal.fire({
                            icon: 'error',
                            title: 'خطأ',
                            text: 'حجم الصورة يجب أن يكون أقل من 5MB',
                        });
                        this.value = '';
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        imagePreview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        // Remove image
        if (removeImageBtn) {
            removeImageBtn.addEventListener('click', function() {
                imageInput.value = '';
                previewImage.src = '#';
                imagePreview.style.display = 'none';
            });
        }

        // Progress bar preview
        const goalAmountInput = document.getElementById('goal_amount');
        const raisedAmountInput = document.getElementById('raised_amount');
        const progressBar = document.getElementById('progress-preview');
        const progressText = document.querySelector('.progress-text');
        const raisedPreview = document.getElementById('raised-preview');
        const goalPreview = document.getElementById('goal-preview');

        function updateProgressBar() {
            const goal = parseFloat(goalAmountInput.value) || 0;
            const raised = parseFloat(raisedAmountInput.value) || 0;
            let percentage = 0;

            if (goal > 0) {
                percentage = Math.min((raised / goal) * 100, 100);
            }

            progressBar.style.width = `${percentage}%`;
            progressText.textContent = `${percentage.toFixed(0)}%`;
            raisedPreview.textContent = raised.toLocaleString();
            goalPreview.textContent = goal.toLocaleString();

            // Change color based on percentage
            if (percentage >= 100) {
                progressBar.classList.remove('bg-success', 'bg-warning');
                progressBar.classList.add('bg-danger');
            } else if (percentage >= 70) {
                progressBar.classList.remove('bg-success', 'bg-danger');
                progressBar.classList.add('bg-warning');
            } else {
                progressBar.classList.remove('bg-warning', 'bg-danger');
                progressBar.classList.add('bg-success');
            }
        }

        if (goalAmountInput && raisedAmountInput) {
            goalAmountInput.addEventListener('input', updateProgressBar);
            raisedAmountInput.addEventListener('input', updateProgressBar);
            updateProgressBar(); // Initial update
        }

        // Form validation
        const form = document.getElementById('create-cause-form');
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                // Validate required fields
                let isValid = true;
                const requiredFields = form.querySelectorAll('[required]');

                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        field.classList.add('is-invalid');
                        isValid = false;

                        // Add error message if not exists
                        if (!field.nextElementSibling || !field.nextElementSibling.classList.contains('invalid-feedback')) {
                            const errorDiv = document.createElement('div');
                            errorDiv.className = 'invalid-feedback';
                            errorDiv.textContent = 'هذا الحقل مطلوب';
                            field.parentNode.appendChild(errorDiv);
                        }
                    }
                });

                // Validate email format if provided
                const emailField = document.getElementById('responsible_person_email');
                if (emailField.value && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailField.value)) {
                    emailField.classList.add('is-invalid');
                    isValid = false;

                    if (!emailField.nextElementSibling || !emailField.nextElementSibling.classList.contains('invalid-feedback')) {
                        const errorDiv = document.createElement('div');
                        errorDiv.className = 'invalid-feedback';
                        errorDiv.textContent = 'البريد الإلكتروني غير صالح';
                        emailField.parentNode.appendChild(errorDiv);
                    }
                }

                // Validate financial amounts
                const goalAmount = parseFloat(goalAmountInput.value) || 0;
                const raisedAmount = parseFloat(raisedAmountInput.value) || 0;

                if (raisedAmount > goalAmount) {
                    raisedAmountInput.classList.add('is-invalid');
                    isValid = false;

                    if (!raisedAmountInput.nextElementSibling ||
                        !raisedAmountInput.nextElementSibling.classList.contains('invalid-feedback')) {
                        const errorDiv = document.createElement('div');
                        errorDiv.className = 'invalid-feedback';
                        errorDiv.textContent = 'المبلغ المجموع لا يمكن أن يكون أكبر من الهدف';
                        raisedAmountInput.parentNode.appendChild(errorDiv);
                    }
                }

                if (isValid) {
                    Swal.fire({
                        title: 'هل أنت متأكد؟',
                        text: "سيتم إضافة الحملة الجديدة إلى النظام",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#4e73df',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'نعم، أضف الحملة',
                        cancelButtonText: 'إلغاء',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                        }
                    });
                } else {
                    // Scroll to first invalid field
                    const firstInvalid = form.querySelector('.is-invalid');
                    if (firstInvalid) {
                        firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        firstInvalid.focus();
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'خطأ',
                        text: 'الرجاء إكمال جميع الحقول المطلوبة بشكل صحيح',
                    });
                }
            });
        }
    });
</script>
@endpush --}}

{{-- @extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->

        <!-- Main Content -->
        <div class="col-lg-10 col-md-9 ms-sm-auto px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">
                    <i class="fas fa-plus-circle text-primary"></i> إنشاء حملة تبرعات جديدة
                </h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="{{ route('admin.causes.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-times"></i> إلغاء
                    </a>
                </div>
            </div>

            <!-- Main Form Card -->
            <div class="card shadow-sm mb-4 border-0">
                <div class="card-body p-4">
                    <form action="{{ route('admin.causes.store') }}" method="POST" enctype="multipart/form-data" id="create-cause-form">
                        @csrf

                        <!-- Basic Information Section -->
                        <div class="mb-5">
                            <h5 class="mb-4 pb-2 border-bottom d-flex align-items-center">
                                <i class="fas fa-info-circle me-2 text-primary"></i>
                                <span>المعلومات الأساسية</span>
                            </h5>

                            <div class="row g-3">
                                <!-- Campaign Title -->
                                <div class="col-md-6">
                                    <label for="title" class="form-label">عنوان الحملة <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                           id="title" name="title" value="{{ old('title') }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">يجب أن يكون العنوان واضحًا وجذابًا</div>
                                </div>

                                <!-- Category -->
                                <div class="col-md-6">
                                    <label for="category" class="form-label">فئة الحملة</label>
                                    <select class="form-select @error('category') is-invalid @enderror"
                                            id="category" name="category">
                                        <option value="">اختر الفئة</option>
                                        <option value="تعليم" @if(old('category') == 'تعليم') selected @endif>تعليم</option>
                                        <option value="صحة" @if(old('category') == 'صحة') selected @endif>صحة</option>
                                        <option value="إغاثة" @if(old('category') == 'إغاثة') selected @endif>إغاثة</option>
                                        <option value="تنمية" @if(old('category') == 'تنمية') selected @endif>تنمية</option>
                                    </select>
                                    @error('category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Description -->
                                <div class="col-12">
                                    <label for="description" class="form-label">وصف الحملة <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                              id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">صف الحملة بشكل مفصل وأهدافها ومستفيديها</div>
                                </div>
                            </div>
                        </div>

                        <!-- Financial Information Section -->
                        <div class="mb-5">
                            <h5 class="mb-4 pb-2 border-bottom d-flex align-items-center">
                                <i class="fas fa-money-bill-wave me-2 text-primary"></i>
                                <span>المعلومات المالية</span>
                            </h5>

                            <div class="row g-3">
                                <!-- Goal Amount -->
                                <div class="col-md-4">
                                    <label for="goal_amount" class="form-label">الهدف المطلوب ($) <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('goal_amount') is-invalid @enderror"
                                           id="goal_amount" name="goal_amount" value="{{ old('goal_amount') }}"
                                           min="100" step="100" required>
                                    @error('goal_amount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Raised Amount -->
                                <div class="col-md-4">
                                    <label for="raised_amount" class="form-label">المبلغ المجموع ($)</label>
                                    <input type="number" class="form-control @error('raised_amount') is-invalid @enderror"
                                           id="raised_amount" name="raised_amount" value="{{ old('raised_amount', 0) }}"
                                           min="0" step="100">
                                    @error('raised_amount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Extra Raised Amount -->
                                <div class="col-md-4">
                                    <label for="extra_raised_amount" class="form-label">مبلغ إضافي ($)</label>
                                    <input type="number" class="form-control @error('extra_raised_amount') is-invalid @enderror"
                                           id="extra_raised_amount" name="extra_raised_amount" value="{{ old('extra_raised_amount', 0) }}"
                                           min="0" step="100">
                                    @error('extra_raised_amount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Progress Bar Preview -->
                                <div class="col-12 mt-3">
                                    <div class="card bg-light">
                                        <div class="card-body py-3">
                                            <h6 class="mb-3">تقدم الحملة:</h6>
                                            <div class="progress" style="height: 12px;">
                                                <div class="progress-bar progress-bar-striped bg-success"
                                                     id="progress-preview" role="progressbar" style="width: 0%">
                                                    <span class="progress-text">0%</span>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between mt-2 small">
                                                <span class="text-muted">$<span id="raised-preview">0</span> محصل</span>
                                                <span class="text-muted">$<span id="goal-preview">0</span> مطلوب</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Location & Responsible Section -->
                        <div class="mb-5">
                            <h5 class="mb-4 pb-2 border-bottom d-flex align-items-center">
                                <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                                <span>الموقع والمسؤول</span>
                            </h5>

                            <div class="row g-3">
                                <!-- Location -->
                                <div class="col-md-6">
                                    <label for="location" class="form-label">موقع الحملة</label>
                                    <input type="text" class="form-control @error('location') is-invalid @enderror"
                                           id="location" name="location" value="{{ old('location') }}">
                                    @error('location')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- End Date -->
                                <div class="col-md-6">
                                    <label for="end_date" class="form-label">تاريخ الانتهاء</label>
                                    <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                                           id="end_date" name="end_date" value="{{ old('end_date') }}"
                                           min="{{ date('Y-m-d') }}">
                                    @error('end_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Responsible Person -->
                                <div class="col-md-6">
                                    <label for="responsible_person_name" class="form-label">اسم المسؤول</label>
                                    <input type="text" class="form-control @error('responsible_person_name') is-invalid @enderror"
                                           id="responsible_person_name" name="responsible_person_name"
                                           value="{{ old('responsible_person_name') }}">
                                    @error('responsible_person_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Responsible Email -->
                                <div class="col-md-6">
                                    <label for="responsible_person_email" class="form-label">بريد المسؤول</label>
                                    <input type="email" class="form-control @error('responsible_person_email') is-invalid @enderror"
                                           id="responsible_person_email" name="responsible_person_email"
                                           value="{{ old('responsible_person_email') }}">
                                    @error('responsible_person_email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Image & Additional Details Section -->
                        <div class="mb-4">
                            <h5 class="mb-4 pb-2 border-bottom d-flex align-items-center">
                                <i class="fas fa-image me-2 text-primary"></i>
                                <span>الصورة والتفاصيل</span>
                            </h5>

                            <div class="row g-3">
                                <!-- Image Upload -->
                                <div class="col-md-6">
                                    <label class="form-label">صورة الحملة</label>
                                    <div class="image-upload-container border rounded p-3 text-center">
                                        <input type="file" id="image" name="image" accept="image/*"
                                               class="d-none @error('image') is-invalid @enderror">
                                        <label for="image" class="image-upload-label cursor-pointer">
                                            <div class="image-upload-icon mb-2">
                                                <i class="fas fa-cloud-upload-alt fa-2x text-muted"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-1">اضغط لرفع صورة</h6>
                                                <p class="text-muted small mb-0">JPEG, PNG - الحد الأقصى 5MB</p>
                                            </div>
                                        </label>
                                        @error('image')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div id="image-preview" class="mt-3 text-center" style="display: none;">
                                        <img id="preview-image" src="#" alt="Preview"
                                             class="img-thumbnail rounded" style="max-height: 200px;">
                                        <button type="button" id="remove-image" class="btn btn-sm btn-danger mt-2">
                                            <i class="fas fa-trash me-1"></i> إزالة الصورة
                                        </button>
                                    </div>
                                </div>

                                <!-- Additional Details -->
                                <div class="col-md-6">
                                    <label for="additional_details" class="form-label">تفاصيل إضافية</label>
                                    <textarea class="form-control @error('additional_details') is-invalid @enderror"
                                              id="additional_details" name="additional_details"
                                              rows="8">{{ old('additional_details') }}</textarea>
                                    @error('additional_details')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex justify-content-end mt-4 pt-3 border-top">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save me-2"></i> حفظ الحملة
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Image Upload Styling */
    .image-upload-container {
        border: 2px dashed #dee2e6;
        transition: all 0.3s;
    }
    .image-upload-container:hover {
        border-color: #4e73df;
        background-color: rgba(78, 115, 223, 0.05);
    }
    .cursor-pointer {
        cursor: pointer;
    }

    /* Progress Bar Styling */
    .progress {
        overflow: visible;
    }
    .progress-bar {
        position: relative;
        border-radius: 4px;
    }
    .progress-text {
        position: absolute;
        top: -25px;
        right: 0;
        font-size: 12px;
        color: #333;
    }

    /* Form Section Styling */
    .card {
        border-radius: 0.5rem;
    }
    .border-bottom {
        border-color: #e9ecef !important;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .image-upload-container {
            padding: 1.5rem !important;
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Image preview functionality
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('image-preview');
        const previewImage = document.getElementById('preview-image');
        const removeImageBtn = document.getElementById('remove-image');

        if (imageInput) {
            imageInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    if (file.size > 5 * 1024 * 1024) { // 5MB limit
                        Swal.fire({
                            icon: 'error',
                            title: 'خطأ',
                            text: 'حجم الصورة يجب أن يكون أقل من 5MB',
                        });
                        this.value = '';
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        imagePreview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        // Remove image
        if (removeImageBtn) {
            removeImageBtn.addEventListener('click', function() {
                imageInput.value = '';
                previewImage.src = '#';
                imagePreview.style.display = 'none';
            });
        }

        // Progress bar preview
        const goalAmountInput = document.getElementById('goal_amount');
        const raisedAmountInput = document.getElementById('raised_amount');
        const progressBar = document.getElementById('progress-preview');
        const progressText = document.querySelector('.progress-text');
        const raisedPreview = document.getElementById('raised-preview');
        const goalPreview = document.getElementById('goal-preview');

        function updateProgressBar() {
            const goal = parseFloat(goalAmountInput.value) || 0;
            const raised = parseFloat(raisedAmountInput.value) || 0;
            let percentage = 0;

            if (goal > 0) {
                percentage = Math.min((raised / goal) * 100, 100);
            }

            progressBar.style.width = `${percentage}%`;
            progressText.textContent = `${percentage.toFixed(0)}%`;
            raisedPreview.textContent = raised.toLocaleString();
            goalPreview.textContent = goal.toLocaleString();

            // Change color based on percentage
            if (percentage >= 100) {
                progressBar.classList.remove('bg-success', 'bg-warning');
                progressBar.classList.add('bg-danger');
            } else if (percentage >= 70) {
                progressBar.classList.remove('bg-success', 'bg-danger');
                progressBar.classList.add('bg-warning');
            } else {
                progressBar.classList.remove('bg-warning', 'bg-danger');
                progressBar.classList.add('bg-success');
            }
        }

        if (goalAmountInput && raisedAmountInput) {
            goalAmountInput.addEventListener('input', updateProgressBar);
            raisedAmountInput.addEventListener('input', updateProgressBar);
            updateProgressBar(); // Initial update
        }

        // Form validation
        const form = document.getElementById('create-cause-form');
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                // Validate required fields
                let isValid = true;
                const requiredFields = form.querySelectorAll('[required]');

                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        field.classList.add('is-invalid');
                        isValid = false;

                        // Add error message if not exists
                        if (!field.nextElementSibling || !field.nextElementSibling.classList.contains('invalid-feedback')) {
                            const errorDiv = document.createElement('div');
                            errorDiv.className = 'invalid-feedback';
                            errorDiv.textContent = 'هذا الحقل مطلوب';
                            field.parentNode.appendChild(errorDiv);
                        }
                    }
                });

                // Validate email format if provided
                const emailField = document.getElementById('responsible_person_email');
                if (emailField.value && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailField.value)) {
                    emailField.classList.add('is-invalid');
                    isValid = false;

                    if (!emailField.nextElementSibling || !emailField.nextElementSibling.classList.contains('invalid-feedback')) {
                        const errorDiv = document.createElement('div');
                        errorDiv.className = 'invalid-feedback';
                        errorDiv.textContent = 'البريد الإلكتروني غير صالح';
                        emailField.parentNode.appendChild(errorDiv);
                    }
                }

                // Validate financial amounts
                const goalAmount = parseFloat(goalAmountInput.value) || 0;
                const raisedAmount = parseFloat(raisedAmountInput.value) || 0;

                if (raisedAmount > goalAmount) {
                    raisedAmountInput.classList.add('is-invalid');
                    isValid = false;

                    if (!raisedAmountInput.nextElementSibling ||
                        !raisedAmountInput.nextElementSibling.classList.contains('invalid-feedback')) {
                        const errorDiv = document.createElement('div');
                        errorDiv.className = 'invalid-feedback';
                        errorDiv.textContent = 'المبلغ المجموع لا يمكن أن يكون أكبر من الهدف';
                        raisedAmountInput.parentNode.appendChild(errorDiv);
                    }
                }

                if (isValid) {
                    Swal.fire({
                        title: 'هل أنت متأكد؟',
                        text: "سيتم إضافة الحملة الجديدة إلى النظام",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#4e73df',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'نعم، أضف الحملة',
                        cancelButtonText: 'إلغاء',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                        }
                    });
                } else {
                    // Scroll to first invalid field
                    const firstInvalid = form.querySelector('.is-invalid');
                    if (firstInvalid) {
                        firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        firstInvalid.focus();
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'خطأ',
                        text: 'الرجاء إكمال جميع الحقول المطلوبة بشكل صحيح',
                    });
                }
            });
        }
    });
</script>
@endpush --}}
{{-- @extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Main content -->
        <div class="col-xl-10 col-lg-9 col-md-12 ms-auto">
            <div class="content" style="background: #f8fafc; min-height: 100vh; direction: rtl;">
                <!-- Animated Header -->
                <div class="page-header mb-4">
                    <h2 class="fw-bold text-gradient">
                        <i class="fas fa-plus-circle me-2"></i> إنشاء حملة تبرعات جديدة
                    </h2>
                    <p class="text-muted">املأ النموذج أدناه لإضافة حملة تبرعات جديدة إلى النظام</p>
                </div>

                <!-- Progress Steps -->
                <div class="row mb-5">
                    <div class="col-12">
                        <div class="steps">
                            <div class="step active" data-step="1">
                                <div class="step-circle">1</div>
                                <div class="step-title">المعلومات الأساسية</div>
                            </div>
                            <div class="step" data-step="2">
                                <div class="step-circle">2</div>
                                <div class="step-title">المعلومات المالية</div>
                            </div>
                            <div class="step" data-step="3">
                                <div class="step-circle">3</div>
                                <div class="step-title">الموقع والمسؤول</div>
                            </div>
                            <div class="step" data-step="4">
                                <div class="step-circle">4</div>
                                <div class="step-title">الصورة والتفاصيل</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Form Card -->
                <div class="card shadow-lg border-0 rounded-lg overflow-hidden">
                    <form action="{{ route('admin.causes.store') }}" method="POST" enctype="multipart/form-data" id="create-cause-form" novalidate>
                        @csrf

                        <div class="card-body p-5">
                            <!-- Step 1: Basic Information -->
                            <div class="form-step active" id="step-1">
                                <h4 class="form-step-title mb-4 text-primary">
                                    <i class="fas fa-info-circle me-2"></i> المعلومات الأساسية
                                </h4>

                                <div class="row g-4">
                                    <!-- Campaign Title -->
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                                   id="title" name="title" value="{{ old('title') }}"
                                                   placeholder="عنوان الحملة" required>
                                            <label for="title">عنوان الحملة <span class="text-danger">*</span></label>
                                            @error('title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text text-muted">يجب أن يكون العنوان واضحًا وجذابًا</div>
                                        </div>
                                    </div>

                                    <!-- Category -->
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <select class="form-select @error('category') is-invalid @enderror"
                                                    id="category" name="category">
                                                <option value="">اختر الفئة</option>
                                                <option value="تعليم" @if(old('category') == 'تعليم') selected @endif>تعليم</option>
                                                <option value="صحة" @if(old('category') == 'صحة') selected @endif>صحة</option>
                                                <option value="إغاثة" @if(old('category') == 'إغاثة') selected @endif>إغاثة</option>
                                                <option value="تنمية" @if(old('category') == 'تنمية') selected @endif>تنمية</option>
                                            </select>
                                            <label for="category">فئة الحملة</label>
                                            @error('category')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Description -->
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea class="form-control @error('description') is-invalid @enderror"
                                                      id="description" name="description"
                                                      placeholder="وصف الحملة" style="height: 120px" required>{{ old('description') }}</textarea>
                                            <label for="description">وصف الحملة <span class="text-danger">*</span></label>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text text-muted">صف الحملة بشكل مفصل وأهدافها ومستفيديها</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between mt-5">
                                    <button type="button" class="btn btn-outline-secondary disabled">
                                        <i class="fas fa-arrow-right me-2"></i> السابق
                                    </button>
                                    <button type="button" class="btn btn-primary next-step" data-next="2">
                                        التالي <i class="fas fa-arrow-left me-2"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Step 2: Financial Information -->
                            <div class="form-step" id="step-2">
                                <h4 class="form-step-title mb-4 text-primary">
                                    <i class="fas fa-money-bill-wave me-2"></i> المعلومات المالية
                                </h4>

                                <div class="row g-4">
                                    <!-- Goal Amount -->
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="number" class="form-control @error('goal_amount') is-invalid @enderror"
                                                   id="goal_amount" name="goal_amount" value="{{ old('goal_amount') }}"
                                                   placeholder="الهدف المطلوب" min="100" step="100" required>
                                            <label for="goal_amount">الهدف المطلوب ($) <span class="text-danger">*</span></label>
                                            @error('goal_amount')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text text-muted">أدخل المبلغ الإجمالي المطلوب جمعه</div>
                                        </div>
                                    </div>

                                    <!-- Raised Amount -->
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="number" class="form-control @error('raised_amount') is-invalid @enderror"
                                                   id="raised_amount" name="raised_amount" value="{{ old('raised_amount', 0) }}"
                                                   placeholder="المبلغ المجموع" min="0" step="100">
                                            <label for="raised_amount">المبلغ المجموع ($)</label>
                                            @error('raised_amount')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text text-muted">إذا كان هناك مبلغ محصل مسبقًا</div>
                                        </div>
                                    </div>

                                    <!-- Extra Raised Amount -->
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="number" class="form-control @error('extra_raised_amount') is-invalid @enderror"
                                                   id="extra_raised_amount" name="extra_raised_amount" value="{{ old('extra_raised_amount', 0) }}"
                                                   placeholder="مبلغ إضافي" min="0" step="100">
                                            <label for="extra_raised_amount">مبلغ إضافي ($)</label>
                                            @error('extra_raised_amount')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text text-muted">لأي تبرعات إضافية غير محسوبة</div>
                                        </div>
                                    </div>

                                    <!-- Progress Bar Preview -->
                                    <div class="col-12 mt-3">
                                        <div class="card bg-light">
                                            <div class="card-body">
                                                <h6 class="mb-3">معاينة تقدم الحملة:</h6>
                                                <div class="progress" style="height: 20px;">
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                                         id="progress-preview" role="progressbar" style="width: 0%">
                                                        <span class="progress-text">0%</span>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between mt-2">
                                                    <small class="text-muted">$<span id="raised-preview">0</span> محصل</small>
                                                    <small class="text-muted">$<span id="goal-preview">0</span> مطلوب</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between mt-5">
                                    <button type="button" class="btn btn-outline-secondary prev-step" data-prev="1">
                                        <i class="fas fa-arrow-right me-2"></i> السابق
                                    </button>
                                    <button type="button" class="btn btn-primary next-step" data-next="3">
                                        التالي <i class="fas fa-arrow-left me-2"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Step 3: Location & Responsible -->
                            <div class="form-step" id="step-3">
                                <h4 class="form-step-title mb-4 text-primary">
                                    <i class="fas fa-map-marker-alt me-2"></i> الموقع والمسؤول
                                </h4>

                                <div class="row g-4">
                                    <!-- Location -->
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control @error('location') is-invalid @enderror"
                                                   id="location" name="location" value="{{ old('location') }}"
                                                   placeholder="الموقع">
                                            <label for="location">موقع الحملة</label>
                                            @error('location')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text text-muted">المكان الذي ستخدمه الحملة</div>
                                        </div>
                                    </div>

                                    <!-- End Date -->
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                                                   id="end_date" name="end_date" value="{{ old('end_date') }}"
                                                   min="{{ date('Y-m-d') }}">
                                            <label for="end_date">تاريخ الانتهاء</label>
                                            @error('end_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text text-muted">تاريخ انتهاء جمع التبرعات</div>
                                        </div>
                                    </div>

                                    <!-- Responsible Person -->
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control @error('responsible_person_name') is-invalid @enderror"
                                                   id="responsible_person_name" name="responsible_person_name"
                                                   value="{{ old('responsible_person_name') }}" placeholder="اسم المسؤول">
                                            <label for="responsible_person_name">اسم المسؤول</label>
                                            @error('responsible_person_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Responsible Email -->
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="email" class="form-control @error('responsible_person_email') is-invalid @enderror"
                                                   id="responsible_person_email" name="responsible_person_email"
                                                   value="{{ old('responsible_person_email') }}" placeholder="بريد المسؤول">
                                            <label for="responsible_person_email">بريد المسؤول</label>
                                            @error('responsible_person_email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between mt-5">
                                    <button type="button" class="btn btn-outline-secondary prev-step" data-prev="2">
                                        <i class="fas fa-arrow-right me-2"></i> السابق
                                    </button>
                                    <button type="button" class="btn btn-primary next-step" data-next="4">
                                        التالي <i class="fas fa-arrow-left me-2"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Step 4: Image & Additional Details -->
                            <div class="form-step" id="step-4">
                                <h4 class="form-step-title mb-4 text-primary">
                                    <i class="fas fa-image me-2"></i> الصورة والتفاصيل
                                </h4>

                                <div class="row g-4">
                                    <!-- Image Upload -->
                                    <div class="col-md-6">
                                        <div class="card border-0 bg-light">
                                            <div class="card-body text-center">
                                                <div class="image-upload-container">
                                                    <input type="file" id="image" name="image" accept="image/*"
                                                           class="d-none @error('image') is-invalid @enderror">
                                                    <label for="image" class="image-upload-label">
                                                        <div class="image-upload-icon">
                                                            <i class="fas fa-cloud-upload-alt fa-3x text-muted"></i>
                                                        </div>
                                                        <div class="mt-3">
                                                            <h6>اضغط لرفع صورة الحملة</h6>
                                                            <p class="text-muted small">JPEG, PNG - الحد الأقصى 5MB</p>
                                                        </div>
                                                    </label>
                                                    @error('image')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div id="image-preview" class="mt-3" style="display: none;">
                                                    <img id="preview-image" src="#" alt="Preview"
                                                         class="img-thumbnail rounded" style="max-height: 200px;">
                                                    <button type="button" id="remove-image" class="btn btn-sm btn-danger mt-2">
                                                        <i class="fas fa-trash me-1"></i> إزالة الصورة
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Additional Details -->
                                    <div class="col-md-6">
                                        <div class="form-floating h-100">
                                            <textarea class="form-control h-100 @error('additional_details') is-invalid @enderror"
                                                      id="additional_details" name="additional_details"
                                                      placeholder="تفاصيل إضافية">{{ old('additional_details') }}</textarea>
                                            <label for="additional_details">تفاصيل إضافية</label>
                                            @error('additional_details')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text text-muted">أي معلومات إضافية تريد إضافتها</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between mt-5">
                                    <button type="button" class="btn btn-outline-secondary prev-step" data-prev="3">
                                        <i class="fas fa-arrow-right me-2"></i> السابق
                                    </button>
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-save me-2"></i> حفظ الحملة
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Progress Steps Style */
    .steps {
        display: flex;
        justify-content: space-between;
        position: relative;
        margin-bottom: 30px;
    }
    .steps::before {
        content: "";
        position: absolute;
        top: 20px;
        left: 0;
        right: 0;
        height: 3px;
        background: #e9ecef;
        z-index: 1;
    }
    .step {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        z-index: 2;
    }
    .step-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #e9ecef;
        color: #6c757d;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        margin-bottom: 8px;
        transition: all 0.3s;
    }
    .step-title {
        color: #6c757d;
        font-size: 14px;
    }
    .step.active .step-circle {
        background: #4e73df;
        color: white;
    }
    .step.active .step-title {
        color: #4e73df;
        font-weight: bold;
    }

    /* Form Steps */
    .form-step {
        display: none;
        animation: fadeIn 0.5s ease;
    }
    .form-step.active {
        display: block;
    }

    /* Image Upload Styling */
    .image-upload-container {
        border: 2px dashed #dee2e6;
        border-radius: 10px;
        padding: 2rem;
        cursor: pointer;
        transition: all 0.3s;
    }
    .image-upload-container:hover {
        border-color: #4e73df;
        background: rgba(78, 115, 223, 0.05);
    }
    .image-upload-label {
        cursor: pointer;
    }

    /* Floating Labels Enhancement */
    .form-floating > label {
        right: auto;
        left: 0;
        padding: 0 1rem;
    }
    .form-floating > .form-control:focus ~ label,
    .form-floating > .form-control:not(:placeholder-shown) ~ label,
    .form-floating > .form-select ~ label {
        transform: scale(0.85) translateY(-0.5rem) translateX(1.15rem);
    }

    /* Animations */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Gradient Text for Header */
    .text-gradient {
        background: linear-gradient(45deg, #4e73df, #224abe);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .steps {
            flex-wrap: wrap;
        }
        .step {
            width: 50%;
            margin-bottom: 20px;
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle multi-step form navigation
        const nextButtons = document.querySelectorAll('.next-step');
        const prevButtons = document.querySelectorAll('.prev-step');
        const steps = document.querySelectorAll('.step');
        const formSteps = document.querySelectorAll('.form-step');

        // Initialize first step
        updateStepIndicator(1);

        // Next button click handler
        nextButtons.forEach(button => {
            button.addEventListener('click', function() {
                const currentStep = document.querySelector('.form-step.active').id.split('-')[1];
                const nextStep = this.getAttribute('data-next');

                // Validate current step before proceeding
                if (validateStep(currentStep)) {
                    document.getElementById(`step-${currentStep}`).classList.remove('active');
                    document.getElementById(`step-${nextStep}`).classList.add('active');
                    updateStepIndicator(nextStep);

                    // Scroll to top of form
                    document.querySelector('.card-body').scrollTo({ top: 0, behavior: 'smooth' });
                }
            });
        });

        // Previous button click handler
        prevButtons.forEach(button => {
            button.addEventListener('click', function() {
                const currentStep = document.querySelector('.form-step.active').id.split('-')[1];
                const prevStep = this.getAttribute('data-prev');

                document.getElementById(`step-${currentStep}`).classList.remove('active');
                document.getElementById(`step-${prevStep}`).classList.add('active');
                updateStepIndicator(prevStep);

                // Scroll to top of form
                document.querySelector('.card-body').scrollTo({ top: 0, behavior: 'smooth' });
            });
        });

        // Update step indicator
        function updateStepIndicator(activeStep) {
            steps.forEach(step => {
                step.classList.remove('active');
                if (parseInt(step.getAttribute('data-step')) <= parseInt(activeStep)) {
                    step.classList.add('active');
                }
            });
        }

        // Validate step fields
        function validateStep(step) {
            let isValid = true;
            const currentStep = document.getElementById(`step-${step}`);

            // Check required fields in current step
            const requiredFields = currentStep.querySelectorAll('[required]');
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('is-invalid');
                    isValid = false;

                    // Add error message if not exists
                    if (!field.nextElementSibling || !field.nextElementSibling.classList.contains('invalid-feedback')) {
                        const errorDiv = document.createElement('div');
                        errorDiv.className = 'invalid-feedback';
                        errorDiv.textContent = 'هذا الحقل مطلوب';
                        field.parentNode.appendChild(errorDiv);
                    }
                } else {
                    field.classList.remove('is-invalid');
                }
            });

            // Special validation for email in step 3
            if (step === '3') {
                const emailField = document.getElementById('responsible_person_email');
                if (emailField.value && !validateEmail(emailField.value)) {
                    emailField.classList.add('is-invalid');
                    isValid = false;

                    if (!emailField.nextElementSibling || !emailField.nextElementSibling.classList.contains('invalid-feedback')) {
                        const errorDiv = document.createElement('div');
                        errorDiv.className = 'invalid-feedback';
                        errorDiv.textContent = 'البريد الإلكتروني غير صالح';
                        emailField.parentNode.appendChild(errorDiv);
                    }
                }
            }

            // Special validation for financial fields in step 2
            if (step === '2') {
                const goalAmount = parseFloat(document.getElementById('goal_amount').value) || 0;
                const raisedAmount = parseFloat(document.getElementById('raised_amount').value) || 0;

                if (raisedAmount > goalAmount) {
                    document.getElementById('raised_amount').classList.add('is-invalid');
                    isValid = false;

                    if (!document.getElementById('raised_amount').nextElementSibling ||
                        !document.getElementById('raised_amount').nextElementSibling.classList.contains('invalid-feedback')) {
                        const errorDiv = document.createElement('div');
                        errorDiv.className = 'invalid-feedback';
                        errorDiv.textContent = 'المبلغ المجموع لا يمكن أن يكون أكبر من الهدف';
                        document.getElementById('raised_amount').parentNode.appendChild(errorDiv);
                    }
                }
            }

            if (!isValid) {
                // Scroll to first invalid field
                const firstInvalid = currentStep.querySelector('.is-invalid');
                if (firstInvalid) {
                    firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstInvalid.focus();
                }
            }

            return isValid;
        }

        // Email validation helper
        function validateEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }

        // Image preview functionality
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('image-preview');
        const previewImage = document.getElementById('preview-image');
        const removeImageBtn = document.getElementById('remove-image');

        if (imageInput) {
            imageInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    if (file.size > 5 * 1024 * 1024) { // 5MB limit
                        Swal.fire({
                            icon: 'error',
                            title: 'خطأ',
                            text: 'حجم الصورة يجب أن يكون أقل من 5MB',
                        });
                        this.value = '';
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        imagePreview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        // Remove image
        if (removeImageBtn) {
            removeImageBtn.addEventListener('click', function() {
                imageInput.value = '';
                previewImage.src = '#';
                imagePreview.style.display = 'none';
            });
        }

        // Progress bar preview
        const goalAmountInput = document.getElementById('goal_amount');
        const raisedAmountInput = document.getElementById('raised_amount');
        const progressBar = document.getElementById('progress-preview');
        const progressText = document.querySelector('.progress-text');
        const raisedPreview = document.getElementById('raised-preview');
        const goalPreview = document.getElementById('goal-preview');

        function updateProgressBar() {
            const goal = parseFloat(goalAmountInput.value) || 0;
            const raised = parseFloat(raisedAmountInput.value) || 0;
            let percentage = 0;

            if (goal > 0) {
                percentage = Math.min((raised / goal) * 100, 100);
            }

            progressBar.style.width = `${percentage}%`;
            progressText.textContent = `${percentage.toFixed(0)}%`;
            raisedPreview.textContent = raised.toLocaleString();
            goalPreview.textContent = goal.toLocaleString();

            // Change color based on percentage
            if (percentage >= 100) {
                progressBar.classList.remove('bg-success', 'bg-warning');
                progressBar.classList.add('bg-danger');
            } else if (percentage >= 70) {
                progressBar.classList.remove('bg-success', 'bg-danger');
                progressBar.classList.add('bg-warning');
            } else {
                progressBar.classList.remove('bg-warning', 'bg-danger');
                progressBar.classList.add('bg-success');
            }
        }

        if (goalAmountInput && raisedAmountInput) {
            goalAmountInput.addEventListener('input', updateProgressBar);
            raisedAmountInput.addEventListener('input', updateProgressBar);
            updateProgressBar(); // Initial update
        }

        // Form submission with confirmation
        const form = document.getElementById('create-cause-form');
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                // Validate all steps before submission
                let allValid = true;
                for (let i = 1; i <= 4; i++) {
                    if (!validateStep(i)) {
                        allValid = false;
                        // Show the invalid step
                        document.querySelector('.form-step.active').classList.remove('active');
                        document.getElementById(`step-${i}`).classList.add('active');
                        updateStepIndicator(i);
                        break;
                    }
                }

                if (allValid) {
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
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'خطأ',
                        text: 'الرجاء إكمال جميع الحقول المطلوبة بشكل صحيح',
                    });
                }
            });
        }
    });
</script>
@endpush --}}
