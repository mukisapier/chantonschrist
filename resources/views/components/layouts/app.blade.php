<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Page Title' }}</title>
    <!-- Phosphor Icons -->
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/phosphor-icons/regular/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/phosphor-icons/fill/style.css') }}" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- <link rel="stylesheet" href="{{ asset('build/assets/app-BV7Thv1u.css') }}">
    <script src="{{ asset('build/assets/app-DsaENKCq.js') }}"></script> --}}
</head>

<body class="bg-[#FCFCFC]">
    {{ $slot }}
</body>

</html>
