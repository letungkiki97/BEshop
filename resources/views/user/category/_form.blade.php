<div class="panel panel-primary">
    <div class="panel-body">
        @if (isset($category))
            {!! Form::model($category, array('url' => 'quantri/'.$type . '/' . $category->id, 'method' => 'put', 'files'=> true)) !!}
            <input type="hidden" name="category_id" value={{$category->id}}>
        @else
            {!! Form::open(array('url' => 'quantri/'.$type, 'method' => 'post', 'files'=> true)) !!}
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
    </div>
</div>

@section('scripts')
@endsection
