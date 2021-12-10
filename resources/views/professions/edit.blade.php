@extends('layout')

@section('title', 'Editar profesión')

@section('content')
    @card
        @slot('header', 'Editar profesión')

        @include('shared._errors')

        <form action="{{ route('profession.update', $profession) }}" method="POST">
            {{ method_field('PUT') }}

            @include('professions._fields')

            <div class="form-group mt-4">
                <button type="submit">Actualizar profesión</button>
                <a href="{{ route('professions.index') }}" class="btn btn-link">Regresar al listado de profesións</a>
            </div>
        </form>
    @endcard
@endsection
