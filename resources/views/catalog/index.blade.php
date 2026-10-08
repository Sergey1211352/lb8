@extends('layouts.app')

@section('content')
    <h1>{{ $title }}</h1>

    <form method="GET" action="{{ route('catalog.index') }}" class="row g-2 mb-3">
        <div class="col-auto">
            <input type="text" name="q" value="{{ $search }}" class="form-control" placeholder="Код группы...">
        </div>
        <div class="col-auto">
            <select name="sort" class="form-select">
                <option value="code" @selected($sort === 'code')>По коду</option>
                <option value="start_year" @selected($sort === 'start_year')>По году начала</option>
                <option value="students_count" @selected($sort === 'students_count')>По числу студентов</option>
            </select>
        </div>
        <div class="col-auto"><button class="btn btn-secondary">Найти</button></div>
    </form>

    <table class="table">
        <tr>
            <th>№</th><th>Код группы</th><th>Специальность</th><th>Год начала</th><th>Студентов</th><th></th>
        </tr>
        @forelse ($groups as $group)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td><a href="{{ route('catalog.show', ['id' => $group['id']]) }}">{{ $group['code'] }}</a></td>
                <td>
                    <a href="{{ route('catalog.specialty', ['specialty' => $group['specialty']]) }}">{{ $group['specialty'] }}</a>
                </td>
                <td>{{ $group['start_year'] }}</td>
                <td>{{ $group['students_count'] }}</td>
                <td>@if ($group['is_budget']) <span class="badge bg-success">Бюджет</span> @endif</td>
            </tr>
        @empty
            <tr><td colspan="6" class="text-muted">Ничего не найдено.</td></tr>
        @endforelse
    </table>
@endsection
