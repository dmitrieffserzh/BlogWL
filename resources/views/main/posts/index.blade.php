@extends('main.index')

@section('content')

    <section class="section">
        @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if ($posts)

            @foreach ($posts as $post)
                <a href="{{ route('blog.url', implode("/", $post->category->ancestorsAndSelf($post->category_id)->pluck('slug')->all()).'/'.$post->slug) }}">{{ $post->title }}</a>

            @endforeach
            @endif
        <div class="row">
{{--            @include('main.content.news.partials.item', ['posts' => $posts])--}}
        </div>

        {!! $posts->links() !!}

    </section>

@endsection
