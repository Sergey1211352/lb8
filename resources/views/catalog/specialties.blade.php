@extends('layouts.app')

@section('content')
    <h1>{{ $title }}</h1>

    <ul class="list-group mb-3">
        @foreach ($specialties as $specialty)
            <li class="list-group-item">
                <a href="{{ route('catalog.specialty', ['specialty' => $specialty]) }}">{{ $specialty }}</a>
            </li>
        @endforeach
    </ul>

    <a href="{{ route('catalog.index') }}">&larr; К каталогу</a>
@endsection
