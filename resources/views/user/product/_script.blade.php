<script>
    $('.promotion').on('input paste keyup', function() {
        setTimeout(function(e) {
            if($('#promotion_price_percent').val() && $('#sale_price').val()) {
                var newprice =  ($('#sale_price').val() * (100 - parseInt($('#promotion_price_percent').val()))) / 100;
                $('#promotion_price').val(newprice);
            }
        }, 0);
    });
    $('.professional').on('input paste keyup', function() {
        setTimeout(function(e) {
            if($('#professional_price_percent').val() && $('#sale_price').val()) {
                var newprice =  ($('#sale_price').val() * (100 - parseInt($('#professional_price_percent').val()))) / 100;
                $('#professional_price').val(newprice);
            }
        }, 0)
    });
    $('#promotion_price').on('input paste keyup', function() {
        setTimeout(function(e) {
            $('#promotion_price_percent').val('');
        }, 0)
    });
    $('#professional_price').on('input paste keyup', function() {
        setTimeout(function(e) {
            $('#professional_price_percent').val('');
        }, 0)
    });
    $("#main_sku").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: '{{ url('product/suggest') }}',
                type: 'post',
                data: {
                    _token : '{{ csrf_token() }}',
                },
                success: function(data) {
                    var matcher = new RegExp( $.ui.autocomplete.escapeRegex( request.term ), "i" );
                    response($.grep(data, function(value) {
                      return matcher.test(value.value) || matcher.test(value.name);
                    }));
                }
            });
        },
    });
    @if(isset($product))
    $('#gen_var').click(function() {
        var combine = [];
        $('.attr_value').each(function(i, e) {
            if($(e).val()) {
                combine[i] = $(e).val();
            }
        });
        if (combine.length) {
            $.ajax({
                url : '{{ url('product/generate-variantions') }}',
                type : 'POST',
                data : {
                    _token : '{{ csrf_token() }}',
                    properties : combine,
                },
                success : function(data) {
                    $.each(data, function(i, e) {
                        if(!$('#variant-detail').find('*[data-code="'+e.code+'"]').length) {
                            var html = '<tr>';
                            html += '<input type="hidden" data-id="" value="'+e.id+'" class="property_item" data-code="'+e.code+'" data-name="'+e.name+'" />'
                            html += '<td>'+$('#product_sku').val()+e.code+'</td>';
                            html += '<td class="text-transform">'+$('#product_name').val()+' ('+e.name+')</td>';
                            html += '<td><input type="radio" class="main_variant" name="main_variant"><br></td>';
                            html += '<td class="number_format">'+$('#sale_price').val()+'</td>';
                            html += '<td class="number_format">'+$('#promotion_price').val()+'</td>';
                            var promo_range = '';
                            if($('#promotion_from').val() && $('#promotion_to').val()) {
                                promo_range = $('#promotion_from').val()+' - '+$('#promotion_to').val();
                            }
                            html += '<td>'+promo_range+'</td>';
                            html += '<td class="number_format">'+$('#professional_price').val()+'</td>';
                            html += '<td><a href="javascript:void(0)" class="removeclass"><i class="fa fa-fw fa-times fa-lg text-danger"></i></a></td>';
                            html += '</tr>';
                            $('#variant-detail').append(html);   
                            $('.number_format').number(true);
                            $('.main_variant:last').iCheck({
                                radioClass: 'iradio_minimal-blue'
                            });
                        }
                    });
                }
            });
        } else {
            alert('{{__('message.select_property')}}');
        }
    });

    $('#save_var').click(function() {
        var generated_item = [];
        $('.property_item').each(function(i, e) {
            var check_radio = 0;
            var parent      = $(this).closest('tr');
            if(parent.find('.main_variant').is(':checked')){
                check_radio = 1;
            }
            if($(e).val()) {
                generated_item.push({
                    'pro_id': $(e).data('id'),
                    'id' : $(e).val(), 
                    'code' : $(e).data('code'),
                    'name' : $(e).data('name'),
                    'main_variant': check_radio,
                });
            }
            if($(e).data('id') && !$(e).val()){
                generated_item.push({
                    'pro_id': $(e).data('id'),
                    'main_variant': check_radio,
                });
            }
        });

        if(generated_item.length) {
            if (!confirm('{{__('message.save_variantions')}}')) {
                return false;
            }
            $.ajax({
                url : '{{ url('product/save-variantions') }}',
                type : 'POST',
                data : {
                    _token : '{{ csrf_token() }}',
                    item : generated_item,
                    id : {{ $product->id }},
                },
                success : function(data) {
                    // return false;
                    $(window).unbind("beforeunload");
                    $('.panel-body form')[0].submit();

                }
            });
        } else {
            alert('{{__('message.no_variantions')}}');
        }
    });
    @endif
    $('#category_id').change(function () {
        $.ajax({
            url : '{{ url('product/sku') }}',
            type : 'POST',
            data : {
                _token : '{{ csrf_token() }}',
                category : $(this).val(),
                old_category: {{ isset($product) ? $product->category_id : 0 }}
            },
            success : function (data) {
                $("#product_sku").val(data);
            }
        });
    })
    $('body').on("click", ".removeclass", function (e) {
        $(this).parent().parent().remove();
        mainImage();
        // hoverImage();
        $(window).bind('beforeunload', function(){
            return true;
        });
    });
    $('body').on("click", ".showclass", function (e) {
        var eye = $(this);
        $.ajax({
            url : '{{ url('product/update-status') }}',
            data : {
                _token : '{{ csrf_token() }}',
                id : $(this).data('id'),
            },
            type : 'POST',
            success : function(data) {
                $(eye).find('i').toggleClass('fa-eye-slash').toggleClass('fa-eye');
            }
        });
    });
    function mainImage() {
        if(!$('input[name="product_image"]:checked').length){
            $('input[name="product_image"]:first').iCheck('check') ;
        }
    }
    function hoverImage() {
        if(!$('input[name="hover_image"]:checked').length){
            $('input[name="hover_image"]:first').iCheck('check') ;
        }
    }
    function getAttr(e) {
        var row = $(e).parent().parent().find('.attr_value');
        var selected = [];
        if (row.data('select')) {
            selected = row.data('select').toString().split(',');
        }
        $.ajax({
            url : '{{ url('property_type/properties') }}',
            data : {
                _token : '{{ csrf_token() }}',
                id : $(e).val()
            },
            type : 'POST',
            success : function(data) {
                row.empty();
                $.each(data, function(i, v) {
                    if (selected.indexOf(i) != -1) {
                        row.append('<option value="'+i+'" selected>'+v+'</option>');
                    } else {
                        row.append('<option value="'+i+'">'+v+'</option>');
                    }
                });
            }
        });
    }
    $('#AddMoreFileBox').click(function (e) {
        e.preventDefault();
        var inputBox = '<tr><td><select class="attr_name form-control" onchange="getAttr(this)"></select></td><td><select name="property[]" class="attr_value form-control" multiple></select></td><td><a href="javascript:void(0)" class="delete removeclass"><i class="fa fa-fw fa-times text-danger"></i></a></td></tr>';
        $("#InputsWrapper").append(inputBox);
        $(".attr_name:last").select2(ajaxData('{{ url('ajax/property_type') }}', 'Select property type'));
        $(".attr_value:last").select2({theme:'bootstrap', width:'100%'});
    });

    function doSuccess (files,data,xhr,pd) {
        $("#product_image").append('<tr class="remove_tr"><input type="hidden" name="image_gallery[]" value="'+data.id+'"><td><a href="{{ url('uploads/products') }}/'+data.name+'" target="_blank"><img src="{{ url('uploads/products/thumb_') }}'+data.name+'"></a></td><td><a href="{{ url('uploads/products') }}/'+data.name+'" target="_blank">'+data.name+'</a></td><td>'+data.title+'</td><td>'+data.alt+'</td><td><input type="radio" class="product_image" name="product_image" value="'+data.id+'"><br></td><td><input type="radio" class="hover_image" name="hover_image" value="'+data.id+'"><br></td><td><a href="javascript:void(0)" class="removeclass"><i class="fa fa-fw fa-times fa-lg text-danger"></i></a></td></tr>');
        $('.product_image:last').iCheck({
            radioClass: 'iradio_minimal-blue'
        });
        $('.hover_image:last').iCheck({
            radioClass: 'iradio_minimal-blue'
        });
        mainImage();
        $(window).bind('beforeunload', function(){
            return true;
        });
    }

    var galleryObj = upFile("#fileuploader", "{{ url('product/upload') }}", doSuccess); 

    $("#gallery_close").click(function(e) {
        galleryObj.startUpload();
        if ($('#url-upload').val()) {
            $.ajax({
                url : '{{ url('product/upload-from-url') }}',
                data : {
                    _token : '{{ csrf_token() }}',
                    url : $('#url-upload').val(),
                    title: $('#url-title').val(),
                    alt: $('#url-alt').val()
                },
                type : 'POST',
                success : function(data) {
                    if (data) {
                        doSuccess (null,data,null,null);
                        $('#url-upload').val('');
                        $('#url-title').val('');
                        $('#url-alt').val('');
                    }
                }
            });
        }
    });
    CKEDITOR.replace( 'editor' );
    $(document).ready(function () {
        @if(isset($product) && $group)
            $(".attr_name").select2(ajaxData('{{ url('ajax/property_type') }}', 'Select property type')).trigger('change');
        @endif
        $('.product_image, .hover_image, .main_variant').iCheck({
            radioClass: 'iradio_minimal-blue'
        });
        $('#assigned_to').select2(ajaxData('{{ url('ajax/user') }}', 'Select user'));
        $('.property_feature').each(function() {
            $(this).select2 (ajaxData('{{ url('ajax/property') }}/'+$(this).data('id'), 'Select property')).trigger('change');
        })
    });

    $('#editModal .submit-edit').click(function () {
        var url = '/ajax/add-img-content';
        var data = {};
        var parent = $(this).closest('#editModal');
        data.src = parent.find('input.img_src').val();
        data.img_name = parent.find('input.img_name').val();
        data.path   = 'products';
        if (data.img_name == '') {
            parent.find('span.helper-block').css('display', 'block');
            return false;
        }
        data.title = parent.find('input.img_title').val();
        data.alt = parent.find('input.img_alt').val();

        $.get(url, data, function (response) {
            var res = JSON.parse(response);
            var html = '';
            html += '<img data-id="' + res.id + '" src="' + res.src + '"  alt="' + res.alt + '" title="' + res.title + '"/>';
            // CKEDITOR.instances['content'].insertHtml(html);
            parent.find('span.helper-block').css('display', 'none');
            $('#editModal').modal('hide');
        });
    })
</script>