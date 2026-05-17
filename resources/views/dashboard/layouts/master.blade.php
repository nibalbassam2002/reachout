<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('title', 'Dashboard - NiceAdmin Bootstrap Template')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('reachout/img/logogrope.png')}}" rel="icon">
  <link href="{{asset('reachout/img/logo3.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('reachout/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('reachout/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('reachout/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('reachout/vendor/quill/quill.snow.css')}}" rel="stylesheet">
  <link href="{{asset('reachout/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
  <link href="{{asset('reachout/vendor/remixicon/remixicon.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('reachout/css/style.css')}}" rel="stylesheet">
  @yield('styles')
</head>

<body>

  @include('dashboard.layouts.header')

  @include('dashboard.layouts.sidebar')

  <main id="main" class="main">
      @yield('content')
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset('reachout/vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{asset('reachout/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('reachout/vendor/chart.js/chart.umd.js')}}"></script>
  <script src="{{asset('reachout/vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{asset('reachout/vendor/quill/quill.js')}}"></script>
  <script src="{{asset('reachout/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{asset('reachout/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{asset('reachout/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('reachout/js/main.js')}}"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
    });

    @if(session('success'))
        Toast.fire({
            icon: 'success',
            title: "{{ session('success') }}"
        });
    @endif
</script>
  @yield('scripts')

</body>
</html>