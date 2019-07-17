@extends('layouts.app')

@section('css')
@stop

@section('content')
    <div class="container">

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                {{ $error }}<br/>
            @endforeach
        @endif

        <div class="row justify-content-center">
            <div class="col-md-12">

                @yield('form-open')
                <div class="form-group row">
                    <label for="title" class="col-4 col-form-label">Имя</label>
                    <div class="col-8">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fa fa-address-card"></i>
                                </div>
                            </div>
                            <input id="name" name="name" type="text" class="form-control" value="{{ $category->name ?? old('name') ?? '' }}">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="hint" class="col-4 col-form-label">Краткое описание</label>
                    <div class="col-8">
                        <textarea id="hint" name="hint" cols="40" rows="5" class="form-control">{{ $category->hint ?? old('hint') ?? '' }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="offset-4 col-8">
                        <button name="submit" type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </div>
                {{ csrf_field() }}
                </form>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
@stop