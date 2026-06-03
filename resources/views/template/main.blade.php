<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <title>Laravel + Tailwind + Flowbite</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gradient-to-br from-gray-100 to-blue-100 min-h-screen">

    @include('template.navbar')

    <div class="content p-10">
        @yield('content')
    </div>

</body>

</html>