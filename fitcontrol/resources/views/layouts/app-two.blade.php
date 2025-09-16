<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FitControl | @yield('title')</title>
  <link rel="icon" type="img/userrm.png" href="img/icon.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@stack('styles')

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
 

  <div class="main-content">
    @yield('content')
  </div>

  <script src="{{ asset('js/script.js') }}"></script>
  @stack('scripts')
</body>
</html>
