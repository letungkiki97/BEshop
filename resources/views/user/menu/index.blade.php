@extends('layouts.user')

{{-- Web site Title --}}
@section('title')
    {{ $title }}
@stop

@section('styles')
   <!-- Nestable css -->
    <link href="{{ url('css/jquery.nestable.css') }}" rel="stylesheet" />
    <style>
      /* nestable */
       .dd-item a {
           margin-left: 10px;
       }
       .title-label {
          margin: 10px 0;
          font-size: 18px;
       }
       .customer {
        margin-right: 20px;
        display: inline-block;
       }
    </style>
@endsection

@section('content')
<div class="page-header clearfix">
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
      <a type="button" href="javascript:void(0)" class="btn btn-warning" id="expand-all">{{ __('form.expand_all') }}</a>
      <a type="button" href="javascript:void(0)" class="btn btn-danger" id="collapse-all">{{ __('form.collapse_all') }}</a>
      <a type="button" href="javascript:void(0)" class="btn btn-info" id="add">{{ __('table.new') }}</a>
      <div class="row">
        <div class="col-xs-12 col-md-6">
          <label class="control-label title-label">{{ __('menu.list') }}</label>
          <div class="clear"></div>
           <div class="dd">
            {!! $nestable !!}
          </div>
        </div>
        <div class="col-xs-12 col-md-6">
          <label class="control-label title-label" id="form-title">{{ __('menu.new') }}</label>
          <div class="clear"></div>
          <form class="form-horizontal" role="form" method="post" action="{{ url('menu') }}" id="form" enctype="multipart/form-data">
              <input type="hidden" name="_method" id="menu-method" value="post">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="parent_id" id="menu-parent" value="0">
              <input type="hidden" name="position" id="menu-position" value="0">

              <div class="form-group col-xs-12 form-element">
                <label class="control-label required">{{ __('menu.menu_title') }}</label>
                <input type="text" name="title" id="menu-title" class="form-control" required>
              </div>

              <div class="form-group col-xs-12 form-element">
                <label class="control-label">{{ __('menu.link') }}</label>
                <input type="text" name="link" id="menu-link" class="form-control">
              </div>

              <div class="form-group col-xs-12 form-element">
                <label class="control-label">{{ __('menu.status') }}</label>
                <select class="form-control" name="status" id="menu-status">
                  <option value="1">Active</option>
                  <option value="0">Inactive</option>
                </select>
              </div>

              <div class="form-group col-xs-12 form-element">
                <label class="control-label">{{ __('menu.color') }}</label>
                 <input type="text" name="color" id="menu-color" class="form-control jscolor">
              </div>

              <div class="form-group col-xs-12 form-element">
                <label class="control-label">{{ __('menu.bold') }}</label>
                 <input type="checkbox" name="bold" id="menu-bold" value="1" class="check">
              </div>

              <div class="form-group col-xs-12 fileinput fileinput-new" id="fileinput" data-provides="fileinput">
                <input type="hidden" id="menu-image" name="image">
                <label class="control-label">{{__('menu.image') }}</label>
                <div class="controls">
                    <div class="fileinput-preview fileinput-exists thumbnail" style="width: 200px"></div>
                    <div>
                        <span class="btn btn-default btn-file">
                            <span class="fileinput-new">{{ __('form.select_image') }}</span>
                            <span class="fileinput-exists">{{ __('form.change_image') }}</span>
                            <input type="file" name="image_file">
                        </span>
                        <a href="#" class="btn btn-default fileinput-exists" id="remove_image" data-dismiss="fileinput">{{ __('form.remove_image') }}</a>
                    </div>
                </div>
            </div>

              <div class="form-group col-xs-12 form-element">
               <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> {{__('table.ok')}}</button>
             </div>
           </form>
        </div>
      </div>
    </div>
</div>
@endsection

@section('scripts')
<!--script for this page only-->
<script src="{{ url('js/jquery.nestable.js') }}"></script>
<script>
  $('.dd').nestable().on('change', function() {
    $.ajax({
     url : '{{ url('menu/serialize') }}',
     type: 'POST',
     data: {
        data: $('.dd').nestable('serialize'),
        _token: '{{ csrf_token() }}'
     },
     success: function(data) {
        window.location.reload();
     }
    });
  });

  $('form').on('change.bs.fileinput', '.fileinput', function() {
      $('#menu-image').val(null);
  }).on('clear.bs.fileinput', '.fileinput', function() {
      $('#menu-image').val(null);
  });

  $('#add').click(function() {
    $('#form-title').html('{{ __('menu.new') }}');
    $('#menu-title').val('');
    $('#menu-link').val('');
    document.getElementById('menu-color').jscolor.fromString('FFFFFF');
    $('#menu-bold').iCheck('uncheck');
    $('#menu-method').val('POST');
    $('#form').attr('action', '{{ url('menu') }}');
    $('#remove_image').trigger('click');
  });


  $('body').on('click', '.edit', function() {
    var url = '{{ url('menu') }}/' + $(this).data('id');
    $.ajax({
     url : url,
     type: 'GET',
     success: function(data) {
        $('#form-title').html('{{ __('menu.edit') }} "'+data.title+'"');
        $('#menu-title').val(data.title);
        $('#menu-link').val(data.link);
        $('#menu-status').val(data.status);
        if (data.image) {
          $('.fileinput-preview').html('<img src="{{ url('uploads/menu') }}/'+data.image+'">');
          $('#fileinput').removeClass('fileinput-new').addClass('fileinput-exists');
        } else {
          $('#remove_image').trigger('click');
        }
        $('#menu-image').val(data.image);
        $('#menu-parent').val(data.parent_id);
        $('#menu-position').val(data.position);
        document.getElementById('menu-color').jscolor.fromString('#'+data.color);
        if (data.bold == 1) {
          $('#menu-bold').iCheck('check');
        } else {
          $('#menu-bold').iCheck('uncheck');
        }
        $('#menu-method').val('PUT');
        $('#form').attr('action', url);
      }
    });
  });

  $('#expand-all').click(function() {
    $('.dd').nestable('expandAll');
  });

  $('#collapse-all').click(function() {
    $('.dd').nestable('collapseAll');
  });

  $(document).ready(function(){
    $('.check').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
    });
  });
</script>
@endsection