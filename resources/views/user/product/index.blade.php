@extends('layouts.user')

{{-- Web site Title --}}
@section('title')
    {{ $title }}
@stop

{{-- Content --}}
<?php
$domain = (strpos(\URL::full(), 'cazacrm.yez.vn') !== FALSE)?\Config::get('app.domain_test_site'):\Config::get('app.domain');
?>
@section('content')
    <div class="page-header clearfix">
        @include('layouts._action')
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
                        <th><input type="checkbox" class="check"></th>
                        <th style="width: 5%;">{{ __('table.id') }}</th>
                        <th>{{ __('product.main_sku') }}</th>
                        <th>{{ __('product.product_sku') }}</th>
                        <th>{{ __('product.product_name') }}</th>
                        <th>{{ __('product.product_image') }}</th>
                        <th>{{ __('product.category') }}</th>
                        <th>{{ __('product.status') }}</th>
                        <th>{{ __('table.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if(count($product))
                            @foreach($product as $item)
                            <tr>
                                <td><input type="checkbox" class="check" data-id="{{$item->id}}"></td>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->main_sku }}</td>
                                <td>{{ $item->product_sku }}</td>
                                <td>{{ $item->product_name }}</td>
                                <td>
                                    @if($item->product_image && isset($item->image->name) && $item->image->name)
                                        <img width="100" src="uploads/products/{{$item->image->name}}" />
                                    @endif
                                </td>
                                <td>{{ $item->category->name }}</td>
                                <td><label class="label label-{{ $item->status ? 'success' : 'warning' }}">{{ $item->status ? 'Active' : 'Inactive' }}</label></td>
                                <td>
                                    <a href="{{ url('product/' . $item->id . '/edit' ) }}"  title="{{ __('table.edit') }}"><i class="fa fa-fw fa-pencil text-warning"></i> </a>
                                    @if(!$item->status && ($user_data->hasAccess([$type.'.delete']) || $user_data->inRole('admin')))
                                    <a href="javascript:void(0)" class="delete_item" data-name="{{ $item->product_sku }}" data-id="{{$item->id}}" title="{{ __('table.delete') }}"><i class="fa fa-fw fa-times text-danger"></i></a>
                                    @endif
                                    @if($item->published)
                                    <a href="{{ $domain.'/shop/'.$item->slug }}" title = "{{$item->product_name}}" target="_blank"><i class="fa fa-eye"></i></a> 
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
                </table>
            </div>
            <div class="pull-left">{{ $page_info }}</div>
            <div class="pull-right">{{ $product->appends(request()->all())->links() }}</div>
        </div>
    </div>

@stop

{{-- Scripts --}}
@section('scripts')
@stop
