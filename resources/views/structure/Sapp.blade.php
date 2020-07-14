<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <title>{{config('app.name', 'AppSupport')}}</title>
    </head>
    <body>
        @include('include.navbar')
        <div class="container">
            @include('include.messages') {{-- Validation Error Message made easy --}} 
            @yield('content')
        </div>
        <script src="{{ asset('ckeditor/ckeditor.js') }}">
        </script>
        <script>
            CKEDITOR.replace( 'summary-ckeditor' );
        </script>
    </body>
</html>
