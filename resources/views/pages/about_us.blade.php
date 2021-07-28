@extends ('layouts.master')

@section ('meta')
    <meta charset="UTF-8">
    <title>@lang('homepage.meta.title')</title>
    <meta name="description" content="@lang('homepage.meta.description')">
    <meta name="robots" content="index, follow">
    <meta name="language" content="en"/>
    <meta name="copyright" content="seolist.top"/>
@endsection

@section ('content')
<div class="flex_card">
    <div class="site">
         <h2>{{$page->title}}</h2>
        {!!$page->content!!}
    </div>    
</div>

@endsection