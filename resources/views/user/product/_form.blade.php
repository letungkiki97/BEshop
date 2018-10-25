@section('styles')
    <style>
        #url td {
            padding: 10px;
        }
        .ajax-file-upload-filename{
            display: none;
        }
        .text-transform {
            text-transform: uppercase;
        }
    </style>
@endsection

@if (session('status'))
    <div class="alert alert-success">{{ session('status') }} <a href="#" class="close" data-dismiss="alert">&times;</a></div>
@endif
<div class="panel panel-primary">
    <div class="panel-body">
        @if (isset($product))
            {!! Form::model($product, array('url' => 'quantri/'.$type . '/' . $product->id, 'method' => 'put', 'files'=> true)) !!}
        @else
            {!! Form::open(array('url' => 'quantri/'.$type, 'method' => 'post', 'files'=> true)) !!}
        @endif
        <div class="nav-tabs-custom" id="setting_tabs">
            <ul class="nav nav-tabs" style="display:list-item;">
                <li id="tab_general" class="active">
                    <a href="#general" data-toggle="tab" title="{{ __('tab.information') }}">
                        <i class="material-icons md-24">info</i>
                    </a>
                </li>
                <li id="tab_config">
                    <a href="#config" data-toggle="tab" title="{{ __('tab.config') }}">
                        <i class="material-icons md-24">settings</i>
                    </a>
                </li>
                @if(isset($user_data) && ($user_data->hasAccess(['product.price']) || $user_data->inRole('admin')))
                <li id="tab_price">
                    <a href="#price" data-toggle="tab" title="{{ __('tab.price') }}">
                        <i class="material-icons md-24">attach_money</i>
                    </a>
                </li>
                @endif
                <li id="tab_file">
                    <a href="#file" data-toggle="tab" title="{{ __('tab.file') }}">
                        <i class="material-icons md-24">attach_file</i>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="general">
                    <div class="form-group col-xs-6 required {{ $errors->has('product_name') ? 'has-error' : '' }}">
                        {!! Form::label('product_name', __('product.product_name'), array('class' => 'control-label required')) !!}
                        <div class="controls">
                            {!! Form::text('product_name', null, array('class' => 'form-control', 'required' => true, 'style' => 'text-transform:uppercase')) !!}
                            <span class="help-block">{{ $errors->first('product_name', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group col-xs-6 required {{ $errors->has('category_id') ? 'has-error' : '' }}">
                        {!! Form::label('category_id', __('product.category'), array('class' => 'control-label required')) !!}
                        <div class="controls">
                            @if (isset($product) && $product->main_sku != '')
                                <select class="form-control select2" name="category_id" id="category_id">
                                    @foreach($category as $k => $v)
                                        <option {{(isset($product->category_id) && $product->category_id == $k) ? 'selected ' : 'disabled'}} value="{{$k}}">{{$v}}</option>
                                    @endforeach
                                </select>
                            @else
                                {!! Form::select('category_id', $category, null, array('id'=>'category_id','class' => 'form-control select2', 'required' => true)) !!}
                            @endif
                            <span class="help-block">{{ $errors->first('category_id', ':message') }}</span>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="form-group col-xs-12 {{ $errors->has('description') ? 'has-error' : '' }}">
                        {!! Form::label('description', __('product.description'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::textarea('description', null, array('class' => 'form-control resize_vertical')) !!}
                            <span class="help-block">{{ $errors->first('description', ':message') }}</span>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="form-group col-xs-12">
                        <h4 style="font-weight: bold">{{ __('product.feature') }}
                            @if(empty($product->id))
                                <span style="color: #FD9883">
                                     ! Save product to see full list of features
                                </span>
                            @endif
                        </h4>
                    </div>
                    <div class="form-group col-xs-6 {{ $errors->has('product_color') ? 'has-error' : '' }}">
                        {!! Form::label('product_color', __('product.product_color'), array('class' => 'control-label')) !!}
                        <select name="color[]" class="form-control select2 feature" multiple="true">
                            @foreach ($colors as $k => $v)
                                <option value="{{$k}}" {{ isset($product_color) && in_array($k, $product_color) ? 'selected' : '' }}>{{$v}}</option>
                            @endforeach
                        </select>
                        <span class="help-block">{{ $errors->first('color_id', ':message') }}</span>
                    </div>
                    <div class="form-group col-xs-6 required {{ $errors->has('catego') ? 'has-error' : '' }}">
                        {!! Form::label('catego', __('product.catego'), array('class' => 'control-label required')) !!}
                        <div class="controls">
                            {!! Form::select('catego', $catego, isset($product) ? $product->catego : 1, ['class' => 'form-control']) !!}
                            <span class="help-block">{{ $errors->first('catego', ':message') }}</span>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="form-group col-xs-3 {{ $errors->has('product_weight') ? 'has-error' : '' }}">
                        {!! Form::label('product_weight', __('product.product_weight'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::text('product_weight', null, array('class' => 'form-control number')) !!}
                            <span class="help-block">{{ $errors->first('product_weight', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group col-xs-3 {{ $errors->has('product_length') ? 'has-error' : '' }}">
                        {!! Form::label('product_length', __('product.product_length'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::text('product_length', null, array('class' => 'form-control number')) !!}
                            <span class="help-block">{{ $errors->first('product_length', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group col-xs-3 {{ $errors->has('product_width') ? 'has-error' : '' }}">
                        {!! Form::label('product_width', __('product.product_width'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::text('product_width', null, array('class' => 'form-control number')) !!}
                            <span class="help-block">{{ $errors->first('product_width', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group col-xs-3 {{ $errors->has('product_depth') ? 'has-error' : '' }}">
                        {!! Form::label('product_depth', __('product.product_depth'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::text('product_depth', null, array('class' => 'form-control number')) !!}
                            <span class="help-block">{{ $errors->first('product_depth', ':message') }}</span>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="form-group col-xs-12 {{ $errors->has('long_description') ? 'has-error' : '' }}">
                        {!! Form::label('long_description', __('product.long_description'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::textarea('long_description', null, array('class' => 'form-control', 'id' => 'editor')) !!}
                            <span class="help-block">{{ $errors->first('long_description', ':message') }}</span>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="form-group col-xs-6 required {{ $errors->has('published') ? 'has-error' : '' }}">
                        {!! Form::label('published', __('product.published'), array('class' => 'control-label required')) !!}
                        <div class="controls">
                            {!! Form::select('published', $toggle, isset($product) ? $product->published : 0, ['class' => 'form-control', 'disabled' => !$user_data->inRole('admin') && !$user_data->hasAccess(['product.change_publish']) ? true : false ]) !!}
                            <span class="help-block">{{ $errors->first('published', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group col-xs-6 required {{ $errors->has('status') ? 'has-error' : '' }}">
                        {!! Form::label('status', __('product.status'), array('class' => 'control-label required')) !!}
                        <div class="controls">
                            {!! Form::select('status', $status, isset($product) ? $product->status : 1, ['class' => 'form-control', 'disabled' => !$user_data->inRole('admin') && !$user_data->hasAccess(['product.change_status']) ? true : false]) !!}
                            <span class="help-block">{{ $errors->first('status', ':message') }}</span>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="tab-pane" id="config">
                    <div class="form-group col-xs-6 {{ $errors->has('main_sku') ? 'has-error' : '' }}">
                        {!! Form::label('main_sku', __('product.main_sku'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::text('main_sku', null, array('class' => 'form-control')) !!}
                            <span class="help-block">{{ $errors->first('main_sku', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group col-xs-6 {{ $errors->has('product_sku') ? 'has-error' : '' }}">
                        {!! Form::label('product_sku', __('product.product_sku'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::text('product_sku', null, array('class' => 'form-control', 'readonly')) !!}
                            <span class="help-block">{{ $errors->first('product_sku', ':message') }}</span>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="form-group col-xs-6 {{ $errors->has('product_url') ? 'has-error' : '' }}">
                        {!! Form::label('product_url', __('product.product_url'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::text('product_url', null, array('class' => 'form-control')) !!}
                            <span class="help-block">{{ $errors->first('product_url', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group col-xs-6 {{ $errors->has('slug') ? 'has-error' : '' }}">
                        {!! Form::label('slug', __('product.slug'), array('class' => 'control-label required')) !!}
                        <div class="controls">
                            {!! Form::text('slug', null, array('class' => 'form-control', 'required' => true,)) !!}
                            <span class="help-block">{{ $errors->first('slug', ':message') }}</span>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="form-group col-xs-6 {{ $errors->has('meta_title') ? 'has-error' : '' }}">
                        {!! Form::label('meta_title', __('product.meta_title'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::text('meta_title', null, array('class' => 'form-control')) !!}
                            <span class="help-block">{{ $errors->first('meta_title', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group col-xs-6 {{ $errors->has('meta_description') ? 'has-error' : '' }}">
                        {!! Form::label('meta_description', __('product.meta_description'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::text('meta_description', null, array('class' => 'form-control')) !!}
                            <span class="help-block">{{ $errors->first('meta_description', ':message') }}</span>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="form-group col-xs-6 {{ $errors->has('focus_keyword') ? 'has-error' : '' }}">
                        {!! Form::label('focus_keyword', __('product.focus_keyword'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::text('focus_keyword', null, array('class' => 'form-control')) !!}
                            <span class="help-block">{{ $errors->first('focus_keyword', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group col-xs-6 required {{ $errors->has('made_to_order') ? 'has-error' : '' }}">
                        {!! Form::label('made_to_order', __('product.made_to_order'), array('class' => 'control-label required')) !!}
                        <div class="controls">
                            {!! Form::select('made_to_order', $toggle, isset($product) ? $product->made_to_order : 0, ['class' => 'form-control']) !!}
                            <span class="help-block">{{ $errors->first('made_to_order', ':message') }}</span>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
                @if(isset($user_data) && ($user_data->hasAccess(['product.price']) || $user_data->inRole('admin')))
                <div class="tab-pane" id="price">
                    <div class="form-group col-xs-12 required {{ $errors->has('sale_price') ? 'has-error' : '' }}">
                        {!! Form::label('sale_price', __('product.sale_price'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::text('sale_price', null, array('class' => 'form-control professional promotion number')) !!}
                            <span class="help-block">{{ $errors->first('sale_price', ':message') }}</span>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="form-group col-xs-6 {{ $errors->has('professional_price') ? 'has-error' : '' }}">
                        {!! Form::label('professional_price', __('product.professional_price'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::text('professional_price', null, array('class' => 'form-control number')) !!}
                            <span class="help-block">{{ $errors->first('professional_price', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group col-xs-6">
                        {!! Form::label('professional_price_percent', __('product.professional_price') . ' ' . __('table.discount') . ' (%)', array('class' => 'control-label')) !!}
                        <div class="controls">
                            <input type="number" id="professional_price_percent" class="form-control professional" step="1" min="0" max="99">
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="form-group col-xs-6 {{ $errors->has('promotion_price') ? 'has-error' : '' }}">
                        {!! Form::label('promotion_price', __('product.promotion_price'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::text('promotion_price', null, array('class' => 'form-control number')) !!}
                            <span class="help-block">{{ $errors->first('promotion_price', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group col-xs-6">
                        {!! Form::label('promotion_price_percent', __('product.promotion_price') . ' ' . __('table.discount') . ' (%)', array('class' => 'control-label')) !!}
                        <div class="controls">
                            <input type="number" id="promotion_price_percent" class="form-control promotion" step="1" min="0" max="99">
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="form-group col-xs-6 {{ $errors->has('promotion_from') ? 'has-error' : '' }}">
                        {!! Form::label('promotion_from', __('product.promotion_from'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::text('promotion_from', null, array('class' => 'form-control date')) !!}
                            <span class="help-block">{{ $errors->first('promotion_from', ':message') }}</span>
                        </div>
                    </div>
                    <div class="form-group col-xs-6 {{ $errors->has('promotion_to') ? 'has-error' : '' }}">
                        {!! Form::label('promotion_to', __('product.promotion_to'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            {!! Form::text('promotion_to', null, array('class' => 'form-control date')) !!}
                            <span class="help-block">{{ $errors->first('promotion_to', ':message') }}</span>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
                @endif
                <div class="tab-pane" id="file">
                    <div class="form-group col-xs-12">
                        <label class="control-label">{{__('product.gallery')}}
                            <span>{!! $errors->first('gallery') !!}</span></label>
                        <table class="table table-bordered">
                            <thead>
                            <tr style="font-size: 12px;">
                                <th>{{__('table.preview')}}</th>
                                <th>{{__('table.image_name')}}</th>
                                <th>{{__('table.image_title')}}</th>
                                <th>{{__('table.image_alt')}}</th>
                                <th>{{__('product.main_image')}}</th>
                                <th>{{__('product.hover_image')}}</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody id="product_image">
                            @if(isset($product) && $product->parent && $product->parent->images)
                                @foreach($product->parent->images as $item)
                                    @if(!in_array($item->id, $unlink))
                                    <tr class="remove_tr">
                                        <input type="hidden" name="parent_gallery[]" value="{{ $item->id }}">
                                        <td>
                                            <div style="margin-bottom: 5px; font-weight: bold">({{ $product->main_sku }})</div>
                                            <a href="{{ url('uploads/products/thumb_' . $item->name) }}" target="_blank"><img src="{{ url('uploads/products/thumb_'). $item->name }}"></a>
                                        </td>
                                        <td><a href="{{ url('uploads/products/' . $item->name) }}" target="_blank">{{ $item->name }}</a></td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->alt }}</td>
                                        <td><input type="radio" class="product_image" name="product_image" value="{{ $item->id }}" {{ $item->id == $product->product_image ? 'checked' : '' }}><br></td>
                                        <td><input type="radio" class="hover_image" name="hover_image" value="{{ $item->id }}" {{ $item->id == $product->hover_image ? 'checked' : '' }}><br></td>
                                        <td><a href="javascript:void(0)" class="removeclass"><i class="fa fa-fw fa-times fa-lg text-danger"></i></a></td>
                                    </tr>
                                    @endif
                                @endforeach
                            @endif
                            @if (isset($productGallery))
                                @foreach ($productGallery as $item)
                                    <tr class="remove_tr">
                                        <input type="hidden" name="image_gallery[]" value="{{ $item->id }}">
                                        <td><a href="{{ url('uploads/products/thumb_' . $item->name) }}" target="_blank"><img src="{{ url('uploads/products/thumb_'. $item->name) }}"></a></td>
                                        <td><a href="{{ url('uploads/products/' . $item->name) }}" target="_blank">{{ $item->name }}</a></td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->alt }}</td>
                                        <td><input type="radio" class="product_image" name="product_image" value="{{ $item->id }}" {{ $item->id == $product->product_image ? 'checked' : '' }}><br></td>
                                        <td><input type="radio" class="hover_image" name="hover_image" value="{{ $item->id }}" {{ $item->id == $product->hover_image ? 'checked' : '' }}><br></td>
                                        <td><a href="javascript:void(0)" class="removeclass"><i class="fa fa-fw fa-times fa-lg text-danger"></i></a></td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#galleryModal">{{__('form.upload_image')}}</button>
                    </div>
                    <hr>
                    <div class="form-group col-xs-12 required {{ $errors->has('file_3d_file.*') ? 'has-error' : '' }}">
                        {!! Form::label('file_3d', __('product.file_3d'), array('class' => 'control-label')) !!}
                        <div class="controls">
                            @if (isset($product) && $product->file_3d)
                                @php
                                $list_file = explode(',', $product->file_3d);
                                @endphp
                                <table class="table table-bordered">
                                    <thead>
                                    <tr style="font-size: 12px;">
                                        <th>{{__('table.file_name')}}</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($list_file as $val)
                                        <tr>
                                            <td>{{ $val }}</td>
                                            <td><a href="javascript:void(0)" title="{{ __('table.delete') }}" class="removeclass"><i class="fa fa-fw fa-times fa-lg text-danger"></i></a></td> 
                                            <input type="hidden" name="old_file[]" value="{{$val}}">
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                            <input name="file_3d_file[]" type="file" id="file_3d" multiple>
                            <span class="help-block">{{ $errors->first('file_3d_file.*', ':message') }}</span>
                        </div>
                    </div>
                </div>
                <!-- Form Actions -->
                <div class="form-group col-xs-12">
                    <div class="controls">
                        <a href="{{ route($type.'.index') }}" class="btn btn-danger"><i
                                    class="fa fa-times"></i> {{__('table.back')}}</a>
                        <a href="javascript:void(0)" class="btn btn-primary" id="prev_tab"><i class="fa fa-chevron-circle-left"></i> {{__('tab.back')}}</a>
                        <button type="submit" class="btn btn-success"><i
                                    class="fa fa-check-square-o"></i> {{__('table.ok')}}</button>
                        <a href="javascript:void(0)" class="btn btn-primary" id="next_tab">{{__('tab.next')}} <i class="fa fa-chevron-circle-right"></i></a>
                        @if(isset($product))
                        @include('layouts._history', ['model' => $product])
                        @endif
                    </div>
                </div>
                <!-- ./ form actions -->
            </div>
        </div>
        {!! Form::close() !!}
        <div id="galleryModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">{{ __('product.image_gallery') }}</h4>
                    </div>
                    <div class="modal-body">
                        <div id="fileuploader"></div>
                        <table id="url">
                            <tr>
                                <td colspan="2"><h4>{{ __('product.upload_from_url') }}</h4></td>
                            </tr>
                            <tr>
                                <td><label>{{__('table.image_url')}}</label></td>
                                <td><input type="text" id="url-upload" size="35"></td>
                            </tr>
                            <tr>
                                <td><label>{{__('table.image_title')}}</label></td>
                                <td><input type="text" id="url-title" size="35"></td>
                            </tr>
                            <tr>
                                <td><label>{{__('table.image_alt')}}</label></td>
                                <td><input type="text" id="url-alt" size="35"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal" id="gallery_close">{{ __('form.start_upload') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="editModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <input type="hidden" value="" class="img_src">
            <form id="editForm" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{ __('image.title') }}</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group required">
                        <lable>{{ __('image.name') }} *</lable>
                        <div class="controls">
                            <input type="text" class="form-control txt_img img_name">
                            <span class="helper-block">Please enter a value</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <lable>{{ __('image.title_img') }}</lable>
                        <div class="controls">
                            <input type="text" class="form-control txt_img img_title">
                        </div>
                    </div>
                    <div class="form-group">
                        <lable>{{ __('image.alt') }}</lable>
                        <div class="controls">
                            <input type="text" class="form-control txt_img img_alt">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary submit-edit">{{__('table.ok')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@section('scripts')
    @include('user.product._script')
@endsection
