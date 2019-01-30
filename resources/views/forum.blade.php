{{--This displays all the discussions in the Forum project--}}
@extends('layouts.app')

@section('content')
   <div class="container">
       @foreach($discussions as $d)
            <div class="card" style="border-radius: 2px 32px 2px 2px">
                <div class="card-header">
                    <img src="{{$d->user ? $d->user->avatar:"No foto"}}" alt="Anonymous" width="40px" height="40px">
                    {{$d->user?$d->user->name : "Anonymous"}}
                    &nbsp;&nbsp;<a href="{{route('discussion',['slug'=>$d->slug])}}" class="btn btn-sm btn-info pull-right" style="border-radius: 2px 15px 2px 15px">View</a>
                    &nbsp;@if($d->hasBestAnswer())
                        &nbsp;<span class="btn btn-sm btn-success pull-right" data-toggle="tooltip" title="The best answer has been marked and discussion is closed"><i class="fa fa-folder"></i></span>&nbsp;
                        @else
                        <span class="btn btn-sm btn-danger pull-right" data-toggle="tooltip" title="discussion is open as no best answer is marked"><i class="fa fa-folder-open"></i></span>&nbsp;

                        @endif
                </div>

                <div class="card-body">
                    <h2 class="text-left"><i class="fa fa-lightbulb-o"></i>{{$d->title}}</h2>
                    <span class="fa fa-comment"></span>{!! str_limit($d->content,30) !!}                </div>
                <div class="card-footer">
                    {{$d->replies->count()}} : Replies <span style="padding:2px;border: 1px solid darkslategrey" class="pull-right"><i class="fa fa-link"></i>
                        <a title="View all discussions on this topic" data-toggle="tooltip " href="{{route('channel',['slug'=>$d->channel->slug])}}">{{str_limit($d->channel->title,20)}}</a> <i class="fa fa-space-shuttle"></i> {{$d->created_at->diffForhumans()}}</span>
                </div>
            </div>
           <hr>
           @endforeach <br>

   </div> <br>
   <div class="text-center">
       {{$discussions->links()}}
   </div>
@endsection