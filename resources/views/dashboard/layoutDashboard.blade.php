<!DOCTYPE html>
<html lang="en" class="page-myexam">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Sign in to your MedExHub account.">
  <title>Sign In | MedExHub</title>
  <!-- Bootstrap CSS -->
  <!-- <link rel="stylesheet" href="../theme_files/css/bootstrap.min.css"/> -->
  <link rel="stylesheet" href="../packages/bootstrap538/css/bootstrap.min.css"/>
  <!-- table CSS -->
  <link href='/packages/bootstrap538/datatables/css/dataTables.bootstrap4.css' rel='stylesheet' >
  <link rel="stylesheet" href="../theme_files/css/style_v1.css"/>
  <link rel="stylesheet" href="../theme_files/css/style_common.css"/>
</head>
<body>
  @include('frontend.headerAuth')
  <main class="page-shell">
    @include('dashboard.dashboardMenu')
      @yield('exam')
      @yield('showtest')
      @yield('createnew')
      @yield('viewexam')
      @yield('message')
      @yield('workboard')
      @yield('subsection')
      @yield('basket')
      @yield('subscriptions')
      @yield('invoice')
      @yield('examhistory')
      @yield('loginhistory')
      @yield('conversation')
  </main>
  @include('frontend.footer')
  <script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true
        });
    });
  </script>
  @include('frontend.index_footer')