<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>LoveUs - Charity and Fundraising HTML Template | Home Page 01</title>

        <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
        <link href="{{ asset('css/color.css') }}" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">
        <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

        <!--[if lt IE 9]>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
        <![endif]-->
        <!--[if lt IE 9]>
            <script src="{{ asset('js/respond.js') }}"></script>
        <![endif]-->
    </head>

<body>

<div class="page-wrapper">
    <!-- Preloader -->
    <div class="preloader"><div class="icon"></div></div>

    <!-- Main Header -->
    <header class="main-header">
        <!-- Header Top -->
        <div class="header-top">
            <div class="auto-container">
				<div class="inner clearfix">
                    <div class="top-left">
                        <ul class="social-links clearfix">
                            <li class="social-title">Follow Us:</li>
                            <li><a href="#"><span class="fab fa-facebook-f"></span></a></li>
                            <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                            <li><a href="#"><span class="fab fa-linkedin-in"></span></a></li>
                            <li><a href="#"><span class="fab fa-pinterest-p"></span></a></li>
                        </ul>
                    </div>

                    <div class="top-right">
                        <ul class="info clearfix">
                            <li class="search-btn"><button type="button" class="theme-btn search-toggler"><span class="fa fa-search"></span></button></li>
                            <li><a href="tel:12345615523"><span class="icon fa fa-phone-alt"></span> Call: &nbsp;123 4561 5523</a></li>
                            <li><a href="mailto:info@templatepath.com"><span class="icon fa fa-envelope"></span> Email: &nbsp;info@loveuscharity.com</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Header Upper -->
        <div class="header-upper">
            <div class="auto-container">
                <div class="inner-container clearfix">
                    <!--Logo-->
                    <div class="logo-box">
                        <div class="logo"><a href="index.html" title="LoveUs - Charity and Fundraising HTML Template">        <img src="{{ asset('images/logo.png') }}" alt="LoveUs - Charity and Fundraising HTML Template" title="LoveUs - Charity and Fundraising HTML Template">
                        </a></div>
                    </div>

                    <!--Nav Box-->
                    <div class="nav-outer clearfix">
                        <!--Mobile Navigation Toggler-->
                        <div class="mobile-nav-toggler"><span class="icon flaticon-menu-1"></span></div>

                        <!-- Main Menu -->
                        <nav class="main-menu navbar-expand-md navbar-light">
                            <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                <ul class="navigation clearfix">
                                    <li><a href="">أنواع التبرعات</a></li>

                                    <li><a href="{{ route('volunteer.form') }}">التطوع</a></li>

                                    <li class="dropdown"><a href="#">الإعلام</a>
                                        <ul>
                                            <li><a href="gallery.html">معرض الصور</a></li>
                                            <li><a href="blog.html">المدونة</a></li>
                                        </ul>
                                    </li>

                                    <li><a href="donation-tools.html">أدوات التبرع</a></li>

                                    <li class="dropdown"><a href="#">برامجنا</a>
                                        <ul>
                                            <li><a href="eradicate-hunger.html">مشروع القضاء على الجوع</a></li>
                                            <li><a href="feeding-programs.html">برامج التغذية</a></li>
                                            <li><a href="volunteering-programs.html">برامج التطوع</a></li>
                                        </ul>
                                    </li>

                                    <li><a href="contact.html">اتصل بنا</a></li>
                                </ul>
                            </div>
                        </nav>

                        <!-- Main Menu End-->

                        <div class="link-box clearfix">
                            <div class="auth-links d-flex align-items-center gap-3">
                                {{-- <div class="cart-link">
                                    <a href="shopping-cart.html" class="theme-btn">
                                        <span class="icon flaticon-paper-bag"></span>
                                    </a>
                                </div> --}}

                                @auth
                                    <div class="dropdown">
                                        <button class="btn dropdown-toggle d-flex align-items-center" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="background: none; border: none; font-size: 18px; font-weight: bold; padding: 5px 10px; text-align: left;">


                                            <span class="text-dark">مرحباً، {{ Auth::user()->name }}</span>
                                            <img src="{{ asset(Auth::user()->profile_image ?? 'images/default-user.png') }}" class="rounded-circle" width="40" height="40" alt="User Image" style="margin-right: 10px;">
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown" style="min-width: 150px;">
                                            <li><a class="dropdown-item" href="">الملف الشخصي</a></li>
                                            <li>
                                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item">تسجيل الخروج</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                    @else
                                    <a href="{{ route('login') }}" class="theme-btn btn-style-one" style="font-size: 12px; margin: 1px;">
                                        <span class="btn-title">تسجيل الدخول</span>
                                    </a>
                                    <a href="{{ route('register') }}" class="theme-btn btn-style-one" style="font-size: 12px; margin: 1px">
                                        <span class="btn-title">إنشاء حساب</span>
                                    </a>
                                @endauth


                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <!--End Header Upper-->

        <!-- Sticky Header  -->
        <div class="sticky-header">
            <div class="auto-container clearfix">
                <!--Logo-->
                <div class="logo pull-left">
                    <a href="index.html" title=""><img src="images/sticky-logo.png" alt="" title=""></a>
                </div>
                <!--Right Col-->
                <div class="pull-right">
                    <!-- Main Menu -->
                    <nav class="main-menu clearfix">
                        <!--Keep This Empty / Menu will come through Javascript-->
                    </nav><!-- Main Menu End-->
                </div>
            </div>
        </div><!-- End Sticky Menu -->

        <!-- Mobile Menu  -->
        <div class="mobile-menu">
            <div class="menu-backdrop"></div>
            <div class="close-btn"><span class="icon flaticon-cancel"></span></div>

            <nav class="menu-box">
                <div class="nav-logo"><a href="index.html"><img src="images/logo.png" alt="" title=""></a></div>
                <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
				<!--Social Links-->
				<div class="social-links">
					<ul class="clearfix">
						<li><a href="#"><span class="fab fa-twitter"></span></a></li>
						<li><a href="#"><span class="fab fa-facebook-square"></span></a></li>
						<li><a href="#"><span class="fab fa-pinterest-p"></span></a></li>
						<li><a href="#"><span class="fab fa-instagram"></span></a></li>
						<li><a href="#"><span class="fab fa-youtube"></span></a></li>
					</ul>
                </div>
            </nav>
        </div><!-- End Mobile Menu -->
    </header>
    <!-- End Main Header -->

        <!-- Sticky Header  -->
        <div class="sticky-header">
            <div class="auto-container clearfix">
                <!--Logo-->
                <div class="logo pull-left">
                    <a href="index.html" title=""><img src="images/sticky-logo.png" alt="" title=""></a>
                </div>
                <!--Right Col-->
                <div class="pull-right">
                    <!-- Main Menu -->
                    <nav class="main-menu clearfix">
                        <!--Keep This Empty / Menu will come through Javascript-->
                    </nav><!-- Main Menu End-->
                </div>
            </div>
        </div><!-- End Sticky Menu -->

        <!-- Mobile Menu  -->
        <div class="mobile-menu">
            <div class="menu-backdrop"></div>
            <div class="close-btn"><span class="icon flaticon-cancel"></span></div>

            <nav class="menu-box">
                <div class="nav-logo"><a href="index.html"><img src="images/logo.png" alt="" title=""></a></div>
                <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
				<!--Social Links-->
				<div class="social-links">
					<ul class="clearfix">
						<li><a href="#"><span class="fab fa-twitter"></span></a></li>
						<li><a href="#"><span class="fab fa-facebook-square"></span></a></li>
						<li><a href="#"><span class="fab fa-pinterest-p"></span></a></li>
						<li><a href="#"><span class="fab fa-instagram"></span></a></li>
						<li><a href="#"><span class="fab fa-youtube"></span></a></li>
					</ul>
                </div>
            </nav>
        </div><!-- End Mobile Menu -->
    </header>
    <!-- End Main Header -->


@extends('layouts.app')

@section('content')
    <section class="donation-confirmation-section" style="padding: 50px 0; background-color: #f9f9f9; direction: rtl;">
        <div class="auto-container">
            <!-- Step 1: Title -->
            <div class="sec-title centered" style="text-align: right; margin-bottom: 30px;">
                <h2 style="font-size: 36px; color: #25282a; font-weight: 700;">
                    <i class="fas fa-check-circle" style="color: #3cc88f; margin-left: 10px;"></i>
                    تأكيد التبرع - {{ $category->title }}
                </h2>
                <p style="font-size: 18px; color: #555; text-align: right;">
                    قم بإتمام عملية التبرع الآن باستخدام طريقة الدفع التي تفضلها.
                </p>
            </div>

            <!-- Step 2: Donation Details -->
            <div class="confirmation-details" style="background-color: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
                <form method="POST" action="{{  route('donation.store') }}" id="donation-form">
                    @csrf
                    <table style="width: 100%; border-collapse: collapse; font-size: 18px;">
                        <thead>
                            <tr>
                                <th style="text-align: right; padding: 10px; font-weight: 600;">التفاصيل</th>
                                <th style="text-align: right; padding: 10px; font-weight: 600;">القيمة</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align: right; padding: 10px;">
                                    <i class="fas fa-money-bill-wave" style="color: #3cc88f; margin-left: 10px;"></i>
                                    <strong>المبلغ المطلوب:</strong>
                                </td>
                                <td style="text-align: right; padding: 10px;">
                                    {{ $amount }} {{ $currency == 'USD' ? 'دولار أمريكي' : 'دينار أردني' }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right; padding: 10px;">
                                    <i class="fas fa-users" style="color: #3cc88f; margin-left: 10px;"></i>
                                    <strong>عدد الأفراد:</strong>
                                </td>
                                <td style="text-align: right; padding: 10px;">
                                    {{ $peopleCount }}
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right; padding: 10px;">
                                    <i class="fas fa-user-tag" style="color: #3cc88f; margin-left: 10px;"></i>
                                    <strong>المبلغ لكل شخص:</strong>
                                </td>
                                <td style="text-align: right; padding: 10px;">
                                    @php
                                        $amountPerPerson = $amount / $peopleCount;
                                    @endphp
                                    {{ number_format($amountPerPerson, 2) }} {{ $currency == 'USD' ? 'دولار أمريكي' : 'دينار أردني' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Step 3: Payment Methods -->
                    <p style="text-align: right; font-size: 18px; margin-bottom: 20px;">
                        <strong><i class="fas fa-credit-card" style="color: #3cc88f; margin-left: 10px;"></i> طريقة الدفع:</strong>
                    </p>
                    <div class="payment-methods" style="display: flex; justify-content: space-between; margin-bottom: 20px;">
                        <div style="flex: 1; text-align: right; padding: 10px; border: 1px solid #ddd; border-radius: 8px; transition: transform 0.3s;">
                            <input type="radio" id="paypal" name="payment_method" value="paypal" checked onclick="togglePaymentForm('paypal')">
                            <label for="paypal" style="font-size: 16px; color: #25282a;">
                                <i class="fab fa-paypal" style="margin-left: 10px; color: #3cc88f;"></i> PayPal
                            </label>
                        </div>
                        <div style="flex: 1; text-align: right; padding: 10px; border: 1px solid #ddd; border-radius: 8px; transition: transform 0.3s;">
                            <input type="radio" id="credit_card" name="payment_method" value="credit_card" onclick="togglePaymentForm('credit_card')">
                            <label for="credit_card" style="font-size: 16px; color: #25282a;">
                                <i class="fas fa-credit-card" style="margin-left: 10px; color: #3cc88f;"></i> بطاقة ائتمان
                            </label>
                        </div>
                    </div>

                    <!-- PayPal Form -->
                    <div id="paypal-form" style="display: block; padding: 15px; background: #f5f5f5; border-radius: 10px; margin-bottom: 20px;">
                        <label for="paypal_email" style="font-size: 16px; color: #25282a;">البريد الإلكتروني لـ PayPal</label>
                        <input type="email" name="paypal_email" id="paypal_email" placeholder="البريد الإلكتروني لـ PayPal" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ddd; background-color: #fff;">
                    </div>

                    <!-- Credit Card Form -->
                    <div id="credit-card-form" style="display: none; padding: 15px; background: #f5f5f5; border-radius: 10px; margin-bottom: 20px;">
                        <label for="credit_card_name" style="font-size: 16px; color: #25282a;">اسم حامل البطاقة</label>
                        <input type="text" name="credit_card_name" id="credit_card_name" placeholder="اسم حامل البطاقة" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ddd; background-color: #fff;">

                        <label for="credit_card_number" style="font-size: 16px; color: #25282a;">رقم البطاقة</label>
                        <input type="text" name="credit_card_number" id="credit_card_number" placeholder="رقم البطاقة" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ddd; background-color: #fff;" oninput="validateCardNumber(this)">

                        <label for="credit_card_expiry" style="font-size: 16px; color: #25282a;">تاريخ الانتهاء</label>
                        <input type="text" name="credit_card_expiry" id="credit_card_expiry" placeholder="MM/YY" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ddd; background-color: #fff;">

                        <label for="credit_card_cvc" style="font-size: 16px; color: #25282a;">رمز الأمان (CVC)</label>
                        <input type="text" name="credit_card_cvc" id="credit_card_cvc" placeholder="رمز الأمان" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ddd; background-color: #fff;">
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="theme-btn btn-style-one" id="donate-btn" style="background-color: #3cc88f; color: #fff; border-radius: 8px; padding: 12px 30px; font-size: 16px; text-align: right; transition: background-color 0.3s;">
                        <span class="btn-title"><i class="fas fa-hand-holding-usd" style="margin-left: 10px;"></i> إتمام التبرع</span>
                    </button>
                </form>
            </div>
        </div>
    </section>

    <script>
        // Toggle between PayPal and Credit Card Forms
        function togglePaymentForm(paymentMethod) {
            if (paymentMethod === 'paypal') {
                document.getElementById('paypal-form').style.display = 'block';
                document.getElementById('credit-card-form').style.display = 'none';
            } else if (paymentMethod === 'credit_card') {
                document.getElementById('paypal-form').style.display = 'none';
                document.getElementById('credit-card-form').style.display = 'block';
            }
        }

        // Validation and Form Submission
        document.getElementById('donate-btn').addEventListener('click', function(event) {
            // Validate form before submission
            if (formIsValid()) {
                document.querySelector('form').submit();  // Submit the form if valid
            } else {
                event.preventDefault();  // Prevent submission if there are errors
            }
        });

        // Function to validate form inputs
        function formIsValid() {
            // Here you can add your validation logic
            // For example, check if payment method is selected, card number is valid, etc.
            return true;  // For simplicity, assuming the form is valid.
        }
    </script>

    <style>
        /* Hover styles for the submit button */
        #donate-btn:not([disabled]):hover {
            background-color: #2ab76c;
            cursor: pointer;
        }

        #donate-btn[disabled]:hover {
            background-color: #3cc88f;
            cursor: not-allowed;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection





