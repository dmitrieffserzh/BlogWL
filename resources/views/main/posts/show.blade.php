@extends('main.layouts.main')

@section('content')

        <h1 class="h4">{{ $item->title}}</h1>
        {{--@include('main.components.user_info.user_info-mini', ['content'=>$item])--}}
        <a href="{{ route('blog.url', implode("/", $item->category->ancestorsAndSelf($item->category_id)->pluck('slug')->all())) }}" class="news-tile__category-title">{{$item->category->title}}</a>

        <div>{!! $item->content !!}</div>

        <div>
            {{--@include('main.components.com_count.com_count', ['content'=>$item])--}}
            {{--@include('main.components.views.view_count', ['content'=>$item])--}}
            {{--@include('main.components.likes.like', ['content'=>$item])--}}
        </div>

@endsection

@section('sidebar')
    SIDEBAR
@endsection