@extends('layouts.app')

@section('content')
    <div class="container">
        @if($discussions->count()>0)
        @foreach($discussions as $d)
            <div class="card ">
                <div class="card-header">
                    <img src="{{$d->user ? $d->user->avatar:"No foto"}}" alt="Anonymous" width="40px" height="40px">
                    {{$d->user?$d->user->name : "Anonymous"}}
                    <a href="{{route('discussion',['slug'=>$d->slug])}}" class="btn btn-info float-right">View</a>
                </div>

                <div class="card-body">
                    <h2 class="text-left"><i class="fa fa-lightbulb-o"></i>{{$d->title}}</h2>
                    <span class="fa fa-comment"></span>{{str_limit($d->content,30)}}
                </div>
                <div class="card-footer">
                    {{$d->replies->count()}} : Replies <span class="pull-right">{{$d->created_at->diffForhumans()}}</span>
                </div>
            </div>
            <hr>
        @endforeach

        @else
            <div class="container">
                <div class="row">
                  <div class="col-md-12" style="margin-top: 200px">
                      <h1>No discussions under This Channel [Empty]  <a href="{{route('discussions.create')}}" class="btn btn-success btn-sm">Create a new Discussion</a></h1>
                      <img src="{{url('avatars/book.png')}}">
                  </div>

                </div>
            </div>
        @endif
            <br>

    </div> <br>
    <div  >
        {{$discussions->links()}}
    </div>
@endsection