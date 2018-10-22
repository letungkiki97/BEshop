@extends('layouts.user')
@section('title')
    {{__('dashboard.title')}}
@stop
@section('styles')
    <style>
        #now {
            color: #103ffb;
        }
    </style>
@stop
@section('content')
    @if($errors->any())
        <div class="alert alert-danger alert-dismissable fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{$errors->first()}}
        </div>
    @endif
    <div class="row mar-20">
        <div class="col-md-12">
            <h2 id="now"></h2>
        </div>
    </div>
@stop

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/moment.min.js') }}"></script>
    <script>
        setInterval(function() {
            $('#now').html(moment().format('dddd D MMMM YYYY - HH:mm:ss'));
        }, 1000);
    </script>
@stop