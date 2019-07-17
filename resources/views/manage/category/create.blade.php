@extends('manage.category.template')

@section('form-open')
    <form method="POST" action="{{ route('category.store') }}">
@endsection
