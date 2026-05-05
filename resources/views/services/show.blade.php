<h1>{{ $service->nomService }}</h1>

<p>{{ $service->description }}</p>

<hr>

@if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p style="color:red;">{{ session('error') }}</p>
@endif

{{-- ========================= --}}
{{-- FILE DISPLAY --}}
{{-- ========================= --}}
@if($service->fileAttente)

    <h3>File disponible</h3>

    <p>Nom : {{ $service->fileAttente->nomFile }}</p>
    <p>Capacité : {{ $service->fileAttente->capacite }}</p>

    {{-- ========================= --}}
    {{-- USER ACTION --}}
    {{-- ========================= --}}
    @if(session('role') == 'utilisateur')

        <form method="POST" action="{{ route('file.join') }}">
            @csrf
            <input type="hidden" name="idFile" value="{{ $service->fileAttente->idFile }}">
            <button>Rejoindre file</button>
        </form>

    @endif


    {{-- ========================= --}}
    {{-- AGENT ACTIONS --}}
    {{-- ========================= --}}
    @if(session('role') == 'agent')

        <br>

        {{-- UPDATE FILE --}}
        <a href="{{ route('file.update.form', $service->fileAttente->idFile) }}">
            Modifier file
        </a>

        <br><br>

        {{-- DELETE FILE --}}
        <form method="POST" action="{{ route('file.delete', $service->fileAttente->idFile) }}">
            @csrf
            <button style="color:red;">Supprimer file</button>
        </form>

    @endif

@else
    <p>Aucune file disponible pour ce service</p>
@endif

<hr>

{{-- ========================= --}}
{{-- SERVICE MANAGEMENT (AGENT) --}}
{{-- ========================= --}}
@if(session('role') == 'agent')

    <a href="{{ route('services.update.form', $service->idService) }}">
        Modifier service
    </a>

    <br><br>

    <form method="POST" action="{{ route('services.delete', $service->idService) }}">
        @csrf
        <button style="color:red;">Supprimer service</button>
    </form>

@endif

<br>
<a href="{{ route('services.index') }}">Retour</a>