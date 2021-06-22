<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>@yield('title')</title>
    <link rel="icon" href="{{ url('/seapalace/img/favicon.png') }}" type="image/png">

    {{-- Style --}}
    @stack('prepend-style')
        {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="/DataTables/datatables.min.css"/>
        <link rel="stylesheet" href="sweetalert2.min.css"> --}}
    @include('includes.style')
    @stack('addon-style')
  </head>

  <body>
    {{-- Navbar --}}
    @include('includes.navbar')

    @include('includes.sidebar')

    {{-- Page Content --}}
    @yield('content')

    {{-- Footer --}}
    @include('includes.footer')

    <!-- Bootstrap core JavaScript -->
    @include('sweetalert::alert')
    {{-- Script --}}
    @stack('prepend-script')
    <script src="sweetalert2.min.js"></script>
    @include('includes.script')
    @stack('addon-script')
  </body>
</html>
