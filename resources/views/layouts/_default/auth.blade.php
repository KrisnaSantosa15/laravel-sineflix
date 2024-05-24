<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.partials.header')
</head>

<body class="bg-gray-50 dark:bg-gray-800">
    <main>
        @yield('content')
    </main>

    @include('layouts.partials.scripts')

</body>

</html>
