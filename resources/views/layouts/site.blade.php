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
<h2>Categories</h2>
@foreach($categories as $category)
<div class="tag">
    <a href="{{ route('category.show', $category->slug) }}">{{$category->name}}</a>
</div>
@endforeach
<div class="flex_card">
    <div class="site">
        <div class="name">
            <h2>{{$site->name}} - {{$site->category->name}} / {{$site->website_type->name}}</h2>
        </div>
        <div class="description">{!!$site->description!!}</div>
        <div class="tags">
            @if ($site->link_in_comments)
                <div class="site-tag">
                    @if ($site->link_in_comments == 0)
                        <i class="fas fa-link"></i> link in comments: <span class="red">Nofollow</span>
                    @else
                        <i class="fas fa-link"></i> link in comments: <span class="green">Dofollow</span>
                    @endif
                </div>
            @endif

            @if ($site->website_type->name == 'Directory')
                <div class="site-tag">
                    @if ($site->is_free)
                        <span class="red">PAID</span> directory
                    @else
                        <span class="green">FREE</span> directory
                    @endif
                </div>
            @endif

            @if ($site->price)
                <div class="site-tag">
                @switch($site->website_type->name)
                    @case('Blog')
                    Price for advertorial: <b>{{$site->price}}$</b>
                    @break

                    @case('Directory')
                    Price for submission: <b>{{$site->price}}$</b>
                    @break

                    @default
                    Price: </b>{{$site->price}}$</b>
                    @endswitch
                </div>
            @endif

            @if ($site->submitted_date)
                <div class="site-tag">
                @switch($site->website_type->name)
                    @case('Blog')
                    Submitted comment at: <b>{{$site->submitted_date}}</b>
                    @break

                    @case('Directory')
                    Submitted listing at: <b>{{$site->submitted_date}}</b>
                    @break

                    @default
                    Submitted at: </b>{{$site->submitted_date}}</b>
                    @endswitch
                </div>
            @endif

            @if ($site->approved_date)
                <div class="site-tag">
                @switch($site->website_type->name)
                    @case('Blog')
                    <span class="green">Approve comment at: <b>{{$site->approved_date}}</b></span>
                    @break

                    @case('Directory')
                    <span class="green">Approve listing at: <b>{{$site->approved_date}}</b></span>
                    @break

                    @default
                    <span class="green">Submitted at: </b>{{$site->approved_date}}</b></span>
                    @endswitch
                </div>
            @endif

        </div>
        <div class="visit"><button class="red-button btn-site" id="{{$site->id}}">VISIT SITE</button></div>
            <h3>Comments:</h3>
        @foreach ($comments as $comment)
            <div class="comment">
                <div class="comment_user">Posted by {{$comment->user->name}} at {{$comment->created_at->format('F Y')}}</a></div>
                <div class="comment_description">{!!$comment->comment!!}</div>
            </div>
        @endforeach
    </div>
</div>

@endsection

@section ('extra-script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
@endsection
