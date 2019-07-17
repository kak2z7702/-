@extends('manage.post.template')


@section('form-open')
    <form method="POST" action="{{ route('post.update', ['post'=>$post->id]) }}">
        <input type="hidden" name="id" value="{{ $post->id }}">
@endsection
