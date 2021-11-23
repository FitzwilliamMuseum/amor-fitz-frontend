<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
    @hasSection('title') @yield('title') | @endif {{ config('app.name') }}</title>
  <link rel="stylesheet" href="{{ mix('/css/fitzwilliam.css') }}" />
  <link rel="stylesheet" href="{{ mix('/css/global-styles.css') }}" />
</head>
<body class="w-100 bg-creme">
  <div class="" id="app">
    <the-header></the-header>
    <section class="mw9 mw9-ns center pa3 ph5-ns">
      @yield('breadcrumbs')
    </section>
    @yield('content')
  </div>
  @include('includes.footer')
</body>
</html>
