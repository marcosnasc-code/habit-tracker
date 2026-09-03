<h1> Welcome to the Home Page</h1>

<p>
    Olá, {{ $nome }}
</p>

<p>
    Seus hábitos são:
</p>

<ul>
    @foreach ($habits as $habit)
    <li>
        {{ $habit }}
    </li>
    @endforeach
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