@extends('layouts.app')

@section('content')

<!-- Sidebar Page Container -->
<div class="sidebar-page-container" style="direction: rtl;">
    <div class="auto-container">
        <div class="row clearfix">
            <!-- استخدام الـ Sidebar Component هنا -->
            <x-user-sidebar :subscriptions="$subscriptions" />

            <!-- Content Side (المحتوى الرئيسي) -->
            <div class="content-side col-lg-8 col-md-12 col-sm-12">
                <div class="user-profile-details" style="box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); padding: 20px; border-radius: 10px; background: #fff; animation: fadeIn 1s ease-in-out;">
                    <h2 style="text-align: right; color: #3cc88f;">تفاصيل الاشتراك في التطوع</h2>
                    <table class="table table-bordered table-striped" style="direction: rtl; text-align: right; table-layout: fixed; width: 100%; border-radius: 10px; border: 1px solid #ddd;">
                        <thead style="background-color: #3cc88f; color: white; font-weight: bold;">
                            <tr>
                                <th class="text-center" style="min-width: 150px;">الحدث</th>
                                <th class="text-center" style="min-width: 200px;">الوصف</th>
                                <th class="text-center" style="min-width: 150px;">تاريخ الحدث</th>
                                <th class="text-center" style="min-width: 120px;">الوقت</th>
                                <th class="text-center" style="min-width: 150px;">الموقع</th>
                                <th class="text-center" style="min-width: 150px;">عدد المتطوعين المطلوبين</th>
                                <th class="text-center" style="min-width: 150px;">عدد المتطوعين المشتركين</th>
                                <th class="text-center" style="min-width: 150px;">رابط الموقع</th>
                            </tr>
                        </thead>
                        <tbody style="background-color: #f9f9f9;">
                            @foreach($subscriptions as $subscription)
                                <tr style="transition: transform 0.3s ease; cursor: pointer;" onmouseover="this.style.transform='scale(1.05)';" onmouseout="this.style.transform='scale(1)';">
                                    <td style="word-wrap: break-word; white-space: normal;">{{ $subscription->title }}</td>
                                    <td style="word-wrap: break-word; white-space: normal;">{{ $subscription->description }}</td>
                                    <td>{{ \Carbon\Carbon::parse($subscription->date)->format('Y-m-d') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($subscription->time)->format('h:i A') }}</td>
                                    <td>{{ $subscription->location }}</td>
                                    <td class="text-center">{{ $subscription->volunteers_needed }}</td>
                                    <td class="text-center">{{ $subscription->volunteer_count }}</td>
                                    <td class="text-center">
                                        @if($subscription->location_url)
                                            <a href="{{ $subscription->location_url }}" target="_blank">رابط الموقع</a>
                                        @else
                                            غير متوفر
                                        @endif
                                    </td>
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
        transform: scale(1.05);
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
