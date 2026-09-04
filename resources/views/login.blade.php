<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} — Login</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-zinc-50 text-zinc-900 antialiased dark:bg-zinc-950 dark:text-zinc-100">
    <main class="flex min-h-screen items-center justify-center p-6">
        <section class="flex w-full max-w-md flex-col gap-6 rounded-2xl border border-zinc-200 bg-white p-8 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
            <header class="flex flex-col gap-2">
                <p class="text-sm font-medium text-emerald-600 dark:text-emerald-400">{{ config('app.name') }}</p>
                <h1 class="text-2xl font-semibold tracking-tight">Página de login</h1>
                <p class="text-sm text-zinc-500 dark:text-zinc-400">Entre com seu login e senha.</p>
            </header>

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

            <form method="POST" action="{{ url('/login') }}" class="flex flex-col gap-4">
                @csrf

                <div class="flex flex-col gap-1.5">
                    <label for="login" class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Login</label>
                    <input
                        id="login"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="seu@email.com"
                        class="rounded-lg border border-zinc-200 bg-white px-3 py-2.5 text-sm text-zinc-900 outline-none ring-emerald-500/40 placeholder:text-zinc-400 focus:border-emerald-500 focus:ring-2 dark:border-zinc-700 dark:bg-zinc-950 dark:text-zinc-100 dark:placeholder:text-zinc-500"
                    >
                    @error('email')
                        <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1.5">
                    <label for="password" class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Senha</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="••••••••"
                        class="rounded-lg border border-zinc-200 bg-white px-3 py-2.5 text-sm text-zinc-900 outline-none ring-emerald-500/40 placeholder:text-zinc-400 focus:border-emerald-500 focus:ring-2 dark:border-zinc-700 dark:bg-zinc-950 dark:text-zinc-100 dark:placeholder:text-zinc-500"
                    >
                    @error('password')
                        <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center rounded-lg bg-zinc-900 px-4 py-2.5 text-sm font-medium text-white dark:bg-zinc-100 dark:text-zinc-900"
                >
                    Confirmar login
                </button>
            </form>

            <div class="flex flex-col gap-2">
                @error('email')
                    <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <a
                href="{{ url('/rotaController') }}"
                class="inline-flex items-center justify-center rounded-lg border border-zinc-200 px-4 py-2.5 text-sm font-medium text-zinc-700 dark:border-zinc-700 dark:text-zinc-200"
            >
                Ir para a home
            </a>
        </section>
    </main>
</body>
</html>
