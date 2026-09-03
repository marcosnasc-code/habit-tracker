<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{config('app.name')}}</title>
</head>
<body>
    <h1>Welcome to the Home Page</h1>
    <p>
        Olá, {{ $nome }}
    </p>
    <p>
        Seus hábitos são:
    </p>
    <ul>
        @foreach ($habits as $habit)
        <li>{{ $habit }}</li>
    </ul>
    @auth
    <p>
        Você está autenticado
    </p>
    @endauth
    @guest
    <p>
        Você não está autenticado
    </p>
    @endguest
</body>
</html>