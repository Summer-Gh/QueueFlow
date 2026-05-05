@if($errors->any())

@foreach($errors->all() as $error)
{{ $error }}
@endforeach

@endif

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