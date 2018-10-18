<table>
	<tr>
		<td style="padding: 10px 0">{{__('table.image_title')}}</td>
		<td style="padding: 10px 0">
			<input type="text" name="img_title" class="form-control">
		</td>
	</tr>
	<tr>
		<td style="padding: 10px 0">{{__('table.image_alt')}}</td>
		<td style="padding: 10px 0">
			<input type="text" name="img_alt" class="form-control">
		</td>
	</tr>
	@if($page == 'image')
	<tr>
		<td style="padding: 10px 0">{{__('table.image_path')}}</td>
		<td style="padding: 10px 0">
			<select name="img_path" class="form-control">
				<option value="banner">banner</option>
				<option value="production">production</option>
				<option value="products">products</option>
				<option value="suppliers">suppliers</option>
			</select>
		</td>
	</tr>
	@endif
</table>