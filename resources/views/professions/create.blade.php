@extends('layout')

@section('title', 'Detalles de una profesión')

@section('content')
    @card
        @slot('header', 'Crear nueva profesión')

        @include('shared._errors')

        <form action="{{ route('professions.store') }}" method="POST">

            @include('professions._fields')

            <div class="form-group mt-4">
                <button type="submit">Crear profesión</button>
                <a href="{{ route('professions.index') }}" class="btn btn-link">Regresar al listado de profesiones</a>
            </div>
        </form>
    @endcard
@endsection
