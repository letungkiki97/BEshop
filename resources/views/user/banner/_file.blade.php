<tr class="remove_tr">
	<td>
		<input type="hidden" name="images[{{ $image->id }}]" value="'+data.id+'">
		<a href="{{ url('uploads').'/'.$image->path . '/' . $image->name }}" target="_blank" style="margin-bottom: 10px; display: inline-block;"><img src="{{ url('uploads').'/'.$image->path.'/thumb_' . $image->name }}"></a>
		<p><label>Title:</label> {{ $image->title }}</p>
		<p><label>Alt:</label> {{ $image->alt }}</p>
	</td>
	<td>
		<div class="form-group col-xs-12">
			<label class="control-label">Text</label>
			<input type="text" name="text_text[{{ $image->id }}]" class="form-control" value="{{ isset($image) && $image->pivot ? $image->pivot->text_text : '' }}">
		</div>
		<div class="clear"></div>
		<div class="form-group col-xs-4">
			<label class="control-label">Color</label>
			<input type="text" name="text_color[{{ $image->id }}]" class="form-control jscolor" value="{{ isset($image) && $image->pivot ? $image->pivot->text_color : '' }}">
		</div>
		<div class="form-group col-xs-4">
			<label class="control-label">Font</label>
			<select type="text" name="text_font[{{ $image->id }}]" class="form-control">
				@foreach($font as $f)
				<option value="{{ $f }}" {{ isset($image) && $image->pivot && $image->pivot->text_font == $f ? 'selected' : '' }}>{{ $f }}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group col-xs-4">
			<label class="control-label">Font size</label>
			<input type="text" name="text_size[{{ $image->id }}]" class="form-control" value="{{ isset($image) && $image->pivot ? $image->pivot->text_size : '' }}">
		</div>
		<div class="clear"></div>
		<div class="form-group col-xs-3">
			<label class="control-label">Left</label>
			<input type="text" name="text_left[{{ $image->id }}]" class="form-control" value="{{ isset($image) && $image->pivot ? $image->pivot->text_left : '' }}">
		</div>
		<div class="form-group col-xs-3">
			<label class="control-label">Top</label>
			<input type="text" name="text_top[{{ $image->id }}]" class="form-control" value="{{ isset($image) && $image->pivot ? $image->pivot->text_top : '' }}">
		</div>
		<div class="form-group col-xs-3">
			<label class="control-label">Right</label>
			<input type="text" name="text_right[{{ $image->id }}]" class="form-control" value="{{ isset($image) && $image->pivot ? $image->pivot->text_right : '' }}">
		</div>
		<div class="form-group col-xs-3">
			<label class="control-label">Bottom</label>
			<input type="text" name="text_bottom[{{ $image->id }}]" class="form-control" value="{{ isset($image) && $image->pivot ? $image->pivot->text_bottom : '' }}">
		</div>
	</td>
	<td>
		<div class="form-group col-xs-12">
			<label class="control-label">Text</label>
			<input type="text" name="button_text[{{ $image->id }}]" class="form-control" value="{{ isset($image) && $image->pivot ? $image->pivot->button_text : '' }}">
		</div>
		<div class="clear"></div>
		<div class="form-group col-xs-4">
			<label class="control-label">Color</label>
			<input type="text" name="button_color[{{ $image->id }}]" class="form-control jscolor" value="{{ isset($image) && $image->pivot ? $image->pivot->button_color : '' }}">
		</div>
		<div class="form-group col-xs-4">
			<label class="control-label">Font</label>
			<select type="text" name="button_font[{{ $image->id }}]" class="form-control">
				@foreach($font as $f)
				<option value="{{ $f }}" {{ isset($image) && $image->pivot && $image->pivot->button_font == $f ? 'selected' : '' }}>{{ $f }}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group col-xs-4">
			<label class="control-label">Font size</label>
			<input type="text" name="button_size[{{ $image->id }}]" class="form-control" value="{{ isset($image) && $image->pivot ? $image->pivot->button_size : '' }}">
		</div>
		<div class="clear"></div>
		<div class="form-group col-xs-3">
			<label class="control-label">Left</label>
			<input type="text" name="button_left[{{ $image->id }}]" class="form-control" value="{{ isset($image) && $image->pivot ? $image->pivot->button_left : '' }}">
		</div>
		<div class="form-group col-xs-3">
			<label class="control-label">Top</label>
			<input type="text" name="button_top[{{ $image->id }}]" class="form-control" value="{{ isset($image) && $image->pivot ? $image->pivot->button_top : '' }}">
		</div>
		<div class="form-group col-xs-3">
			<label class="control-label">Right</label>
			<input type="text" name="button_right[{{ $image->id }}]" class="form-control" value="{{ isset($image) && $image->pivot ? $image->pivot->button_right : '' }}">
		</div>
		<div class="form-group col-xs-3">
			<label class="control-label">Bottom</label>
			<input type="text" name="button_bottom[{{ $image->id }}]" class="form-control" value="{{ isset($image) && $image->pivot ? $image->pivot->button_bottom : '' }}">
		</div>
		<div class="clear"></div>
		<div class="form-group col-xs-8">
			<label class="control-label">Link</label>
			<input type="text" name="link[{{ $image->id }}]" class="form-control" value="{{ isset($image) && $image->pivot ? $image->pivot->link : '' }}">
		</div>
		<div class="form-group col-xs-4">
			<label class="control-label">Background</label>
			<input type="text" name="button_background[{{ $image->id }}]" class="form-control jscolor" value="{{ isset($image) && $image->pivot ? $image->pivot->button_background : '' }}">
		</div>
	</td>
	<td>
		<a href="javascript:void(0)" class="up"><i class="fa fa-fw fa-arrow-up fa-lg text-warning"></i></a>
		<a href="javascript:void(0)" class="down"><i class="fa fa-fw fa-arrow-down fa-lg text-primary"></i></a>
		<a href="javascript:void(0)" class="remove"><i class="fa fa-fw fa-times fa-lg text-danger"></i></a>
	</td>
</tr>