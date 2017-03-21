@extends('layouts.app')

@section('content')
    <div class="row">

        <ul id="tabs-swipe-demo" class="tabs tabs-fixed-width" style="margin-top: 10px;">
            <li class="tab col s3"><a class="active red white-text" href="#digital-art">Digital Art</a></li>
            <li class="tab col s3"><a class="blue white-text" href="#animation">Animation</a></li>
            <li class="tab col s3"><a class="green white-text" href="#audio">Audio</a></li>
        </ul>

        <div id="digital-art" class="col s12 white" style="border-color:red;">

            <div class="row" style="margin-top: 10px;">
                @foreach ($commissions as $commission)
                    @include ('commissions.commission')
                @endforeach
            </div>

            <ul class="pagination center">
                <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
                <li class="active"><a href="#!">1</a></li>
                <li class="waves-effect"><a href="#!">2</a></li>
                <li class="waves-effect"><a href="#!">3</a></li>
                <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
            </ul>

        </div>


        <div id="animation" class="col s12 white" style="border-color:blue;">

            Animation

        </div>


        <div id="audio" class="col s12 white" style="border-color:green;">

             Audio

        </div>

    </div>
@endsection