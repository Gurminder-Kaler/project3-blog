@extends('layouts.app')

@section('content')
    <div class="card ">
        <div class="card-header">Update the reply</div>

        <div class="card-body">
            <form action="{{route('reply.update',['id'=>$reply->id])}}" method="post">
                {{csrf_field()}}
                {{--<div class="form-group">--}}
                {{--<label for="title">Title</label>--}}
                {{--<input type="text" value="{{old('title')}}" name="title" class="form-control">--}}
                {{--</div>--}}
                <div class="form-group">
                    <label for="content">Ask a Question</label>
                    <textarea name="content" id="content1" cols="30" rows="10"  class="form-control"> {!! $reply->content !!}</textarea>
                </div>
                {{--{!! Markdown::convertToHtml($reply->content)!!}--}}
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Save Reply Changes</button>
                </div>
            </form>

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