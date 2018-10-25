@extends('frontend.layouts.master')
@section('title', 'Blog')
@section('Content')
<div class="container-mot" style="margin-left:20%; margin-right:20%;">
{!!@Settings::get('long_description1')!!} 
</div>
@endsection