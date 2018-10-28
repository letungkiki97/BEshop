<script>
    function update_price(auto = false) {
        var item_price = $('#item_price').val() ? parseFloat($('#item_price').val()) : 0;
        var quantity = parseInt($('#quantity').val());
        var exchange_rate = parseInt($('#exchange_rate').val());
        var vat = $('#vat').val() ? parseInt($('#vat').val()) : 0;
        var discount = $('#discount').val() ? parseInt($('#discount').val()) : 0;
        var discount_amount = $('#discount_amount').val() ? parseInt($('#discount_amount').val()) : 0;
        if($('input[name="purchase_from"]:checked').val() == 1) {
            var internal_product_price = $('#internal_product_price').val() ? parseInt($('#internal_product_price').val()) : 0;
            var total = internal_product_price * quantity;
            var transportation_fee = $('#transportation_fee').val() ? parseInt($('#transportation_fee').val()) : 0;
        } else {
            var ordering_fee =  $('#ordering_fee').val() ? parseFloat($('#ordering_fee').val()) : 0;
            var internal_transportation_fee = $('#internal_transportation_fee').val() ? parseInt($('#internal_transportation_fee').val()) : 0;
            var international_transport_rate_volume = $('#international_transport_rate_volume').val() ? parseInt($('#international_transport_rate_volume').val()) : 0;
            var international_transport_rate_kg = $('#international_transport_rate_kg').val() ? parseInt($('#international_transport_rate_kg').val()) : 0;
            var box_weight = $('#box_weight').val() ? parseFloat($('#box_weight').val()) : 0;
            var box1_length = $('#box1_length').val() ? parseFloat($('#box1_length').val()) : 0;
            var box1_depth = $('#box1_depth').val() ? parseFloat($('#box1_depth').val()) : 0;
            var box1_height = $('#box1_height').val() ? parseFloat($('#box1_height').val()) : 0;
            var box1_quantity = $('#box1_quantity').val() ? parseFloat($('#box1_quantity').val()) : 0;
            var box2_length = $('#box2_length').val() ? parseFloat($('#box2_length').val()) : 0;
            var box2_depth = $('#box2_depth').val() ? parseFloat($('#box2_depth').val()) : 0;
            var box2_height = $('#box2_height').val() ? parseFloat($('#box2_height').val()) : 0;
            var box2_quantity = $('#box2_quantity').val() ? parseFloat($('#box2_quantity').val()) : 0;
            var price_per_order_unit = Math.round(item_price * quantity);
            if (auto) {
                ordering_fee = price_per_order_unit * {{ $ordering_fee }};
                $('#ordering_fee').val(ordering_fee);
            }
            var internal_product_price = ((price_per_order_unit + ordering_fee + internal_transportation_fee) / quantity) * exchange_rate;
            var total = (price_per_order_unit + ordering_fee + internal_transportation_fee) * exchange_rate;
            var total_transport_rate = international_transport_rate_kg * box_weight;
            var box1_volume = box1_length * box1_depth * box1_height * box1_quantity;
            var box2_volume = box2_length * box2_depth * box2_height * box2_quantity;
            var total_volume = box1_volume + box2_volume;
            var volume = total_volume * international_transport_rate_volume;
            var transportation_fee = volume > total_transport_rate ? volume : total_transport_rate;
            $('#price_per_order_unit').val(price_per_order_unit);
            $('#internal_product_price').val(internal_product_price);
            $('#total_transport_rate').val(total_transport_rate);
            $('#box1_volume').val(box1_volume);
            $('#box2_volume').val(box2_volume);
            $('#total_volume').val(total_volume);
            $('#transportation_fee').val(transportation_fee);
        }
        var grand_total = (total + transportation_fee) * (1 + (vat/100)) * (1 - (discount/100)) - discount_amount;
        var nominate_price = grand_total / quantity;
        $('#total').val(total);
        $('#grand_total').val(grand_total);
        $('#nominate_price').val(nominate_price);
    }
    function update_code(code) {
        $('.currency_code').each(function() {
            $(this).html('('+code+')');
        })
    }
    $('#supplier_id').change(function() {
        if ($(this).val()) {
            $.ajax({
                url : '{{ url('supplier/info/') }}',
                type : 'POST',
                data : {
                    'id' : $(this).val(),
                    '_token' : '{{ csrf_token() }}'
                },
                success : function (data) {
                    $('#currency').val(data.currency_id).trigger('change');
                    if(data.local.country.name == "Vietnam") {
                        $('#vietnam').iCheck('check');
                    } else {
                        $('#oversea').iCheck('check');
                    }
                }
            });
        }
    });
    $('#currency').change(function () {
        if ($(this).val()) {
            $.ajax({
                url : '{{ url('purchase/currency') }}',
                type : 'POST',
                data : {
                    'id' : $(this).val(),
                    '_token' : '{{ csrf_token() }}'
                },
                success : function (data) {
                    $("#exchange_rate").val(data.exchange_rate_value).trigger('input');
                    update_code(data.code);
                    var item_price = $('#item_price');
                    if (data.code == 'VND') {
                        item_price.removeClass('number2').addClass('number');
                        $('#item_price').remove();
                        item_price.insertBefore('#item_price_span');
                        $('#item_price').number( true, 0 );
                    } else {
                        item_price.removeClass('number').addClass('number2');
                        $('#item_price').remove();
                        item_price.insertBefore('#item_price_span');
                        $('#item_price').number( true, 2 );
                    }
                }
            });
        }
        });
    $('body').on('input paste keyup', '.price', function () {
        var id = $(this).attr('id');
        setTimeout(function(e) {
            var auto = false;
            if (id == 'item_price' || id == 'quantity') {
                auto = true;
            } 
            update_price(auto); 
        }, 0)
    });
    $('.purchase_from').on('ifChecked', function() {
        $('.price:not(.no-change)').val(0);
        if($(this).val() == 1) {
            $('#price .clear, #price .oversea').hide();
            $('#internal_product_price, #transportation_fee').prop('readonly', false);
        } else {
            $('#price .clear, #price .oversea').show();
            $('#internal_product_price, #transportation_fee').prop('readonly', true);
        }
        update_price(true); 
    });
    $('#warehouse').change(function() {
        $('#storage').select2(ajaxData('{{ url('ajax/storage') }}'+'/'+$(this).val(), 'Select storage')).val('').trigger('change');
    });
    @if(isset($purchase))
    $('#create_stock').click(function() {
        if(!confirm('{{ __('message.create_stock') }}')) {
            return false;
        }
        if (!$('#stock_quantity').val() || !$('#storage').val() || !$('#stock_date').val()) {
            alert('{{ __('message.required_field') }}');
            return false;
        }
        if ({{$max}} <= 0) {
            alert('{{ __('message.purchase_quantity') }}');
        } else {
            $.ajax({
                url: '{{ url('purchase/add-stock') }}',
                type: 'POST',
                data: {
                    'id' : {{$purchase->id}},
                    'movement_type' : 'Purchase​ ​order',
                    'product_id' : $('#product_id').val(),
                    'storage_id' : $('#storage').val(),
                    'date' : $('#stock_date').val(),
                    'reference' : $('#stock_reference').val(),
                    'quantity' : $('#stock_quantity').val(),
                    '_token' : '{{ csrf_token() }}'
                },
                success: function(data) {
                    window.location.reload();
                }
            });
        }
    });
    @endif
    $(document).ready(function() {
        CKEDITOR.replace('note');
        @if(!isset($purchase))
            $('#oversea').iCheck('check');
            @if(session('purchase_product') && session('purchase_quantity'))
               $('#quantity').val({{ session('purchase_quantity') }});
               $('#product_id').append('<option value="{{ session('purchase_product')['id'] }}" selected="selected" data-img="{{ session('purchase_product')['img'] }}">{{ session('purchase_product')['name'] }}</option>')
            @endif
            @if(request()->price)
                $.ajax({
                    url: '{{ url('supplier_price/'. request()->price) }}',
                    async: false,
                    success: function(data) {
                        $('#supplier_id').append('<option value="'+data.supplier_id+'" selected="selected">'+ data.supplier_id + ' | ' + data.supplier.name+'</option>');
                        $('#product_id').append('<option value="'+data.product_id+'" selected="selected" data-img="'+data.product_image+'">'+ data.product.product_sku + ' | ' + data.product.product_name+'</option>');
                        $('#url').val(data.link_to_product);
                        $('#currency').val(data.item_price_currency).trigger('change');
                        $('#item_price').val(data.item_price);
                        $('#quantity').val(data.order_unit_quantity);
                        $('#ordering_fee').val(data.ordering_fee);
                        $('#internal_transportation_fee').val(data.internal_transportation_fee);
                        $('#international_transport_rate_volume').val(data.international_transport_rate_volume);
                        $('#international_transport_rate_kg').val(data.international_transport_rate_kg);
                        $('#box_weight').val(data.box_weight);
                        $('#box1_height').val(data.box1_height);
                        $('#box1_depth').val(data.box1_depth);
                        $('#box1_length').val(data.box1_length);
                        $('#box1_quantity').val(1);
                        $('#box2_height').val(data.box2_height);
                        $('#box2_depth').val(data.box2_depth);
                        $('#box2_length').val(data.box2_length);
                        $('#box2_quantity').val(1);
                    }
                });
            @endif
            update_price(true);
        @else
            update_code('{{$code}}');
            @if ($purchase->purchase_from)
                $('#price .clear, #price .oversea').hide();
                $('#internal_product_price, #transportation_fee').prop('readonly', false);
            @else
                $('#price .clear, #price .oversea').show();
                $('#internal_product_price, #transportation_fee').prop('readonly', true);
            @endif
            $('#warehouse').select2(ajaxData('{{ url('ajax/warehouse') }}', 'Select warehouse'));
            $('#storage').select2(ajaxData('{{ url('ajax/storage') . '/' . $user_data->receipt->warehouse_id }}', 'Select storage'));
            @if($tab)
                $('a[href="#{{$tab}}"]').trigger('click');
            @endif
        @endif
        $('#product_id').select2(ajaxData('{{ url('ajax/product') }}'));
        $('#product_detail').select2(ajaxData('{{ url('ajax/product') }}'));
        $('#supplier_id').select2(ajaxData('{{ url('ajax/supplier') }}', 'Select supplier'));
        $('#assigned_to').select2(ajaxData('{{ url('ajax/user') }}', 'Select user'));
        $('.purchase_from').iCheck({
            radioClass: 'iradio_minimal-blue'
        });
    });
</script>