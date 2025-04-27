@extends('layouts.admin')

@section('content')
<div class="container-fluid" style="padding-right: 270px; padding-top: 20px;">
    @include('admin.sidebar')

    <div class="content" style="background: #f9f9f9; padding: 30px; min-height: 100vh;">
        <h1>مرحباً بك في لوحة التحكم</h1>

        <div class="row" style="margin-top: 30px;">

            <!-- كارد عدد المستخدمين -->
            <div class="col-md-4 mb-4">
                <div class="card text-white bg-primary" style="border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                    <div class="card-body text-center">
                        <i class="fas fa-users fa-3x mb-3"></i>
                        <h4 class="card-title">عدد المستخدمين</h4>
                        <p class="card-text" style="font-size: 24px; font-weight: bold;">{{ $totalUsers }}</p>
                    </div>
                </div>
            </div>

            <!-- كارد مجموع التبرعات -->
            <div class="col-md-4 mb-4">
                <div class="card text-white bg-success" style="border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                    <div class="card-body text-center">
                        <i class="fas fa-hand-holding-usd fa-3x mb-3"></i>
                        <h4 class="card-title">إجمالي التبرعات</h4>
                        <p class="card-text" style="font-size: 24px; font-weight: bold;">${{ number_format($totalDonations, 2) }}</p>
                    </div>
                </div>
            </div>

            <!-- كارد عدد التبرعات -->
            <div class="col-md-4 mb-4">
                <div class="card text-white bg-warning" style="border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                    <div class="card-body text-center">
                        <i class="fas fa-donate fa-3x mb-3"></i>
                        <h4 class="card-title">عدد عمليات التبرع</h4>
                        <p class="card-text" style="font-size: 24px; font-weight: bold;">{{ $donationCount }}</p>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
