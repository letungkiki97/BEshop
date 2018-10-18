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
          <label class="control-label title-label">{{ __('footer.list') }}</label>
          <div class="clear"></div>
           <div class="dd">
            {!! $nestable !!}
          </div>
        </div>
        <div class="col-xs-12 col-md-6">
          <label class="control-label title-label" id="form-title">{{ __('footer.new') }}</label>
          <div class="clear"></div>
          <form class="form-horizontal" role="form" method="post" action="{{ url('footer') }}" id="form" enctype="multipart/form-data">
              <input type="hidden" name="_method" id="footer-method" value="post">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="parent_id" id="footer-parent" value="0">
              <input type="hidden" name="position" id="footer-position" value="0">

              <div class="form-group col-xs-12 form-element">
                <label class="control-label required">{{ __('footer.footer_title') }}</label>
                <input type="text" name="title" id="footer-title" class="form-control" required>
              </div>

              <div class="form-group col-xs-12 form-element">
                <label class="control-label">{{ __('footer.link') }}</label>
                <input type="text" name="link" id="footer-link" class="form-control">
              </div>

              <div class="form-group col-xs-12 form-element">
                <label class="control-label">{{ __('footer.status') }}</label>
                <select class="form-control" name="status" id="footer-status">
                  <option value="1">Active</option>
                  <option value="0">Inactive</option>
                </select>
              </div>

              <div class="form-group col-xs-12 form-element">
                <label class="control-label">{{ __('footer.color') }}</label>
                 <input type="text" name="color" id="footer-color" class="form-control jscolor">
              </div>

              <div class="form-group col-xs-12 form-element">
                <label class="control-label">{{ __('footer.bold') }}</label>
                 <input type="checkbox" name="bold" id="footer-bold" value="1" class="check">
              </div>
              
              <div class="form-group col-xs-12 fileinput fileinput-new" id="fileinput" data-provides="fileinput">
                <input type="hidden" id="footer-image" name="image">
                <label class="control-label">{{__('footer.image') }}</label>
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
     url : '{{ url('footer/serialize') }}',
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
      $('#footer-image').val(null);
  }).on('clear.bs.fileinput', '.fileinput', function() {
      $('#footer-image').val(null);
  });

  $('#add').click(function() {
    $('#form-title').html('{{ __('footer.new') }}');
    $('#footer-title').val('');
    $('#footer-link').val('');
    document.getElementById('footer-color').jscolor.fromString('FFFFFF');
    $('#footer-bold').iCheck('uncheck');
    $('#footer-method').val('POST');
    $('#form').attr('action', '{{ url('footer') }}');
    $('#remove_image').trigger('click');
  });

   
  $('body').on('click', '.edit', function() {
    var url = '{{ url('footer') }}/' + $(this).data('id');
    $.ajax({
     url : url,
     type: 'GET',
     success: function(data) {
        $('#form-title').html('{{ __('footer.edit') }} "'+data.title+'"');
        $('#footer-title').val(data.title);
        $('#footer-link').val(data.link);
        $('#footer-status').val(data.status);
        if (data.image) {
          $('.fileinput-preview').html('<img src="{{ url('uploads/footer') }}/'+data.image+'">');
          $('#fileinput').removeClass('fileinput-new').addClass('fileinput-exists');
        } else {
          $('#remove_image').trigger('click');
        }
        $('#footer-image').val(data.image);
        $('#footer-parent').val(data.parent_id);
        $('#footer-position').val(data.position);
        document.getElementById('footer-color').jscolor.fromString('#'+data.color);
        if (data.bold == 1) {
          $('#footer-bold').iCheck('check');
        } else {
          $('#footer-bold').iCheck('uncheck');
        }
        $('#footer-method').val('PUT');
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