@extends('layouts.app')

@section('content')
   <div class="container">
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
           @endforeach <br>

   </div> <br>
   <div  >
       {{$discussions->links()}}
   </div>
@endsection