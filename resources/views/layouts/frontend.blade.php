<!DOCTYPE html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8" />
    <title>Batik Gumelem.</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />

    <link rel="manifest" href="site.webmanifest" />
    <link rel="apple-touch-icon" href="{{ url('/frontend/images/content/favicon.png') }}" />
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="{{ url('/frontend/css/app.css') }}" />
    <link rel="icon" href="{{ url('/frontend/images/content/favicon.png') }}" />

    <meta name="theme-color" content="#000" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="favicon.ico"><link href="{{ url('/frontend/css/app.minify.css') }}" rel="stylesheet"></head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @stack('addon-script')
  <body>
    <!-- Add your site or application content here -->

    @include('components.frontend.navbar')

    @yield('content')

    @include('components.frontend.footer')

    <!-- START: LOAD SVG -->
    <!-- <svg width="23" height="26" class="hidden" id="icon-play">
      <path
        d="M21 9.536c2.667 1.54 2.667 5.39 0 6.928l-15 8.66c-2.667 1.54-6-.385-6-3.464V4.34C0 1.26 3.333-.664 6 .876l15 8.66z"
        fill="#fff"
      />
    </svg> -->
    <!-- END: LOAD SVG  -->

    <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
    <script>
      window.ga = function () {
        ga.q.push(arguments);
      };
      ga.q = [];
      ga.l = +new Date();
      ga("create", "UA-XXXXX-Y", "auto");
      ga("set", "anonymizeIp", true);
      ga("set", "transport", "beacon");
      ga("send", "pageview");
    </script>
    <script src="https://www.google-analytics.com/analytics.js" async></script>
  <script src="{{ url('/frontend/js/app.js') }}"></script></body>
</html>
