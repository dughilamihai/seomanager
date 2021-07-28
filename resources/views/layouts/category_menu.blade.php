<h2>Categories</h2>
@foreach($categories as $category)
<div class="tag">
    <a href="{{ route('category.show', $category->slug) }}">{{$category->name}}</a>
</div>
@endforeach