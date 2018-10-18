@extends('layouts.user')

{{-- Web site Title --}}
@section('title')
    {{ $title }}
@stop

@section('styles')
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
    <div class="panel panel-primary" xmlns:v-bind="http://symfony.com/schema/routing">
        <div class="panel-body">
            <span class="pull-right">
                <a href="#" class="text-muted">
                    <i class="fa fa-gear"></i>
                </a>
            </span>
            {!! Form::open(array('url' => '/content_setting', 'method' => 'post', 'files'=> true)) !!}
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
                        <a href="#customer_configuration" data-toggle="tab" title="{{ __('tab.customer') }}">
                            <i class="material-icons md-24">group</i>
                        </a>
                    </li>
                    <li>
                        <a href="#text_configuration" data-toggle="tab" title="{{ __('tab.text') }}">
                            <i class="material-icons md-24">edit</i>
                        </a>
                    </li>
                    <li>
                        <a href="#product_configuration" data-toggle="tab" title="{{ __('tab.product') }}">
                            <i class="material-icons md-24">apps</i>
                        </a>
                    </li>
                    <li>
                        <a href="#social_configuration" data-toggle="tab" title="{{ __('tab.social') }}">
                            <i class="material-icons md-24">public</i>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="customer_configuration">
                        <div class="form-group {{ $errors->has('individual_customer') ? 'has-error' : '' }}">
                            {!! Form::label('individual_customer', __('setting.individual_customer'), array('class' => 'control-label')) !!}
                            <div class="controls">
                                {!! Form::select('individual_customer', $customer_type, old('individual_customer', Settings::get('individual_customer')), array('class' => 'form-control select2')) !!}
                                <span class="help-block">{{ $errors->first('individual_customer', ':message') }}</span>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('professional_customer') ? 'has-error' : '' }}">
                            {!! Form::label('professional_customer', __('setting.professional_customer'), array('class' => 'control-label')) !!}
                            <div class="controls">
                                {!! Form::select('professional_customer', $customer_type, old('professional_customer', Settings::get('professional_customer')), array('class' => 'form-control select2')) !!}
                                <span class="help-block">{{ $errors->first('professional_customer', ':message') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="text_configuration">
                        <div class="form-group {{ $errors->has('shipping_return') ? 'has-error' : '' }}">
                            {!! Form::label('shipping_return', __('setting.shipping_return'), array('class' => 'control-label')) !!}
                            <div class="controls">
                                {!! Form::textArea('shipping_return', old('shipping_return', Settings::get('shipping_return')), array('class' => 'form-control')) !!}
                                <span class="help-block">{{ $errors->first('shipping_return', ':message') }}</span>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('payment') ? 'has-error' : '' }}">
                            {!! Form::label('payment', __('setting.payment'), array('class' => 'control-label')) !!}
                            <div class="controls">
                                {!! Form::textArea('payment', old('payment', Settings::get('payment')), array('class' => 'form-control')) !!}
                                <span class="help-block">{{ $errors->first('payment', ':message') }}</span>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('why_buy') ? 'has-error' : '' }}">
                            {!! Form::label('why_buy', __('setting.why_buy'), array('class' => 'control-label')) !!}
                            {!! Form::text('why_buy', old('why_buy', Settings::get('why_buy')), array('class' => 'form-control b-t-10')) !!}
                            <div class="clear"></div>
                            <div class="row">
                                <div class="col-xs-3">
                                    <div class="controls">
                                        {!! Form::label('section_1', 'Section 1', array('class' => 'control-label')) !!}
                                        {!! Form::text('title_1', old('title_1', Settings::get('title_1')), array('class' => 'form-control b-t-10', 'placeholder' => 'Title')) !!}
                                        {!! Form::textArea('content_1', old('content_1', Settings::get('content_1')), array('class' => 'form-control b-t-10', 'placeholder' => 'Content')) !!}
                                        {!! Form::text('link_1', old('link_1', Settings::get('link_1')), array('class' => 'form-control b-t-10', 'placeholder' => 'Link')) !!}
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="controls">
                                        {!! Form::label('section_2', 'Section 2', array('class' => 'control-label')) !!}
                                        {!! Form::text('title_2', old('title_2', Settings::get('title_2')), array('class' => 'form-control b-t-10', 'placeholder' => 'Title')) !!}
                                        {!! Form::textArea('content_2', old('content_2', Settings::get('content_2')), array('class' => 'form-control b-t-10', 'placeholder' => 'Content')) !!}
                                        {!! Form::text('link_2', old('link_2', Settings::get('link_2')), array('class' => 'form-control b-t-10', 'placeholder' => 'Link')) !!}
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="controls">
                                        {!! Form::label('section_3', 'Section 3', array('class' => 'control-label')) !!}
                                        {!! Form::text('title_3', old('title_3', Settings::get('title_3')), array('class' => 'form-control b-t-10', 'placeholder' => 'Title')) !!}
                                        {!! Form::textArea('content_3', old('content_3', Settings::get('content_3')), array('class' => 'form-control b-t-10', 'placeholder' => 'Content')) !!}
                                        {!! Form::text('link_3', old('link_3', Settings::get('link_3')), array('class' => 'form-control b-t-10', 'placeholder' => 'Link')) !!}
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="controls">
                                        {!! Form::label('section_4', 'Section 4', array('class' => 'control-label')) !!}
                                        {!! Form::text('title_4', old('title_4', Settings::get('title_4')), array('class' => 'form-control b-t-10', 'placeholder' => 'Title')) !!}
                                        {!! Form::textArea('content_4', old('content_4', Settings::get('content_4')), array('class' => 'form-control b-t-10', 'placeholder' => 'Content')) !!}
                                        {!! Form::text('link_4', old('link_4', Settings::get('link_4')), array('class' => 'form-control b-t-10', 'placeholder' => 'Link')) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="product_configuration">
                        <div class="form-group fileinput fileinput-{{ Settings::get('category_top') ? 'exists' : 'new' }}" data-provides="fileinput" id="category_top_section">
                            <input type="hidden" id="category_top" name="category_top" value="{{ Settings::get('category_top') ?: '' }}">
                            {!! Form::label('category_top_file', __('setting.category_top'), array('class' => 'control-label')) !!}
                            <div class="controls">
                                <div class="fileinput-preview fileinput-exists thumbnail" style="width: 200px">
                                    @if (Settings::get('category_top'))
                                        <img src="{{asset('uploads/site'). '/' . Settings::get('category_top')}}" width="200">
                                    @endif
                                </div>
                                <div>
                                    <span class="btn btn-default btn-file">
                                        <span class="fileinput-new">{{ __('form.select_image') }}</span>
                                        <span class="fileinput-exists">{{ __('form.change_image') }}</span>
                                        <input type="file" name="category_top_file">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form-group fileinput fileinput-{{ Settings::get('category_middle') ? 'exists' : 'new' }}" data-provides="fileinput" id="category_middle_section">
                            <input type="hidden" id="category_middle" name="category_middle" value="{{ Settings::get('category_middle') ?: '' }}">
                            {!! Form::label('category_middle_file', __('setting.category_middle'), array('class' => 'control-label')) !!}
                            <div class="controls">
                                <div class="fileinput-preview fileinput-exists thumbnail" style="width: 200px">
                                    @if (Settings::get('category_middle'))
                                        <img src="{{asset('uploads/site'). '/' . Settings::get('category_middle')}}" width="200">
                                    @endif
                                </div>
                                <div>
                                    <span class="btn btn-default btn-file">
                                        <span class="fileinput-new">{{ __('form.select_image') }}</span>
                                        <span class="fileinput-exists">{{ __('form.change_image') }}</span>
                                        <input type="file" name="category_middle_file">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="social_configuration">
                        <div class="row">
                            <div class="col-md-4 form-group {{ $errors->has('facebook') ? 'has-error' : '' }}">
                                {!! Form::label('facebook', __('setting.facebook'), array('class' => 'control-label')) !!}
                                {!! Form::text('facebook', old('facebook', Settings::get('facebook')), array('class' => 'form-control b-t-10')) !!}
                            </div>
                            <div class="col-md-4 form-group {{ $errors->has('instagram') ? 'has-error' : '' }}">
                                {!! Form::label('instagram', __('setting.instagram'), array('class' => 'control-label')) !!}
                                {!! Form::text('instagram', old('instagram', Settings::get('instagram')), array('class' => 'form-control b-t-10')) !!}
                            </div>
                            <div class="col-md-4 form-group {{ $errors->has('pinterest') ? 'has-error' : '' }}">
                                {!! Form::label('pinterest', __('setting.pinterest'), array('class' => 'control-label')) !!}
                                {!! Form::text('pinterest', old('pinterest', Settings::get('pinterest')), array('class' => 'form-control b-t-10')) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group {{ $errors->has('zalo') ? 'has-error' : '' }}">
                                {!! Form::label('zalo', __('setting.zalo'), array('class' => 'control-label')) !!}
                                {!! Form::text('zalo', old('zalo', Settings::get('zalo')), array('class' => 'form-control b-t-10')) !!}
                            </div>
                            <div class="col-md-4 form-group {{ $errors->has('youtube') ? 'has-error' : '' }}">
                                {!! Form::label('youtube', __('setting.youtube'), array('class' => 'control-label')) !!}
                                {!! Form::text('youtube', old('youtube', Settings::get('youtube')), array('class' => 'form-control b-t-10')) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Form Actions -->
            <div class="form-group">
                <div class="controls">
                    <a href="javascript:void(0)" class="btn btn-primary" id="prev_tab"><i class="fa fa-chevron-circle-left"></i> Back</a>
                    <button type="submit" class="btn btn-success"><i
                                class="fa fa-check-square-o"></i> {{__('table.ok')}}</button>
                    <a href="javascript:void(0)" class="btn btn-primary" id="next_tab">Next <i class="fa fa-chevron-circle-right"></i></a>
                </div>
            </div>
            <!-- ./ form actions -->

            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('scripts')
    <script>
    </script>
@stop
