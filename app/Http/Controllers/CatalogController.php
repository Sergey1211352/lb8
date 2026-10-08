<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatalogController extends Controller
{
    // Временное хранилище: в ЛПР № 9 его заменит база данных.
    // ITEMS = 5; code = 3 заглавные латинские буквы, дефис, 5 цифр.
    private function groups(): array
    {
        return [
            ['id' => 1, 'code' => 'ISP-23101', 'specialty' => 'Информационные системы и программирование',
                'course' => 4, 'students_count' => 24, 'start_year' => 2023, 'is_budget' => true],
            ['id' => 2, 'code' => 'ISP-24102', 'specialty' => 'Информационные системы и программирование',
                'course' => 3, 'students_count' => 26, 'start_year' => 2024, 'is_budget' => false],
            ['id' => 3, 'code' => 'SSA-24201', 'specialty' => 'Сетевое и системное администрирование',
                'course' => 3, 'students_count' => 22, 'start_year' => 2024, 'is_budget' => true],
            ['id' => 4, 'code' => 'SSA-25202', 'specialty' => 'Сетевое и системное администрирование',
                'course' => 2, 'students_count' => 25, 'start_year' => 2025, 'is_budget' => true],
            ['id' => 5, 'code' => 'BUH-25301', 'specialty' => 'Экономика и бухгалтерский учёт',
                'course' => 2, 'students_count' => 20, 'start_year' => 2025, 'is_budget' => false],
        ];
    }

    // GET /catalog?q=...&sort=...
    public function index(Request $request)
    {
        $groups = collect($this->groups());

        $search = $request->query('q');
        if ($search) {
            $groups = $groups->filter(fn ($g) => mb_stripos($g['code'], $search) !== false);
        }

        $sort = $request->query('sort', 'code');
        if (in_array($sort, ['code', 'start_year', 'students_count'])) {
            $groups = $groups->sortBy($sort);
        }

        return view('catalog.index', [
            'title'  => 'Каталог учебных групп',
            'groups' => $groups,
            'search' => $search,
            'sort'   => $sort,
        ]);
    }

    // GET /catalog/3
    public function show(int $id)
    {
        $group = collect($this->groups())->firstWhere('id', $id);
        abort_if(! $group, 404);

        return view('catalog.show', ['title' => $group['code'], 'group' => $group]);
    }

    // GET /catalog/code/ISP-23101
    public function byCode(string $code)
    {
        $group = collect($this->groups())->firstWhere('code', $code);
        abort_if(! $group, 404);

        return view('catalog.show', ['title' => $group['code'], 'group' => $group]);
    }

    // GET /catalog/specialty/Название  или  /catalog/specialty
    public function bySpecialty(?string $specialty = null)
    {
        $groups = collect($this->groups());

        // ⭐ без параметра — список специальностей со ссылками
        if (! $specialty) {
            return view('catalog.specialties', [
                'title'       => 'Все специальности',
                'specialties' => $groups->pluck('specialty')->unique(),
            ]);
        }

        return view('catalog.index', [
            'title'  => "Группы: {$specialty}",
            'groups' => $groups->where('specialty', $specialty),
            'search' => null,
            'sort'   => 'code',
        ]);
    }

    // ⭐ GET /catalog/stats
    public function stats()
    {
        $groups = collect($this->groups());

        return view('catalog.stats', [
            'title' => 'Статистика',
            'count' => $groups->count(),
            'avg'   => $groups->avg('students_count'),
            'min'   => $groups->min('students_count'),
            'max'   => $groups->max('students_count'),
        ]);
    }
}
