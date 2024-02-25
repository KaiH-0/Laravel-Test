<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite('resources/js/app.js')
    @routes
    @inertiaHead
  </head>
  <body>
    @include('navbar')
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
    @inertia

    </div>
  </body>
</html>