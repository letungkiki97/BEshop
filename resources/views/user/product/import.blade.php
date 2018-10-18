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
            <form action="{{ url('product/import') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                <div class="col-xs-12 form-group {{ $errors->has('import_file') ? 'has-error' : '' }}">
                        {{ csrf_field() }}
                        <input type="file" name="import_file" />
                        <span class="help-block">{{ $errors->first('import_file', ':message') }}</span>
                </div>
                 @if (session('product') && count(session('product')))
                <p><label class="control-label">{{ __('table.total') }}: {{ count(session('product')) }} {{ __('table.record') }}</label></p>
                <div class="col-xs-12 form-group">
                    <table class="table" border="1" bordercolor="#ddd">
                        <thead>
                        <tr>
                            <th>{{ __('table.item') }}</th>
                            <th>{{ __('product.product_name') }}</th>
                            <th>{{ __('product.product_sku') }}</th>
                            <th>{{ __('product.product_name') }}</th>
                            <th width="20%">{{ __('table.status') }}</th>
                        </tr>
                        <thead>
                        <tbody>
                        @foreach(session('product') as $product)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->product_sku }}</td>
                                <td>{{ $product->sales_price }}</td>
                                <td>
                                    @if(count($product->status))
                                        @foreach ($product->status as $status)
                                        <p><i class="fa fa-close text-danger"></i> {{$status}}</p>
                                        @endforeach
                                    @else
                                        <p><i class="fa fa-check text-success"></i> Product created successfully</p>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
                <div class="form-group col-xs-12">
                    <a href="{{ route($type.'.index') }}" class="btn btn-danger"><i class="fa fa-times"></i> {{__('table.back')}}</a>
                    <button type="submit" class="btn btn-success">{{__('table.import')}}</button>
                </div>
            </form>
        </div>
    </div>

@stop

{{-- Scripts --}}
@section('scripts')

@stop
