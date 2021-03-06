@extends('layouts.auth')
@section('content')
    <div class="box-color text-color">
        <h4>{{trans('auth.forgot')}}</h4>
        <br>
        {!! Form::open(array('url' => url('password'), 'method' => 'post')) !!}
        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
            {!! Form::label(trans('auth.email')) !!} :
            <span class="help-block">{{ $errors->first('email', ':message') }}</span>
            {!! Form::email('email', null, array('class' => 'form-control', 'required'=>'required')) !!}
        </div>
            <button type="submit" class="btn btn-primary btn-block">{{trans('auth.send_reset')}}</button>
        {!! Form::close() !!}
        <h5 class="text-center">
            <a href="{{url('signin')}}" class="text-default">{{trans('auth.login')}}?</a>
        </h5>
    </div>
@stop