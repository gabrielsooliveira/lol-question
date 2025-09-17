<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <link rel="icon" href="favicon.ico">
    @inertiaHead
    @routes
  </head>
  <body class="overflow-y-auto min-vh-100">
    @inertia
  </body>
</html>
