@extends('layouts.user')
@section('content')
    <div class="panel panel-primary">
        <div class="panel-body">
            {!! Form::model($user_data, array('url' => url('account/'.$user_data->id), 'method' => 'put', 'files'=> true)) !!}
            <div class="nav-tabs-custom" id="setting_tabs">
                <ul class="nav nav-tabs" style="display:list-item;">
                    <li class="active">
                        <a href="#general" data-toggle="tab" title="{{ __('tab.information') }}">
                            <i class="material-icons md-24">info</i>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="general">
                        <div class="form-group col-xs-6 required {{ $errors->has('first_name') ? 'has-error' : '' }}">
                            {!! Form::label('first_name', __('user.first_name'), array('class' => 'control-label required')) !!}
                            <div class="controls">
                                {!! Form::text('first_name', null, array('class' => 'form-control', 'required' => true)) !!}
                                <span class="help-block">{{ $errors->first('first_name', ':message') }}</span>
                            </div>
                        </div>
                        <div class="form-group col-xs-6 required {{ $errors->has('last_name') ? 'has-error' : '' }}">
                            {!! Form::label('last_name', __('user.last_name'), array('class' => 'control-label required')) !!}
                            <div class="controls">
                                {!! Form::text('last_name', null, array('class' => 'form-control', 'required' => true)) !!}
                                <span class="help-block">{{ $errors->first('last_name', ':message') }}</span>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group col-xs-6 required {{ $errors->has('phone_number') ? 'has-error' : '' }}">
                            {!! Form::label('phone_number', __('user.phone_number'), array('class' => 'control-label required')) !!}
                            <div class="controls">
                                {!! Form::text('phone_number', null, array('class' => 'form-control','data-fv-integer' => 'true', 'required' => true)) !!}
                                <span class="help-block">{{ $errors->first('phone_number', ':message') }}</span>
                            </div>
                        </div>
                        <div class="form-group col-xs-6 required {{ $errors->has('email') ? 'has-error' : '' }}">
                            {!! Form::label('email', __('user.email'), array('class' => 'control-label required')) !!}
                            <div class="controls">
                                {!! Form::text('email', null, array('class' => 'form-control', 'required' => true)) !!}
                                <span class="help-block">{{ $errors->first('email', ':message') }}</span>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group fileinput col-xs-6 fileinput-{{isset($user_data) && $user_data->user_avatar ? 'exists' : 'new' }}" data-provides="fileinput">
                            <input type="hidden" id="user_avatar" name="user_avatar" value="{{isset($user_data) && $user_data->user_avatar ? $user_data->user_avatar : ''}}">
                            {!! Form::label('user_avatar', __('user.avatar'), array('class' => 'control-label')) !!}
                            <div class="controls">
                                <div class="fileinput-preview fileinput-exists thumbnail" style="width: 200px">
                                    @if (isset($user_data) && $user_data->user_avatar)
                                        <img src="{{asset('uploads/avatar'). '/' . $user_data->user_avatar}}" width="200">
                                    @endif
                                </div>
                                <div>
                                    <span class="btn btn-default btn-file">
                                        <span class="fileinput-new">{{ __('form.select_image') }}</span>
                                        <span class="fileinput-exists">{{ __('form.change_image') }}</span>
                                        <input type="file" name="avatar_file">
                                    </span>
                                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">{{ __('form.remove_image') }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group col-xs-6 {{ $errors->has('password') ? 'has-error' : '' }}">
                            {!! Form::label('password', __('user.password'), array('class' => 'control-label')) !!}
                            <div class="controls">
                                {!! Form::password('password', array('class' => 'form-control')) !!}
                                <span class="help-block">{{ $errors->first('password', ':message') }}</span>
                            </div>
                        </div>
                        <div class="form-group col-xs-6 {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                            {!! Form::label('password_confirmation', __('user.password_confirmation'), array('class' => 'control-label')) !!}
                            <div class="controls">
                                {!! Form::password('password_confirmation', array('class' => 'form-control')) !!}
                                <span class="help-block">{{ $errors->first('password_confirmation', ':message') }}</span>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group col-xs-6 {{ $errors->has('lang') ? 'has-error' : '' }}">
                            {!! Form::label('lang', __('user.lang'), array('class' => 'control-label')) !!}
                            <div class="controls">
                                {!! Form::select('lang', $lang, isset($user_data) ? $user_data->lang : null, ['class' => 'form-control select2']) !!}
                                <span class="help-block">{{ $errors->first('lang', ':message') }}</span>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="form-group col-xs-6">
                    <div class="controls">
                        <a href="{{ url('/') }}" class="btn btn-danger"><i
                                    class="fa fa-times"></i> {{__('table.back')}}</a>
                        <button type="submit" class="btn btn-success"><i
                                    class="fa fa-check-square-o"></i> {{__('table.ok')}}</button>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@stop

@section('scripts')
    <script>
        $('form').on('change.bs.fileinput', '.fileinput', function() {
            $('#user_avatar').val(null);
        }).on('clear.bs.fileinput', '.fileinput', function() {
            $('#user_avatar').val(null);
        });
    </script>
@stop