<h2>Inscription</h2>

@if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif

<form method="POST" action="/register">
    @csrf

    <input type="text" name="nom" placeholder="Nom"><br><br>
    <input type="email" name="email" placeholder="Email"><br><br>
    <input type="password" name="password" placeholder="Mot de passe"><br><br>
    <input type="text" name="telephone" placeholder="Téléphone"><br><br>

    <button>S'inscrire</button>
</form>

<a href="/login">Login</a>