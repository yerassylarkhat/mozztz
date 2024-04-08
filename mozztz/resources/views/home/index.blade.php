@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-4" id="{{ $post->id }}" onclick="show({{ $post->id }})">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text flex-grow-1">{{ $post->content }}</p>
                            <div class="mt-auto text-center">
                                @if($post->preview)
                                    <img src="{{ asset($post->preview) }}" alt="Post Preview" class="img-fluid mb-3"
                                         style="max-width: 250px; max-height: 190px; width: auto; height: auto">
                                @else
                                    <img src="{{ asset('images/default-post-image.png') }}" alt="Default Preview" class="img-fluid mb-3">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{ $posts->links('pagination::bootstrap-4') }}

    </div>

    <script>
        function show($id){
            window.location.href = "http://localhost:8888/post/" + $id;
        }
    </script>
@endsection
