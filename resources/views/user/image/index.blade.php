@extends('layouts.user')

{{-- Web site Title --}}
@section('title')
    {{ $title }}
@stop

@section('styles')
<link rel="stylesheet" href="{{ url('css/jquery.fancybox.min.css') }}" />
    <style>
        .five {
            width: 20%;
            float: left;
            padding: 10px;
        }
        .img-box {
            width: 100%;
            position: relative;
            display: inline-block;
        }
        .img-box img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }
        .img-toolbox {
            position: absolute;
            bottom: 0;
            width: 100%;
            display: none;
            color: #fff;
            transition: all .2s ease;
            text-align: center;
            padding: 5px;
        }
        .img-caption {
            position: absolute;
            top: 50%;
            width: 100%;
            display: none;
            color: #fff;
            transition: all .2s ease;
            text-align: center;
            padding: 5px;
            transform: translateY(-50%);
        }
        .img-box:hover .img-toolbox {
            display: block;
            background-color: rebeccapurple;
        }
        .img-box:hover .img-caption {
            display: block;
        }
        .img-box:hover img {
            filter:brightness(80%);
        }
        .img-box a {
            font-size: 16px;
        }
    </style>
@endsection

{{-- Content --}}
@section('content')
    <div class="page-header clearfix">
        <div class="pull-right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newModal"> <i class="fa fa-plus-circle"></i> {{ __('table.new') }}</button>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <i class="material-icons">dashboard</i>
                {{ $title }}
            </h4>
            <span class="pull-right">
                <i class="fa fa-fw fa-chevron-up clickable"></i>
                <i class="fa fa-fw fa-times removepanel clickable"></i>
            </span>
        </div>
        <div class="panel-body">
            @include('layouts._toolbox')
                @if(count($image))
                    @foreach($image as $item)
                    <div class="five">
                        <div class="img-box">
                            <img src="{{ $item->full_path }}">
                            <div class="img-caption">{{ $item->name }}</div>
                            <div class="img-toolbox">
                                <a href="{{ $item->full_path }}" data-fancybox="gallery" data-caption="{{ $item->name }}"><i class="fa fa-fw fa-eye text-primary"></i></a>
                                <a class="edit-item" href="javascript:void(0)" data-url="{{ url('quantri/image/' . $item->id ) }}" title="{{ __('table.edit') }}"><i class="fa fa-fw fa-pencil text-warning"></i> </a>
                                <a href="javascript:void(0)" class="delete_item" data-name="{{ $item->name }}" data-id="{{$item->id}}" title="{{ __('table.delete') }}"><i class="fa fa-fw fa-times text-danger"></i></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            <div class="clear"></div>
            <div class="pull-left">{{ $page_info }}</div>
            <div class="pull-right">{{ $image->appends(request()->all())->links() }}</div>
        </div>
    </div>
    
    <div id="newModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{ __('image.title') }}</h4>
                </div>
                <div class="modal-body">
                    <div id="fileuploader"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="gallery_close">{{ __('form.start_upload') }}</button>
                </div>
            </div>
        </div>
    </div>

    <div id="editModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editForm" method="POST">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">{{ __('image.title') }}</h4>
                    </div>
                    <div class="modal-body">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group required">
                            {!! Form::label('name', __('image.name'), array('class' => 'control-label required')) !!}
                            <div class="controls">
                                {!! Form::text('name', null, array('class' => 'form-control', 'id' => 'name', 'required' => true)) !!}
                                <span class="help-block">{{ $errors->first('name', ':message') }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('title', __('image.img_title'), array('class' => 'control-label')) !!}
                            <div class="controls">
                                {!! Form::text('title', null, array('class' => 'form-control', 'id' => 'title')) !!}
                                <span class="help-block">{{ $errors->first('title', ':message') }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('alt', __('image.img_alt'), array('class' => 'control-label')) !!}
                            <div class="controls">
                                {!! Form::text('alt', null, array('class' => 'form-control', 'id' => 'alt')) !!}
                                <span class="help-block">{{ $errors->first('alt', ':message') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{__('table.ok')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

{{-- Scripts --}}
@section('scripts')

<script src="{{ url('js/jquery.fancybox.min.js') }}"></script>
<script>
    var galleryObj = upFile("#fileuploader", "{{ url('quantri/image') }}", function (files,data,xhr,pd) {
        location.reload();
    }, false);
    $("#gallery_close").click(function(e) {
        galleryObj.startUpload();
    });

    $('.edit-item').click(function(e) {
        var url = $(this).data('url');
        $.ajax({
            url: url + '/edit',
            type: 'GET',
            success: function(data) {
                $('#name').val(data.file_name);
                $('#title').val(data.title);
                $('#alt').val(data.alt);
                $('#editForm').attr('action', url);
                $('#editModal').modal('show');
            }
        });
    })
</script>
@stop
