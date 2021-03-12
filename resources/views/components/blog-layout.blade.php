@extends('show-blog')

@section('content')

    <div class="container mx-auto mt-10">
        <div class="container ">
                <div class="container py-5">
                    <h1 class="text-gray-700 text-xl font-bold">{{ $blog->title }}</h1>
                    <h3 class="text-gray-700">{{ $blog->body }}</h3>
                    <p class="text-gray-700">Author: {{ $author}}</p>
                </div>
        </div>
    </div>


@endsection
