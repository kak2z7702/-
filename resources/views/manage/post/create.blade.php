@extends('manage.post.template')


@section('form-open')
    <form method="POST" action="{{ route('post.store') }}">
@endsection
