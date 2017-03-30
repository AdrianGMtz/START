@extends('layouts.app')

@section('content')
    <div class="row">
        <ul id="tabs-swipe" class="tabs tabs-fixed-width" style="margin-top: 10px;">
            <li class="tab col s3"><a class="active red white-text" href="#photography">Photography</a></li>
            <li class="tab col s3"><a class="blue white-text" href="#digital-art">Digital Art</a></li>
            <li class="tab col s3"><a class="green white-text" href="#sketch">Sketches</a></li>
        </ul>

        <div id="photography" class="col s12 white" style="border-color:red;">
            <div class="row" style="margin-top: 10px;">
                @if (count($photography_commissions) > 0)
                    @foreach ($photography_commissions as $commission)
                        @include ('commissions.explore_commission')
                    @endforeach
                @else
                    <h5 class="center">No commissions for this type.</h5>
                @endif
            </div>

            {!! $photography_commissions->links('commissions/pagination') !!}
        </div>

        <div id="digital-art" class="col s12 white" style="border-color:blue;">
            <div class="row" style="margin-top: 10px;">
                @if (count($digital_commissions) > 0)
                    @foreach ($digital_commissions as $commission)
                        @include ('commissions.explore_commission')
                    @endforeach
                @else
                    <h5 class="center">No commissions for this type.</h5>
                @endif
            </div>

            {!! $digital_commissions->links('commissions/pagination') !!}
        </div>

        <div id="sketch" class="col s12 white" style="border-color:green;">
             <div class="row" style="margin-top: 10px;">
                @if (count($sketch_commissions) > 0)
                    @foreach ($sketch_commissions as $commission)
                        @include ('commissions.explore_commission')
                    @endforeach
                @else
                    <h5 class="center">No commissions for this type.</h5>
                @endif
            </div>

            {!! $sketch_commissions->links('commissions/pagination') !!}
        </div>
    </div>
@endsection