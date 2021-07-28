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
<h2>Categories</h2>
@foreach($categories as $category)
<div class="tag">
    <a href="{{ route('category.show', $category->slug) }}">{{$category->name}}</a>
</div>
@endforeach

<h2 class="clear">New sites</h2>
<div class="flex_card">
@foreach ($sites as $site)
    <div class="card">
        <div class="site_name"><a href="{{ route('site.show', $site->slug) }}">{{$site->name}}</a></div>
        <div class="site_description">{!! \Illuminate\Support\Str::limit($site->description, 100, '...') !!}</div>
    </div>
@endforeach
</div>

@endsection