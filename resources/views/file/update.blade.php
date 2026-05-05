<h2>Modifier file</h2>

<form method="POST" action="{{ route('file.update', $file->idFile) }}">
    @csrf

    <input type="text" name="nomFile" value="{{ $file->nomFile }}"><br><br>
    <input type="number" name="capacite" value="{{ $file->capacite }}"><br><br>

    <button>Modifier</button>
</form>

<a href="{{ route('services.index') }}">Retour</a>