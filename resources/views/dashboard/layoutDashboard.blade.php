<!DOCTYPE html>
<html lang="en" class="page-myexam">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Sign in to your MedExHub account.">
  <title>Sign In | MedExHub</title>
  <link rel="stylesheet" href="../theme_files/css/style_v1.css"/>
  <link rel="stylesheet" href="../theme_files/css/style_common.css"/>
</head>
<body>
@include('frontend.headerAuth')
  <main class="page-shell">
    <aside class="sidebar" aria-label="Dashboard menu">
      @include('dashboard.dashboardMenu')
    </aside>
    <section class="content" aria-label="ACEM Primary Examination">
              @yield('exam')
              @yield('showtest')
              @yield('createnew')
              @yield('viewexam')
              @yield('message')
              @yield('workboard')
              {{-- @yield('result') --}}
              @yield('subsection')
              @yield('basket')
              @yield('subscriptions')
              @yield('invoice')
              @yield('invoice')
              @yield('examhistory')
              @yield('loginhistory')
              @yield('betteranswer')
              @yield('correction')
    </section>
  </main>
















    @include('frontend.footer')
@include('frontend.index_footer')