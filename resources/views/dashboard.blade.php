<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} — Dashboard</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
@php
    $displayName = $nome ?? (auth()->user()->name ?? 'Usuário');
    $habits = $habits ?? [];
    $habitMeta = [
        'Programar' => ['lang' => 'PHP', 'color' => 'bg-indigo-500', 'desc' => 'Prática diária de código e projetos.'],
        'Estudar' => ['lang' => 'Docs', 'color' => 'bg-amber-500', 'desc' => 'Leitura e revisão de conteúdo técnico.'],
        'Jogar' => ['lang' => 'Fun', 'color' => 'bg-rose-500', 'desc' => 'Lazer intencional para recarregar energia.'],
    ];

    $weeks = 53;
    $days = 7;
    $contributionLevels = [];
    $totalCheckins = 0;
    $start = now()->subWeeks($weeks - 1)->startOfWeek();

    for ($week = 0; $week < $weeks; $week++) {
        for ($day = 0; $day < $days; $day++) {
            $date = $start->copy()->addWeeks($week)->addDays($day);
            if ($date->isFuture()) {
                $level = 0;
            } else {
                $seed = crc32($date->toDateString().$displayName);
                $level = $seed % 5;
                if ($level > 0) {
                    $totalCheckins += $level;
                }
            }
            $contributionLevels[$week][$day] = [
                'level' => $level,
                'date' => $date->format('d/m/Y'),
            ];
        }
    }

    $levelClasses = [
        0 => 'bg-zinc-200 dark:bg-zinc-800',
        1 => 'bg-emerald-200 dark:bg-emerald-900',
        2 => 'bg-emerald-300 dark:bg-emerald-700',
        3 => 'bg-emerald-500 dark:bg-emerald-600',
        4 => 'bg-emerald-600 dark:bg-emerald-500',
    ];

    $activity = [];
    foreach (array_reverse($habits) as $index => $habit) {
        $activity[] = [
            'habit' => $habit,
            'message' => 'check-in #'.(12 - $index).' — mantendo a sequência',
            'when' => ($index + 1).'d atrás',
        ];
    }
@endphp
<body class="min-h-screen bg-[#f6f8fa] text-zinc-900 antialiased dark:bg-[#0d1117] dark:text-zinc-100">
    <header class="border-b border-zinc-300/80 bg-[#f6f8fa] dark:border-zinc-800 dark:bg-[#010409]">
        <div class="mx-auto flex max-w-6xl items-center justify-between gap-4 px-4 py-3">
            <div class="flex items-center gap-3">
                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-zinc-900 text-sm font-semibold text-white dark:bg-zinc-100 dark:text-zinc-900">
                    {{ strtoupper(substr($displayName, 0, 1)) }}
                </span>
                <div class="flex flex-col">
                    <span class="text-sm font-semibold">{{ config('app.name') }}</span>
                    <span class="text-xs text-zinc-500 dark:text-zinc-400">Overview</span>
                </div>
            </div>

            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        type="submit"
                        class="rounded-md border border-zinc-300 bg-white px-3 py-1.5 text-sm font-medium text-zinc-700 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-200"
                    >
                        Sair
                    </button>
                </form>
            @endauth
            @guest
                <a
                    href="{{ route('login') }}"
                    class="rounded-md border border-zinc-300 bg-white px-3 py-1.5 text-sm font-medium text-zinc-700 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-200"
                >
                    Login
                </a>
            @endguest
        </div>
    </header>

    <main class="mx-auto grid max-w-6xl gap-8 px-4 py-8 lg:grid-cols-[240px_1fr]">
        <aside class="flex flex-col gap-4">
            <div class="flex flex-col gap-3">
                <div class="flex h-24 w-24 items-center justify-center rounded-full border-2 border-zinc-200 bg-zinc-100 text-3xl font-semibold text-zinc-600 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-300">
                    {{ strtoupper(substr($displayName, 0, 1)) }}
                </div>
                <div>
                    <h1 class="text-2xl font-semibold tracking-tight">{{ $displayName }}</h1>
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">habit tracker</p>
                </div>
                <p class="text-sm text-zinc-600 dark:text-zinc-400">
                    Acompanhe seus hábitos como repositórios e sua constância como commits.
                </p>
                <div class="flex gap-4 text-sm">
                    <span><strong>{{ count($habits) }}</strong> <span class="text-zinc-500">hábitos</span></span>
                    <span><strong>{{ $totalCheckins }}</strong> <span class="text-zinc-500">check-ins</span></span>
                </div>
            </div>
        </aside>

        <div class="flex min-w-0 flex-col gap-6">
            <section class="rounded-lg border border-zinc-300 bg-white p-4 dark:border-zinc-800 dark:bg-[#0d1117]">
                <div class="mb-3 flex flex-wrap items-end justify-between gap-2">
                    <h2 class="text-sm font-semibold">
                        {{ $totalCheckins }} check-ins no último ano
                    </h2>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400">Contribution activity</p>
                </div>

                <div class="overflow-x-auto pb-2">
                    <div class="inline-flex gap-1">
                        @foreach ($contributionLevels as $week)
                            <div class="flex flex-col gap-1">
                                @foreach ($week as $cell)
                                    <span
                                        title="{{ $cell['date'] }} — nível {{ $cell['level'] }}"
                                        class="block h-2.5 w-2.5 rounded-[2px] {{ $levelClasses[$cell['level']] }}"
                                    ></span>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-3 flex items-center justify-end gap-1 text-xs text-zinc-500 dark:text-zinc-400">
                    <span>Menos</span>
                    @foreach ($levelClasses as $class)
                        <span class="block h-2.5 w-2.5 rounded-[2px] {{ $class }}"></span>
                    @endforeach
                    <span>Mais</span>
                </div>
            </section>

            <section class="flex flex-col gap-3">
                <div class="flex items-center justify-between gap-3">
                    <h2 class="text-base font-semibold">Repositories</h2>
                    <span class="text-xs text-zinc-500 dark:text-zinc-400">{{ count($habits) }} hábitos</span>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    @forelse ($habits as $habit)
                        @php
                            $meta = $habitMeta[$habit] ?? [
                                'lang' => 'Habit',
                                'color' => 'bg-emerald-500',
                                'desc' => 'Acompanhamento contínuo deste hábito.',
                            ];
                        @endphp
                        <article class="flex flex-col gap-3 rounded-lg border border-zinc-300 bg-white p-4 dark:border-zinc-800 dark:bg-[#0d1117]">
                            <div class="flex items-start justify-between gap-2">
                                <a href="#" class="text-sm font-semibold text-sky-700 hover:underline dark:text-sky-400">
                                    {{ \Illuminate\Support\Str::slug($habit) }}
                                </a>
                                <span class="rounded-full border border-zinc-300 px-2 py-0.5 text-[11px] text-zinc-600 dark:border-zinc-700 dark:text-zinc-400">
                                    Public
                                </span>
                            </div>
                            <p class="text-sm text-zinc-600 dark:text-zinc-400">{{ $meta['desc'] }}</p>
                            <div class="mt-auto flex items-center gap-4 text-xs text-zinc-500 dark:text-zinc-400">
                                <span class="inline-flex items-center gap-1.5">
                                    <span class="h-2.5 w-2.5 rounded-full {{ $meta['color'] }}"></span>
                                    {{ $meta['lang'] }}
                                </span>
                                <span>Updated {{ $loop->iteration }}d ago</span>
                            </div>
                        </article>
                    @empty
                        <p class="rounded-lg border border-dashed border-zinc-300 p-6 text-sm text-zinc-500 dark:border-zinc-700">
                            Nenhum hábito cadastrado ainda.
                        </p>
                    @endforelse
                </div>
            </section>

            <section class="flex flex-col gap-3 rounded-lg border border-zinc-300 bg-white p-4 dark:border-zinc-800 dark:bg-[#0d1117]">
                <h2 class="text-base font-semibold">Contribution activity</h2>
                <ol class="relative flex flex-col gap-0 border-l border-zinc-300 pl-4 dark:border-zinc-700">
                    @forelse ($activity as $item)
                        <li class="relative pb-5 last:pb-0">
                            <span class="absolute -left-[21px] top-1.5 h-2.5 w-2.5 rounded-full border-2 border-white bg-emerald-500 dark:border-[#0d1117]"></span>
                            <p class="text-sm">
                                <span class="font-semibold">{{ $displayName }}</span>
                                completed a check-in in
                                <span class="font-semibold text-sky-700 dark:text-sky-400">{{ \Illuminate\Support\Str::slug($item['habit']) }}</span>
                            </p>
                            <p class="mt-1 font-mono text-xs text-zinc-500 dark:text-zinc-400">
                                {{ $item['message'] }}
                            </p>
                            <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">{{ $item['when'] }}</p>
                        </li>
                    @empty
                        <li class="text-sm text-zinc-500">Nenhuma atividade recente.</li>
                    @endforelse
                </ol>
            </section>
        </div>
    </main>
</body>
</html>
