@extends('layouts.user')

{{-- Web site Title --}}
@section('title')
    {{ $title }}
@stop

{{-- Content --}}
@section('content')
    <div class="page-header clearfix">
        @include('layouts._action')
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
            @include('layouts._toolbox')
            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th><input type="checkbox" class="check"></th>
                        <th>{{ __('table.id') }}</th>
                        <th>{{ __('user.avatar') }}</th>
                        <th>{{ __('user.full_name') }}</th>
                        <th>{{ __('user.email') }}</th>
                        <th>{{ __('user.active') }}</th>
                        <th>{{ __('common.role') }}</th>
                        <th>{{ __('table.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if(count($member))
                            @foreach($member as $item)
                            <tr>
                                <td><input type="checkbox" class="check" data-id="{{$item->id}}"></td>
                                <td>{{ $item->id }}</td>
                                <td>
                                    @if($item->user_avatar)
                                        <img src="{{asset('uploads/avatar/thumb_') . $item->user_avatar}}" />
                                    @endif
                                </td>
                                <td>{{ $item->full_name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->status ? 'Yes' : 'No' }}</td>
                                <td>{{ $item->role()->first() ? $item->role()->first()->name : '--' }}</td>
                                <td>
                                    <a href="{{ url('user/' . $item->id . '/edit' ) }}"  title="{{ __('table.edit') }}"><i class="fa fa-fw fa-pencil text-warning"></i> </a>
                                    @if($user_data->hasAccess([$type.'.delete']) || $user_data->inRole('admin'))
                                    <a href="javascript:void(0)" class="delete_item" data-id="{{$item->id}}" title="{{ __('table.delete') }}"><i class="fa fa-fw fa-times text-danger"></i></a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td id="no-data"></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="pull-left">{{ $page_info }}</div>
            <div class="pull-right">{{ $member->appends(request()->all())->links() }}</div>
        </div>
    </div>

@stop

{{-- Scripts --}}
@section('scripts')
@stop