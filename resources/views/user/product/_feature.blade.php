@if(count($category_feature))
@foreach($category_feature as $k => $f)
	<div class="form-group col-xs-12">
	{!! Form::label('feature', $f->name . ' (' . $f->type . ')', array('class' => 'control-label')) !!}
		<div class="controls">
			@php
				switch ($f->type) {
					case 'Short text':
						@endphp
						{!! Form::text('feature['.$f->id.']', isset($product_feature[$k]) ? $product_feature[$k]->value : null, array('class' => 'form-control')) !!}
						@php
						break;

					case 'Long text':
						@endphp
						{!! Form::textArea('feature['.$f->id.']', isset($product_feature[$k]) ? $product_feature[$k]->value : null, array('class' => 'form-control')) !!}
						@php
						break;

					case 'Decimal':
						@endphp
						{!! Form::text('feature['.$f->id.']', isset($product_feature[$k]) ? $product_feature[$k]->value : null, array('class' => 'form-control number2')) !!}
						@php
						break;

					case 'Number':
						@endphp
						{!! Form::text('feature['.$f->id.']', isset($product_feature[$k]) ? $product_feature[$k]->value : null, array('class' => 'form-control number')) !!}
						@php
						break;

					case 'Checkbox':
						@endphp
						{!! Form::checkbox('feature['.$f->id.']', 1, isset($product_feature[$k]) , array('class' => 'check-box')) !!}
						@php
						break;

					case 'Percent':
						@endphp
						{!! Form::number('feature['.$f->id.']', isset($product_feature[$k]) ? $product_feature[$k]->value : null, array('class' => 'form-control', 'min' => 0, 'max' => 100)) !!}
						@php
						break;

					case 'Multi select':
						$select_list = explode(',', $f->value);
						$selected = isset($product_feature[$k]->value) ? explode(',', $product_feature[$k]->value) : [];
						@endphp
						<select name="feature[{{$f->id}}][]" class="form-control select2" multiple>
							@foreach($select_list as $l)
							<option value="{{$l}}" {{in_array($l, $selected) ? 'selected' : ''}}>{{$l}}</option>
							@endforeach
						</select>
						@php
						break;

					case 'Product property'
						@endphp
						<select name="feature[{{$f->id}}]" class="property_feature form-control" data-id="{{ $category_feature[$f->id]->value }}" {{ isset($property_main[$k]->value) ? 'disabled' : '' }}>
							@if (isset($property_main[$f->id]))
							<option value="{{$property_main[$f->id]->id}}" selected>{{ $property_main[$f->id]->value }}</option>
							@endif
							@if (isset($product_feature[$f->id]))
							<option value="{{$product_feature[$f->id]->value}}" selected>{{ $property_feature[$f->id]->value }}</option>
							@endif
						</select>
						@php
					
					default:
						break;
				}
			@endphp
		</div>
	</div>
	<div class="clear"></div>
@endforeach
@endif