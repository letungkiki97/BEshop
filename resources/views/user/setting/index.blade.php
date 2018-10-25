@extends('layouts.user')

{{-- Web site Title --}}
@section('title')
{{ $title }}
@stop

@section('styles')
<link rel="stylesheet" href="{{ asset('css/icheck.css') }}" type="text/css">
<style>
    .b-t-10 {
            margin-bottom: 10px;
        }
    </style>
@stop
{{-- Content --}}
@section('content')
@include('vendor.flash.message')
@if (session('status'))
<div class="alert alert-success">{{ session('status') }} <a href="#" class="close" data-dismiss="alert">&times;</a></div>
@endif
<div class="panel panel-primary">
    <div class="panel-body">
        <span class="pull-right">
            <a href="#" class="text-muted">
                <i class="fa fa-gear"></i>
            </a>
        </span>
        {!! Form::open(array('url' => 'quantri/setting', 'method' => 'post', 'files'=> true)) !!}
        <div class="nav-tabs-custom" id="setting_tabs">
            @if($errors->any())
            <div class="form-group has-error">
                @foreach($errors->all() as $error)
                <span class="help-block">{{ $error }}</span>
                @endforeach
            </div>
            @endif
            <ul class="nav nav-tabs" style="display:list-item;">
                <li class="active">
                    <a href="#general_configuration" data-toggle="tab" title="{{ __('tab.general') }}"><i class="material-icons md-24">build</i></a>
                </li>
                <li>
                    <a href="#email_configuration" data-toggle="tab" title="{{ __('tab.email') }}"><i class="material-icons md-24">email</i></a>
                </li>
                <li>
                    <a href="#supplier_configuration" data-toggle="tab" title="{{ __('tab.supplier') }}"><i class="material-icons md-24">store</i></a>
                </li>
                <li>
                    <a href="#sales_configuration" data-toggle="tab" title="{{ __('tab.sales') }}"><i class="material-icons md-24">shopping_cart</i></a>
                </li>
                <li>
                    <a href="#requirement_configuration" data-toggle="tab" title="{{ __('tab.requirement') }}"><i class="material-icons md-24">perm_data_setting</i></a>
                </li>
                <li>
                    <a href="#delivery_configuration" data-toggle="tab" title="{{ __('tab.delivery') }}"><i class="material-icons md-24">local_shipping</i></a>
                </li>
                <li>
                    <a href="#stock_configuration" data-toggle="tab" title="{{ __('tab.stock') }}">
                        <i class="material-icons md-24">account_balance</i>
                    </a>
                </li>
                <li>
                    <a href="#other_configuration" data-toggle="tab" title="{{ __('tab.other') }}"><i class="material-icons md-24">settings</i></a>
                </li>
                <li>
                    <a href="#other_contact" data-toggle="tab" title="Contact"><i class="glyphicon glyphicon-file md-24"></i></a>
                </li>
                <li>
                    <a href="#other_introduce" data-toggle="tab" title="introduce"><i class="glyphicon glyphicon-book md-24"></i></a>
                </li>

            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="general_configuration">
                    <div class="form-group required {{ $errors->has('site_name') ? 'has-error' : '' }}">
                        {!! Form::label('site_name', __('setting.site_name'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::text('site_name', old('site_name', Settings::get('site_name')), array('class' =>
                            'form-control')) !!}
                            <span class="help-block">{{ $errors->first('site_name', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group required {{ $errors->has('site_email') ? 'has-error' : '' }}">
                        {!! Form::label('site_email', __('setting.site_email'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::text('site_email', old('site_email', Settings::get('site_email')), array('class'
                            => 'form-control')) !!}
                            <span class="help-block">{{ $errors->first('site_email', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group required {{ $errors->has('hotline') ? 'has-error' : '' }}">
                        {!! Form::label('hotline', __('setting.hotline'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::text('hotline', old('hotline', Settings::get('hotline')), array('class' =>
                            'form-control')) !!}
                            <span class="help-block">{{ $errors->first('hotline', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group required {{ $errors->has('address') ? 'has-error' : '' }}">
                        {!! Form::label('address', __('setting.address'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::text('address', old('address', Settings::get('address')), array('class' =>
                            'form-control')) !!}
                            <span class="help-block">{{ $errors->first('address', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group required {{ $errors->has('slogan') ? 'has-error' : '' }}">
                        {!! Form::label('slogan', __('setting.slogan'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::text('slogan', old('slogan', Settings::get('slogan')), array('class' =>
                            'form-control')) !!}
                            <span class="help-block">{{ $errors->first('slogan', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group fileinput fileinput-{{ Settings::get('site_logo') ? 'exists' : 'new' }}"
                        data-provides="fileinput">
                        <input type="hidden" id="site_logo" name="site_logo" value="{{ Settings::get('site_logo') ?: '' }}">
                        {!! Form::label('site_logo_file', __('setting.site_logo'), array('class' => 'control-label'))
                        !!}
                        <div class="controls">
                            <div class="fileinput-preview fileinput-exists thumbnail" style="width: 200px">
                                @if (Settings::get('site_logo'))
                                <img src="{{asset('uploads/site'). '/' . Settings::get('site_logo')}}" width="200">
                                @endif
                            </div>
                            <div>
                                <span class="btn btn-default btn-file">
                                    <span class="fileinput-new">{{ __('form.select_image') }}</span>
                                    <span class="fileinput-exists">{{ __('form.change_image') }}</span>
                                    <input type="file" name="site_logo_file">
                                </span>
                                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">{{
                                    __('form.remove_image') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group required {{ $errors->has('date_format') ? 'has-error' : '' }}">
                        {!! Form::label('date_format', __('setting.date_format'), array('class' => 'control-label'))
                        !!}
                        <div class="controls">
                            <div class="radio">
                                {!! Form::radio('date_format', 'F j,Y',(Settings::get('date_format')=='F
                                j,Y')?true:false,array('class' => 'icheck')) !!}
                                {!! Form::label('true', date('F j,Y')) !!}
                            </div>
                            <div class="radio">
                                {!! Form::radio('date_format',
                                'Y-d-m',(Settings::get('date_format')=='Y-d-m')?true:false,array('class' => 'icheck'))
                                !!}
                                {!! Form::label('date_format', date('Y-d-m')) !!}
                            </div>
                            <div class="radio">
                                {!! Form::radio('date_format',
                                'd.m.Y.',(Settings::get('date_format')=='d.m.Y.')?true:false,array('class' =>
                                'icheck')) !!}
                                {!! Form::label('date_format', date('d.m.Y.')) !!}
                            </div>
                            <div class="radio">
                                {!! Form::radio('date_format',
                                'd.m.Y',(Settings::get('date_format')=='d.m.Y')?true:false,array('class' => 'icheck'))
                                !!}
                                {!! Form::label('date_format', date('d.m.Y')) !!}
                            </div>
                            <div class="radio">
                                {!! Form::radio('date_format',
                                'd/m/Y',(Settings::get('date_format')=='d/m/Y')?true:false,array('class' => 'icheck'))
                                !!}
                                {!! Form::label('date_format', date('d/m/Y')) !!}
                            </div>
                            <div class="radio">
                                {!! Form::radio('date_format',
                                'm/d/Y',(Settings::get('date_format')=='m/d/Y')?true:false,array('class' => 'icheck'))
                                !!}
                                {!! Form::label('date_format', date('m/d/Y')) !!}
                            </div>
                            <div class="form-inline" style="display: none;">
                                {!! Form::radio('date_format', 'm/d/Y',false,array('class' => 'icheck',
                                'id'=>'date_format_custom_radio')) !!}
                                {!! Form::label('custom_format', __('setting.custom_format')) !!}
                                {!! Form::input('text','date_format_custom', Settings::get('date_format'),
                                array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <span class="help-block">{{ $errors->first('date_format', ':message') }}</span>
                    </div>
                    <div class="form-group required {{ $errors->has('time_format') ? 'has-error' : '' }}">
                        {!! Form::label('time_format', __('setting.time_format'), array('class' => 'control-label'))
                        !!}
                        <div class="controls">
                            <div class="radio">
                                {!! Form::radio('time_format', 'g:i a',(Settings::get('time_format')=='g:i
                                a')?true:false,array('class' => 'icheck')) !!}
                                {!! Form::label('time_format', date('g:i a')) !!}
                            </div>
                            <div class="radio">
                                {!! Form::radio('time_format', 'g:i A',(Settings::get('time_format')=='g:i
                                A')?true:false,array('class' => 'icheck')) !!}
                                {!! Form::label('time_format', date('g:i A')) !!}
                            </div>
                            <div class="radio">
                                {!! Form::radio('time_format',
                                'H:i',(Settings::get('time_format')=='H:i')?true:false,array('class' => 'icheck')) !!}
                                {!! Form::label('time_format', date('H:i')) !!}
                            </div>
                            <div class="form-inline" style="display: none;">
                                {!! Form::radio('time_format', 'H:i',false,array('class' => 'icheck',
                                'id'=>'time_format_custom_radio')) !!}
                                {!! Form::label('custom_format', __('setting.custom_format')) !!}
                                {!! Form::input('text','time_format_custom', Settings::get('time_format'),
                                array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <span class="help-block">{{ $errors->first('date_format', ':message') }}</span>
                    </div>
                </div>
                <div class="tab-pane" id="email_configuration">
                    {{-- <div class="form-group required {{ $errors->has('email_driver') ? 'has-error' : '' }}">
                        {!! Form::label('email_driver', __('setting.email_driver'), array('class' => 'control-label'))
                        !!}
                        <div class="controls">
                            <div class="form-inline">
                                <div class="radio">
                                    {!! Form::radio('email_driver',
                                    'mail',(Settings::get('email_driver')=='mail')?true:false,array('id'=>'mail','class'
                                    => 'email_driver icheck')) !!}
                                    {!! Form::label('true', 'MAIL') !!}
                                </div>
                                <div class="radio">
                                    {!! Form::radio('email_driver', 'smtp',
                                    (Settings::get('email_driver')=='smtp')?true:false,array('id'=>'smtp','class' =>
                                    'email_driver icheck')) !!}
                                    {!! Form::label('false', 'SMTP') !!}
                                </div>
                            </div>
                            <span class="help-block">{{ $errors->first('email_driver', ':message') }}</span>
                        </div>
                    </div> --}}
                    <div class="form-group required {{ $errors->has('email_driver') ? 'has-error' : '' }}">
                        {!! Form::label('email_driver', __('setting.email_driver'), array('class' => 'control-label'))
                        !!}
                        <div class="controls">
                            {!! Form::input('text','email_driver', old('email_driver', Settings::get('email_driver')),
                            array('class' => 'form-control')) !!}
                            <span class="help-block">{{ $errors->first('email_driver', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group required {{ $errors->has('email_host') ? 'has-error' : '' }}">
                        {!! Form::label('email_host', __('setting.email_host'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::input('text','email_host', old('email_host', Settings::get('email_host')),
                            array('class' => 'form-control')) !!}
                            <span class="help-block">{{ $errors->first('email_host', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group required {{ $errors->has('email_port') ? 'has-error' : '' }}">
                        {!! Form::label('email_port', __('setting.email_port'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::input('text','email_port', old('email_port', Settings::get('email_port')),
                            array('class' => 'form-control')) !!}
                            <span class="help-block">{{ $errors->first('email_port', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group required {{ $errors->has('email_username') ? 'has-error' : '' }}">
                        {!! Form::label('email_username', __('setting.email_username'), array('class' =>
                        'control-label')) !!}
                        <div class="controls">
                            {!! Form::input('text','email_username', old('email_username',
                            Settings::get('email_username')), array('class' => 'form-control')) !!}
                            <span class="help-block">{{ $errors->first('email_username', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group required {{ $errors->has('email_password') ? 'has-error' : '' }}">
                        {!! Form::label('email_password', __('setting.email_password'), array('class' =>
                        'control-label')) !!}
                        <div class="controls">
                            {!! Form::input('text','email_password', old('email_password',
                            Settings::get('email_password')), array('class' => 'form-control')) !!}
                            <span class="help-block">{{ $errors->first('email_password', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('email_list') ? 'has-error' : '' }}">
                        {!! Form::label('email_list', __('setting.email_list'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>{{ __('setting.email_username') }}</th>
                                        <th>{{ __('setting.email_password') }}</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="mail_list">
                                    @if($email_list)
                                    @foreach($email_list as $a => $p)
                                    <tr>
                                        <td>
                                            {!! Form::input('text','mail_account[]', old('mail_account[]', $a),
                                            array('class' => 'form-control')) !!}
                                        </td>
                                        <td>
                                            {!! Form::input('text','mail_password[]', old('mail_password[]', $p),
                                            array('class' => 'form-control')) !!}
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" class="delete removeclass"><i class="fa fa-fw fa-times text-danger"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-primary" id="add_account">{{ __('form.add_account') }}</button>
                            <span class="help-block">{{ $errors->first('email_list', ':message') }}</span>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="supplier_configuration">
                    <div class="form-group required {{ $errors->has('international_transport_rate_volume') ? 'has-error' : '' }}">
                        {!! Form::label('international_transport_rate_volume',
                        __('setting.international_transport_rate_volume'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::text('international_transport_rate_volume',
                            old('international_transport_rate_volume',
                            Settings::get('international_transport_rate_volume')), array('class' => 'form-control
                            number')) !!}
                            <span class="help-block">{{ $errors->first('international_transport_rate_volume',
                                ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group required {{ $errors->has('international_transport_rate_kg') ? 'has-error' : '' }}">
                        {!! Form::label('international_transport_rate_kg',
                        __('setting.international_transport_rate_kg'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::text('international_transport_rate_kg', old('international_transport_rate_kg',
                            Settings::get('international_transport_rate_kg')), array('class' => 'form-control number'))
                            !!}
                            <span class="help-block">{{ $errors->first('international_transport_rate_kg', ':message')
                                }}</span>
                        </div>
                    </div>
                    <div class="form-group required {{ $errors->has('ordering_fee') ? 'has-error' : '' }}">
                        {!! Form::label('ordering_fee', __('setting.ordering_fee'), array('class' => 'control-label'))
                        !!}
                        <div class="controls">
                            {!! Form::number('ordering_fee', old('ordering_fee', Settings::get('ordering_fee')),
                            array('class' => 'form-control', 'min' => 0.01, 'max' => 100, 'step' => 0.01)) !!}
                            <span class="help-block">{{ $errors->first('ordering_fee', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group required {{ $errors->has('default_lead_time') ? 'has-error' : '' }}">
                        {!! Form::label('default_lead_time', __('setting.default_lead_time'), array('class' =>
                        'control-label')) !!}
                        <div class="controls">
                            {!! Form::number('default_lead_time', old('default_lead_time',
                            Settings::get('default_lead_time')), array('class' => 'form-control')) !!}
                            <span class="help-block">{{ $errors->first('default_lead_time', ':message') }}</span>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="requirement_configuration">
                    <div class="form-group required {{ $errors->has('mrp_hour') ? 'has-error' : '' }}">
                        {!! Form::label('mrp_hour', __('setting.mrp_hour'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::number('mrp_hour', old('mrp_hour', Settings::get('mrp_hour')), array('class' =>
                            'form-control')) !!}
                            <span class="help-block">{{ $errors->first('mrp_hour', ':message') }}</span>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="sales_configuration">
                    <div class="form-group {{ $errors->has('sales_person') ? 'has-error' : '' }}">
                        {!! Form::label('sales_person', __('setting.sales_person'), array('class' => 'control-label'))
                        !!}
                        <div class="controls">
                            {!! Form::select('sales_person', $staffs, old('sales_person',
                            Settings::get('sales_person')), array('class' => 'form-control select2')) !!}
                            <span class="help-block">{{ $errors->first('sales_person', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group required {{ $errors->has('deposit') ? 'has-error' : '' }}">
                        {!! Form::label('deposit', __('setting.deposit'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::number('deposit', old('deposit', Settings::get('deposit')), array('class' =>
                            'form-control', 'min' => 0.01, 'max' => 100, 'step' => 0.01)) !!}
                            <span class="help-block">{{ $errors->first('deposit', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group required {{ $errors->has('tracking_number') ? 'has-error' : '' }}">
                        {!! Form::label('tracking_number', __('setting.tracking_number'), array('class' =>
                        'control-label')) !!}
                        <div class="controls">
                            {!! Form::text('tracking_number', old('tracking_number', Settings::get('tracking_number')),
                            array('class' => 'form-control', 'readonly' => true)) !!}
                            <span class="help-block">{{ $errors->first('tracking_number', ':message') }}</span>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="delivery_configuration">
                    <div class="form-group required {{ $errors->has('picking_lead_time') ? 'has-error' : '' }}">
                        {!! Form::label('picking_lead_time', __('setting.picking_lead_time'), array('class' =>
                        'control-label')) !!}
                        <div class="controls">
                            {!! Form::number('picking_lead_time', old('picking_lead_time',
                            Settings::get('picking_lead_time')), array('class' => 'form-control')) !!}
                            <span class="help-block">{{ $errors->first('picking_lead_time', ':message') }}</span>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="other_configuration">
                    <div class="form-group {{ $errors->has('endpoint_url') ? 'has-error' : '' }}">
                        {!! Form::label('endpoint_url', __('setting.endpoint_url'), array('class' => 'control-label'))
                        !!}
                        <div class="controls">
                            {!! Form::input('text','endpoint_url', old('endpoint_url', Settings::get('endpoint_url')),
                            array('class' => 'form-control')) !!}
                            <span class="help-block">{{ $errors->first('endpoint_url', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('consumer_key') ? 'has-error' : '' }}">
                        {!! Form::label('consumer_key', __('setting.consumer_key'), array('class' => 'control-label'))
                        !!}
                        <div class="controls">
                            {!! Form::input('text','consumer_key', old('consumer_key', Settings::get('consumer_key')),
                            array('class' => 'form-control')) !!}
                            <span class="help-block">{{ $errors->first('consumer_key', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('consumer_secret') ? 'has-error' : '' }}">
                        {!! Form::label('consumer_secret', __('setting.consumer_secret'), array('class' =>
                        'control-label')) !!}
                        <div class="controls">
                            {!! Form::input('text','consumer_secret', old('consumer_secret',
                            Settings::get('consumer_secret')), array('class' => 'form-control')) !!}
                            <span class="help-block">{{ $errors->first('consumer_secret', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('gtm_code') ? 'has-error' : '' }}">
                        {!! Form::label('gtm_code', __('setting.gtm_code'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::input('text','gtm_code', old('gtm_code', Settings::get('gtm_code')),
                            array('class' => 'form-control')) !!}
                            <span class="help-block">{{ $errors->first('gtm_code', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('ga_code') ? 'has-error' : '' }}">
                        {!! Form::label('ga_code', __('setting.ga_code'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::input('text','ga_code', old('ga_code', Settings::get('ga_code')), array('class'
                            => 'form-control')) !!}
                            <span class="help-block">{{ $errors->first('ga_code', ':message') }}</span>
                        </div>
                    </div>
                </div>
                <!-- contact -->
                <div class="tab-pane" id="other_contact">
                    <div class="form-group required {{ $errors->has('long_description1') ? 'has-error' : '' }}">

                        <div class="controls">
                            {!! Form::textarea('long_description1', old('long_description1', Settings::get('long_description1')), array('class' => 'form-control', 'id' =>
                            'editor')) !!}
                            <span class="help-block">{{ $errors->first('long_description1', ':message') }}</span>
                        </div>
                    </div>
                </div>
                <!-- end contact -->

                <!-- introduce -->
                <div class="tab-pane" id="other_introduce">
                    <div class="form-group required {{ $errors->has('long_description2') ? 'has-error' : '' }}">
                        <div class="controls">
                            {!! Form::textarea('long_description2', old('long_description2', Settings::get('long_description2')), array('class' => 'form-control', 'id' =>
                            'editor2')) !!}
                            <span class="help-block">{{ $errors->first('long_description2', ':message') }}</span>
                        </div>
                    </div>
                </div>
                <!-- end introduce -->

            </div>
        </div>
        <!-- Form Actions -->
        <div class="form-group">
            <div class="controls">
                <a href="javascript:void(0)" class="btn btn-primary" id="prev_tab"><i class="fa fa-chevron-circle-left"></i>
                    Back</a>
                <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> {{__('table.ok')}}</button>
                <a href="javascript:void(0)" class="btn btn-primary" id="next_tab">Next <i class="fa fa-chevron-circle-right"></i></a>
            </div>
        </div>
        <!-- ./ form actions -->

        {!! Form::close() !!}
    </div>
</div>
@stop

@section('scripts')
<script type="text/javascript" src="{{ asset('js/icheck.min.js') }}"></script>
<script>
    CKEDITOR.replace('editor');
    CKEDITOR.replace('editor2');
    $(document).ready(function () {
        $('.icheck').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });

        $("input[name='date_format']").on('ifChecked', function () {
            if ("date_format_custom_radio" != $(this).attr("id"))
                $("input[name='date_format_custom']").val($(this).val()).siblings('.example').text($(this).siblings('span').text());
        });
        $("input[name='date_format_custom']").focus(function () {
            $("#date_format_custom_radio").attr("checked", "checked");
        });

        $("input[name='time_format']").on('ifChecked', function () {
            if ("time_format_custom_radio" != $(this).attr("id"))
                $("input[name='time_format_custom']").val($(this).val()).siblings('.example').text($(this).siblings('span').text());
        });
        $("input[name='time_format_custom']").focus(function () {
            $("#time_format_custom_radio").attr("checked", "checked");
        });
        $("input[name='date_format_custom'], input[name='time_format_custom']").on('ifChecked', function () {
            var format = $(this);
            format.siblings('img').css('visibility', 'visible');
            $.post(ajaxurl, {
                action: 'date_format_custom' == format.attr('name') ? 'date_format' : 'time_format',
                date: format.val()
            }, function (d) {
                format.siblings('img').css('visibility', 'hidden');
                format.siblings('.example').text(d);
            });
        });
        $('body').on("click", ".removeclass", function (e) {
            $(this).closest('tr').remove();
        });
        $('#add_account').click(function () {
            $('#mail_list').append('<tr><td><input name="mail_account[]" type="text" class="form-control"></td> <td><input name="mail_password[]" type="text" class="form-control"></td> <td><a href="javascript:void(0)" class="delete removeclass"><i class="fa fa-fw fa-times text-danger"></i></a></td></tr>');
        });
        $('form').on('change.bs.fileinput', '.fileinput', function () {
            $('#site_logo').val(null);
        }).on('clear.bs.fileinput', '.fileinput', function () {
            $('#site_logo').val(null);
        });
    });
</script>
@stop