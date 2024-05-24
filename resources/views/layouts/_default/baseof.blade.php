{{-- FILEPATH: /home/krisna/MyProjects/WebDevelopment/laravel-sineflix/resources/views/layouts/_default/baseof.blade.php --}}
<!doctype html>
<html lang="en" class="dark">

<head>
    @include('layouts.partials.header')
</head>
@section('body_override')

    <body class="bg-white dark:bg-gray-900">
    @show
    @include('layouts.partials.skippy')

    @section('main')
    @show

    @include('layouts.partials.scripts')
</body>

</html>
