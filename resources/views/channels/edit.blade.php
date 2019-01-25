@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit the {{$channel->title}}</div>

                    <div class="card-body">
                        {{--@if (session('status'))--}}
                        {{--<div class="alert alert-success" role="alert">--}}
                        {{--{{ session('status') }}--}}
                        {{--</div>--}}
                        {{--@endif--}}

                        <form action="{{route('channels.update',['channel'=>$channel->id])}}" method="post"  >
                            {{csrf_field()}}
                            {{method_field('PUT')}}
                            <div class="form-group">
                                <input type="text" name="channel" value="{{$channel->title}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success"  type="submit">Update Channel</button>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
