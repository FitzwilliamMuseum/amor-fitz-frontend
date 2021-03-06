<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
    @hasSection('title') @yield('title') | @endif {{ config('app.name') }}
  </title>
  <meta name="keywords" content="@yield('keywords','relationships,letters,correspondence')">
  <meta name="description" content="@yield('description','A Museum of Relationships, a digital edition of William Hayley\'s correspondence')">
<!-- Open graph -->
  <meta property="og:locale" content="{{ app()->getLocale() }}" />
  <meta property="og:type" content="website" />
  <meta property="og:title" content="@yield('title')" />
  <meta property="og:description" content="@yield('description','A Museum of Relationships, a digital edition of William Hayley\'s correspondence')" />
  <meta property="og:url" content="{{ URL::current() }}" />
  <meta property="og:site_name" content="The Fitzwilliam Museum" />

  @hasSection('socialImage')
  <meta property="og:image" content="@yield('socialImage')" />
  <meta name="twitter:image" content="@yield('socialImage')" />
  @else
  <meta property="og:image" content="{{ URL::to('/images/hayley.jpg') }}" />
  <meta name="twitter:image" content="{{ URL::to('/images/hayley.jpg') }}" />
  @endif

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Twitter card -->
  <meta name="twitter:card" content="summary" />
  <meta name="twitter:description" content="@yield('description','A Museum of Relationships, a digital edition of William Hayley\'s correspondence')" />
  <meta name="twitter:title" content="@yield('title')" />
  <meta name="twitter:site" content="@yield('twitter_id', '@fitzmuseum_uk')" />
  <meta name="twitter:creator" content="@yield('twitter_id', '@fitzmuseum_uk')" />
  <link rel="canonical" href="{{url()->current()}}"/>
  <link rel="stylesheet" href="{{ mix('/css/fitzwilliam.css') }}" />
  <link rel="stylesheet" href="{{ mix('/css/global-styles.css') }}" />
  <link rel="icon" href="/images/favicon.ico">
  <script type="application/ld+json">
      {"publisher":{"@type":"Organization",
      "logo":{"@type":"ImageObject",
      "url":"https://fitz-cms-images.s3.eu-west-2.amazonaws.com/fitz_logo_150.jpg"}},
      "headline":"A museum of relationships","@type":"WebSite","url":"{{ route('home')}}",
      "name":"A Museum of Relationships",
      "description":"The correspondence of William Hayley, housed at the Fitzwilliam Museum, Cambridge",
      "@context":"https://schema.org"}
    </script>
</head>
<body class="w-100 bg-white">
  <div class="" id="app">
    <the-header></the-header>
    <section class="mw9 mw9-ns center pa3 ph5-ns">
      @yield('breadcrumbs')
    </section>
    @if(request()->is('search*'))
    <section class="w-100">
      @include('includes.searchForm')

    </section>
    @endif
    <main class="w-100 ">
      @yield('content')
      @yield('lettermap')
    </main>
  </div>
  @include('includes.footer')
  @yield('scripts')
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-8H7LKK1CKC"></script>

  <script src="/js/ga.js" type="text/javascript"></script>

</body>
</html>
