<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة تحكم المسؤول</title>

    <!-- Bootstrap 5 RTL CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Chart.js -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.css">

    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">


    <style>
        :root {
            --sidebar-width: 280px;
            --sidebar-collapsed-width: 80px;
            --primary: #4e73df;
            --primary-light: #e8f1fd;
            --success: #1cc88a;
            --success-light: #e2f8f0;
            --warning: #f6c23e;
            --warning-light: #fef8e8;
            --info: #36b9cc;
            --info-light: #e8f7fa;
            --dark: #2c3e50;
            --light: #f8f9fc;
            --gray-200: #eaecf4;
            --gray-600: #858796;
            --border-radius: 0.5rem;
            --box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            --transition-speed: 0.3s;
        }

        body {
            background-color: var(--light);
            font-family: 'Tajawal', sans-serif;
        }

        #wrapper {
            display: flex;
            min-height: 100vh;
        }

        #page-content-wrapper {
            flex: 1;
            padding: 20px;
            margin-right: var(--sidebar-width);
            transition: all var(--transition-speed);
        }

        #wrapper.toggled #page-content-wrapper {
            margin-right: var(--sidebar-collapsed-width);
        }

        @media (max-width: 992px) {
            #page-content-wrapper {
                margin-right: 0;
            }

            #wrapper.toggled #page-content-wrapper {
                margin-right: 0;
            }
        }
    </style>
</head>
<body>
    <div id="wrapper">
        <!-- Sidebar -->
        @include('admin.sidebar')

        <!-- Page Content -->
        <div id="page-content-wrapper">
            @yield('content')
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.all.min.js"></script>

    <!-- Custom Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle Sidebar
            document.getElementById('sidebarToggle')?.addEventListener('click', function() {
                document.getElementById('wrapper').classList.toggle('toggled');
            });

            // Initialize Charts
            if (document.getElementById('donationsChart')) {
                const donationsCtx = document.getElementById('donationsChart').getContext('2d');
                new Chart(donationsCtx, {
                    type: 'line',
                    data: {
                        labels: ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو', 'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر'],
                        datasets: [{
                            label: 'إجمالي التبرعات',
                            data: [1200, 1900, 1500, 2200, 2500, 3000, 2800, 3500, 4000, 3800, 4200, 5000],
                            backgroundColor: 'rgba(78, 115, 223, 0.05)',
                            borderColor: 'rgba(78, 115, 223, 1)',
                            borderWidth: 2,
                            tension: 0.3,
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { display: false }
                        }
                    }
                });
            }
        });
    </script>

    @stack('scripts')

    <script src="{{ asset('js/sidebar.js') }}"></script>

</body>
</html>
