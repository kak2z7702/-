@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
            </div>
            <div class="col text-center">
                @sortablelink('created_at', 'Дата')
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <ul class="ul-reset">
                    <li>
                        <a href="{{ route('index') }}">
                            Все
                        </a>
                    </li>
                    @foreach($categories as $category)
                        <li>
                            <a href="{{ route('category.view', ['category' => $category->id]) }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach

                </ul>
            </div>
            <div class="col">
                <ul id="posts" class="ul-reset">
                    @foreach($posts as $post)
                        <li>
                            <p>
                                <a href="{{ route('post.view', ['post' => $post->id]) }}">
                                    {{ $post->title  }}
                                    <span class="time-box">{{ $post->created_at->formatLocalized('%d %B %Y, %H:%M') }}</span> от {{ $post->user->name }}
                                </a>
                            </p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col">
                {{ $posts->links('layouts.pagination') }}
            </div>
        </div>
    </div>
@endsection
