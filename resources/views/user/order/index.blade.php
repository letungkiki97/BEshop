@extends('layouts.user')

{{-- Web site Title --}}
@section('title')
    {{ $title }}
@stop

@section('styles')
    <style>
        .status_filter {
            padding: 0;
            margin: 0;
        }
        .status_filter li {
            display: inline-block;
        }
        .status_filter li a {
            padding: 6px 12px;
            background: #fbfcfc;
            border: 1px solid #d9d9d9;
            display: inline-block;
            color: #3e3d3e;
            font-weight: bold;
        }
        .status_filter li.active a, .status_filter li a:hover {
            background: #e4e4e4;
        }
        table a {
            outline: none !important;
        }
    </style>
@endsection

{{-- Content --}}
@section('content')
    <div class="page-header clearfix">
        <div class="pull-left" style="margin-right: 20px; display: flex; justify-content: center;">
            <ul class="status_filter">
                @if($user_data->hasAccess(['order.list']) || $user_data->inRole('admin'))
                <li class="{{ !request()->status ? 'active' : '' }}"><a href="{{ url('order') }}">All</a></li>
                @endif
                @if($user_data->hasAccess(['order.draft']) || $user_data->inRole('admin'))
                <li class="{{ request()->status == 'Draft' ? 'active' : '' }}"><a href="{{ url('order?status=Draft') }}">Draft</a></li>
                @endif
                @if($user_data->hasAccess(['order.active']) || $user_data->inRole('admin'))
                <li class="{{ request()->status == 'Active' ? 'active' : '' }}"><a href="{{ url('order?status=Active') }}">Active</a></li>
                @endif
                @if($user_data->hasAccess(['order.received']) || $user_data->inRole('admin'))
                <li class="{{ request()->status == 'Received' ? 'active' : '' }}"><a href="{{ url('order?status=Received') }}">Received</a></li>
                @endif
                @if($user_data->hasAccess(['order.paid']) || $user_data->inRole('admin'))
                <li class="{{ request()->status == 'Paid' ? 'active' : '' }}"><a href="{{ url('order?status=Paid') }}">Paid</a></li>
                @endif
                @if($user_data->hasAccess(['order.cancelled']) || $user_data->inRole('admin'))
                <li class="{{ request()->status == 'Cancelled' ? 'active' : '' }}"><a href="{{ url('order?status=Cancelled') }}">Cancelled</a></li>
                @endif
            </ul>
            @if($user_data->hasAccess([$type.'.delete']) || $user_data->inRole('admin'))
            <a href="javascript:void(0)" id="mass_delete" class="btn btn-danger" style="margin-left: 20px">{{ __('table.delete') }} <i class="fa fa-fw fa-times"></i></a>
            @endif
        </div>
        <div class="pull-right">
            @if($user_data->inRole('admin'))
            <a href="{{ $type.'/import' }}" class="btn btn-success">
                <i class="fa fa-upload"></i> {{ __('table.import') }}</a>
            @endif
            <a href="{{ $type.'/create' }}" class="btn btn-primary">
                <i class="fa fa-plus-circle"></i> {{ __('table.new') }}</a>
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
            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-bordered">
                    @if(request()->status == 'Active')
                    <thead>
                    <tr>
                        <th><input type="checkbox" class="check"></th>
                        <th>{{ __('table.id') }}</th>
                        <th>{{ __('common.product') }}</th>
                        <th>{{ __('product.product_image') }}</th>
                        <th>{{ __('purchase.quantity') }}</th>
                        <th>{{ __('purchase.supplier_po') }}</th>
                        <th>{{ __('purchase.note') }}</th>
                        <th>{{ __('purchase.receiving_date') }}</th>
                        <th>{{ __('purchase.purchase_date') }}</th>
                        <th>{{ __('purchase.total_volume') }}</th>
                        <th>Boxes</th>
                        <th>{{ __('common.supplier') }}</th>
                        <th>{{ __('purchase.nominate_price') }}</th>
                        <th>{{ __('table.created_by') }}</th>
                        <th>{{ __('purchase.assigned_to') }}</th>
                        <th>{{ __('table.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if(count($order))
                            @foreach($order as $item)
                            <tr>
                                <td><input type="checkbox" class="check" data-id="{{$item->id}}"></td>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->product->product_sku . ' - ' . $item->product->product_name }}</td>
                                <td>
                                    @if($item->product->image)
                                        <img src="uploads/products/thumb_{{$item->product->image->name}}" />
                                    @endif
                                </td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->supplier_po }}</td>
                                <td>
                                @if($item->note)
                                    <a href="javascript:void(0)" class="noteItem" title="{{ __('table.show') }}" data-toggle="modal" data-target="#noteModal">{{ __('table.view') }}</a>
                                    <div class="hidden">{!! $item->note !!}</div>
                                @endif
                                </td>
                                <td>{{ $item->receiving_date }}</td>
                                <td>{{ $item->purchase_date }}</td>
                                <td>{{ number_format((float)$item->total_volume, 2, '.', ',') }}</td>
                                <td>{{ $item->box1_quantity + $item->box2_quantity }}</td>
                                <td>{{ $item->supplier->name }}</td>
                                <td>{{ number_format((float)$item->nominate_price) }}</td>
                                <td>{{ $item->createdBy() ? $item->createdBy()->full_name : '' }}</td>
                                <td>
                                    @if($item->assigned_to)
                                        {{$item->user->full_name}}
                                    @endif
                                </td>
                                <td>
                                    @if($item->url)
                                    <a href="{{ $item->url }}" target="_blank"><i class="material-icons text-primary">input</i></a>
                                    @endif
                                    <a href="{{ url('purchase/' . $item->id . '/edit' ) }}"  title="{{ __('table.edit') }}"><i class="fa fa-fw fa-pencil text-warning"></i> </a>
                                    @if($item->status != 'Draft' && $item->status != 'Paid' && $item->status != 'Cancelled' && $item->getReceivedQuantity() < $item->quantity)
                                    <a href="{{ url('purchase/' . $item->id . '/edit?tab=stock' ) }}"  title="{{ __('table.receipt') }}">
                                            <i class="fa fa-fw fa-bank text-primary"></i> </a>
                                    @endif
                                    @if($item->status == 'Draft')
                                    <a href="javascript:void(0)" class="move-item" title="{{ __('table.activate') }}" data-id="{{$item->id}}" data-status="Active">
                                            <i class="material-icons text-success">assignment_turned_in</i> </a>
                                    @endif
                                    @if($item->status == 'Received')
                                    <a href="javascript:void(0)" class="move-item" title="{{ __('table.paid') }}" data-id="{{$item->id}}" data-status="Paid">
                                            <i class="fa fa-fw fa-dollar text-success"></i>
                                    @endif
                                    @if($user_data->hasAccess([$type.'.delete']) || $user_data->inRole('admin'))
                                    <a href="javascript:void(0)" class="delete_item" data-id="{{$item->id}}" title="{{ __('table.delete') }}"><i class="fa fa-fw fa-times text-danger"></i></a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td id="no-data"></td>
                            </tr>
                        @endif
                    </tbody>
                    @else
                    <thead>
                    <tr>
                        <th><input type="checkbox" class="check"></th>
                        <th>{{ __('table.id') }}</th>
                        <th>{{ __('common.supplier') }}</th>
                        <th>{{ __('common.product') }}</th>
                        <th>{{ __('product.product_image') }}</th>
                        <th>{{ __('purchase.quantity') }}</th>
                        <th>{{ __('purchase.purchase_date') }}</th>
                        <th>{{ __('purchase.receiving_date') }}</th>
                        <th>{{ __('purchase.nominate_price') }}</th>
                        <th>{{ __('purchase.grand_total') }}</th>
                        <th>{{ __('table.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if(count($order))
                            @foreach($order as $item)
                            <tr>
                                <td><input type="checkbox" class="check" data-id="{{$item->id}}"></td>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->supplier_id . ' - ' . $item->supplier->name }}</td>
                                <td>{{ $item->product->product_sku . ' - ' . $item->product->product_name }}</td>
                                <td>
                                    @if($item->product->image)
                                        <img src="uploads/products/thumb_{{$item->product->image->name}}" />
                                    @endif
                                </td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->purchase_date }}</td>
                                <td>{{ $item->receiving_date }}</td>
                                <td>{{ number_format((float)$item->nominate_price) }}</td>
                                <td>{{ number_format((float)$item->grand_total) }}</td>
                                <td>
                                    <a href="{{ url('purchase/' . $item->id . '/edit' ) }}"  title="{{ __('table.edit') }}"><i class="fa fa-fw fa-pencil text-warning"></i> </a>
                                    @if($item->status != 'Draft' && $item->status != 'Paid' && $item->status != 'Cancelled' && $item->getReceivedQuantity() < $item->quantity)
                                    <a href="{{ url('purchase/' . $item->id . '/edit?tab=stock' ) }}"  title="{{ __('table.receipt') }}">
                                            <i class="fa fa-fw fa-bank text-primary"></i> </a>
                                    @endif
                                    @if($item->status == 'Draft')
                                    <a href="javascript:void(0)" class="move-item" title="{{ __('table.activate') }}" data-id="{{$item->id}}" data-status="Active">
                                            <i class="material-icons text-success">assignment_turned_in</i> </a>
                                    @endif
                                    @if($item->status == 'Received')
                                    <a href="javascript:void(0)" class="move-item" title="{{ __('table.paid') }}" data-id="{{$item->id}}" data-status="Paid">
                                            <i class="fa fa-fw fa-dollar text-success"></i>
                                    @endif
                                    @if($user_data->hasAccess([$type.'.delete']) || $user_data->inRole('admin'))
                                    <a href="javascript:void(0)" class="delete_item" data-id="{{$item->id}}" title="{{ __('table.delete') }}"><i class="fa fa-fw fa-times text-danger"></i></a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td id="no-data"></td>
                            </tr>
                        @endif
                    </tbody>
                    @endif
                </table>
            </div>
            <div class="pull-left">{{ $page_info }}</div>
            <div class="pull-right">{{ $order->appends(request()->all())->links() }}</div>
        </div>
    </div>
<!-- Modal -->
<div id="noteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{ __('sales_order.note') }}</h4>
            </div>
            <div class="modal-body"></div>
        </div>

    </div>
</div>
@stop

{{-- Scripts --}}
@section('scripts')
    <script>
        $('.move-item').click(function() {
            var status = $(this).data('status'),
                id = $(this).data('id');
            if (!confirm('{{ __('message.move_purchase') }} '+status+'?')) {
                return false;
            }
            $.ajax({
                url: '{{ url('order/move') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: status,
                    id: id,
                },
                success: function(data) {
                    location.reload();
                }
            });
        });
        $('.noteItem').click(function () {
            $('#noteModal .modal-body').html($(this).next().html());
        });

    </script>
@stop