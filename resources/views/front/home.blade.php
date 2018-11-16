@extends('layouts.blog-home')

@section('content')
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div> -->

    <div class="col-md-8">
        <!-- First Blog Post -->
        @if($posts)
            @foreach($posts as $post)
                <h2>
                    <a href="{{route('home.post', $post->slug)}}">{{$post->title}}</a>
                </h2>
                <p class="lead">
                    by {{$post->user->name}}</a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on {{$post->created_at->diffForHumans()}}</p>
                <hr>
                <img class="img-responsive" src="{{($post->photo) ? $post->photo->name : $post->photoPlaceholder()}}" alt="">
                <hr>
                <p>{!! str_limit($post->body, 300) !!}</p>
                <a class="btn btn-primary" href="{{route('home.post', $post->slug)}}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
            @endforeach
        @endif


        <!-- Pagination -->
        {{$posts->render()}}
    </div>

    <!-- Blog Sidebar Widgets Column -->
    @include('includes.front_sidebar')

@endsection
