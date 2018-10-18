@section('styles')
    <style>
    #sortable div:hover, #sortable div.ui-sortable-helper {
        cursor: move;
    }
    </style>
@endsection
<div class="panel panel-primary">
    <div class="panel-body">
        @if (isset($category))
            {!! Form::model($category, array('url' => $type . '/' . $category->id, 'method' => 'put', 'files'=> true)) !!}
            <input type="hidden" name="category_id" value={{$category->id}}>
        @else
            {!! Form::open(array('url' => $type, 'method' => 'post', 'files'=> true)) !!}
        @endif
        <div class="form-group col-xs-6 required {{ $errors->has('parent_id') ? 'has-error' : '' }}">
            {!! Form::label('parent_id', __('category.parent'), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::select('parent_id', $categories, isset($category) ? $category->parent_id : null, ['class' => 'form-control select2']) !!}
                <span class="help-block">{{ $errors->first('parent_id', ':message') }}</span>
            </div>
        </div>
        <div class="form-group col-xs-6 required {{ $errors->has('name') ? 'has-error' : '' }}">
            {!! Form::label('name', __('category.name'), array('class' => 'control-label required')) !!}
            <div class="controls">
                {!! Form::text('name', null, array('class' => 'form-control', 'required' => true)) !!}
                <span class="help-block">{{ $errors->first('name', ':message') }}</span>
            </div>
        </div>
        <div class="clear"></div>
        <div class="form-group col-xs-6 required {{ $errors->has('code') ? 'has-error' : '' }}">
            {!! Form::label('code', __('category.code'), array('class' => 'control-label required')) !!}
            <div class="controls">
                {!! Form::text('code', null, array('class' => 'form-control', 'required' => true)) !!}
                <span class="help-block">{{ $errors->first('code', ':message') }}</span>
            </div>
        </div>
        <div class="form-group col-xs-6 {{ $errors->has('slug') ? 'has-error' : '' }}">
            {!! Form::label('slug', __('category.slug'), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('slug', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('slug', ':message') }}</span>
            </div>
        </div>
        <div class="clear"></div>
        <div class="form-group col-xs-6 {{ $errors->has('meta_title') ? 'has-error' : '' }}">
            {!! Form::label('meta_title', __('category.meta_title'), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('meta_title', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('meta_title', ':message') }}</span>
            </div>
        </div>
        <div class="form-group col-xs-6 {{ $errors->has('meta_description') ? 'has-error' : '' }}">
            {!! Form::label('meta_description', __('category.meta_description'), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('meta_description', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('meta_description', ':message') }}</span>
            </div>
        </div>
        <div class="clear"></div>
        <div class="form-group col-xs-6 {{ $errors->has('counter') ? 'has-error' : '' }}">
            {!! Form::label('counter', __('category.counter'), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('counter', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('counter', ':message') }}</span>
            </div>
        </div>
        <div class="clear"></div>

        <!-- upload IMG -->
        <div class="form-group fileinput col-xs-6 fileinput-{{isset($category) && $category->image ? 'exists' : 'new' }}" data-provides="fileinput">
            <input type="hidden" id="image" name="image" value="{{isset($category) && $category->image ? $category->image : ''}}">
            {!! Form::label('image', __('news.image'), array('class' => 'control-label')) !!}
            <div class="controls">
                <div class="fileinput-preview fileinput-exists thumbnail" style="width: 200px">
                    @if (isset($category) && $category->image)
                        <img src="{{asset('uploads/product_category'). '/' . $category->image}}" width="200">
                    @endif
                </div>

                <div>
                    <span class="btn btn-default btn-file">
                        <span class="fileinput-new">{{ __('form.select_image') }}</span>
                        <span class="fileinput-exists">{{ __('form.change_image') }}</span>
                        <input type="file" name="image_file" {{ isset($category) ? '' : 'required' }}>
                    </span>
                </div>
            </div>
        </div>
        <div class="clear"></div>
        <!-- End upload IMG -->

        {!! Form::label('feature', __('common.feature'), array('class' => 'control-label col-xs-12')) !!}
        <div id="sortable" class='form-group col-xs-12'>
            @if(isset($category) && $category->category_feature->count())
                @foreach ($category->category_feature as $k => $v)
                <div class="ui-state-default" style="overflow: hidden; padding: 10px 0; margin: 10px 0">
                    <div class="controls col-xs-4">
                        <select name="feature[]" class="form-control feature">
                            <option value="{{$v->feature->id}}">{{$v->feature->name}}</option>
                        </select>
                    </div>
                    <div class="col-xs-8">
                        <a href="javascript:void(0)" class="remove-item">
                            <i class="fa fa-times fa-fw pull-right text-danger"></i>
                        </a>
                    </div>
                </div>
                <div class="clear"></div>
                @endforeach
            @endif
        </div>
        <div class="form-group col-xs-12">
        <button type="button" id="add-feature" class="btn btn-primary">{{__('form.add_feature')}}</button>
        </div>

        <!-- Form Actions -->
        <div class="form-group col-xs-12">
            <div class="controls">
                <a href="{{ route($type.'.index') }}" class="btn btn-danger"><i class="fa fa-times"></i> {{__('table.back')}}</a>
                <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> {{__('table.ok')}}</button>
                @if(isset($category))
                @include('layouts._history', ['model' => $category])
                @endif
            </div>
        </div>
        <!-- ./ form actions -->

        {!! Form::close() !!}
    </div>
</div>

@section('scripts')
    <script>
        $( "#sortable" ).sortable();
        $( "#sortable" ).disableSelection();
        $('#add-feature').click(function() {
            $.ajax({
                url: '{{url('feature/add-feature')}}',
                type: 'GET',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(data) {
                    $('#sortable').append(data);
                    $('.feature').select2(ajaxData('{{ url('ajax/feature') }}', 'Select product feature'));
                }
            });
        });
        $('body').on('click', '.remove-item', function() {
            $(this).closest('.ui-state-default').remove();
        })
        $(document).ready(function() { 
            $('.feature').select2(ajaxData('{{ url('ajax/feature') }}', 'Select product feature'));
        })
    </script>
@endsection
