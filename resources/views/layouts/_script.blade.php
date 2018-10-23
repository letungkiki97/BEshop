<script>
    $(document).ready(function () {
        $('.date').datetimepicker({format: '{{ isset($jquery_date)?$jquery_date:"MMMM D,YYYY" }}',
            useCurrent:false,
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
        }})
        $('form .date').on('dp.change', function() {
            if ($(this).attr('name')) {
                var name = $(this).attr('name');
                $('form').data('bootstrapValidator').removeField(name).addField(name).revalidateField(name);
            }
        });
        $('.datetime').datetimepicker({format: '{{ isset($jquery_date_time)?$jquery_date_time:"MMMM D,YYYY H:mm" }}',
            useCurrent:false,
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
        }});
        $('.number').number( true );
        $('.number2').number( true , 2 );
        @if(count($errors))
            $('.nav a[href="#' + $('.has-error:first').closest('.tab-pane').attr('id') + '"]').tab('show');
        @endif
        $('#no-data').attr('colspan', $('#data-table th').length).text('{{ __('table.no_data') }}');
        $('.check').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
        });
    }).ajaxStart(function () {
        $('.panel-body:not(.loading)').loading({
            overlay: $("#loading")
        });
        $('.panel-body.message').loading({
            theme: 'dark',
            message: 'Working...'
        });
    }).ajaxStop(function () {
        $('.panel-body').loading('stop');
    });

    $('input').dblclick(function () {
       $(this).select();
    });

    @if(isset($type))
    // mass delete action
    $('#mass_delete').click(function(e){
        var rows_selected = $('td .check:checked');
        if (rows_selected.length) {
            if (!confirm('{{ __('message.delete_item') }}')) {
                return false;
            }
            var complete = 0;
            var done = 0;
            $.each(rows_selected, function(){
                $.ajax({
                    url : '{{ url('quantri/'.$type) }}/' + $(this).data('id'),
                    type : 'post',
                    data : {
                        '_method' : 'delete',
                        '_token' : '{{ csrf_token() }}',
                    },
                    success: function(data) {
                        complete++;
                        if (data) {
                            done++;
                        }
                        if (complete == rows_selected.length) {
                            if (done != rows_selected.length) {
                                alert('{{ __('message.cant_delete_items') }}')
                            }
                            location.reload();
                        }
                    }
                })
            });
        } else {
            alert('{{ __('message.no_item') }}');
        }
    });

    // delete an item
        @if(isset($title))
        $('body').on('click', '.delete_item', function (){
            var str = $(this).data('id');
            if ($(this).data('name')) {
                str = $(this).data('name');
            }
            if (!confirm('Delete {{ strtolower($title) }} "'+str+'" ?')) {
                return false;
            }
            $.ajax({
                url : '{{ url('quantri/'.$type) }}/'+$(this).data('id'),
                type : 'post',
                data : {
                    '_method' : 'delete',
                    '_token' : '{{ csrf_token() }}',
                },
                success : function(data) {
                    if (data) {
                        location.reload();
                    } else {
                        alert('{{ __('message.cant_delete_item') }}');
                    }
                }
            })
        });
        @endif
    // upload file
    function upFile(selector, url, callSuccess,  multiple=true, fileName='gallery') {
        return $(selector).uploadFile({
            url:url,
            fileName:fileName,
            formData: {'_token': '{{ csrf_token() }}', 'page': '{{$type}}'},
            extraHTML:function() {
                return `@include('layouts._file', ['page' => $type])`;            
            },
            autoSubmit:false,
            showStatusAfterSuccess:false,
            uploadStr: 'Select images',
            statusBarWidth: "100%",
            dragdropWidth: "100%",
            showPreview:true,
            previewWidth: "20%",
            maxFileSize: "10000000",
            maxFileCount: 10,
            acceptFiles: "image/*",
            allowedTypes: "jpg,jpeg,png,gif",
            showFileCounter: true,
            multiple: multiple,
            cancelStr: "Remove",
            onSuccess: function(files,data,xhr,pd) {
                callSuccess(files,data,xhr,pd);
            }
        });
    }
    @endif

    // show hide the delete
    $('body').on('ifChecked', 'th .check', function() {
        $('td .check').iCheck('check');
    }).on('ifUnchecked', 'th .check', function() {
        $('td .check').iCheck('uncheck');
    });

    // show hide the delete
    $('body').on('ifChanged', '.check', function() {
        if($('td .check:checked').length) {
            $('#mass_delete').show();
        } else {
            $('#mass_delete').hide();
        }
    });

    // select box data
    function ajaxData(url, placeholder = '{{ __('message.search') }}', multiple = false) {
        return {
            placeholder: placeholder,
            theme: 'bootstrap',
            width: '100%',
            ajax: {
                url: url,
                delay: 250,
                data: function (params) {
                    var query = {
                        q: params.term,
                        page: '{{isset($type) ? $type : null}}',
                        multiple: multiple,
                    }
                    return query;
                },
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                            return {
                                text: item.text,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            },
            language: {
                noResults: function(){
                   return '{{ __('message.no_match') }}';
                }
            },
            escapeMarkup: function (markup) {
                return markup;
            },
            templateSelection: function(template) {
                var text = template.text;
                if (typeof $(template.element).data('img') !== 'undefined' && $(template.element).data('img') != '') {
                    text = '<img src="'+$(template.element).data('img')+'" class="thumb-data" /> <span>'+text+'</span>';
                }
                return $('<div style="display: inline-flex; align-items: center;">'+text+'</div>');
            },
        }
    }

    // form action
    @if(isset($type) && Request::is( $type.'/*/edit') && !$user_data->hasAccess([$type.'.edit']) && !$user_data->inRole('admin'))
        $('form :input').prop('disabled', true);
    @endif

    @if(isset($type) && (Request::is( $type.'/*/edit') || Request::is( $type.'/create')))
        $(":input").one("change", function() { 
            $(window).bind('beforeunload', function(){
                return true;
            });
        }); 
        $(document).ready(function() {
            $("form").on("submit", function(e) {
                $(window).unbind("beforeunload");
                return true;
            });
        });
    @endif

    // validate form
    $('form').bootstrapValidator({
        excluded: [':disabled'],
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        }
    }).on('err.field.fv', function(e, data) {
        var $invalidFields = data.fv.getInvalidFields().eq(0);
        var $tabPane     = $invalidFields.parents('.tab-pane'),
            invalidTabId = $tabPane.attr('id');
        if (!$tabPane.hasClass('active')) {
            $invalidFields.focus();
        }
    }).on('keyup keypress', function (e) {
        var code = e.keyCode || e.which;
        if (code == 13 && !$(e.target).is("textarea") && $(e.target).closest('form').attr('id') != 'search-form' && $(e.target).closest('form').attr('id') != 'filter-form') {
            e.preventDefault();
            return false;
        }
    });

    $('select[name="data_length"]').change(function() {
        window.location.href = '{!! request()->except('length') ? request()->url() . '?' . http_build_query(request()->except('length')) . '&' : request()->url() . '?' !!}length=' + $(this).val();
    });

    // tab controller
    $('.nav-tabs li a').click(function() {
        if ($(this).parent().is(':last-child')) {
            $('#next_tab').hide();
        } else {
            $('#next_tab').show();
        }
        if ($(this).parent().is(':first-child')) {
            $('#prev_tab').hide();
        } else {
            $('#prev_tab').show();
        }
    });
    $('#next_tab').click(function(){
        $('.nav-tabs > .active').next('li').find('a').trigger('click');
    });
    $('#prev_tab').click(function(){
        $('.nav-tabs > .active').prev('li').find('a').trigger('click');
    });
</script>