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
            <div class="card-header bg-gradient-primary text-white">
                <h5 class="mb-0">
                    <i class="fas fa-calendar-alt me-2"></i> تعديل بيانات الحدث: {{ $event->title }}
                </h5>
            </div>

            <div class="card-body">
                <form id="eventForm" action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data" novalidate>
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
                                              id="description" name="description" rows="3" required>{{ old('description', $event->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Date and Time -->
                                <div class="col-md-4">
                                    <label for="date" class="form-label">التاريخ <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('date') is-invalid @enderror"
                                           id="date" name="date"value="{{ old('date', \Carbon\Carbon::parse($event->date)->format('Y-m-d')) }}" required>
                                    @error('date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="time" class="form-label">الوقت <span class="text-danger">*</span></label>
                                    <input type="time" class="form-control @error('time') is-invalid @enderror"
                                           id="time" name="time" value="{{ old('time', $event->time) }}" required>
                                    @error('time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Volunteers -->
                                <div class="col-md-4">
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
                                    <label for="location_url" class="form-label">رابط الموقع</label>
                                    <input type="url" class="form-control @error('location_url') is-invalid @enderror"
                                           id="location_url" name="location_url" value="{{ old('location_url', $event->location_url) }}">
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
                                    <button type="button" class="btn btn-outline-primary w-100" id="openMapModal">
                                        <i class="fas fa-map-marked-alt me-2"></i> تحديد على الخريطة
                                    </button>
                                    <small class="text-muted d-block mt-1">اضغط لتحديد الموقع على الخريطة</small>
                                </div>

                                <!-- Map Preview -->
                                <div class="col-12">
                                    <div id="mapPreview" style="height: 300px; border-radius: 0.25rem; border: 1px solid #dee2e6; margin-top: 10px;">
                                        @if($event->latitude && $event->longitude)
                                            <img src="https://maps.googleapis.com/maps/api/staticmap?center={{ $event->latitude }},{{ $event->longitude }}&zoom=15&size=600x300&maptype=roadmap&markers=color:red%7C{{ $event->latitude }},{{ $event->longitude }}&key=YOUR_API_KEY"
                                                 alt="موقع الحدث" style="width: 100%; height: 100%; object-fit: cover; border-radius: 0.25rem;">
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
                                    <label for="image" class="form-label">الصورة الرئيسية</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                                           id="image" name="image" accept="image/*">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

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

                                <!-- Gallery -->
                                <div class="col-md-6">
                                    <label for="gallery" class="form-label">معرض الصور</label>
                                    <input type="file" class="form-control @error('gallery') is-invalid @enderror"
                                           id="gallery" name="gallery[]" multiple accept="image/*">
                                    @error('gallery')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    @if($event->gallery && count($event->gallery) > 0)
                                    <div class="mt-3">
                                        <h6>الصور الحالية:</h6>
                                        <div class="row g-2">
                                            @foreach($event->gallery as $image)
                                            <div class="col-4">
                                                <div class="position-relative">
                                                    <img src="{{ asset('storage/'.$image) }}" class="img-thumbnail" style="height: 80px; object-fit: cover;">
                                                    <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-gallery-image" data-image="{{ $image }}">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <input type="hidden" name="removed_gallery_images" id="removedGalleryImages" value="">
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
                            <button type="submit" class="btn btn-primary" id="submitBtn">
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
            <div class="modal-header bg-primary text-white">
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
                                <button class="btn btn-primary" type="button" id="searchButton">
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
                <button type="button" class="btn btn-primary" id="saveLocation">
                    <i class="fas fa-save me-2"></i> حفظ الموقع
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .nav-tabs .nav-link {
        font-weight: 500;
        border: none;
        padding: 0.75rem 1.25rem;
        color: #6c757d;
    }

    .nav-tabs .nav-link.active {
        color: #0d6efd;
        border-bottom: 3px solid #0d6efd;
        background: transparent;
    }

    .bg-gradient-primary {
        background: linear-gradient(87deg, #5e72e4 0, #825ee4 100%) !important;
    }

    .img-thumbnail {
        max-width: 100%;
        height: auto;
    }

    #map, #mapPreview {
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
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-control-geocoder@1.13.0/dist/Control.Geocoder.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form Validation
    const form = document.getElementById('eventForm');
    form.addEventListener('submit', function(e) {
        if (!form.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();

            // Show error messages and switch to first invalid tab
            const invalidFields = form.querySelectorAll(':invalid');
            if (invalidFields.length > 0) {
                const firstInvalid = invalidFields[0];
                const tabPane = firstInvalid.closest('.tab-pane');
                const tabId = tabPane ? tabPane.id : 'basic-info';

                // Switch to the tab containing the first invalid field
                document.querySelector(`[data-bs-target="#${tabId}"]`).click();
            }
        }

        form.classList.add('was-validated');
    }, false);

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
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    removeImage.value = '1';
                    if (currentImage) {
                        currentImage.style.display = 'none';
                    }
                    this.disabled = true;
                    Swal.fire('تم الحذف!', 'تم تحديد الصورة للحذف', 'success');
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
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    this.closest('.position-relative').style.display = 'none';
                    removedImages.push(image);
                    removedGalleryImages.value = JSON.stringify(removedImages);
                    Swal.fire('تم الحذف!', 'تم تحديد الصورة للحذف', 'success');
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
                    L.Control.geocoder({
                        defaultMarkGeocode: false,
                        position: 'topright',
                        placeholder: 'ابحث عن موقع...',
                        errorMessage: 'لم يتم العثور على النتائج',
                        geocoder: geocoder
                    })
                    .on('markgeocode', function(e) {
                        const { center, name } = e.geocode;
                        map.setView(center, 15);
                        if (marker) {
                            marker.setLatLng(center);
                        } else {
                            marker = L.marker(center).addTo(map);
                        }
                        document.getElementById('modalLatitude').value = center.lat.toFixed(6);
                        document.getElementById('modalLongitude').value = center.lng.toFixed(6);
                        document.getElementById('locationName').value = name;
                    })
                    .addTo(map);

                    // Add marker
                    marker = L.marker([latitude, longitude]).addTo(map);

                    // Handle map clicks
                    map.on('click', function(e) {
                        if (marker) {
                            marker.setLatLng(e.latlng);
                        } else {
                            marker = L.marker(e.latlng).addTo(map);
                        }

                        // Update coordinates
                        document.getElementById('modalLatitude').value = e.latlng.lat.toFixed(6);
                        document.getElementById('modalLongitude').value = e.latlng.lng.toFixed(6);

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

    // Search Location Functionality
    const searchButton = document.getElementById('searchButton');
    if (searchButton) {
        searchButton.addEventListener('click', function() {
            const query = document.getElementById('searchLocation').value;
            if (!query) return;

            geocoder.geocode(query, function(results) {
                if (results && results.length > 0) {
                    const { center, name } = results[0];
                    map.setView(center, 15);
                    if (marker) {
                        marker.setLatLng(center);
                    } else {
                        marker = L.marker(center).addTo(map);
                    }
                    document.getElementById('modalLatitude').value = center.lat.toFixed(6);
                    document.getElementById('modalLongitude').value = center.lng.toFixed(6);
                    document.getElementById('locationName').value = name;
                } else {
                    Swal.fire('خطأ', 'لم يتم العثور على الموقع المطلوب', 'error');
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
                Swal.fire('خطأ', 'الرجاء تحديد موقع على الخريطة', 'error');
                return;
            }

            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
            document.getElementById('location').value = locationName;

            // Update map preview
            const mapPreview = document.getElementById('mapPreview');
            if (mapPreview) {
                mapPreview.innerHTML = `
                    <img src="https://maps.googleapis.com/maps/api/staticmap?center=${lat},${lng}&zoom=15&size=600x300&maptype=roadmap&markers=color:red%7C${lat},${lng}&key=YOUR_API_KEY"
                         alt="موقع الحدث" style="width: 100%; height: 100%; object-fit: cover; border-radius: 0.25rem;">
                `;
            }

            mapModal.hide();
            Swal.fire('تم الحفظ!', 'تم تحديث موقع الحدث بنجاح', 'success');
        });
    }

    // Submit Confirmation
    const submitBtn = document.getElementById('submitBtn');
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
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'نعم، احفظ التعديلات',
            cancelButtonText: 'إلغاء',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            } else {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }
        });
    });

    // Show success/error messages
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'تم بنجاح',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'خطأ',
            text: '{{ session('error') }}',
            timer: 3000
        });
    @endif
});
</script>
@endpush
