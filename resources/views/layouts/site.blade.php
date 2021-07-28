@extends ('layouts.master')

@section ('meta')

@if($site->meta_title)
    @php $meta_title = $site->meta_title;  @endphp
@else
    @php $meta_title = $site->name." SEO link"; @endphp
@endif

@if($site->meta_description)
    @php $meta_description = $site->meta_description;  @endphp
@else
    @php $meta_description = substr($site->description, 0, 160); @endphp
@endif

    <meta charset="UTF-8">
    <title>{{$meta_title}}</title>
    <meta name="description" content="{{$meta_description}}">
    <meta name="robots" content="index, follow">
    <meta name="language" content="en"/>
    <meta name="copyright" content="seolist.top"/>
@endsection

@section ('content')

<div class="flex_card">
    <div class="site">
        <div class="name">
            <h2>{{$site->name}}</h2>
        </div>
        <div class="description">{!!$site->description!!}</div>
        <div class="tags">
            <i class="fas fa-link"></i>
           
            @if ($site->is_dofollow)
                link in comments: <span class="red">Nofollow</span>
            @else
                link in comments: <span class="green">Dofollow</span>
            @endif            
        </div>
        <div class="visit"><button class="red-button btn-site" id="{{$site->id}}">VISIT SITE</button></div>
    </div>
</div>

@endsection

@section ('extra-script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
@endsection