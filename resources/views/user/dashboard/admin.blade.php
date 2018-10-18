@extends('layouts.user')
@section('title')
    {{__('dashboard.title')}}
@stop
@section('styles')
@stop
@section('content')
    @if($errors->any())
        <div class="alert alert-danger alert-dismissable fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{$errors->first()}}
        </div>
    @endif
@stop

@section('scripts')

@stop