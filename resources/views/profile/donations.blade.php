@extends('layouts.app')

@section('content')

<!-- Sidebar Page Container -->
<div class="sidebar-page-container" style="direction: rtl;">
    <div class="auto-container">
        <div class="row clearfix">
            <!-- استخدام الـ Sidebar Component هنا -->
            @include('components.user-sidebar')

            <!-- Content Side (المحتوى الرئيسي) -->
            <div class="content-side col-lg-8 col-md-12 col-sm-12">
                <div class="user-profile-details" style="box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); padding: 20px; border-radius: 10px; background: #fff; animation: fadeIn 1s ease-in-out;">
                    <h2 style="text-align: right; color: #3cc88f;">عمليات التبرع</h2>
                    <table class="table table-bordered" style="direction: rtl; text-align: right; table-layout: fixed; width: 100%; border-radius: 10px; border: 1px solid #ddd;">
                        <thead style="background-color: #3cc88f; color: white; font-weight: bold;">
                            <tr>
                                <th>المبلغ</th>
                                <th>العملة</th>
                                <th>طريقة الدفع</th>
                                <th>تاريخ التبرع</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 14px; background-color: #f9f9f9;">
                            @foreach($donations as $donation)
                                <tr style="transition: transform 0.3s ease; cursor: pointer;" onmouseover="this.style.transform='scale(1.05)';" onmouseout="this.style.transform='scale(1)';">
                                    <td>{{ $donation->amount }}</td>
                                    <td>{{ $donation->currency }}</td>
                                    <td>
                                        @if($donation->paymentMethod)
                                            {{ $donation->paymentMethod->method_name }}
                                        @else
                                            غير معروف
                                        @endif
                                    </td>
                                    <td>{{ $donation->created_at->format('Y-m-d H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Sidebar Page Container -->

@endsection

@section('styles')
<style>
    /* إضافة تأثير التلاشي عند تحميل المحتوى */
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    /* تأثير التمرير فوق الصفوف */
    tbody tr:hover {
        background-color: #e0f4eb;
    }

    /* تنسيق الجدول */
    table {
        border-collapse: collapse;
    }
    th, td {
        padding: 12px;
        text-align: right; /* محاذاة النص لليمين */
    }
    th {
        background-color: #3cc88f; /* اللون الجديد */
        color: white;
        font-weight: bold;
    }
    tbody tr {
        background-color: #f9f9f9;
    }
</style>
@endsection

{{-- @extends('layouts.app')

@section('content')

<!-- Sidebar Page Container -->
<div class="sidebar-page-container" style="direction: rtl;">
    <div class="auto-container">
        <div class="row clearfix">
            <!-- استخدام الـ Sidebar Component هنا -->
            <x-user-sidebar :subscriptions="$subscriptions" />

            <!-- Content Side (المحتوى الرئيسي) -->
            <div class="content-side col-lg-8 col-md-12 col-sm-12">
                <div class="user-profile-details" style="box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); padding: 20px; border-radius: 10px; background: #fff;">
                    <h2>عمليات التبرع</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>المبلغ</th>
                                <th>العملة</th>
                                <th>طريقة الدفع</th>
                                <th>تاريخ التبرع</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($donations as $donation)
                                <tr>
                                    <td>{{ $donation->amount }}</td>
                                    <td>{{ $donation->currency }}</td>
                                    <td>
                                        <!-- ربط مع جدول طرق الدفع باستخدام payment_method_id -->
                                        @if($donation->paymentMethod)
                                            {{ $donation->paymentMethod->method_name }}
                                        @else
                                            غير معروف
                                        @endif
                                    </td>
                                    <td>{{ $donation->created_at->format('Y-m-d H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Sidebar Page Container -->

@endsection --}}
