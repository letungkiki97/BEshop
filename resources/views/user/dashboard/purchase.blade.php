@extends('layouts.user')
@section('title')
    {{ $title }}
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('css/daterangepicker.css')}}" />
@endsection
@section('content')
    <div class="page-header clearfix">
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <i class="material-icons">dashboard</i>
                {{ __('table.filter') }}
            </h4>
            <span class="pull-right">
                <i class="fa fa-fw fa-chevron-up clickable"></i>
                <i class="fa fa-fw fa-times removepanel clickable"></i>
            </span>
        </div>
        <div class="panel-body">
            <form action="{{ url('report/purchase') }}">
                <div class="form-group col-xs-6">
                    <label class="control-label">{{ __('purchase.purchase_date') }}</label>
                    <div class="controls">
                        <input type="text" class="form-control daterange" value="{{ isset($purchase_start) && isset($purchase_end) ? $purchase_start . ' - ' . $purchase_end : '' }}">
                        <input type="hidden" class="form-control date-start" name="purchase_start" value="{{ isset($request->purchase_start) ? $request->purchase_start : '' }}">
                        <input type="hidden" class="form-control date-end" name="purchase_end" value="{{ isset($request->purchase_end) ? $request->purchase_end : '' }}">
                    </div>
                </div>
                <div class="form-group col-xs-6">
                    <label class="control-label">{{ __('purchase.receiving_date') }}</label>
                    <div class="controls">
                        <input type="text" class="form-control daterange" value="{{ isset($receiving_start) && isset($receiving_end) ? $receiving_start . ' - ' . $receiving_end : '' }}">
                        <input type="hidden" class="form-control date-start" name="receiving_start" value="{{ isset($request->receiving_start) ? $request->receiving_start : '' }}">
                        <input type="hidden" class="form-control date-end" name="receiving_end" value="{{ isset($request->receiving_end) ? $request->receiving_end : '' }}">
                    </div>
                </div>
                <div class="clear"></div>
                <div class="form-group col-xs-6">
                    <label class="control-label">{{ __('purchase.purchase_from') }}</label>
                    <div class="controls">
                        <input type="radio" value="0" class="purchase_from" name="purchase_from" {{$request->has('purchase_from') && $request->purchase_from == 0 ? 'checked' : ''}}><span> Oversea</span>
                        <input type="radio" value="1" class="purchase_from" name="purchase_from" {{$request->has('purchase_from') && $request->purchase_from == 1 ? 'checked' : ''}}><span> Vietnam</span>
                    </div>
                </div>
                <div class="form-group col-xs-6">
                    <label class="control-label">{{ __('purchase.status') }}</label>
                    <div class="controls">
                        <select name="status[]" class="form-control select2" id="status" multiple>
                            @foreach($status as $k => $v)
                            <option value="{{ $k }}" {{$request->has('status') && in_array($k, $request->status) ? 'selected' : ''}}>{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="form-group col-xs-6">
                    <label class="control-label">{{ __('common.product') }}</label>
                    <div class="controls">
                        <select name="product" class="form-control" id="product">
                            @if(isset($product))
                            <option value="{{ $product->id }}" selected="selected" data-img="{{ ($product->product_image && isset($product->image->name) && $product->image->name) ? asset('uploads/products') . '/thumb_' . $product->image->name : asset('img/no-img.png') }}">{{  $product->product_sku . ' | ' . $product->product_name }}</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="form-group col-xs-6">
                    <label class="control-label">{{ __('common.supplier') }}</label>
                    <div class="controls">
                        <select name="supplier" class="form-control" id="supplier">
                            @if(isset($supplier))
                            <option value="{{ $supplier->id }}" selected="selected">{{  $supplier->id . ' | ' . $supplier->name }}</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="form-group col-xs-12">
                    <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> {{__('table.ok')}}</button>
                    <button type="reset" id="reset" class="btn btn-danger"><i class="fa fa-eraser"></i> {{__('table.clear')}}</button>
                </div>
            </form>
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
            <div class="col-xs-12">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>{{ __('table.id') }}</th>
                            <th>{{ __('purchase.status') }}</th>
                            <th>{{ __('common.supplier') }}</th>
                            <th>{{ __('common.product') }}</th>
                            <th>{{ __('purchase.quantity') }}</th>
                            <th>{{ __('purchase.received') }}</th>
                            <th>{{ __('purchase.nominate_price') }}</th>
                            <th>{{ __('purchase.grand_total') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($purchase))
                            <tr>
                                <td><b>{{ __('table.total') }}</b></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>{{ number_format($total) }}</td>
                            </tr>
                            @foreach($purchase as $p)
                            <tr>
                                <td><a href="{{ url('purchase', $p->id) }}/edit" target="_blank">{{$p->id}}</a></td>
                                <td>{{$p->status}}</td>
                                <td>{{$p->supplier_id . ' - ' . $p->supplier->name}}</td>
                                <td>{{$p->product->product_sku . ' - ' . $p->product->product_name}}</td>
                                <td>{{$p->quantity}}</td>
                                <td>{{number_format($p->getReceivedQuantity())}}</td>
                                <td>{{number_format($p->nominate_price)}}</td>
                                <td>{{number_format($p->grand_total)}}</td>
                            </tr>
                            @endforeach
                        @else
                        <tr>
                            <td colspan="8" class="text-center"></td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                <div class="pull-right">{{ $purchase->appends($request->all())->links() }}</div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{asset('js/daterangepicker.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/moment.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.daterange').daterangepicker({
                autoUpdateInput:false, 
                showDropdowns:true,
                locale: {
                  format: '{{settings('jquery_date')}}'
                },
            }).on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('{{settings('jquery_date')}}') + ' - ' + picker.endDate.format('{{settings('jquery_date')}}'));
                $(this).closest('.form-group').find('.date-start').val(picker.startDate.format("YYYY-MM-DD"))
                $(this).closest('.form-group').find('.date-end').val(picker.endDate.format("YYYY-MM-DD"));
            }).on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
                $(this).closest('.form-group').find('.date-start').val(null)
                $(this).closest('.form-group').find('.date-end').val(null);
            });
            $('.purchase_from').iCheck({
                radioClass: 'iradio_minimal-blue'
            });
            $('#product').select2(ajaxData('{{ url('ajax/product') }}'));
            $('#supplier').select2(ajaxData('{{ url('ajax/supplier') }}'));
        });
        $('#reset').click(function() {
            $('.daterange').removeAttr('value').trigger('change');
            $('.purchase_from').iCheck('uncheck').removeAttr('checked'); 
            $('#product').empty();
            $('#supplier').empty();
            $('select option:selected').each(function(i,e) {
                $(e).removeAttr('selected');
            })
            $('select, .date-start, .date-end').val(null).trigger('change');
        })
    </script>
@endsection