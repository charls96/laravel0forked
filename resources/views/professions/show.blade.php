@extends('layout')

@section('title', 'Detalles de una profesión')

@section('content')
    <h1>Profesión #{{ $profession->id }}</h1>

    <p>Mostrando detalles de la profesión: {{ $profession->title }}</p>

    <p>
        <a href="{{ route('professions.index') }}">Regresar al listado de profesiones</a>
    </p>
@endsection