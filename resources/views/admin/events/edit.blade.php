@extends('layouts.admin')

@section('content')
<div class="admin-container">
    @include('admin.sidebar')

    <div class="admin-content">
        <!-- Header Section -->
        <div class="content-header">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="page-title">
                    <i class="fas fa-calendar-edit me-2"></i> تعديل الحدث
                </h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.events.index') }}">الأحداث</a></li>
                        <li class="breadcrumb-item active" aria-current="page">تعديل</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Edit Event Form -->
        <div class="card shadow-lg">
            <div class="card-header  text-white" style="background-color: #3cc88f;">
                <h5 class="mb-0">
                    <i class="fas fa-calendar-alt me-2"></i> تعديل بيانات الحدث: {{ $event->title }}
                </h5>
            </div>

            <div class="card-body">
                <form id="eventForm" action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Form Tabs -->
                    <ul class="nav nav-tabs mb-4" id="eventTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="basic-tab" data-bs-toggle="tab" data-bs-target="#basic-info" type="button">
                                <i class="fas fa-info-circle me-1"></i> المعلومات الأساسية
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="location-tab" data-bs-toggle="tab" data-bs-target="#location-info" type="button">
                                <i class="fas fa-map-marker-alt me-1"></i> معلومات الموقع
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="media-tab" data-bs-toggle="tab" data-bs-target="#media-info" type="button">
                                <i class="fas fa-images me-1"></i> الوسائط
                            </button>
                        </li>
                    </ul>

                    <!-- Tab Contents -->
                    <div class="tab-content" id="eventTabsContent">
                        <!-- Basic Info Tab -->
                        <div class="tab-pane fade show active" id="basic-info" role="tabpanel">
                            <div class="row g-3">
                                <!-- Title -->
                                <div class="col-md-6">
                                    <label for="title" class="form-label">عنوان الحدث <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                           id="title" name="title" value="{{ old('title', $event->title) }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Description -->
                                <div class="col-md-6">
                                    <label for="description" class="form-label">الوصف المختصر <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                              id="description" name="description" rows="3" required
                                              oninput="checkWordAndCharCount(this)">{{ old('description', $event->description) }}</textarea>
                                    <div id="error-message" class="invalid-feedback" style="display:none;">
                                        يجب ألا يتجاوز عدد الكلمات 20 كلمة، وألا تتجاوز أطول كلمة 15 حرف.
                                    </div>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Date and Time -->
                                <div class="col-md-4">
                                    <label for="date" class="form-label">التاريخ <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('date') is-invalid @enderror"
                                           id="date" name="date" value="{{ old('date', \Carbon\Carbon::parse($event->date)->format('Y-m-d')) }}" required>
                                    @error('date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="time" class="form-label">وقت البدء <span class="text-danger">*</span></label>
                                    <input type="time" class="form-control @error('time') is-invalid @enderror"
                                           id="time" name="time" value="{{ old('time', $event->time) }}" required>
                                    @error('time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="end_time" class="form-label">وقت الانتهاء <span class="text-danger">*</span></label>
                                    <input type="time" class="form-control @error('end_time') is-invalid @enderror"
                                           id="end_time" name="end_time" value="{{ old('end_time', $event->end_time) }}" required>
                                    @error('end_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Volunteers -->
                                <div class="col-md-6">
                                    <label for="volunteers_needed" class="form-label">عدد المتطوعين <span class="text-danger">*</span></label>
                                    <input type="number" min="1" class="form-control @error('volunteers_needed') is-invalid @enderror"
                                           id="volunteers_needed" name="volunteers_needed" value="{{ old('volunteers_needed', $event->volunteers_needed) }}" required>
                                    @error('volunteers_needed')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Mission -->
                                <div class="col-12">
                                    <label for="mission" class="form-label">المهمة الرئيسية <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('mission') is-invalid @enderror"
                                              id="mission" name="mission" rows="4" required>{{ old('mission', $event->mission) }}</textarea>
                                    @error('mission')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Mission Points -->
                                <div class="col-md-4">
                                    <label for="mission_point_1" class="form-label">نقطة المهمة 1 <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('mission_point_1') is-invalid @enderror"
                                           id="mission_point_1" name="mission_point_1" value="{{ old('mission_point_1', $event->mission_point_1) }}" required>
                                    @error('mission_point_1')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="mission_point_2" class="form-label">نقطة المهمة 2 <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('mission_point_2') is-invalid @enderror"
                                           id="mission_point_2" name="mission_point_2" value="{{ old('mission_point_2', $event->mission_point_2) }}" required>
                                    @error('mission_point_2')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="mission_point_3" class="form-label">نقطة المهمة 3 <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('mission_point_3') is-invalid @enderror"
                                           id="mission_point_3" name="mission_point_3" value="{{ old('mission_point_3', $event->mission_point_3) }}" required>
                                    @error('mission_point_3')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Location Info Tab -->
                        <div class="tab-pane fade" id="location-info" role="tabpanel">
                            <div class="row g-3">
                                <!-- Location -->
                                <div class="col-md-6">
                                    <label for="location" class="form-label">الموقع <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('location') is-invalid @enderror"
                                           id="location" name="location" value="{{ old('location', $event->location) }}" required>
                                    @error('location')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Location URL -->
                                <div class="col-md-6">
                                    <label for="location_url" class="form-label">رابط الموقع <span class="text-danger">*</span></label>
                                    <input type="url" class="form-control @error('location_url') is-invalid @enderror"
                                           id="location_url" name="location_url" value="{{ old('location_url', $event->location_url) }}" required>
                                    @error('location_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Coordinates -->
                                <div class="col-md-4">
                                    <label for="latitude" class="form-label">خط العرض <span class="text-danger">*</span></label>
                                    <input type="number" step="0.000001" class="form-control @error('latitude') is-invalid @enderror"
                                           id="latitude" name="latitude" value="{{ old('latitude', $event->latitude) }}" required>
                                    @error('latitude')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="longitude" class="form-label">خط الطول <span class="text-danger">*</span></label>
                                    <input type="number" step="0.000001" class="form-control @error('longitude') is-invalid @enderror"
                                           id="longitude" name="longitude" value="{{ old('longitude', $event->longitude) }}" required>
                                    @error('longitude')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">خريطة الموقع <span class="text-danger">*</span></label>
                                    <button type="button" class="btn w-100" id="openMapModal" style="background-color: #3cc88f; border-color: #3cc88f; color: white;">
                                        فتح الخريطة
                                      </button>
                                                                              <i class="fas fa-map-marked-alt me-2"></i> تحديد على الخريطة
                                    </button>
                                    <small class="text-muted d-block mt-1">اضغط لتحديد الموقع على الخريطة</small>
                                </div>

                                <!-- Map Preview -->
                                <div class="col-12">
                                    <div id="mapPreview" style="height: 300px; border-radius: 0.25rem; border: 1px solid #dee2e6; margin-top: 10px;">
                                        @if($event->latitude && $event->longitude)
                                            <div id="miniMap" style="width: 100%; height: 100%;"></div>
                                        @else
                                            <div class="d-flex align-items-center justify-content-center h-100 bg-light">
                                                <p class="text-muted mb-0">لم يتم تحديد موقع بعد</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Media Info Tab -->
                        <div class="tab-pane fade" id="media-info" role="tabpanel">
                            <div class="row g-3">
                                <!-- Main Image -->
                                <div class="col-md-6">
                                    <label for="image" class="form-label">الصورة الرئيسية <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                                           id="image" name="image" accept="image/*">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">الصيغ المسموحة: JPEG, PNG, JPG - الحد الأقصى للحجم: 2MB</small>

                                    @if($event->image)
                                    <div class="mt-3">
                                        <img src="{{ asset('storage/'.$event->image) }}" class="img-thumbnail" id="currentImage" style="max-height: 200px;">
                                        <div class="mt-2">
                                            <button type="button" class="btn btn-sm btn-danger" id="removeImageBtn">
                                                <i class="fas fa-trash me-1"></i> حذف الصورة الحالية
                                            </button>
                                            <input type="hidden" name="remove_image" id="removeImage" value="0">
                                        </div>
                                    </div>
                                    @endif
                                </div>


                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                        <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i> رجوع
                        </a>
                        <div>
                            <button type="reset" class="btn btn-outline-danger me-2">
                                <i class="fas fa-undo me-2"></i> إعادة تعيين
                            </button>
                            <button type="submit" class="btn" id="submitBtn" style="background-color: #3cc88f; color: #fff;">
                                <i class="fas fa-save me-2"></i> حفظ التعديلات
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Map Modal -->
<div class="modal fade" id="mapModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header  text-white" style="background-color: #3cc88f;">
                <h5 class="modal-title">تحديد موقع الحدث على الخريطة</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="row g-0">
                    <div class="col-md-8">
                        <div id="map" style="height: 500px;"></div>
                    </div>
                    <div class="col-md-4 p-3">
                        <div class="mb-3">
                            <label for="searchLocation" class="form-label">بحث عن موقع:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="searchLocation" placeholder="أدخل اسم المكان">
                                <button class="btn" type="button" id="searchButton" style="background-color: #3cc88f; color: white;">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">إحداثيات الموقع:</label>
                            <div class="row g-2">
                                <div class="col-6">
                                    <label class="form-label">خط العرض</label>
                                    <input type="text" class="form-control" id="modalLatitude" readonly>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">خط الطول</label>
                                    <input type="text" class="form-control" id="modalLongitude" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="locationName" class="form-label">اسم الموقع:</label>
                            <input type="text" class="form-control" id="locationName">
                        </div>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i> انقر على الخريطة لتحديد موقع الحدث
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i> إلغاء
                </button>
                <button type="button" class="btn " id="saveLocation" style="background-color: #3cc88f; color: white;">
                    <i class="fas fa-save me-2"></i> حفظ الموقع
                </button>
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

.nav-tabs .nav-link {
    font-weight: 500;
    border: none;
    padding: 0.75rem 1.25rem;
    color: #6c757d;
}

.nav-tabs .nav-link.active {
    color: var(--primary-color);
    border-bottom: 3px solid var(--primary-color);
    background: transparent;
}

.card-header.bg-primary {
    background-color: var(--primary-color) !important;
}

.btn-primary {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
}

.btn-primary:hover {
    background-color: var(--primary-hover);
    border-color: var(--primary-hover);
}

.btn-outline-primary {
    color: var(--primary-color);
    border-color: var(--primary-color);
}

.btn-outline-primary:hover {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
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

.img-thumbnail {
    max-width: 100%;
    height: auto;
}

#map, #mapPreview, #miniMap {
    border-radius: 0.25rem;
    border: 1px solid #dee2e6;
}

.remove-gallery-image {
    padding: 0.15rem 0.3rem;
    border-radius: 50%;
    transform: translate(50%, -50%);
}

.leaflet-top, .leaflet-bottom {
    z-index: 999 !important;
}

.swal2-popup {
    text-align: right !important;
    direction: rtl !important;
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-control-geocoder@1.13.0/dist/Control.Geocoder.js"></script>

<script>
    function checkWordAndCharCount(textarea) {
        let words = textarea.value.trim().split(/\s+/);
        let wordCount = words.length;
        let maxWordLength = 15;
        const errorMessage = document.getElementById("error-message");

        // التحقق من عدد الكلمات وأقصى طول للكلمة
        let maxWordExceeded = words.some(word => word.length > maxWordLength);

        if (wordCount > 20 || maxWordExceeded) {
            // إذا تجاوز عدد الكلمات 20 أو كان هناك كلمة أطول من 15 حرفًا
            textarea.classList.add("is-invalid");  // إضافة الكلاس لإظهار التنسيق الأحمر
            errorMessage.style.display = "block";   // إظهار رسالة الخطأ

            // تقليص النص إذا كان عدد الكلمات أكبر من 20 أو هناك كلمة طويلة
            if (wordCount > 20) {
                textarea.value = words.slice(0, 20).join(" ");
            }
            // تقليص النص إذا كانت هناك كلمة أطول من 15 حرف
            textarea.value = textarea.value.trim().split(/\s+/).map(word =>
                word.length > maxWordLength ? word.slice(0, maxWordLength) : word
            ).join(" ");
        } else {
            // إذا كانت الشروط صحيحة، إخفاء رسالة الخطأ
            textarea.classList.remove("is-invalid");
            errorMessage.style.display = "none";
        }
    }
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize mini map if coordinates exist
    @if($event->latitude && $event->longitude)
    const miniMap = L.map('miniMap').setView([{{ $event->latitude }}, {{ $event->longitude }}], 15);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(miniMap);

    L.marker([{{ $event->latitude }}, {{ $event->longitude }}]).addTo(miniMap);
    @endif

    // Form Validation
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
                const fieldName = field.closest('.form-group')?.querySelector('.form-label')?.textContent?.trim() || 'حقل';
                errorMessage += `- ${fieldName} مطلوب<br>`;
            } else {
                field.classList.remove('is-invalid');
            }
        });

        // Validate image file if new one is uploaded
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

            // Switch to the first tab with errors
            const firstInvalid = form.querySelector(':invalid');
            if (firstInvalid) {
                const tabPane = firstInvalid.closest('.tab-pane');
                if (tabPane) {
                    const tabId = tabPane.id;
                    document.querySelector(`[data-bs-target="#${tabId}"]`).click();
                }
            }

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

    // Image Preview and Removal
    const imageInput = document.getElementById('image');
    const currentImage = document.getElementById('currentImage');
    const removeImageBtn = document.getElementById('removeImageBtn');
    const removeImage = document.getElementById('removeImage');

    if (imageInput) {
        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    if (currentImage) {
                        currentImage.src = e.target.result;
                    }
                }
                reader.readAsDataURL(file);
            }
        });
    }

    if (removeImageBtn) {
        removeImageBtn.addEventListener('click', function() {
            Swal.fire({
                title: 'هل أنت متأكد؟',
                text: "سيتم حذف الصورة الرئيسية للحدث!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'نعم، احذف!',
                cancelButtonText: 'إلغاء',
                reverseButtons: true,
                customClass: {
                    popup: 'text-right'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    removeImage.value = '1';
                    if (currentImage) {
                        currentImage.style.display = 'none';
                    }
                    this.disabled = true;
                    Swal.fire({
                        title: 'تم الحذف!',
                        text: 'تم تحديد الصورة للحذف',
                        icon: 'success',
                        confirmButtonColor: '#3cc88f',
                        customClass: {
                            popup: 'text-right'
                        }
                    });
                }
            });
        });
    }

    // Gallery Image Removal
    const removeButtons = document.querySelectorAll('.remove-gallery-image');
    const removedGalleryImages = document.getElementById('removedGalleryImages');
    let removedImages = [];

    removeButtons.forEach(button => {
        button.addEventListener('click', function() {
            const image = this.getAttribute('data-image');

            Swal.fire({
                title: 'هل أنت متأكد؟',
                text: "سيتم حذف هذه الصورة من المعرض!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'نعم، احذف!',
                cancelButtonText: 'إلغاء',
                reverseButtons: true,
                customClass: {
                    popup: 'text-right'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    this.closest('.position-relative').style.display = 'none';
                    removedImages.push(image);
                    removedGalleryImages.value = JSON.stringify(removedImages);
                    Swal.fire({
                        title: 'تم الحذف!',
                        text: 'تم تحديد الصورة للحذف',
                        icon: 'success',
                        confirmButtonColor: '#3cc88f',
                        customClass: {
                            popup: 'text-right'
                        }
                    });
                }
            });
        });
    });

    // Map Integration with Geocoding
    const openMapModal = document.getElementById('openMapModal');
    const mapModal = new bootstrap.Modal(document.getElementById('mapModal'));
    let map, marker, geocoder;

    if (openMapModal) {
        openMapModal.addEventListener('click', function() {
            mapModal.show();

            // Initialize map when modal is shown
            mapModal._element.addEventListener('shown.bs.modal', function() {
                const latitude = document.getElementById('latitude').value || 24.7136;
                const longitude = document.getElementById('longitude').value || 46.6753;
                const locationName = document.getElementById('location').value || '';

                document.getElementById('modalLatitude').value = latitude;
                document.getElementById('modalLongitude').value = longitude;
                document.getElementById('locationName').value = locationName;

                if (!map) {
                    // Initialize map
                    map = L.map('map').setView([latitude, longitude], 15);

                    // Add tile layer
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                    }).addTo(map);

                    // Initialize geocoder
                    geocoder = L.Control.Geocoder.nominatim();

                    // Add search control
                    L.Control.geocoder({
                        defaultMarkGeocode: false,
                        position: 'topright',
                        placeholder: 'ابحث عن موقع...',
                        errorMessage: 'لم يتم العثور على النتائج',
                        geocoder: geocoder
                    })
                    .on('markgeocode', function(e) {
                        const { center, name } = e.geocode;
                        updateMapLocation(center.lat, center.lng, name);
                    })
                    .addTo(map);

                    // Add marker
                    marker = L.marker([latitude, longitude]).addTo(map);

                    // Handle map clicks
                    map.on('click', function(e) {
                        updateMapLocation(e.latlng.lat, e.latlng.lng);

                        // Reverse geocode to get location name
                        geocoder.reverse(e.latlng, map.options.crs.scale(map.getZoom()), function(results) {
                            if (results && results.length > 0) {
                                document.getElementById('locationName').value = results[0].name;
                            }
                        });
                    });
                } else {
                    // Update existing map view
                    map.setView([latitude, longitude], 15);
                    if (marker) {
                        marker.setLatLng([latitude, longitude]);
                    } else {
                        marker = L.marker([latitude, longitude]).addTo(map);
                    }
                }
            });
        });
    }

    // Function to update map location
    function updateMapLocation(lat, lng, name = '') {
        if (marker) {
            marker.setLatLng([lat, lng]);
        } else {
            marker = L.marker([lat, lng]).addTo(map);
        }

        // Update coordinates
        document.getElementById('modalLatitude').value = lat.toFixed(6);
        document.getElementById('modalLongitude').value = lng.toFixed(6);

        // Update location name if provided
        if (name) {
            document.getElementById('locationName').value = name;
        }
    }

    // Search Location Functionality
    const searchButton = document.getElementById('searchButton');
    if (searchButton) {
        searchButton.addEventListener('click', function() {
            const query = document.getElementById('searchLocation').value;
            if (!query) return;

            geocoder.geocode(query, function(results) {
                if (results && results.length > 0) {
                    const { center, name } = results[0];
                    updateMapLocation(center.lat, center.lng, name);
                } else {
                    Swal.fire({
                        title: 'خطأ',
                        text: 'لم يتم العثور على الموقع المطلوب',
                        icon: 'error',
                        confirmButtonColor: '#3cc88f',
                        customClass: {
                            popup: 'text-right'
                        }
                    });
                }
            });
        });
    }

    // Save Location
    const saveLocation = document.getElementById('saveLocation');
    if (saveLocation) {
        saveLocation.addEventListener('click', function() {
            const lat = document.getElementById('modalLatitude').value;
            const lng = document.getElementById('modalLongitude').value;
            const locationName = document.getElementById('locationName').value;

            if (!lat || !lng) {
                Swal.fire({
                    title: 'خطأ',
                    text: 'الرجاء تحديد موقع على الخريطة',
                    icon: 'error',
                    confirmButtonColor: '#3cc88f',
                    customClass: {
                        popup: 'text-right'
                    }
                });
                return;
            }

            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
            document.getElementById('location').value = locationName;

            // Update mini map preview
            @if($event->latitude && $event->longitude)
            miniMap.setView([lat, lng], 15);
            miniMap.eachLayer(function(layer) {
                if (layer instanceof L.Marker) {
                    layer.setLatLng([lat, lng]);
                }
            });
            @endif

            mapModal.hide();
            Swal.fire({
                title: 'تم الحفظ!',
                text: 'تم تحديث موقع الحدث بنجاح',
                icon: 'success',
                confirmButtonColor: '#3cc88f',
                customClass: {
                    popup: 'text-right'
                }
            });
        });
    }

    // Submit Confirmation
    const submitBtn = document.getElementById('submitBtn');
    if (submitBtn) {
        submitBtn.addEventListener('click', function(e) {
            e.preventDefault();

            const form = document.getElementById('eventForm');
            const originalText = submitBtn.innerHTML;

            if (!form.checkValidity()) {
                form.classList.add('was-validated');
                return;
            }

            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> جاري الحفظ...';

            Swal.fire({
                title: 'تأكيد التعديلات',
                text: "هل أنت متأكد من أنك تريد حفظ التعديلات على هذا الحدث؟",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3cc88f',
                cancelButtonColor: '#d33',
                confirmButtonText: 'نعم، احفظ التعديلات',
                cancelButtonText: 'إلغاء',
                reverseButtons: true,
                customClass: {
                    popup: 'text-right'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                } else {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                }
            });
        });
    }

    // Show success/error messages
    @if(session('success'))
    Swal.fire({
        title: 'تم بنجاح',
        text: '{{ session('success') }}',
        icon: 'success',
        confirmButtonColor: '#3cc88f',
        customClass: {
            popup: 'text-right'
        }
    });
    @endif

    @if(session('error'))
    Swal.fire({
        title: 'خطأ',
        text: '{{ session('error') }}',
        icon: 'error',
        confirmButtonColor: '#3cc88f',
        customClass: {
            popup: 'text-right'
        }
    });
    @endif

    @if($errors->any())
    Swal.fire({
        title: 'خطأ',
        html: `@foreach ($errors->all() as $error)
                <div>- {{ $error }}</div>
              @endforeach`,
        icon: 'error',
        confirmButtonColor: '#3cc88f',
        customClass: {
            popup: 'text-right'
        }
    });
    @endif
});
</script>
@endpush
