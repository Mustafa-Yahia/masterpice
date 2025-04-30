@extends('layouts.admin')

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
@endsection
