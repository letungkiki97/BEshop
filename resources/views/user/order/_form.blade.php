<div class="panel panel-primary">
    <div class="panel-body">
        @if (isset($purchase))
            {!! Form::model($purchase, array('url' => $type . '/' . $purchase->id, 'method' => 'put', 'files'=> true)) !!}
            <input type="hidden" name="purchase_id" value={{$purchase->id}}>
        @else
            {!! Form::open(array('url' => $type, 'method' => 'post', 'files'=> true)) !!}
        @endif
        <div class="nav-tabs-custom" id="setting_tabs">
            <ul class="nav nav-tabs" style="display:list-item;">
                <li class="active">
                    <a href="#general" data-toggle="tab" title="{{ __('tab.information') }}">
                        <i class="material-icons md-24">info</i>
                    </a>
                </li>
                <li>
                    <a href="#price" data-toggle="tab" title="{{ __('tab.price') }}">
                        <i class="material-icons md-24">attach_money</i>
                    </a>
                </li>
                <li>
                    <a href="#config" data-toggle="tab" title="{{ __('tab.config') }}">
                        <i class="material-icons md-24">settings</i>
                    </a>
                </li>
                <li>
                    <a href="#stock" data-toggle="tab" title="{{ __('tab.stock') }}">
                        <i class="material-icons md-24">account_balance</i>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="general">
                    <div class="form-group col-xs-6 required {{ $errors->has('supplier_id') ? 'has-error' : '' }}">
                        {!! Form::label('supplier_id', __('common.supplier'), array('class' => 'control-label required')) !!}
                        <div class="controls">
                            <select name="supplier_id" class="form-control" id="supplier_id" required>
                                @if(isset($purchase))
                                    <option value="{{ $purchase->supplier_id }}"
                                            selected="selected">{{  $purchase->supplier_id . ' | ' . $purchase->supplier->name }}</option>
                                @endif
                            </select>
                            <span class="help-block">{{ $errors->first('supplier_id', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group col-xs-6 required {{ $errors->has('product_id') ? 'has-error' : '' }}">
                        {!! Form::label('product', __('common.product'), array('class' => 'control-label required')) !!}
                        <div class="controls">
                            <select name="product_id" class="form-control" id="product_id" required>
                                @if(isset($purchase))
                                    <option value="{{ $purchase->product_id }}" selected="selected"
                                            data-img="{{ (@$purchase->product->product_image && isset($purchase->product->image->name) && $purchase->product->image->name) ? asset('uploads/products') . '/thumb_' . @$purchase->product->image->name : asset('img/no-img.png') }}">{{  $purchase->product->product_sku . ' | ' . $purchase->product->product_name }}</option>
                                @endif
                            </select>
                            <span class="help-block">{{ $errors->first('product_id', ':message') }}</span>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="form-group col-xs-6 {{ $errors->has('supplier_po') ? 'has-error' : '' }}">
                        {!! Form::label('supplier_po', __('purchase.supplier_po'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::text('supplier_po', null, array('class' => 'form-control')) !!}
                            <span class="help-block">{{ $errors->first('supplier_po', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group col-xs-6 {{ $errors->has('purchase_from') ? 'has-error' : '' }}">
                        {!! Form::label('purchase_from', __('purchase.purchase_from'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            <input type="radio" value="0" class="purchase_from" name="purchase_from"
                                   id="oversea" {{ isset($purchase) && !$purchase->purchase_from ? 'checked' : '' }}><span> Oversea</span>
                            <input type="radio" value="1" class="purchase_from" name="purchase_from"
                                   id="vietnam" {{ isset($purchase) && $purchase->purchase_from ? 'checked' : '' }}><span> Vietnam</span>
                        </div>
                    </div>
                    <div class="clear"></div>
                   {{--  <div class="form-group col-xs-6 required {{ $errors->has('currency_id') ? 'has-error' : '' }}">
                        {!! Form::label('currency', __('purchase.currency'), array('class' => 'control-label required')) !!}
                        <div class="controls">
                            {!! Form::select('currency_id', $currencies, isset($purchase) ? $purchase->currency_id : null, ['id' => 'currency','class' => 'form-control select2', 'required' => true]) !!}
                            <span class="help-block">{{ $errors->first('currency_id', ':message') }}</span>
                        </div>
                    </div> --}}
                    <div class="form-group col-xs-6 required {{ $errors->has('status') ? 'has-error' : '' }}">
                        {!! Form::label('status', __('purchase.status'), array('class' => 'control-label required')) !!}
                        <div class="controls">
                            {!! Form::select('status', $purchase_status, (isset($purchase)?$purchase->status:null), array('class' => 'form-control', 'disabled' => isset($purchase) && !$user_data->inRole('admin'))) !!}
                            <span class="help-block">{{ $errors->first('status', ':message') }}</span>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="form-group col-xs-6 required {{ $errors->has('purchase_date') ? 'has-error' : '' }}">
                        {!! Form::label('purchase_date', __('purchase.purchase_date'), array('class' => 'control-label required')) !!}
                        <div class="controls">
                            {!! Form::text('purchase_date', isset($purchase) ? $purchase->purchase_date : $date, array('class' => 'form-control date', 'required' => true)) !!}
                            <span class="help-block">{{ $errors->first('purchase_date', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group col-xs-6 required {{ $errors->has('receiving_date') ? 'has-error' : '' }}">
                        {!! Form::label('receiving_date', __('purchase.receiving_date'), array('class' => 'control-label required')) !!}
                        <div class="controls">
                            {!! Form::text('receiving_date', isset($purchase) ? $purchase->receiving_date : $date, array('class' => 'form-control date', 'required' => true)) !!}
                            <span class="help-block">{{ $errors->first('receiving_date', ':message') }}</span>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="form-group col-xs-6 {{ $errors->has('payment') ? 'has-error' : '' }}">
                        {!! Form::label('payment', __('purchase.payment'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::text('payment', null, array('class' => 'form-control')) !!}
                            <span class="help-block">{{ $errors->first('payment', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group col-xs-6 {{ $errors->has('url') ? 'has-error' : '' }}">
                        {!! Form::label('url', __('purchase.url'), array('class' => 'control-label')) !!}
                        @if(isset($purchase) && $purchase->url)
                            <a href="{{ $purchase->url }}" target="_blank"><i class="material-icons">input</i></a>
                        @endif
                        <div class="controls">
                            {!! Form::text('url', null, array('class' => 'form-control')) !!}
                            <span class="help-block">{{ $errors->first('url', ':message') }}</span>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="tab-pane" id="price">
                    <div class="form-group oversea col-xs-3 {{ $errors->has('item_price') ? 'has-error' : '' }}">
                        {!! Form::label('item_price', __('purchase.item_price'), array('class' => 'control-label')) !!}
                        <span class="currency_code"></span>
                        <div class="controls">
                            {!! Form::text('item_price', isset($purchase) ? $purchase->item_price : '', array('class' => isset($purchase) && $purchase->currency->code == 'VND' ? 'form-control price number' : 'form-control price number2')) !!}
                            <span class="help-block"
                                  id="item_price_span">{{ $errors->first('item_price', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group col-xs-3 {{ $errors->has('quantity') ? 'has-error' : '' }}">
                        {!! Form::label('quantity', __('purchase.quantity'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::number('quantity', isset($purchase) ? $purchase->quantity : 1, array('class' => 'form-control price no-change', 'min' => 0, 'step' => 1)) !!}
                            <span class="help-block">{{ $errors->first('quantity', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group oversea col-xs-3 {{ $errors->has('price_per_order_unit') ? 'has-error' : '' }}">
                        {!! Form::label('price_per_order_unit', __('purchase.price_per_order_unit'), array('class' => 'control-label')) !!}
                        <span class="currency_code"></span>
                        <div class="controls">
                            {!! Form::text('price_per_order_unit', null, array('class' => 'form-control number', 'readonly' => true)) !!}
                            <span class="help-block">{{ $errors->first('price_per_order_unit', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group col-xs-3 {{ $errors->has('exchange_rate') ? 'has-error' : '' }}">
                        {!! Form::label('exchange_rate', __('purchase.exchange_rate'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            <input type="text" id="exchange_rate" name="exchange_rate"
                                   value="{{ isset($purchase) ? $purchase->exchange_rate : 1 }}"
                                   class="price number form-control">
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="form-group oversea col-xs-3 {{ $errors->has('ordering_fee') ? 'has-error' : '' }}">
                        {!! Form::label('ordering_fee', __('purchase.ordering_fee'), array('class' => 'control-label')) !!}
                        <span class="currency_code"></span>
                        <div class="controls">
                            {!! Form::text('ordering_fee', isset($purchase) ? $purchase->ordering_fee : '', array('class' => 'form-control price number2')) !!}
                            <span class="help-block">{{ $errors->first('ordering_fee', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group oversea col-xs-3 {{ $errors->has('internal_transportation_fee') ? 'has-error' : '' }}">
                        {!! Form::label('internal_transportation_fee', __('purchase.internal_transportation_fee'), array('class' => 'control-label')) !!}
                        <span class="currency_code"></span>
                        <div class="controls">
                            {!! Form::text('internal_transportation_fee', isset($purchase) ? $purchase->internal_transportation_fee : '', array('class' => 'form-control price number')) !!}
                            <span class="help-block">{{ $errors->first('internal_transportation_fee', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group col-xs-3 {{ $errors->has('total') ? 'has-error' : '' }}">
                        {!! Form::label('total', __('purchase.total') . ' (VND)', array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::text('total', null, array('class' => 'form-control price number', 'readonly')) !!}
                            <span class="help-block">{{ $errors->first('total', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group col-xs-3 {{ $errors->has('internal_product_price') ? 'has-error' : '' }}">
                        {!! Form::label('internal_product_price', __('purchase.internal_product_price') . ' (VND)', array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::text('internal_product_price', null, array('class' => 'form-control price number', 'readonly' => true)) !!}
                            <span class="help-block">{{ $errors->first('internal_product_price', ':message') }}</span>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="form-group oversea col-xs-3 {{ $errors->has('international_transport_rate_volume') ? 'has-error' : '' }}">
                        {!! Form::label('international_transport_rate_volume', __('purchase.international_transport_rate_volume'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::text('international_transport_rate_volume', isset($purchase) ? $purchase->international_transport_rate_volume : $international_transport_rate_volume, array('class' => 'form-control no-change price number')) !!}
                            <span class="help-block">{{ $errors->first('international_transport_rate_volume', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group oversea col-xs-3 {{ $errors->has('international_transport_rate_kg') ? 'has-error' : '' }}">
                        {!! Form::label('international_transport_rate_kg', __('purchase.international_transport_rate_kg'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::text('international_transport_rate_kg', isset($purchase) ? $purchase->international_transport_rate_kg : $international_transport_rate_kg, array('class' => 'form-control no-change price number')) !!}
                            <span class="help-block">{{ $errors->first('international_transport_rate_kg', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group oversea col-xs-3 {{ $errors->has('box_weight') ? 'has-error' : '' }}">
                        {!! Form::label('box_weight', __('purchase.box_weight'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::text('box_weight', isset($purchase) ? $purchase->box_weight : '', array('class' => 'form-control price number2')) !!}
                            <span class="help-block">{{ $errors->first('box_weight', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group oversea col-xs-3 {{ $errors->has('total_transport_rate') ? 'has-error' : '' }}">
                        {!! Form::label('total_transport_rate', __('purchase.total_transport_rate'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::text('total_transport_rate', null, array('class' => 'form-control price number','readonly' => true)) !!}
                            <span class="help-block">{{ $errors->first('total_transport_rate', ':message') }}</span>
                        </div>
                    </div>
                    <div class="col-md-12 oversea">
                        <table class="table table-bordered">
                            <thead>
                            <tr style="font-size: 12px;">
                                <th>{{__('table.item')}}</th>
                                <th>{{__('purchase.box_height')}}</th>
                                <th>{{__('purchase.box_depth')}}</th>
                                <th>{{__('purchase.box_length')}}</th>
                                <th>{{__('purchase.box_quantity')}}</th>
                                <th>{{__('purchase.box_volume')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{__('purchase.box1')}}</td>
                                <td>
                                    {!! Form::text('box1_height', isset($purchase) ? $purchase->box1_height : '', array('class' => 'form-control price number2', 'id' => 'box1_height')) !!}
                                    <span class="help-block">{{ $errors->first('box1_height', ':message') }}</span>
                                </td>
                                <td>
                                    {!! Form::text('box1_depth', isset($purchase) ? $purchase->box1_depth : '', array('class' => 'form-control price number2', 'id' => 'box1_depth')) !!}
                                    <span class="help-block">{{ $errors->first('box1_depth', ':message') }}</span>
                                </td>
                                <td>
                                    {!! Form::text('box1_length', isset($purchase) ? $purchase->box1_length : '', array('class' => 'form-control price number2', 'id' => 'box1_length')) !!}
                                    <span class="help-block">{{ $errors->first('box1_length', ':message') }}</span>
                                </td>
                                <td>
                                    {!! Form::number('box1_quantity', null, array('class' => 'form-control price', 'id' => 'box1_quantity')) !!}
                                    <span class="help-block">{{ $errors->first('box1_quantity', ':message') }}</span>
                                </td>
                                <td>
                                    {!! Form::text('box1_volume', null, array('class' => 'form-control price number2', 'id' => 'box1_volume', 'readonly')) !!}
                                    <span class="help-block">{{ $errors->first('box1_volume', ':message') }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>{{__('purchase.box2')}}</td>
                                <td>
                                    {!! Form::text('box2_height', isset($purchase) ? $purchase->box2_height : '', array('class' => 'form-control price number2', 'id' => 'box2_height')) !!}
                                    <span class="help-block">{{ $errors->first('box2_height', ':message') }}</span>
                                </td>
                                <td>
                                    {!! Form::text('box2_depth', isset($purchase) ? $purchase->box2_depth : '', array('class' => 'form-control price number2', 'id' => 'box2_depth')) !!}
                                    <span class="help-block">{{ $errors->first('box2_depth', ':message') }}</span>
                                </td>
                                <td>
                                    {!! Form::text('box2_length', isset($purchase) ? $purchase->box2_length : '', array('class' => 'form-control price number2', 'id' => 'box2_length')) !!}
                                    <span class="help-block">{{ $errors->first('box2_length', ':message') }}</span>
                                </td>
                                <td>
                                    {!! Form::number('box2_quantity', null, array('class' => 'form-control price', 'id' => 'box2_quantity')) !!}
                                    <span class="help-block">{{ $errors->first('box2_quantity', ':message') }}</span>
                                </td>
                                <td>
                                    {!! Form::text('box2_volume', null, array('class' => 'form-control price number2', 'id' => 'box2_volume', 'readonly')) !!}
                                    <span class="help-block">{{ $errors->first('box2_volume', ':message') }}</span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group oversea col-xs-3 {{ $errors->has('total_volume') ? 'has-error' : '' }}">
                        {!! Form::label('total_volume', __('purchase.total_volume'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::text('total_volume', null, array('class' => 'form-control number2', 'readonly' => true)) !!}
                            <span class="help-block">{{ $errors->first('total_volume', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group col-xs-3 {{ $errors->has('transportation_fee') ? 'has-error' : '' }}">
                        {!! Form::label('transportation_fee', __('purchase.transportation_fee'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::text('transportation_fee', null, array('class' => 'form-control price number', 'readonly' => true)) !!}
                            <span class="help-block">{{ $errors->first('transportation_fee', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group col-xs-3 {{ $errors->has('discount') ? 'has-error' : '' }}">
                        {!! Form::label('discount', __('purchase.discount'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::number('discount', null, array('class' => 'form-control price', 'max' => 100)) !!}
                            <span class="help-block">{{ $errors->first('discount', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group col-xs-3 {{ $errors->has('discount_amount') ? 'has-error' : '' }}">
                        {!! Form::label('discount_amount', __('purchase.discount_amount'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::text('discount_amount', null, array('class' => 'form-control price number')) !!}
                            <span class="help-block">{{ $errors->first('discount_amount', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group col-xs-3 {{ $errors->has('vat') ? 'has-error' : '' }}">
                        {!! Form::label('vat', __('purchase.vat'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::number('vat', null, array('class' => 'form-control price', 'max' => 100)) !!}
                            <span class="help-block">{{ $errors->first('vat', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group col-xs-3 {{ $errors->has('grand_total') ? 'has-error' : '' }}">
                        {!! Form::label('grand_total', __('purchase.grand_total'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::text('grand_total', null, array('class' => 'form-control number', 'readonly')) !!}
                            <span class="help-block">{{ $errors->first('grand_total', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group col-xs-3 {{ $errors->has('nominate_price') ? 'has-error' : '' }}">
                        {!! Form::label('nominate_price', __('purchase.nominate_price'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::text('nominate_price', null, array('class' => 'form-control number', 'readonly' => true)) !!}
                            <span class="help-block">{{ $errors->first('nominate_price', ':message') }}</span>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="config">
                    <div class="form-group col-xs-6 {{ $errors->has('handled_by') ? 'has-error' : '' }}">
                        {!! Form::label('handled_by', __('purchase.handled_by'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::text('handled_by', null, array('class' => 'form-control')) !!}
                            <span class="help-block">{{ $errors->first('handled_by', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group col-xs-6 {{ $errors->has('assigned_to') ? 'has-error' : '' }}">
                        {!! Form::label('product', __('purchase.assigned_to'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            <select name="assigned_to" class="form-control" id="assigned_to">
                                @if(isset($purchase) && $purchase->assigned_to)
                                    <option value="{{ $purchase->assigned_to }}"
                                            selected="selected">{{  $purchase->user->full_name }}</option>
                                @endif
                            </select>
                            <span class="help-block">{{ $errors->first('assigned_to', ':message') }}</span>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="form-group col-xs-12 {{ $errors->has('note') ? 'has-error' : '' }}">
                        {!! Form::label('note', __('purchase.note'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::textArea('note', null, array('class' => 'form-control')) !!}
                            <span class="help-block">{{ $errors->first('note', ':message') }}</span>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="stock">
                    @if (isset($purchase))
                        @if($user_data->hasAccess(['stock_movement.add']) || $user_data->inRole('admin'))
                            @if($purchase->status != 'Draft' && $purchase->status != 'Paid' && $purchase->status != 'Cancelled' && $max > 0)
                                <div class="form-group col-xs-6">
                                    <label class="control-label required">{{__('common.product')}}</label>
                                    <div class="controls">
                                        <select class="form-control" id="product_detail" disabled>
                                            <option value="{{ $purchase->product_id }}" selected="selected"
                                                    data-img="{{ ($purchase->product->product_image && isset($purchase->product->image->name) && $purchase->product->image->name) ? asset('uploads/products') . '/thumb_' . $purchase->product->image->name : asset('img/no-img.png') }}">{{  $purchase->product->product_sku . ' | ' . $purchase->product->product_name }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-xs-6">
                                    <label class="control-label required">{{__('stock_movement.quantity')}}</label>
                                    <div class="controls">
                                        <input type="number" class="form-control" min="1" max="{{$max > 0 ? $max : 0}}"
                                               value="{{$max > 0 ? $max : 0}}" id="stock_quantity">
                                    </div>
                                </div>
                                <div class="clear"></div>
                                <div class="form-group col-xs-6">
                                    <label class="control-label required">{{__('common.warehouse')}}</label>
                                    <div class="controls">
                                        <select class="form-control" id="warehouse">
                                            @if (isset($user_data) && $user_data->to_storage)
                                                <option value="{{ $user_data->receipt->warehouse_id }}">{{ $user_data->receipt->warehouse->code . ' | ' . $user_data->receipt->warehouse->name }}</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-xs-6">
                                    <label class="control-label required">{{__('common.storage')}}</label>
                                    <div class="controls">
                                        <select class="form-control" id="storage">
                                            @if (isset($user_data) && $user_data->to_storage)
                                                <option value="{{ $user_data->to_storage }}">{{ $user_data->to_storage . ' | ' . $user_data->receipt->location }}</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="clear"></div>
                                <div class="form-group col-xs-6">
                                    <label class="control-label required">{{__('stock_movement.date')}}</label>
                                    <div class="controls">
                                        <input type="text" class="form-control date" id="stock_date" value="{{$date}}">
                                    </div>
                                </div>
                                <div class="form-group col-xs-6">
                                    <label class="control-label">{{__('stock_movement.reference')}}</label>
                                    <div class="controls">
                                        <input type="text" class="form-control" id="stock_reference">
                                    </div>
                                </div>
                                <div class="clear"></div>
                                <div class="form-group col-xs-12">
                                    <button class="btn btn-primary"
                                            id="create_stock">{{ __('form.add_stock') }}</button>
                                </div>
                            @endif
                            <div class="col-md-12">
                                <label class="control-label">{{ __('purchase.receipt_history') }}</label>
                                <table class="table table-bordered">
                                    <thead>
                                    <tr style="font-size: 12px;">
                                        <th>{{__('stock_movement.date')}}</th>
                                        <th>{{__('stock_movement.quantity')}}</th>
                                        <th>{{__('stock_movement.reference')}}</th>
                                        <th>{{__('common.warehouse')}}</th>
                                        <th>{{__('common.storage')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($stock_movement->count())
                                        @foreach($stock_movement as $item)
                                            <tr>
                                                <td>{{ $item->date }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ $item->reference }}</td>
                                                <td>{{ $item->storage->warehouse->name }}</td>
                                                <td>{{ $item->storage->location }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="form-group col-xs-12">
            <div class="controls">
                <a href="{{ route($type.'.index') }}" class="btn btn-danger"><i
                            class="fa fa-times"></i> {{__('table.back')}}</a>
                <a href="javascript:void(0)" class="btn btn-primary" id="prev_tab"><i
                            class="fa fa-chevron-circle-left"></i> {{__('tab.back')}}</a>
                <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> {{__('table.ok')}}
                </button>
                <a href="javascript:void(0)" class="btn btn-primary" id="next_tab">{{__('tab.next')}} <i
                            class="fa fa-chevron-circle-right"></i></a>
                @if(isset($purchase))
                    @include('layouts._history', ['model' => $purchase])
                @endif
            </div>
        </div>
        <!-- ./ form actions -->

        {!! Form::close() !!}
    </div>
</div>

@section('scripts')
    @include('user.purchase._script')
@endsection