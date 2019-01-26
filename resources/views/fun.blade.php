@extends('layouts.app')

@section('content')
    <div class="container">

        <ul class="list-group">

            <a href="" > <li class="list-group-item activable  " id="item" >learn</li></a>
            <a href="" > <li class="activable list-group-item " id="item" >learn 2</li></a>
            <a href="" > <li class="activable list-group-item "  id="item">learn 3</li></a>

        </ul>
        <br>

    </div> <br>
    {{--<div  >--}}
        {{--{{$discussions->links()}}--}}
    {{--</div>--}}
@endsection
@section('scripts')
    <script>
        $("li.activable").click(function(){
            $("li.activable.active").removeClass("active");
            $(this).addClass("active");
        });
    </script>
    @endsection