<div class="row toolbox">
    <div class="col-sm-6">
            <label class="toolbox-label">{{ __('table.show') }} 
            <select name="data_length" aria-controls="data" class="form-control input-sm">
                <option value="10" {{ request()->length == 10 ? 'selected' : '' }}>10</option>
                <option value="25" {{ request()->length == 25 ? 'selected' : '' }}>25</option>
                <option value="50" {{ request()->length == 50 || !request()->length ? 'selected' : '' }}>50</option>
                <option value="100" {{ request()->length == 100 ? 'selected' : '' }}>100</option>
            </select> {{ __('table.entry') }}</label>
    </div>
    <div class="col-sm-6">
        <form action="" id="search-form">
            @if(isset($search_status) && $search_status)
                <input type="hidden" name="status" value="{{ $search_status }}">
            @endif
            <label>{{ __('table.search') }}:<input type="search" name="search" class="form-control input-sm" value="{{ request()->search }}" aria-controls="data"></label>
        </form>
    </div>
</div>