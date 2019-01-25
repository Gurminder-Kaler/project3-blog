@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header">
                        <img src="{{$d->user ? $d->user->avatar:"No foto"}}" alt="Anonymous" width="40px" height="40px">
                        {{$d->user?$d->user->name : "Anonymous"}}
                        <a href="{{route('discussion',['slug'=>$d->slug])}}" class="btn btn-info float-right">View</a>
                    </div>

                    <div class="card-body">
                        <h2 class="text-left"><i class="fa fa-lightbulb-o"></i>{{$d->title}}</h2>
                        <span class="fa fa-comment"></span>{{$d->content}}
                    </div>
                    <div class="card-footer">
                        {{$d->replies->count()}} : Replies <span class="pull-right">{{$d->created_at->diffForhumans()}}</span>
                    </div>
                </div>
                {{--card ends here--}}
            @foreach($d->replies as $r)
                    <div class="card ">
                        <div class="card-header">
                            <img src="{{$r->user ? $r->user->avatar:"No foto"}}" alt="Anonymous" width="40px" height="40px">
                            {{$r->user?$r->user->name : "Anonymous"}}
                            {{--<a href="{{route('discussion',['slug'=>$r->slug])}}" class="btn btn-info float-right">View</a>--}}
                        </div>

                        <div class="card-body">
                            <h2 class="text-left"><i class="fa fa-lightbulb-o"></i>{{$r->title}}</h2>
                            <span class="fa fa-comment"></span>{{str_limit($r->content,30)}}
                        </div>
                        <div class="card-footer">
                            @if($r->is_liked_by_auth_user())
                            <span class="pull-left fa fa-thumbs-down"><a href="#" class=" btn-danger btn-xs">Unlike</a></span>
                                        @endif
                                <span class="pull-left fa fa-thumbs-up"  ><a class="btn-sm btn-success" href="{{route('reply/like',['id'=>$r->id])}}">Like</a></span>
                            <span class="pull-right">{{$r->created_at->diffForhumans()}}</span>
                        </div>
                    </div>
                @endforeach
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('discussion.reply',['id'=>$d->id])}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="reply">Leave a reply</label>
                                <textarea name="reply" id="" cols="30" class="form-control" rows="10"></textarea>
                            </div>
                            <div class="pull-right"><button type="submit" class="btn btn-primary">Submit</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection