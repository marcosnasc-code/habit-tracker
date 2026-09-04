<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} — Home</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-zinc-50 text-zinc-900 antialiased dark:bg-zinc-950 dark:text-zinc-100">
    <main class="mx-auto flex min-h-screen w-full max-w-xl flex-col justify-center gap-6 p-6">
        <header class="flex flex-col gap-2">
            <p class="text-sm font-medium text-emerald-600 dark:text-emerald-400">{{ config('app.name') }}</p>
            <h1 class="text-3xl font-semibold tracking-tight">Início</h1>
            <p class="text-base text-zinc-600 dark:text-zinc-400">Olá, <span class="font-medium text-zinc-900 dark:text-zinc-100">{{ $nome }}</span></p>
        </header>

        <section class="flex flex-col gap-4 rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
            <h2 class="text-sm font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400">Seus hábitos</h2>
            <ul class="flex flex-col gap-2">
                @foreach ($habits as $habit)
                    <li class="rounded-lg bg-zinc-50 px-4 py-3 text-sm font-medium dark:bg-zinc-800">
                        {{ $habit }}
                    </li>
                @endforeach
            </ul>
        </section>

        @auth
            <p class="rounded-lg bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800 dark:bg-emerald-950/50 dark:text-emerald-300">
                Você está autenticado
            </p>
        @endauth
        @guest
            <p class="rounded-lg bg-amber-50 px-4 py-3 text-sm font-medium text-amber-800 dark:bg-amber-950/50 dark:text-amber-300">
                Você não está autenticado
            </p>
        @endguest

        <a
            href="{{ url('/login') }}"
            class="inline-flex w-fit items-center justify-center rounded-lg border border-zinc-200 px-4 py-2.5 text-sm font-medium text-zinc-700 dark:border-zinc-700 dark:text-zinc-200"
        >
            Ir para o login
        </a>
    </main>
</body>
</html>
