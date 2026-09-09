<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} — Novo hábito</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-zinc-50 text-zinc-900 antialiased dark:bg-zinc-950 dark:text-zinc-100">
    <main class="flex min-h-screen items-center justify-center p-6">
        <section class="flex w-full max-w-md flex-col gap-6 rounded-2xl border border-zinc-200 bg-white p-8 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
            <header class="flex flex-col gap-2">
                <p class="text-sm font-medium text-emerald-600 dark:text-emerald-400">{{ config('app.name') }}</p>
                <h1 class="text-2xl font-semibold tracking-tight">Cadastrar hábito</h1>
                <p class="text-sm text-zinc-500 dark:text-zinc-400">Informe o nome do hábito que deseja acompanhar.</p>
            </header>

            <form method="POST" action="{{ route('habits.store') }}" class="flex flex-col gap-4" novalidate>
                @csrf

                <div class="flex flex-col gap-1.5">
                    <label for="name" class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Nome</label>
                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        autofocus
                        autocomplete="off"
                        placeholder="Ex.: Programar"
                        class="rounded-lg border border-zinc-200 bg-white px-3 py-2.5 text-sm text-zinc-900 outline-none ring-emerald-500/40 placeholder:text-zinc-400 focus:border-emerald-500 focus:ring-2 dark:border-zinc-700 dark:bg-zinc-950 dark:text-zinc-100 dark:placeholder:text-zinc-500 @error('name') border-red-500 dark:border-red-400 @enderror"
                    >
                    @error('name')
                        <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center rounded-lg bg-zinc-900 px-4 py-2.5 text-sm font-medium text-white dark:bg-zinc-100 dark:text-zinc-900"
                >
                    Salvar hábito
                </button>
            </form>

            <p class="text-center text-sm text-zinc-500 dark:text-zinc-400">
                <a href="{{ route('dashboard') }}" class="font-medium text-zinc-900 underline-offset-2 hover:underline dark:text-zinc-100">
                    Voltar ao dashboard
                </a>
            </p>
        </section>
    </main>
</body>
</html>
