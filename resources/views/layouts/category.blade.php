@extends ('layouts.master')

@section ('meta')
    <title>@lang('homepage.meta.title')</title>

    <meta name="description" content="@lang('homepage.meta.description')">
    <meta property="og:url" content="{{ route('homepage') }}"/>
    <meta property="og:title" content="@lang('homepage.meta.title')"/>
    <meta property="og:description" content="@lang('homepage.meta.description')"/>
@endsection

@section ('content')

<div class="flex_card">
@foreach ($sites as $site)
    <div class="card">
        {{$site->url}}
    </div>
@endforeach
</div>

@endsection