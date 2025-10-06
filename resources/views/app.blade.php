<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-XD3SJVR73S"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-XD3SJVR73S');
    </script>
    <meta name="google-adsense-account" content="ca-pub-4640291799140211">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4640291799140211" crossorigin="anonymous"></script>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    @inertiaHead
    @routes
  </head>
  <body class="overflow-y-auto min-vh-100">
    @inertia
  </body>
</html>
