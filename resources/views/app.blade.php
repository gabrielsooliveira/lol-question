<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4743843453103386" crossorigin="anonymous"></script>

    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    @inertiaHead
    @routes
  </head>
  <body class="overflow-y-auto min-vh-100">
    @inertia
  </body>
</html>
