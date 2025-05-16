@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">لوحة التحكم</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0">
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="fas fa-home mr-2"></i> الرئيسية
                </li>
            </ol>
        </nav>
    </div>

    <!-- Stats Cards -->
    <div class="row">
        <!-- Users Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                المستخدمين المسجلين</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalUsers }}</div>
                            <div class="mt-2">
                                <span class="text-success small font-weight-bold">
                                    <i class="fas fa-arrow-up mr-1"></i> 12%
                                </span>
                                <span class="text-muted small">مقارنة بالشهر الماضي</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Donations Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                إجمالي التبرعات</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{ number_format($totalDonations, 2) }}</div>
                            <div class="mt-2">
                                <span class="text-success small font-weight-bold">
                                    <i class="fas fa-arrow-up mr-1"></i> 24%
                                </span>
                                <span class="text-muted small">مقارنة بالشهر الماضي</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-donate fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transactions Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                عمليات التبرع</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $donationCount }}</div>
                            <div class="mt-2">
                                <span class="text-danger small font-weight-bold">
                                    <i class="fas fa-arrow-down mr-1"></i> 3%
                                </span>
                                <span class="text-muted small">مقارنة بالأسبوع الماضي</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hand-holding-usd fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Active Causes Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                الحملات النشطة</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $activeCauses ?? 0 }}</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar"
                                            style="width: {{ ($activeCauses / ($activeCauses + ($inactiveCauses ?? 1))) * 100 }}%"
                                            aria-valuenow="{{ $activeCauses }}" aria-valuemin="0"
                                            aria-valuemax="{{ $activeCauses + ($inactiveCauses ?? 1) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hand-holding-heart fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- تقدم الحملات مع Scrollbar -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between " style="background-color:#34b181;">
            <h6 class="m-0 font-weight-bold text-white">
                <i class="fas fa-chart-line mr-2"></i>تقدم الحملات
            </h6>
            <div class="dropdown no-arrow">

                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in">
                    <a class="dropdown-item" href="{{ route('admin.causes.index') }}">
                        <i class="fas fa-list mr-1"></i> عرض جميع الحملات
                    </a>
                    <a class="dropdown-item" href="">
                        <i class="fas fa-donate mr-1"></i> عرض التبرعات
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body" style="max-height: 400px; overflow-y: auto;">
            <div class="row">
                @foreach($campaigns as $cause)
                @php
                    $percentage = ($cause->raised_amount / $cause->goal_amount) * 100;
                    $progress = min(max($percentage, 0), 100);
                    $remaining_amount = max($cause->goal_amount - $cause->raised_amount, 0);
                    $progress_class = ($percentage >= 100) ? 'bg-success' :
                                    ($percentage >= 70 ? 'bg-warning' : 'bg-danger');
                    $isExpired = $cause->end_date && now()->gt($cause->end_date);
                    $isCompleted = ($percentage >= 100) && !$isExpired;
                @endphp

                <div class="col-lg-6 mb-4">
                    <div class="campaign-card border rounded p-3 h-100">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="mb-0 font-weight-bold text-dark">
                                <i class="fas fa-hashtag mr-1" style="color: #34b181;"></i>
                                {{ $cause->title }}
                            </h6>
                            <span class="badge badge-pill {{ $progress_class }}">
                                {{ round($percentage) }}%
                            </span>
                        </div>

                        <div class="progress mb-3" style="height: 10px;">
                            <div class="progress-bar progress-bar-striped {{ $isExpired ? '' : 'progress-bar-animated' }} {{ $progress_class }}"
                                 role="progressbar"
                                 style="width: {{ $progress }}%"
                                 aria-valuenow="{{ $progress }}"
                                 aria-valuemin="0"
                                 aria-valuemax="100">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="stat-card bg-light-success p-2 rounded text-center">
                                    <small class="text-muted d-block">المحصل</small>
                                    <span class="font-weight-bold text-success">${{ number_format($cause->raised_amount) }}</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="stat-card bg-light-primary p-2 rounded text-center">
                                    <small class="text-muted d-block">الهدف</small>
                                    <span class="font-weight-bold">${{ number_format($cause->goal_amount) }}</span>
                                </div>
                            </div>
                        </div>

                        @if($isExpired)
                            <div class="alert alert-danger p-2 mt-3 mb-0 text-center small">
                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                انتهت الحملة في {{ \Carbon\Carbon::parse($cause->end_date)->format('Y-m-d') }}
                            </div>
                        @elseif($isCompleted)
                            <div class="alert alert-success p-2 mt-3 mb-0 text-center small">
                                <i class="fas fa-check-circle mr-1"></i>
                                @if($percentage > 100)
                                    تم تجاوز الهدف بنسبة {{ round($percentage - 100) }}%
                                @else
                                    تم تحقيق الهدف بنجاح
                                @endif
                            </div>
                        @else
                            <div class="alert {{ $percentage >= 70 ? 'alert-warning' : 'alert-danger' }} p-2 mt-3 mb-0 text-center small">
                                <i class="fas {{ $percentage >= 70 ? 'fa-exclamation-circle' : 'fa-info-circle' }} mr-1"></i>
                                متبقي ${{ number_format($remaining_amount) }} لتحقيق الهدف
                            </div>
                        @endif
                    </div>
                </div>
                @endforeach

                @if($campaigns->isEmpty())
                <div class="col-12">
                    <div class="text-center py-4">
                        <i class="fas fa-hand-holding-heart fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">لا توجد حملات متاحة</h5>
                        <p class="text-muted">لم يتم إنشاء أي حملات حتى الآن</p>
                        <a href="{{ route('admin.causes.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus mr-1"></i> إنشاء حملة جديدة
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- جدول التبرعات مع Scrollbar -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between " style="background-color:#34b181;">
            <h6 class="m-0 font-weight-bold text-white">
                <i class="fas fa-donate mr-2"></i>أحدث التبرعات
            </h6>
            {{-- <a href="" class="btn btn-sm btn-light">
                عرض الكل <i class="fas fa-arrow-left mr-1"></i>
            </a> --}}
        </div>
        <div class="card-body p-0">
            <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                <table class="table table-bordered table-hover mb-0">
                    <thead class="bg-light sticky-top" style="top: -1px;">
                        <tr>
                            <th width="5%" class="sticky-col">#</th>
                            <th width="25%">المتبرع</th>
                            <th width="30%">الحملة</th>
                            <th width="15%" class="text-center">المبلغ</th>
                            <th width="25%" class="text-center">التاريخ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentDonations as $index => $donation)
                        <tr>
                            <td class="sticky-col">{{ $index + 1 }}</td>
                            <td class="font-weight-bold">{{ $donation->user->name ?? 'مستخدم غير معروف' }}</td>
                            <td>{{ Str::limit($donation->cause->title ?? 'حملة غير معروفة', 30) }}</td>
                            <td class="text-center text-success font-weight-bold">${{ number_format($donation->amount, 2) }}</td>
                            <td class="text-center">{{ $donation->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                <i class="fas fa-donate fa-2x text-muted mb-2"></i>
                                <p class="text-muted">لا توجد تبرعات حديثة</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<style>
    /* تخصيص Scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    ::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px;
    }
    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    .campaign-card {
        transition: all 0.3s ease;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    .campaign-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .stat-card {
        transition: all 0.2s ease;
    }
    .stat-card:hover {
        transform: scale(1.02);
    }

    .sticky-col {
        position: sticky;
        left: 0;
        background: white;
        z-index: 1;
    }

    .bg-light-success {
        background-color: rgba(40, 167, 69, 0.1);
    }
    .bg-light-primary {
        background-color: rgba(23, 162, 184, 0.1);
    }

    .bg-light-primary {
        background-color: rgba(78, 115, 223, 0.1);
    }
    .empty-state {
        padding: 2rem;
        text-align: center;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.02);
    }
    .text-truncate {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
@endsection
