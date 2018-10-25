@if($user_data->hasAccess([$type.'.delete']) || $user_data->inRole('admin'))
<div class="pull-left">
    <a href="javascript:void(0)" id="mass_delete" class="btn btn-danger">{{ __('table.delete') }} <i class="fa fa-fw fa-times"></i></a>
</div>
@endif
<div class="pull-right">
	@if($user_data->inRole('admin') && in_array($type, ['customer', 'supplier', 'supplier_price']))
    <a href="{{ $type.'/import' }}" class="btn btn-success">
        <i class="fa fa-upload"></i> {{ __('table.import') }}</a>
    @endif
    @if(Request::is( 'news*') || Request::is( 'news'))
    <a href="{{ $type.'/crawl' }}" class="btn btn-info">
        <i class="fa fa-download"></i> {{ __('table.rawl') }}</a>
    @endif 
    @if(Request::is( 'product_filters/*') || Request::is( 'product_filters'))
    @else
    <a href="{{ $type.'/create' }}" class="btn btn-primary">
        <i class="fa fa-plus-circle"></i> {{ __('table.new') }}</a>
    @endif   
</div>