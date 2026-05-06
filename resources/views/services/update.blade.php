<h2>Modifier service</h2>

@if($errors->any())
    @foreach($errors->all() as $error)
        <p style="color:red;">{{ $error }}</p>
    @endforeach
@endif

<form method="POST" action="{{ route('services.update', $service->idService) }}">
    @csrf

    <div>
        <label>Nom du service :</label><br>
        <input type="text" name="nomService" value="{{ $service->nomService }}">
    </div>

    <br>

    <div>
        <label>Description :</label><br>
        <input type="text" name="description" value="{{ $service->description }}">
    </div>

    <br>

    <button type="submit">Modifier</button>
</form>

<br>
<a href="{{ route('services.index') }}">Retour</a>