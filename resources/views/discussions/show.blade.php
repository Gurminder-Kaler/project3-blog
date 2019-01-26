@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="text-center">
                    <div class="container" style="overflow:auto">
                        <div class="row">
                            <div class="col-md-12" >
                                <h3 style="border: 2px solid green">{{$d->channel->title}}</h3>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="card ">
                    <div class="card-header">
                        <img src="{{$d->user ? $d->user->avatar : 'No foto'}}" alt="Anonymous" width="40px" height="40px">
                        {{$d->user?$d->user->name : "Anonymous"}}
                        @if($d->is_being_watched_by_auth_user())
                            <div class="pull-right">
                                <a href="{{route('discussion.unwatch',['id'=>$d->id])}}" class="btn btn-sm" title="Un-follow the discussion: no Email notifications will be shared about activities on this discussion" data-toggle="tooltip"><i class="fa fa-eye-slash"></i>Unwatch</a>
                            </div>

                            @else
                            <div class="pull-right">
                                <a href="{{route('discussion.watch',['id'=>$d->id])}}" class="btn btn-sm" title="follow the discussion" data-toggle="tooltip"><i class="fa fa-eye"></i>Watch</a>
                            </div>

                            @endif
                        {{--<a href="{{route('discussion',['slug'=>$d->slug])}}" class="btn btn-info float-right">View</a>--}}
                    </div>

                    <div class="card-body">
                        <h2 class="text-left"><i class="fa fa-lightbulb-o"></i>{{$d->title}}</h2>
                        <span class="fa fa-comment"></span>{{$d->content}}
                    </div>
                    <div class="card-footer">
                        {{$d->replies->count()}} : Replies <span class="pull-right">{{$d->created_at->diffForhumans()}}</span>
                    </div>
                </div>
                <hr width="100%" style=" border: 1px dashed darkolivegreen;">
                {{--card ends here--}}
{{--reply starts here--}}
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-11">

                        @foreach($d->replies as $r)
                            <div class="card" id="cardborder">
                                <div class="card-header" id="nicecardheading">
                                    <img src="{{$r->user ? $r->user->avatar:"No foto"}}" alt="Anonymous" width="40px" height="40px">
                                    {{$r->user?$r->user->name : "Anonymous"}} <span class="fa fa-comment"></span>
                                    {{--<a href="{{route('discussion',['slug'=>$r->slug])}}" class="btn btn-info float-right">View</a>--}}
                                </div>

                                <div class="card-body">
                                    {{--<h2 class="text-left"><i class="fa fa-lightbulb-o"></i>{{$r->title}}</h2>--}}
                                    {!! $r->content !!}
                                </div>
                                <div class="card-footer" id="nicecardheading">
                                    @if($r->is_liked_by_auth_user())
                                        <span class="pull-left fa fa-thumbs-down"><a href="{{route('reply.unlike',['id'=>$r->id])}}" class=" btn-danger btn-sm">Unlike <span class="badge">{{$r->likes->count()}}</span></a></span>
                                    @else
                                        <span class="pull-left fa fa-thumbs-up"  ><a class="btn-sm btn-success" href="{{route('reply.like',['id'=>$r->id])}}">Like <span class="badge">{{$r->likes->count()}}</span></a></span>
                                    @endif

                                        <span class="pull-right">&nbsp;{{$r->created_at->diffForhumans()}}</span>
                                        @if(!$best_answer)
                                        <span class="pull-right"><a href="{{route('discussion.best.answer',['id'=>$r->id] )}}" style="text-decoration: none" class="btn-info btn-sm"> Mark as Best Answer </a></span>
                                            @elseif($r->best_answer == 1)
                                            <span class="pull-right"> <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>Best Answer </span>
                                            @endif
                                </div>
                            </div>
                            <hr width="100px" style=" border: 1px solid darkolivegreen;"><hr width="90px" style=" border: 1px solid darkolivegreen;"><hr width="80px" style=" border: 1px solid darkolivegreen;">
                        @endforeach
                                @if(Auth::check())
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{route('discussion.reply',['id'=>$d->id])}}" method="post">
                                        {{csrf_field()}}
                                        <div class="form-group">
                                            <label for="reply">Leave a reply</label>
                                            <textarea name="reply" id="content1" cols="30" class="form-control" rows="4"></textarea>
                                        </div>
                                        <div class="pull-right"><button type="submit" class="btn btn-primary">Submit</button></div>
                                    </form>
                                </div>
                            </div>
                                    @else
                                    <div class="text-center"><br>
                                        <a href="/login"><h2><span class="fa fa-user"></span>SignIn to Reply</h2></a>
                                    </div>
                                    @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('styles')
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
    @endsection
@section('scripts')

    <script>
    $(document).ready(function() {
    $('#content1').summernote();
    });

    </script>
    @endsection