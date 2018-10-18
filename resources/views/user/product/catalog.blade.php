@extends('layouts.user')
@section('title')
    {{ $title }}
@endsection
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('css/daterangepicker.css')}}"/>
    <style>
        .thumbnail {
            padding: 10px;
        }
    </style>
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
            <form action="{{ url('catalog') }}" id="filter-form">
                <div class="form-group col-xs-6">
                    <label class="control-label">{{ __('product.product_name') }}</label>
                    <input type="text" name="name" id="name" class="form-control"
                           value="{{$request->has('name') ? $request->name : ''}}">
                </div>
                <div class="form-group col-xs-6">
                    <label class="control-label">{{ __('product.category') }}</label>
                    <select name="type" class="form-control select2" id="type">
                        <option value="">Select a product type</option>
                        @foreach($categories as $k => $v)
                            <option value="{{ $k }}" {{$request->has('type') && $request->type == $k ? 'selected' : ''}}>{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="clear"></div>
                <div class="form-group col-xs-12">
                    <label class="control-label">{{ __('product.product_category') }}</label>
                    <select name="category[]" class="form-control select2" id="category" multiple>
                        @foreach($categories as $k => $v)
                            <option value="{{ $k }}" {{$request->has('category') && in_array($k, $request->category) ? 'selected' : ''}}>{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="clear"></div>
                <div class="form-group col-xs-2">
                    <label class="control-label">{{ __('product.product_price') }} {{__('table.from')}}</label>
                    <div class="controls">
                        <input type="text" name="price_from" class="form-control price"
                               value="{{$request->has('price_from') ? $request->price_from : ''}}">
                    </div>
                </div>
                <div class="form-group col-xs-2">
                    <label class="control-label">{{ __('product.product_price') }} {{__('table.to')}}</label>
                    <div class="controls">
                        <input type="text" name="price_to" class="form-control price"
                               value="{{$request->has('price_to') ? $request->price_to : ''}}">
                    </div>
                </div>
                <div class="form-group col-xs-2">
                    <label class="control-label">{{ __('product.professional_price') }} {{__('table.from')}}</label>
                    <div class="controls">
                        <input type="text" name="professional_from" class="form-control price"
                               value="{{$request->has('professional_from') ? $request->professional_from : ''}}">
                    </div>
                </div>
                <div class="form-group col-xs-2">
                    <label class="control-label">{{ __('product.professional_price') }} {{__('table.to')}}</label>
                    <div class="controls">
                        <input type="text" name="professional_to" class="form-control price"
                               value="{{$request->has('professional_to') ? $request->professional_to : ''}}">
                    </div>
                </div>
                <div class="form-group col-xs-2">
                    <label class="control-label">{{ __('product.promotion_price') }} {{__('table.from')}}</label>
                    <div class="controls">
                        <input type="text" name="promotion_from" class="form-control price"
                               value="{{$request->has('promotion_from') ? $request->promotion_from : ''}}">
                    </div>
                </div>
                <div class="form-group col-xs-2">
                    <label class="control-label">{{ __('product.promotion_price') }} {{__('table.to')}}</label>
                    <div class="controls">
                        <input type="text" name="promotion_to" class="form-control price"
                               value="{{$request->has('promotion_to') ? $request->promotion_to : ''}}">
                    </div>
                </div>
                <div class="clear"></div>
                <div class="form-group col-xs-3">
                    <label class="control-label">{{ __('product.made_to_order') }}</label>
                    <div class="controls">
                        <input type="radio" value="" class="made_to_order"
                               name="made_to_order" {{!$request->has('made_to_order') ? 'checked' : ''}}><span> All</span>
                        <input type="radio" value="1" class="made_to_order"
                               name="made_to_order" {{$request->has('made_to_order') && $request->made_to_order == 1 ? 'checked' : ''}}><span> Yes</span>
                        <input type="radio" value="0" class="made_to_order"
                               name="made_to_order" {{$request->has('made_to_order') && $request->made_to_order == 0 ? 'checked' : ''}}><span> No</span>
                    </div>
                </div>
                <div class="form-group col-xs-3">
                    <label class="control-label">{{ __('product.published') }}</label>
                    <div class="controls">
                        <input type="radio" value="" class="published"
                               name="published" {{!$request->has('published') ? 'checked' : ''}}><span> All</span>
                        <input type="radio" value="1" class="published"
                               name="published" {{$request->has('published') && $request->published == 1 ? 'checked' : ''}}><span> Yes</span>
                        <input type="radio" value="0" class="published"
                               name="published" {{$request->has('published') && $request->published == 0 ? 'checked' : ''}}><span> No</span>
                    </div>
                </div>
                <div class="form-group col-xs-3">
                    <label class="control-label">{{ __('product.status') }}</label>
                    <div class="controls">
                        <input type="radio" value="" class="status"
                               name="status" {{!$request->has('status') ? 'checked' : ''}}><span> All</span>
                        <input type="radio" value="1" class="status"
                               name="status" {{$request->has('status') && $request->status == 1 ? 'checked' : ''}}><span> Active</span>
                        <input type="radio" value="0" class="status"
                               name="status" {{$request->has('status') && $request->status == 0 ? 'checked' : ''}}><span> Inactive</span>
                    </div>
                </div>
                <div class="form-group col-xs-3">
                    <label class="control-label">{{ __('table.show') }}</label>
                    <div class="controls">
                        <input type="radio" value="0" class="main_sku"
                               name="main_sku" {{!$request->has('main_sku') || ($request->has('main_sku') && $request->main_sku == 0) ? 'checked' : ''}}><span> All</span>
                        <input type="radio" value="1" class="main_sku"
                               name="main_sku" {{$request->has('main_sku') && $request->main_sku == 1 ? 'checked' : ''}}><span> Main SKU</span>
                    </div>
                </div>
                <div class="form-group col-xs-12">
                    <button type="submit" class="btn btn-success"><i
                                class="fa fa-check-square-o"></i> {{__('table.ok')}}</button>
                    <a href="{{ url('catalog') }}" class="btn btn-danger"><i
                                class="fa fa-eraser"></i> {{__('table.clear')}}</a>
                </div>
            </form>
        </div>
    </div>
    <div class="panel panel-default" id="catalog">
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
            @if(count($product))
                @foreach ($product->chunk(4) as $chunk)
                    <div class="row row-eq-height">
                        @foreach ($chunk as $p)
                            <div class="col-xs-12 col-md-3 product-item">
                                <a href="{{ $user_data->hasAccess(['catalog.edit']) || $user_data->inRole('admin') ? url('product/'. $p->id . '/edit') : 'javascript:void(0)' }}"
                                   target="_blank">
                                    <div class="thumbnail">
                                        <img src="{{ ($p->product_image && isset($p->image->name) && $p->image->name) ? url('uploads/products/thumb_'. $p->image->name) : url('img/no-img.png')  }}">
                                        <div class="caption">
                                            <h4 class="text-center" style="font-size: 15px"><b>{{ $p->product_sku }}</b>
                                            </h4>
                                            <h4 class="text-center"><b>{{ $p->product_name }}</b></h4>
                                            <p class="text-center">
                                                @if(!empty($p->promotion_from) && !empty($p->promotion_to))
                                                    @if(strtotime(date('Y-m-d', strtotime(str_replace('/', '-', $p->promotion_from))))<=strtotime(@date('Y-m-d')) && strtotime(date('Y-m-d', strtotime(str_replace('/', '-', $p->promotion_to))))>=strtotime(@date('Y-m-d')))
                                                        <span style="color: red;font-weight: bold">{{ number_format($p->promotion_price) }}
                                                            VND</span>
                                                        <span style="font-weight: bold;opacity: 0.7;text-decoration: line-through;">{{ number_format($p->sale_price) }}
                                                            VND</span>
                                                    @else
                                                        <span style="font-weight: bold;opacity: 1;">{{ number_format($p->sale_price) }}
                                                            VND</span>
                                                    @endif
                                                @else
                                                    <span style="font-weight: bold;opacity: 1;">{{ number_format($p->sale_price) }}
                                                        VND</span>
                                                @endif
                                            </p>
                                            <p class="text-center"
                                               style="font-weight: bold">{{ $p->available_stock->sum('quantity') ? $p->available_stock->sum('quantity') . 'pc' : __('table.no_stock') }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            @endif
            <div class="col-xs-12">
                <div class="pull-right">{{ $product->appends($request->all())->links() }}</div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{asset('js/daterangepicker.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/moment.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            var height = 0;
            $('#catalog .thumbnail').each(function () {
                if ($(this).height() > height) {
                    height = $(this).height();
                }
            });
            $('#catalog .thumbnail').each(function () {
                $(this).height(height);
            })
        })
        $('.price').number(true);
        $('input[type="radio"]').iCheck({
            radioClass: 'iradio_minimal-blue'
        });
    </script>
@endsection