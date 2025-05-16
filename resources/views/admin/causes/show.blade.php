@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <!-- Page Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-info-circle  me-2" style="color: #3cc88f !important"></i> تفاصيل الحملة: {{ $cause->title }}
        </h1>
        <div>
            <a href="{{ route('admin.causes.index') }}" class="btn btn-sm btn-secondary shadow-sm" style="background-color: #3cc88f !important;">
                <i class="fas fa-arrow-right me-1" ></i> رجوع للقائمة
            </a>
        </div>
    </div>

    <!-- Campaign Details Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-gradient-primary">
            <h6 class="m-0 font-weight-bold" style="color: #3cc88f">
                <i class="fas fa-chart-pie me-2" style="color: #3cc88f"></i> نظرة عامة على الحملة
            </h6>
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-white"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                     aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="{{ route('admin.causes.edit', $cause->id) }}">
                        <i class="fas fa-edit fa-sm me-2"></i> تعديل
                    </a>
                    <div class="dropdown-divider"></div>
                    <form action="{{ route('admin.causes.destroy', $cause->id) }}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="fas fa-trash fa-sm me-2"></i> حذف
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <!-- Campaign Image -->
                <div class="col-lg-5 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        @if($cause->image)
                            <img src="{{ asset('storage/' . $cause->image) }}"
                                 class="card-img-top rounded"
                                 alt="صورة الحملة"
                                 style="max-height: 300px; object-fit: cover;">
                        @else
                            <div class="d-flex align-items-center justify-content-center bg-light"
                                 style="height: 300px;">
                                <div class="text-center">
                                    <i class="fas fa-image fa-4x text-gray-400 mb-3"></i>
                                    <p class="text-muted">لا توجد صورة للحملة</p>
                                </div>
                            </div>
                        @endif
                        <div class="card-footer bg-white border-top-0">
                            <div class="d-flex justify-content-between">
                                <span class="badge bg-primary text-white">
                                    <i class="fas fa-tag me-1"></i> {{ $cause->category ?? 'غير محدد' }}
                                </span>
                                <span class="badge bg-info text-white">
                                    <i class="fas fa-map-marker-alt me-1"></i> {{ $cause->location ?? 'غير محدد' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Campaign Details -->
                <div class="col-lg-7">
                    <!-- Progress Card -->
                    <div class="card mb-4 border-left-success">
                        <div class="card-body py-3">
                           <div class="d-flex justify-content-between align-items-center">
    <div>
        <h6 class="font-weight-bold  mb-1" style="color: #3cc88f">تقدم الحملة</h6>
        @php
            $percentage = ($cause->raised_amount / $cause->goal_amount) * 100;

            $isExpired = $cause->end_date && now()->gt($cause->end_date);
            $isCompleted = $cause->raised_amount >= $cause->goal_amount;

            $progressBarClass = 'progress-bar-striped progress-bar-animated';
            $progressBarWidth = $percentage; // العرض الحقيقي

            if ($isCompleted) {
                $progressBarClass = 'bg-success'; // اكتمال: لون أخضر بدون حركة
                $progressBarWidth = min($percentage, 100); // لا يتجاوز 100% في العرض المرئي
            } elseif ($isExpired) {
                $progressBarClass = 'bg-danger'; // انتهاء: لون أحمر بدون حركة
            }
        @endphp

        <!-- شريط التقدم (يستخدم المتغيرات أعلاه) -->
        <div class="progress mb-2" style="height: 10px;">
            <div class="progress-bar {{ $progressBarClass }}"
                 role="progressbar"
                 style="width: {{ $progressBarWidth }}%;"
                 aria-valuenow="{{ $percentage }}"
                 aria-valuemin="0"
                 aria-valuemax="{{ max($cause->goal_amount, $cause->raised_amount) }}">
            </div>
        </div>

        <!-- المبالغ المحصلة والمطلوبة -->
        <div class="d-flex justify-content-between">
            <small class="text-muted">
                ${{ number_format($cause->raised_amount, 2) }} محصل
            </small>
            <small class="text-muted">
                ${{ number_format($cause->goal_amount, 2) }} مطلوب
            </small>
        </div>
    </div>

    <!-- عرض النسبة المئوية كبيرة -->
    <div class="text-end">
        <h3 class="font-weight-bold
            @if($isCompleted) text-success
            @elseif($isExpired) text-danger
            @else text-primary @endif mb-0">
            {{ round($percentage) }}%
        </h3>
    </div>
</div>
                        </div>
                    </div>

                    <!-- Details Card -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-circle bg-primary text-white me-3">
                                            <i class="fas fa-info-circle"></i>
                                        </div>
                                        <div>
                                            <h6 class="font-weight-bold mb-0">عنوان الحملة</h6>
                                            <p class="text-muted mb-0">{{ $cause->title }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-circle bg-success text-white me-3">
                                            <i class="fas fa-user-tie"></i>
                                        </div>
                                        <div>
                                            <h6 class="font-weight-bold mb-0">مسؤول الحملة</h6>
                                            <p class="text-muted mb-0">{{ $cause->responsible_person_name }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-circle bg-info text-white me-3">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        <div>
                                            <h6 class="font-weight-bold mb-0">بريد المسؤول</h6>
                                            <p class="text-muted mb-0">{{ $cause->responsible_person_email }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-circle bg-warning text-white me-3">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                        <div>
                                            <h6 class="font-weight-bold mb-0">تاريخ الإنشاء</h6>
                                            <p class="text-muted mb-0">{{ $cause->created_at->format('Y-m-d') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description Section -->
                <div class="col-12">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header py-3 bg-light">
                            <h6 class="m-0 font-weight-bold" style="color: #3cc88f">
                                <i class="fas fa-align-left me-2" style="color: #3cc88f"></i> وصف الحملة
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="markdown-content">
                                {!! nl2br(e($cause->description)) !!}
                            </div>
                        </div>
                    </div>

                    @if($cause->additional_details)
                    <div class="card shadow-sm">
                        <div class="card-header py-3 bg-light">
                            <h6 class="m-0 font-weight-bold" style="color: #3cc88f">
                                <i class="fas fa-ellipsis-h me-2" style="color: #3cc88f"></i> تفاصيل إضافية
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="markdown-content">
                                {!! nl2br(e($cause->additional_details)) !!}
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                <button type="button" class="btn btn-danger delete-btn">
                    <i class="fas fa-trash me-1"></i> حذف الحملة
                </button>

                <div>
                    <a href="{{ route('admin.causes.index') }}" class="btn btn-secondary me-2">
                        <i class="fas fa-times me-1"></i> إلغاء
                    </a>
                    <a href="{{ route('admin.causes.edit', $cause->id) }}" class="btn text-white" style="background-color: #3cc88f !important;">
                        <i class="fas fa-edit me-1"></i> تعديل الحملة
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Custom Styles */
    .icon-circle {
        width: 40px;
        height: 40px;
        border-radius: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .bg-gradient-primary {
        background: linear-gradient(45deg, #4e73df, #224abe);
    }

    .markdown-content {
        line-height: 1.8;
        font-size: 15px;
    }

    .progress-bar {
        transition: width 1s ease-in-out;
    }

    .card {
        transition: all 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 0.5rem 1.5rem 0 rgba(58, 59, 69, 0.15);
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .d-flex.justify-content-between {
            flex-direction: column-reverse;
            gap: 1rem;
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
                        document.querySelector('.delete-form').submit();
                    }
                });
            });
        }

        // Animate progress bar on page load
        const progressBar = document.querySelector('.progress-bar');
        if (progressBar) {
            // Reset width to 0 for animation
            const targetWidth = progressBar.style.width;
            progressBar.style.width = '0%';

            // Animate after a small delay
            setTimeout(() => {
                progressBar.style.width = targetWidth;
            }, 300);
        }
    });
</script>
@endpush
