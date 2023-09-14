<!doctype html>
<html lang="id">

<head>
    {{-- <!-- Required meta tags --> --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{ asset('assets/landingpage/img/logodelisa.png') }}" type="image/x-icon">

    @include('layouts.landingpage.style')

    <title>@yield('title', "Warung Sayur D'Lisa")</title>
</head>

<body>
    @include('layouts.landingpage.navbar')

    @yield('content')
    
    @include('layouts.landingpage.footer')
    @include('layouts.landingpage.script')
</body>

</html>
