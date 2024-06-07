<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="sineflix">
<meta name="author" content="Krisna">

<title>{{ config('app.name', 'Sineflix') }}</title>

{{-- <link rel="canonical" href="{{ .Permalink }}"> --}}

{{-- {{ with .Params.robots -}}
<meta name="robots" content="{{ . }}">
{{- end }} --}}

{{-- {{ partial "stylesheet" . }}
{{ partial "favicons" . }}
{{ partial "social" . }}
{{ partial "analytics" . }} --}}

@include('layouts.partials.stylesheet')
@include('layouts.partials.favicons')
@include('layouts.partials.social')
@include('layouts.partials.analytics')

{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css"> --}}

<script>
    // On page load or when changing themes, best to add inline in `head` to avoid FOUC
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
            '(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark')
    }
</script>
