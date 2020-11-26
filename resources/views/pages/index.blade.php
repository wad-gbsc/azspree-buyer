<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        {{-- <script data-ad-client="ca-pub-9911749335545567" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> --}}
        <title>{{config('app.name', 'Azspree')}}</title>
        <meta charset=utf-8 >
		<meta name="robots" content="index, follow" > 
		<meta name="keywords" content="Azspree" > 
		<meta name="description" content="Azspree" > 
        <meta name="author" content="Geko Business Solutions Corp.">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        @include('include.favicon')
        
        @yield('embeddedcss')
        

    </head>

    <div>@include('include.tempcss')
        </div>

        <body style="overflow-x:hidden;">
            <div id="loader-overflow">
                <div id="loader3">Please enable JS</div>
            </div>	
            <div id="wrap" class="boxed ">
                <div class="grey-bg">
                    @include('include.topnav')
                    @yield('content')
                    @include('include.shopinfo')
                    @include('include.footer')
                </div>
            </div>
            @include('include.tempjs')
            @yield('embeddedjs')

        </body>
</html>

      