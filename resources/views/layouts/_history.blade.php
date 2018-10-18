<span class="pull-right">
	@php
		$createdBy = $model->createdBy();
		$updatedBy = $model->updatedBy();
	@endphp
	@if($createdBy)
	{{ __('table.created_by') }}: <span style="font-weight: bold">{{ isset($createdBy->full_name) ? $createdBy->full_name : '' }}</span> ({{ $createdBy['time'] }})
    @endif
    @if($createdBy && $updatedBy)
    |
    @endif
    @if($updatedBy)
    {{ __('table.updated_by') }}: <span style="font-weight: bold">{{ isset($updatedBy->full_name) ? $updatedBy->full_name : '' }}</span> ({{ $updatedBy['time'] }})
    @endif
</span>