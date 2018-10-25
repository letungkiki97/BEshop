@extends('frontend.layouts.master')
@section('title', 'Về chúng tôi')
@section('Content')
<div id="PageContainer" class="is-moved-by-drawer">
   <main class="main-content" role="main">
      <section id="page-wrapper">
         <div class="wrapper">
				{!!@Settings::get('long_description2')!!} 
         </div>
      </section>
   </main>
</div>
@endsection