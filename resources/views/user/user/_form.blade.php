<div class="panel panel-primary">
    <div class="panel-body">
        @if (isset($user))
            {!! Form::model($user, array('url' => $type . '/' . $user->id, 'method' => 'put', 'files'=> true)) !!}
            <input type="hidden" name="user_id" value="{{ $user->id }}">
        @else
            {!! Form::open(array('url' => $type, 'method' => 'post', 'files'=> true)) !!}
        @endif
        <div class="nav-tabs-custom" id="setting_tabs">
            <ul class="nav nav-tabs" style="display:list-item;">
                <li class="active">
                    <a href="#general" data-toggle="tab" title="{{ __('tab.information') }}">
                        <i class="material-icons md-24">info</i>
                    </a>
                </li>
                <li>
                    <a href="#delivery"
                       data-toggle="tab" title="{{ __('tab.delivery') }}"><i
                                class="material-icons md-24">local_shipping</i></a>
                </li>
                <li>
                    <a href="#stock"
                       data-toggle="tab" title="{{ __('tab.stock') }}"><i
                                class="material-icons md-24">account_balance</i></a>
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
                        {!! Form::label('email', __('user.email'), array('class' => 'control-label required', 'required' => true)) !!}
                        <div class="controls">
                            {!! Form::email('email', null, array('class' => 'form-control', 'required' => true)) !!}
                            <span class="help-block">{{ $errors->first('email', ':message') }}</span>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="form-group col-xs-6 required {{ $errors->has('role') ? 'has-error' : '' }}">
                        {!! Form::label('role', __('common.role'), array('class' => 'control-label required')) !!}
                        <div class="controls">
                            {!! Form::select('role', $role, isset($user) && $user->role()->first() ? $user->role()->first()->id : null, ['class' => 'form-control select2']) !!}
                            <span class="help-block">{{ $errors->first('role', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group col-xs-6 required {{ $errors->has('lang') ? 'has-error' : '' }}">
                        {!! Form::label('lang', __('user.lang'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::select('lang', $lang, isset($user) ? $user->lang : null, ['class' => 'form-control select2']) !!}
                            <span class="help-block">{{ $errors->first('lang', ':message') }}</span>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="form-group col-xs-12 {{ $errors->has('description') ? 'has-error' : '' }}">
                        {!! Form::label('description', __('product.description'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::textarea('description', null, array('class' => 'form-control', 'id' => 'editor_description')) !!}
                            <span class="help-block">{{ $errors->first('description', ':message') }}</span>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="form-group fileinput col-xs-6 fileinput-{{isset($user) && $user->user_avatar ? 'exists' : 'new' }}" data-provides="fileinput">
                        <input type="hidden" id="user_avatar" name="user_avatar" value="{{isset($user) && $user->user_avatar ? $user->user_avatar : ''}}">
                        {!! Form::label('user_avatar', __('user.avatar'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            <div class="fileinput-preview fileinput-exists thumbnail" style="width: 200px">
                                @if (isset($user) && $user->user_avatar)
                                    <img src="{{asset('uploads/avatar'). '/' . $user->user_avatar}}" width="200">
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
                    @if (isset($user))
                        <div class="form-group col-xs-6">
                            <label class="control-label">{{ __('user.change_password') }}</label> <input id="show_pass" type="checkbox">
                        </div>
                        <div class="form-group col-xs-6">
                            <label class="control-label">{{ __('user.active') }}</label> <input name="status" class="checkbox" type="checkbox" value="1" {{ $user->status ? 'checked' : '' }}>
                        </div>
                    @endif
                    <div class="form-group col-xs-6 password_field required {{ $errors->has('password') ? 'has-error' : '' }}">
                        {!! Form::label('password', __('user.password'), array('class' => 'control-label required')) !!}
                        <div class="controls">
                            @if(isset($user))
                            {!! Form::password('password', array('class' => 'form-control')) !!}
                            @else
                            {!! Form::password('password', array('class' => 'form-control', 'required' => true)) !!}
                            @endif
                            <span class="help-block">{{ $errors->first('password', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group col-xs-6 password_field required {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                        {!! Form::label('password_confirmation', __('user.password_confirmation'), array('class' => 'control-label required')) !!}
                        <div class="controls">
                            @if(isset($user))
                            {!! Form::password('password_confirmation', array('class' => 'form-control')) !!}
                            @else
                            {!! Form::password('password_confirmation', array('class' => 'form-control', 'required' => true)) !!}
                            @endif
                            <span class="help-block">{{ $errors->first('password_confirmation', ':message') }}</span>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="delivery">
                    <div class="form-group required col-xs-6 {{ $errors->has('warehouse') ? 'has-error' : '' }}">
                        {!! Form::label('warehouse', __('common.warehouse'), array('class' => 'control-label required')) !!}
                        <div class="controls">
                            <select class="form-control" id="warehouse" name="warehouse" required>
                                @if(isset($user) && $user->storage_id)
                                <option value="{{ $user->storage->warehouse_id }}" selected="selected">{{ $user->storage->warehouse->code . ' | ' . $user->storage->warehouse->name }}</option>
                                @endif
                            </select>
                            <span class="help-block">{{ $errors->first('warehouse', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group required col-xs-6 {{ $errors->has('storage_id') ? 'has-error' : '' }}">
                        {!! Form::label('storage_id', __('common.storage'), array('class' => 'control-label required')) !!}
                        <div class="controls">
                            <select class="form-control" name="storage_id" id="storage_id" required>
                                @if(isset($user) && $user->storage_id)
                                <option value="{{ $user->storage_id }}" selected="selected">{{ $user->storage_id . ' | ' . $user->storage->location }}</option>
                                @endif
                            </select>
                            <span class="help-block">{{ $errors->first('storage_id', ':message') }}</span>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="stock">
                    <div class="form-group required col-xs-6 {{ $errors->has('to_warehouse') ? 'has-error' : '' }}">
                        {!! Form::label('to_warehouse', __('common.warehouse'), array('class' => 'control-label required')) !!}
                        <div class="controls">
                            <select class="form-control" id="to_warehouse" name="to_warehouse" required>
                                @if(isset($user) && $user->to_storage)
                                <option value="{{ $user->receipt->warehouse_id }}" selected="selected">{{ $user->receipt->warehouse->code . ' | ' . $user->receipt->warehouse->name }}</option>
                                @endif
                            </select>
                            <span class="help-block">{{ $errors->first('warehouse', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group required col-xs-6 {{ $errors->has('to_storage') ? 'has-error' : '' }}">
                        {!! Form::label('to_storage', __('common.storage'), array('class' => 'control-label required')) !!}
                        <div class="controls">
                            <select class="form-control" name="to_storage" id="to_storage" required>
                                @if(isset($user) && $user->to_storage)
                                <option value="{{ $user->to_storage }}" selected="selected">{{ $user->to_storage . ' | ' . $user->receipt->location }}</option>
                                @endif
                            </select>
                            <span class="help-block">{{ $errors->first('to_storage', ':message') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="form-group col-xs-12">
            <div class="controls">
                <a href="{{ route($type.'.index') }}" class="btn btn-danger"><i
                            class="fa fa-times"></i> {{__('table.back')}}</a>
                <button type="submit" class="btn btn-success"><i
                            class="fa fa-check-square-o"></i> {{__('table.ok')}}</button>
                @if(isset($user))
                @include('layouts._history', ['model' => $user])
                @endif
            </div>
        </div>
        <!-- ./ form actions -->

        {!! Form::close() !!}
    </div>
</div>


@section('scripts')
    <script>
        CKEDITOR.replace( 'editor_description' );

        $('form').on('change.bs.fileinput', '.fileinput', function() {
            $('#user_avatar').val(null);
        }).on('clear.bs.fileinput', '.fileinput', function() {
            $('#user_avatar').val(null);
        });
        
        @if (isset($user))
            if ($(".password_field").hasClass('has-error')) {
                $("#show_pass").iCheck('check');
                $(".password_field").show();
            } else {
                $(".password_field").hide();
            }
            $("#show_pass").on('ifChanged', function() {
                if ($("#show_pass").is(':checked')) {
                    $(".password_field").show();
                } else {
                    $(".password_field").hide();
                }
            });
        @endif
        $('#warehouse').change(function() {
            $('#storage_id').select2(ajaxData('{{ url('ajax/storage') }}'+'/'+$(this).val(), 'Select storage')).val('').trigger('change');
        })

        $('#to_warehouse').change(function() {
            $('#to_storage').select2(ajaxData('{{ url('ajax/storage') }}'+'/'+$(this).val(), 'Select storage')).val('').trigger('change');
        })
        $(document).ready(function(){
            $('#show_pass, .checkbox').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
            });
            $('#warehouse').select2(ajaxData('{{ url('ajax/warehouse') }}', 'Select warehouse'));
            @if(isset($user) && $user->storage_id)
                $('#storage_id').select2(ajaxData('{{ url('ajax/storage') . '/' . $user->storage->warehouse_id }}', 'Select district'));
            @else
                $('#storage_id').select2(ajaxData('{{ url('ajax/storage') . '/0' }}', 'Select storage'));
            @endif

            $('#to_warehouse').select2(ajaxData('{{ url('ajax/warehouse') }}', 'Select warehouse'));
            @if(isset($user) && $user->to_storage)
                $('#to_storage').select2(ajaxData('{{ url('ajax/storage') . '/' . $user->receipt->warehouse_id }}', 'Select district'));
            @else
                $('#to_storage').select2(ajaxData('{{ url('ajax/storage') . '/0' }}', 'Select storage'));
            @endif
        });
    </script>
@stop
