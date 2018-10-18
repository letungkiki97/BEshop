<ol class="dd-list">
    @foreach($data as $d)
        <li class="dd-item dd3-item" data-id="{{ $d->id }}">
        	<div class="dd-handle dd3-handle"></div>
            <div class="dd3-content">
                <span class="name">{{ $d->title }}</span>
                @if(!$d->child->count() && ($user_data->hasAccess([$type.'.delete']) || $user_data->inRole('admin')))
                <a href="javascript:void(0)" class="pull-right text-danger delete_item" title="{{ __('table.delete') }}" data-id="{{ $d->id }}" data-name="{{ $d->title }}"><i class="fa fa-times"></i></a>
                @endif
                <a href="javascript:void(0)" class="pull-right text-warning edit" title="{{ __('table.edit') }}" data-id="{{ $d->id }}" data-toggle="modal" data-target="#edit-modal"><i class="fa fa-pencil"></i></a>
            </div>
            @if($d->child->count())
                @include('user.menu._nestable', ['data' => $d->child])
            @endif
        </li>
    @endforeach
</ol>