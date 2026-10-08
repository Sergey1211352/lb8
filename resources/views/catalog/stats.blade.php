@extends('layouts.app')

@section('content')
    <h1>{{ $title }}</h1>

    <dl class="row">
        <dt class="col-sm-4">Количество групп</dt>
        <dd class="col-sm-8">{{ $count }}</dd>

        <dt class="col-sm-4">Студентов в группе, среднее</dt>
        <dd class="col-sm-8">{{ number_format($avg, 2, ',', ' ') }}</dd>

        <dt class="col-sm-4">Студентов в группе, минимум</dt>
        <dd class="col-sm-8">{{ $min }}</dd>

        <dt class="col-sm-4">Студентов в группе, максимум</dt>
        <dd class="col-sm-8">{{ $max }}</dd>
    </dl>

    <a href="{{ route('catalog.index') }}">&larr; К каталогу</a>
@endsection
