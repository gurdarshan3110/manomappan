<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head')
</head>
<body>
    @include('partials.header')

    {{-- Main Content --}}
    @yield('content')

    @include('partials.footer')
    @include('partials.scripts')
</body>
</html>