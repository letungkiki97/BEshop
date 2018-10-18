
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
            <form action="{{ url('report/profitability') }}">
                <div class="form-group col-xs-6">
                    <label class="control-label">{{ __('sales_order.date') }}</label>
                    <div class="controls">
                        <input type="text" class="form-control daterange" value="{{ isset($order_start) && isset($order_end) ? $order_start . ' - ' . $order_end : '' }}">
                        <input type="hidden" class="form-control date-start" name="order_start" value="{{ isset($request->order_start) ? $request->order_start : '' }}">
                        <input type="hidden" class="form-control date-end" name="order_end" value="{{ isset($request->order_end) ? $request->order_end : '' }}">
                    </div>
                </div>
                <div class="form-group col-xs-6">
                    <label class="control-label">{{ __('sales_order.delivery_date') }}</label>
                    <div class="controls">
                        <input type="text" class="form-control daterange" value="{{ isset($delivery_start) && isset($delivery_end) ? $delivery_start . ' - ' . $delivery_end : '' }}">
                        <input type="hidden" class="form-control date-start" name="delivery_start" value="{{ isset($request->delivery_start) ? $request->delivery_start : '' }}">
                        <input type="hidden" class="form-control date-end" name="delivery_end" value="{{ isset($request->delivery_end) ? $request->delivery_end : '' }}">
                    </div>
                </div>
                <div class="clear"></div>
                <div class="form-group col-xs-6">
                    <label class="control-label">{{ __('sales_order.deposit_received_date') }}</label>
                    <div class="controls">
                        <input type="text" class="form-control daterange" value="{{ isset($deposit_start) && isset($deposit_end) ? $deposit_start . ' - ' . $deposit_end : '' }}">
                        <input type="hidden" class="form-control date-start" name="deposit_start" value="{{ isset($request->deposit_start) ? $request->deposit_start : '' }}">
                        <input type="hidden" class="form-control date-end" name="deposit_end" value="{{ isset($request->deposit_end) ? $request->deposit_end : '' }}">
                    </div>
                </div>
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
                <div class="clear"></div>
                <div class="form-group col-xs-6">
                    <label class="control-label">{{ __('common.customer') }}</label>
                    <div class="controls">
                        <select name="customer" class="form-control" id="customer">
                            @if(isset($customer))
                            <option value="{{ $customer->id }}" selected="selected">{{  $customer->name }}</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="form-group col-xs-6">
                    <label class="control-label">{{ __('common.customer_type') }}</label>
                    <div class="controls">
                        <select name="customer_type" class="form-control select2" id="customer_type">
                            @foreach($types as $k => $v)
                            <option value="{{ $k }}" {{$request->has('customer_type') && $k == $request->customer_type ? 'selected' : ''}}>{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="form-group col-xs-6">
                    <label class="control-label">{{ __('common.sales_agent') }}</label>
                    <div class="controls">
                        <select name="sales_agent[]" class="form-control select2" id="sales_agent" multiple>
                            @foreach($agent as $k => $v)
                            <option value="{{ $k }}" {{$request->has('sales_agent') && in_array($k, $request->sales_agent) ? 'selected' : ''}}>{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group col-xs-6">
                    <label class="control-label">{{ __('sales_order.status') }}</label>
                    <div class="controls">
                        <select name="status[]" class="form-control select2" id="status" multiple>
                            @foreach($status as $k => $v)
                            <option value="{{ $k }}" {{$request->has('status') && in_array($k, $request->status) ? 'selected' : ''}}>{{ $v }}</option>
                            @endforeach
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
                            <th>{{ __('sales_order.order_number') }}</th>
                            <th>{{ __('sales_order.status') }}</th>
                            <th>{{ __('sales_order.date') }}</th>
                            <th>{{ __('common.customer') }}</th>
                            <th>{{ __('sales_order.vat') }}</th>
                            <th>{{ __('sales_order.grand_total') }}</th>
                            <th>{{ __('sales_order.order_cost') }}</th>
                            <th>{{ __('sales_order.order_profit') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($profitability))
                            <tr>
                                <td><b>{{ __('table.total') }}</b></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>{{ number_format($after_discount) }}</td>
                                <td>{{ number_format($order_cost) }}</td>
                                <td>{{ number_format($order_profit) }}</td>
                            </tr>
                            @foreach($profitability as $item)
                            <tr>
                                <td><a href="{{ url('sales_order/' . $item->id . '/edit') }}" target="_blank">{{ $item->tracking_number }}</a></td>
                                <td>{{ $item->status }}</td>
                                <td>{{ $item->date }}</td>
                                <td>{{ $item->customer->name }}</td>
                                <td>{{ number_format($item->tax) }}</td>
                                <td>{{ number_format($item->after_discount) }}</td>
                                <td>{{ number_format($item->order_cost) }}</td>
                                <td>{{ number_format($item->order_profit) }}</td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="9"></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="pull-right">{{ $profitability->appends($request->all())->links() }}</div>
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
            $('#product').select2(ajaxData('{{ url('ajax/product') }}'));
            $('#customer').select2(ajaxData('{{ url('ajax/customer') }}'));
        });
        $('#reset').click(function() {
            $('.daterange').removeAttr('value').trigger('change');
            $('#product').empty();
            $('#customer').empty();
            $('select option:selected').each(function(i,e) {
                $(e).removeAttr('selected');
            })
            $('select, .date-start, .date-end').val(null).trigger('change');
        })
    </script>
@endsection