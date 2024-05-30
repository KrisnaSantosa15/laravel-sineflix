@extends('layouts._default.user-main')
@section('content')
    <div class="container">
        <div class="row">
            <h1>MOVIE DETAIL</h1>
            <div class="col-12">
                <h1>{{ $movie->title }}</h1>
                <p>{{ $movie->description }}</p>
                <p>{{ $movie->duration }}</p>
                <p>{{ $movie->release_date }}</p>
                <p>{{ $movie->genre }}</p>
                <p>{{ $movie->rating }}</p>
                <p>{{ $movie->director }}</p>
                <p>{{ $movie->created_at }}</p>
                <p>{{ $movie->updated_at }}</p>
                <a href="{{ route('movies.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
@endsection
