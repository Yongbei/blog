@extends('layouts.blog-post')

@section('content')
    <div class="col-md-8">
    	<!-- Blog Post -->

        <!-- Title -->
        <h1>{{$post->title}}</h1>

        <!-- Author -->
        <p class="lead">
            by <a href="#">{{$post->user->name}}</a>
        </p>

        <hr>

        <!-- Date/Time -->
        <p><span class="glyphicon glyphicon-time"></span> Posted on {{$post->created_at->diffForHumans()}}</p>

        <hr>

        <!-- Preview Image -->
        <img class="img-responsive" src="{{($post->photo) ? $post->photo->name : $post->photoPlaceholder()}}" alt="">

        <hr>

        <!-- Post Content -->
        <p>{!! $post->body !!}</p>

        <hr>

        <!-- Blog Comments -->
    	
    <!-- 	@if (Session::has('comment_msg'))
    		{{session('comment_msg')}}
    	@endif -->

        <!-- Comments Form -->
        @if(Auth::check())
        <div class="well">
            <h4>Leave a Comment:</h4>

            {!! Form::open(['method'=>'POST', 'action'=>'PostCommentsController@store']) !!}

    			{!! Form::hidden('post_id', $post->id) !!}

    			<div class="form-group">
    				{!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>3]) !!}
    			</div>
    			{!! Form::submit('submit', ['class'=>'btn btn-primary']) !!}

            {!! Form::close() !!}


        </div>
        @endif

        <hr>

        <!-- Posted Comments -->

        @if($comments)
            @foreach ($comments as $comment)
                <div class="media">
                    <a class="pull-left" href="#">
                        <img height="64" class="media-object" src="{{($comment->user->photo) ? $comment->user->photo->name : 'http://placehold.it/64x64'}}" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">{{$comment->user->name}}
                            <small>{{$comment->created_at->diffForHumans()}}</small>
                        </h4>
                        {{$comment->body}}

                        <!-- Nested Comment -->
                        @if($comment->commentReplies)
                            @foreach($comment->commentReplies as $commentReply)
                                @if($commentReply->is_active == 1)
                                    <div class="media">
                                        <a class="pull-left" href="#">
                                            <img height="64" class="media-object" src="{{($commentReply->user->photo) ? $commentReply->user->photo->name : 'http://placehold.it/64x64'}}" alt="">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="media-heading">{{$commentReply->user->name}}
                                                <small>{{$commentReply->created_at->diffForHumans()}}</small>
                                            </h4>
                                            {{$commentReply->body}}
                                        </div>                
                                    </div>
                                @endif
                            @endforeach
                        @endif
                        <!-- End Nested Comment -->
                        
                        <button class="replyBtn btn btn-success pull-right">Reply</button>
                        <div class="replyForm">
                            {!! Form::open(['method'=>'POST', 'action'=>'CommentRepliesController@createReply']) !!}

                                {!! Form::hidden('comment_id', $comment->id) !!}

                                <div class="form-group">
                                    {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>3]) !!}
                                </div>
                                {!! Form::submit('submit', ['class'=>'btn btn-primary']) !!}

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <!-- Blog Sidebar Widgets Column -->
    @include('includes.front_sidebar')


@endsection


@section('scripts')
    $(document).ready(function(){
        $(".replyBtn").click(function(){
            $(".replyForm").slideToggle("slow");
        });
    });
@endsection


