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
                        <th>{{ __('category.name') }}</th>
                        <th>{{ __('category.parent') }}</th>
                        <th>{{ __('category.code') }}</th>
                        <th>{{ __('table.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if(count($category))
                            @foreach($category as $item)
                            <tr>
                                <td><input type="checkbox" class="check" data-id="{{$item->id}}"></td>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->parent_id ? $item->parent->name : 'Root Category' }}</td>
                                <td>{{ $item->code }}</td>
                                <td>
                                    <a href="{{ url('quantri/category/' . $item->id . '/edit' ) }}"  title="{{ __('table.edit') }}"><i class="fa fa-fw fa-pencil text-warning"></i> </a>
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
            <div class="pull-right">{{ $category->appends(request()->all())->links() }}</div>
        </div>
    </div>
@stop

{{-- Scripts --}}
@section('scripts')
@stop
