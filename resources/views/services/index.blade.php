<h1>Liste des services</h1>

{{-- ========================= --}}
{{-- MESSAGES --}}
{{-- ========================= --}}
@if(session('success')) <p style="color: green;">{{ session('success') }}</p>
@endif

@if(session('error')) <p style="color: red;">{{ session('error') }}</p>
@endif

<hr>

{{-- ========================= --}}
{{-- AGENT : ADD SERVICE --}}
{{-- ========================= --}}
@if(session('role') == 'agent')

<h3>Ajouter un service</h3>

<form method="POST" action="{{ route('services.add') }}">
    @csrf

```
<input type="text" name="nomService" placeholder="Nom du service"><br><br>
<input type="text" name="description" placeholder="Description"><br><br>

<button type="submit">Ajouter</button>
```

</form>

<hr>

@endif

{{-- ========================= --}}
{{-- LIST OF SERVICES --}}
{{-- ========================= --}}
@forelse($services as $service)

```
{{-- SERVICE CARD (CLICKABLE) --}}
<a href="{{ route('services.show', $service->idService) }}" style="text-decoration:none; color:black;">
    <div style="border:1px solid black; padding:10px; margin:10px;">
        <h3>{{ $service->nomService }}</h3>
        <p>{{ $service->description }}</p>
    </div>
</a>

{{-- ========================= --}}
{{-- AGENT ACTIONS --}}
{{-- ========================= --}}
@if(session('role') == 'agent')

    {{-- ADD FILE (ONLY IF NONE EXISTS) --}}
    @if(!$service->fileAttente)

        <h4>Ajouter une file</h4>

        <form method="POST" action="{{ route('file.add') }}">
            @csrf

            <input type="hidden" name="idService" value="{{ $service->idService }}">

            <input type="text" name="nomFile" placeholder="Nom de la file"><br><br>
            <input type="number" name="capacite" placeholder="Capacité"><br><br>

            <button type="submit">Ajouter file</button>
        </form>

    @else
        <p style="color: gray;">Ce service possède déjà une file</p>
    @endif

    <br>

    {{-- UPDATE SERVICE --}}
    <a href="{{ route('services.update.form', $service->idService) }}">
        Modifier service
    </a>

    <br><br>

    {{-- DELETE SERVICE --}}
    <form method="POST" action="{{ route('services.delete', $service->idService) }}">
        @csrf
        <button style="color:red;">Supprimer service</button>
    </form>

    <hr>

@endif
```

@empty <p>Aucun service disponible</p>
@endforelse

<br>
<a href="/dashboard">Retour au dashboard</a>
