@section('styles')
    <link rel="stylesheet" href="{{ asset('css/uploadimage.css') }}" type="text/css">
@endsection

<div class="panel panel-primary">
    <div class="panel-body">
        @if (isset($banner))
            {!! Form::model($banner, array('url' => 'quantri/'.$type . '/' . $banner->id, 'method' => 'put', 'files'=> true)) !!}
            <input type="hidden" name="banner_id" value={{$banner->id}}>
        @else
            {!! Form::open(array('url' => 'quantri/'.$type, 'method' => 'post', 'files'=> true)) !!}
        @endif
        <div class="form-group col-xs-4 required {{ $errors->has('name') ? 'has-error' : '' }}">
            {!! Form::label('name', __('banner.name'), array('class' => 'control-label required')) !!}
            <div class="controls">
                {!! Form::text('name', null, array('class' => 'form-control', 'required' => true)) !!}
                <span class="help-block">{{ $errors->first('name', ':message') }}</span>
            </div>
        </div>
        <div class="form-group col-xs-4 {{ $errors->has('size') ? 'has-error' : '' }}">
            {!! Form::label('size', __('banner.size'), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::number('size', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('size', ':message') }}</span>
            </div>
        </div> 
        <div class="clear"></div>

        <div class="col-xs-12" style="margin-bottom: 10px">
            <label class="control-label">{{__('banner.slide')}}
            <span>{!! $errors->first('slide') !!}</span></label>
            <table class="table table-bordered">
                <thead>
                <tr style="font-size: 12px;">
                    <th>{{__('banner.image')}}</th>
                    <th>{{__('banner.text')}}</th>
                    <th>{{__('banner.button')}}</th>
                    <th style="width: 10%">{{__('table.actions')}}</th>
                </tr>
                </thead>
                <tbody id="banner_image">
                @if (isset($html))
                    {!! $html !!}
                @endif
                </tbody>
            </table>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#uploadModal">{{__('form.upload_image')}}</button>
        </div>
        <div class="clear"></div>


        <!-- Form Actions -->
        <div class="form-group col-xs-12">
            <div class="controls">
                <a href="{{ route($type.'.index') }}" class="btn btn-danger"><i class="fa fa-times"></i> {{__('table.back')}}</a>
                <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> {{__('table.ok')}}</button>
            </div>
        </div>
        <!-- ./ form actions -->
        <input type="hidden" name="image_file_id" class="image_file_id" value="">
        {!! Form::close() !!}

        {!! \App\Helpers\Functions::uploadImg() !!}
    </div>
</div>

@section('scripts')
    <script>
        var galleryObj = upFile("#fileuploader", "{{ url('quantri/banner/upload') }}", function (files,data,xhr,pd) {
            $("#banner_image").append(data);
            $('.jscolor').each(function() {
                new jscolor(this);
            });
        }); 
        $("#cancel_model").click(function(e) {
            galleryObj.startUpload();
            if ($('#url-upload').val()) {
                $.ajax({
                    url : '{{ url('quantri/banner/upload-from-url') }}',
                    data : {
                        _token : '{{ csrf_token() }}',
                        url : $('#url-upload').val(),
                        title: $('#url-title').val(),
                        alt: $('#url-alt').val()
                    },
                    type : 'POST',
                    success : function(data) {
                        if (data) {
                            $("#banner_image").append(data);
                            $('.jscolor').each(function() {
                                new jscolor(this);
                            });
                            $('#url-upload').val('');
                            $('#url-title').val('');
                            $('#url-alt').val('');
                        }
                    }
                });
            }
        });    
        $('body').on('click', '.remove', function() {
            $(this).closest('tr').remove();
        });
        $("body").on('click', '.down', function () {
            var parent = $(this).parents("tr");
            parent.insertAfter(parent.next()); 
        });
        $("body").on('click', '.up', function () {
            var parent = $(this).parents("tr");
            parent.insertBefore(parent.prev());
        });

        loadImage();

        disabledButton();

        selectImage('no-multi');

        $( "#uploadModal" ).on('shown', function(){
            loadImage();
        });

        $("#inset_image").click(function(e) {
            var id = 0;
            $('.wrap-library .image-item').each(function(){
                if($(this).hasClass('active')){
                    id      = $(this).data('id');
                }
            });
            var url         = '/ajax/upload-banner';
            var data        = {};
            data.img_id     = id;
            
            $.get(url, data, function(res){
                $("#banner_image").append(res);
                $('.jscolor').each(function() {
                    new jscolor(this);
                });
            });
            $('#uploadModal').modal('hide');
        });

    </script>
@endsection