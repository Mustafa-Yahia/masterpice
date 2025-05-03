@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <!-- Page Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-edit text-primary me-2"></i> تعديل حملة تبرعات
        </h1>
        <div>
            <a href="{{ route('admin.causes.index') }}" class="btn btn-sm btn-secondary shadow-sm">
                <i class="fas fa-arrow-right me-1"></i> رجوع للقائمة
            </a>
        </div>
    </div>

    <!-- Form Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-primary">
            <h6 class="m-0 font-weight-bold text-white">
                <i class="fas fa-edit me-2"></i> تعديل بيانات الحملة: {{ $cause->title }}
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.causes.update', $cause->id) }}" method="POST" enctype="multipart/form-data" id="edit-cause-form">
                @csrf
                @method('PUT')

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
                               id="title" name="title" value="{{ old('title', $cause->title) }}"
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
                            <option value="تعليم" @if(old('category', $cause->category) == 'تعليم') selected @endif>تعليم</option>
                            <option value="صحة" @if(old('category', $cause->category) == 'صحة') selected @endif>صحة</option>
                            <option value="إغاثة" @if(old('category', $cause->category) == 'إغاثة') selected @endif>إغاثة</option>
                            <option value="تنمية" @if(old('category', $cause->category) == 'تنمية') selected @endif>تنمية</option>
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
                                  required minlength="20" maxlength="2000">{{ old('description', $cause->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">يجب أن يكون الوصف بين 20 و2000 حرف</small>
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
                    <div class="col-md-6 mb-4">
                        <label for="goal_amount" class="form-label">الهدف المطلوب ($) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('goal_amount') is-invalid @enderror"
                               id="goal_amount" name="goal_amount" value="{{ old('goal_amount', $cause->goal_amount) }}"
                               min="100" max="1000000" step="100" required>
                        @error('goal_amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">يجب أن يكون المبلغ بين 100 و1,000,000 دولار</small>
                    </div>

                    <!-- Raised Amount -->
                    <div class="col-md-6 mb-4">
                        <label for="raised_amount" class="form-label">المبلغ المجموع ($)</label>
                        <input type="number" class="form-control @error('raised_amount') is-invalid @enderror"
                               id="raised_amount" name="raised_amount"
                               value="{{ old('raised_amount', $cause->raised_amount) }}"
                               min="0" step="100" readonly
                               style="background-color: #f8f9fa; cursor: not-allowed;">
                        @error('raised_amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">يتم تحديث هذا الحقل تلقائياً عند تلقي التبرعات</small>
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
                                            <div class="progress-bar progress-bar-striped"
                                                 id="progress-preview" role="progressbar"
                                                 style="width: {{ $cause->progress_percentage }}%">
                                                <span class="progress-text">{{ round($cause->progress_percentage) }}%</span>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <small class="text-muted">$<span id="raised-preview">{{ number_format($cause->raised_amount) }}</span> محصل</small>
                                            <small class="text-muted">$<span id="goal-preview">{{ number_format($cause->goal_amount) }}</span> مطلوب</small>
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
                        <label for="location" class="form-label">موقع الحملة <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('location') is-invalid @enderror"
                               id="location" name="location" value="{{ old('location', $cause->location) }}"
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
                               id="end_date" name="end_date"value="{{ old('end_date', $cause->end_date ? (is_string($cause->end_date) ? \Carbon\Carbon::parse($cause->end_date)->format('Y-m-d') : $cause->end_date->format('Y-m-d')) : '') }}" required>
                        @error('end_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Responsible Person -->
                    <div class="col-md-6 mb-4">
                        <label for="responsible_person_name" class="form-label">اسم المسؤول <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('responsible_person_name') is-invalid @enderror"
                               id="responsible_person_name" name="responsible_person_name"
                               value="{{ old('responsible_person_name', $cause->responsible_person_name) }}"
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
                               value="{{ old('responsible_person_email', $cause->responsible_person_email) }}" required>
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
                        <div class="custom-file-upload border rounded p-4 text-center"
                             style="border: 2px dashed #4e73df; background-color: #f8f9fc;">
                            <input type="file" id="image" name="image" accept="image/*"
                                   class="d-none @error('image') is-invalid @enderror">
                            <label for="image" class="file-upload-label d-flex flex-column align-items-center justify-content-center"
                                   style="cursor: pointer; height: 100%;">
                                <div class="file-upload-icon mb-3">
                                    <i class="fas fa-cloud-upload-alt fa-3x text-primary"></i>
                                </div>
                                <div class="file-upload-text text-center">
                                    <h5 class="mb-2 text-primary" style="font-weight: 600;">ارفاق صورة</h5>
                                    <p class="text-muted mb-1">اضغط هنا لاختيار صورة</p>
                                    <p class="text-muted small">JPEG, PNG - الحد الأقصى 5MB</p>
                                </div>
                            </label>
                            @error('image')
                                <div class="invalid-feedback d-block mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        @if($cause->image)
                        <div class="current-image mt-3">
                            <p class="text-muted mb-2">الصورة الحالية:</p>
                            <img src="{{ asset('storage/' . $cause->image) }}" alt="صورة الحملة الحالية"
                                 class="img-thumbnail rounded" style="max-height: 200px;">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" id="remove_image" name="remove_image">
                                <label class="form-check-label" for="remove_image">
                                    حذف الصورة الحالية
                                </label>
                            </div>
                        </div>
                        @endif

                        <div id="image-preview" class="mt-3 text-center" style="display: none;">
                            <img id="preview-image" src="#" alt="Preview"
                                 class="img-thumbnail rounded" style="max-height: 200px; border: 1px solid #ddd;">
                            <button type="button" id="remove-image" class="btn btn-sm btn-danger mt-2">
                                <i class="fas fa-trash me-1"></i> إزالة الصورة المحددة
                            </button>
                        </div>
                    </div>

                    <!-- Additional Details -->
                    <div class="col-md-6 mb-4">
                        <label for="additional_details" class="form-label">تفاصيل إضافية</label>
                        <textarea class="form-control @error('additional_details') is-invalid @enderror"
                                  id="additional_details" name="additional_details"
                                  rows="8" maxlength="1000">{{ old('additional_details', $cause->additional_details) }}</textarea>
                        @error('additional_details')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">حد أقصى 1000 حرف</small>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                    <button type="button" class="btn btn-danger delete-btn" data-id="{{ $cause->id }}">
                        <i class="fas fa-trash me-1"></i> حذف الحملة
                    </button>

                    <div>
                        <a href="{{ route('admin.causes.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i> إلغاء
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> حفظ التعديلات
                        </button>
                    </div>
                </div>
            </form>

            <!-- Delete Form (Hidden) -->
            <form id="delete-form" action="{{ route('admin.causes.destroy', $cause->id) }}" method="POST" class="d-none">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Custom Styles to Match Admin Theme */
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
        transition: all 0.3s;
    }

    .custom-file-upload:hover {
        background-color: rgba(78, 115, 223, 0.05);
    }

    .file-upload-label {
        cursor: pointer;
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

    /* Color progress bar based on percentage */
    .progress-bar {
        background-color: #1cc88a; /* Success color */
    }
    .progress-bar[style*="width: 100%"] {
        background-color: #e74a3b; /* Danger color */
    }
    .progress-bar[style*="width: 7"] {
        background-color: #f6c23e; /* Warning color */
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

        // Remove selected image
        if (removeImageBtn) {
            removeImageBtn.addEventListener('click', function() {
                imageInput.value = '';
                previewImage.src = '#';
                imagePreview.style.display = 'none';
            });
        }

        // Progress bar color based on percentage
        function updateProgressBarColor() {
            const progressBar = document.getElementById('progress-preview');
            const width = parseInt(progressBar.style.width) || 0;

            if (width >= 100) {
                progressBar.classList.remove('bg-success', 'bg-warning');
                progressBar.classList.add('bg-danger');
            } else if (width >= 70) {
                progressBar.classList.remove('bg-success', 'bg-danger');
                progressBar.classList.add('bg-warning');
            } else {
                progressBar.classList.remove('bg-warning', 'bg-danger');
                progressBar.classList.add('bg-success');
            }
        }

        // Update progress bar when amounts change
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

            updateProgressBarColor();
        }

        if (goalAmountInput && raisedAmountInput) {
            goalAmountInput.addEventListener('input', updateProgressBar);
            raisedAmountInput.addEventListener('input', updateProgressBar);
        }

        // Delete confirmation
        const deleteBtn = document.querySelector('.delete-btn');
        if (deleteBtn) {
            deleteBtn.addEventListener('click', function() {
                Swal.fire({
                    title: 'هل أنت متأكد؟',
                    text: "لن تتمكن من استعادة هذه الحملة بعد الحذف!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'نعم، احذفها!',
                    cancelButtonText: 'إلغاء',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form').submit();
                    }
                });
            });
        }

        // Form submission confirmation
        const form = document.getElementById('edit-cause-form');
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                // Client-side validation
                let isValid = true;
                const requiredFields = form.querySelectorAll('[required]');

                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        field.classList.add('is-invalid');
                        isValid = false;

                        if (!field.nextElementSibling || !field.nextElementSibling.classList.contains('invalid-feedback')) {
                            const errorDiv = document.createElement('div');
                            errorDiv.className = 'invalid-feedback';
                            errorDiv.textContent = 'هذا الحقل مطلوب';
                            field.parentNode.appendChild(errorDiv);
                        }
                    }
                });

                if (!isValid) {
                    Swal.fire({
                        icon: 'error',
                        title: 'خطأ',
                        text: 'الرجاء إكمال جميع الحقول المطلوبة بشكل صحيح',
                    });
                    return;
                }

                Swal.fire({
                    title: 'تأكيد التعديل',
                    text: "هل أنت متأكد من حفظ التعديلات على هذه الحملة؟",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'نعم، احفظ التعديلات!',
                    cancelButtonText: 'إلغاء',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        }

        // Show success message if exists
        @if(session('success'))
            Swal.fire({
                title: 'نجاح!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'حسناً'
            });
        @endif
    });
</script>
@endpush
{{-- @extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">تعديل الحملة</h4>
                        <a href="{{ route('admin.causes.index') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left"></i> رجوع
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.causes.update', $cause->id) }}" method="POST" enctype="multipart/form-data" class="edit-form">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="title" class="form-label">عنوان الحملة <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                                       name="title" value="{{ old('title', $cause->title) }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="category" class="form-label">الفئة</label>
                                <input type="text" class="form-control @error('category') is-invalid @enderror"
                                       id="category" name="category" value="{{ old('category', $cause->category) }}">
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="raised_amount" class="form-label">المبلغ المجموع ($) <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" class="form-control @error('raised_amount') is-invalid @enderror"
                                       id="raised_amount" name="raised_amount" value="{{ old('raised_amount', $cause->raised_amount) }}" required>
                                @error('raised_amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="goal_amount" class="form-label">الهدف المطلوب ($) <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" class="form-control @error('goal_amount') is-invalid @enderror"
                                       id="goal_amount" name="goal_amount" value="{{ old('goal_amount', $cause->goal_amount) }}" required>
                                @error('goal_amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="responsible_person_name" class="form-label">اسم المسؤول</label>
                                <input type="text" class="form-control @error('responsible_person_name') is-invalid @enderror"
                                       id="responsible_person_name" name="responsible_person_name"
                                       value="{{ old('responsible_person_name', $cause->responsible_person_name) }}">
                                @error('responsible_person_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="responsible_person_email" class="form-label">بريد المسؤول</label>
                                <input type="email" class="form-control @error('responsible_person_email') is-invalid @enderror"
                                       id="responsible_person_email" name="responsible_person_email"
                                       value="{{ old('responsible_person_email', $cause->responsible_person_email) }}">
                                @error('responsible_person_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="location" class="form-label">الموقع</label>
                                <input type="text" class="form-control @error('location') is-invalid @enderror"
                                       id="location" name="location" value="{{ old('location', $cause->location) }}">
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="image" class="form-label">صورة الحملة</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                       id="image" name="image" accept="image/*">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if($cause->image)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $cause->image) }}" alt="صورة الحملة الحالية" width="100" class="img-thumbnail">
                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="checkbox" id="remove_image" name="remove_image">
                                            <label class="form-check-label" for="remove_image">
                                                حذف الصورة الحالية
                                            </label>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="col-12 mb-3">
                                <label for="description" class="form-label">الوصف <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                          id="description" name="description" rows="5" required>{{ old('description', $cause->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 mb-3">
                                <label for="additional_details" class="form-label">تفاصيل إضافية</label>
                                <textarea class="form-control @error('additional_details') is-invalid @enderror"
                                          id="additional_details" name="additional_details" rows="3">{{ old('additional_details', $cause->additional_details) }}</textarea>
                                @error('additional_details')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> حفظ التعديلات
                                </button>

                                <a href="{{ route('admin.causes.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> إلغاء
                                </a>

                                <button type="button" class="btn btn-danger float-left delete-btn" data-id="{{ $cause->id }}">
                                    <i class="fas fa-trash"></i> حذف الحملة
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- نموذج الحذف المخفي -->
                    <form id="delete-form" action="" method="POST" class="d-none">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // معالجة رسائل النجاح من السيرفر
        @if(session('success'))
            Swal.fire({
                title: 'نجاح!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'حسناً'
            });
        @endif

        // تأكيد الحذف
        const deleteBtn = document.querySelector('.delete-btn');
        if (deleteBtn) {
            deleteBtn.addEventListener('click', function() {
                const causeId = this.getAttribute('data-id');
                const deleteForm = document.getElementById('delete-form');
                deleteForm.action = `/admin/causes/${causeId}`;

                Swal.fire({
                    title: 'هل أنت متأكد؟',
                    text: "لن تتمكن من استعادة هذه الحملة بعد الحذف!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'نعم، احذفها!',
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
                        deleteForm.submit();
                    }
                });
            });
        }

        // تأكيد التعديل
        const editForm = document.querySelector('.edit-form');
        if (editForm) {
            editForm.addEventListener('submit', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'تأكيد التعديل',
                    text: "هل أنت متأكد من حفظ التعديلات على هذه الحملة؟",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'نعم، احفظ التعديلات!',
                    cancelButtonText: 'إلغاء',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'جاري الحفظ...',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        this.submit();
                    }
                });
            });
        }
    });
</script>
@endpush
@endsection --}}
