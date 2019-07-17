@extends('manage.category.template')

@section('form-open')
    <form method="POST" action="{{ route('category.update', ['category'=>$category->id]) }}">
        <input type="hidden" name="id" value="{{ $category->id }}">
@endsection
