<meta charset="UTF-8">
<title>
    {{@$title ? $title : 'CRM Admin'}}
</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

<meta id="token" name="token" value="{{ csrf_token() }}">
@if(Sentinel::check())
    <meta id="userId" name="userId" value="{{ $user_data->id }}">
@endif