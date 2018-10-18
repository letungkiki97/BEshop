@extends('layouts.user')

{{-- Web site Title --}}
@section('title')
    {{ $title }}
@stop

{{-- Content --}}
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
            @include('layouts._toolbox')
            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 5%;">{{ __('table.id') }}</th>
                        <th>{{ __('product.main_sku') }}</th>
                        <th>{{ __('product.product_sku') }}</th>
                        <th>{{ __('product.product_name') }}</th>
                        <th>{{ __('product.product_image') }}</th>
                        <th>{{ __('product.category') }}</th>
                        <th>{{ __('table.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if(count($product))
                            @foreach($product as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->main_sku }}</td>
                                <td>{{ $item->product_sku }}</td>
                                <td>{{ $item->product_name }}</td>
                                <td>
                                    @if($item->image)
                                        <img src="uploads/products/thumb_{{$item->image->name}}" />
                                    @endif
                                </td>
                                <td>{{ $item->category->name }}</td>
                                <td>
                                    <a href="javascript:void(0)" class="recover_item" data-id="{{$item->id}}" title="{{ __('table.recover') }}"><i class="fa fa-fw fa-undo text-danger"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td id="no-data"></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="pull-left">{{ $page_info }}</div>
            <div class="pull-right">{{ $product->appends(request()->all())->links() }}</div>
        </div>
    </div>

@stop

{{-- Scripts --}}
@section('scripts')
    <script>
        $('.recover_item').click(function() {
            if(!confirm('{{ __('message.restore') }}')) {
                return false;
            }
            var id = $(this).data('id');
            $.ajax({
                url: '{{ url('product/restore') }}',
                type: 'POST',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}',
                },
                success: function(data) {
                    location.reload();
                }
            });
        });
    </script>
@stop
