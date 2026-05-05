<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h1>Bienvenue {{ session('user_nom') }}</h1>

<p>Vous êtes connecté avec succès.</p>

<a href="/logout">Se déconnecter</a>

</body>
</html>