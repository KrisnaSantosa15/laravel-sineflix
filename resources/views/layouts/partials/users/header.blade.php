<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="sineflix">
<meta name="author" content="Krisna">

<title>{{ config('app.name', 'Sineflix') }}</title>

@include('layouts.partials.users.stylesheet')
@include('layouts.partials.favicons')
@include('layouts.partials.social')
@include('layouts.partials.analytics')

<script>
    // On page load or when changing themes, best to add inline in `head` to avoid FOUC
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
            '(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark')
    }
</script>
