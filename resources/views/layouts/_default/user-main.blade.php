<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.partials.users.header')
</head>

<body class="bg-gray-50 dark:bg-gray-800">
    @include('layouts.partials.users.navbar')
    <main>
        @yield('content')
    </main>

    @include('layouts.partials.users.footer')
    @include('layouts.partials.users.script')

</body>

</html>
