@extends('layouts.app')

@section('content')
    <h1>Группа {{ $group['code'] }}</h1>

    <dl class="row">
        <dt class="col-sm-3">Код</dt>
        <dd class="col-sm-9">{{ $group['code'] }}</dd>

        <dt class="col-sm-3">Специальность</dt>
        <dd class="col-sm-9">{{ $group['specialty'] }}</dd>

        <dt class="col-sm-3">Курс</dt>
        <dd class="col-sm-9">{{ $group['course'] }}</dd>

        <dt class="col-sm-3">Студентов</dt>
        <dd class="col-sm-9">{{ $group['students_count'] }}</dd>

        <dt class="col-sm-3">Год начала обучения</dt>
        <dd class="col-sm-9">{{ $group['start_year'] }}</dd>

        <dt class="col-sm-3">Форма обучения</dt>
        <dd class="col-sm-9">{{ $group['is_budget'] ? 'Бюджет' : 'Платное' }}</dd>
    </dl>

    <a href="{{ route('catalog.index') }}">&larr; К каталогу</a>
@endsection
