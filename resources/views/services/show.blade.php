<h1>{{ $service->nomService }}</h1>

<p>{{ $service->description }}</p>

<hr>

{{-- MESSAGES --}}
@if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p style="color:red;">{{ session('error') }}</p>
@endif

<hr>

{{-- FILE --}}
@if($service->fileAttente)

    <h3>File disponible</h3>

    <p>Nom : {{ $service->fileAttente->nomFile }}</p>
    <p>Capacité : {{ $service->fileAttente->capacite }}</p>

    {{-- USER JOIN --}}
    @if(session('role') == 'utilisateur')

        <form method="POST" action="{{ route('file.join') }}">
            @csrf
            <input type="hidden" name="idFile" value="{{ $service->fileAttente->idFile }}">
            <button>Rejoindre file</button>
        </form>

    @endif

    {{-- AGENT ACTIONS --}}
    @if(session('role') == 'agent')

        <br>

        <a href="{{ route('file.update.form', $service->fileAttente->idFile) }}">
            Modifier file
        </a>

        <br><br>

        <form method="POST" action="{{ route('file.delete', $service->fileAttente->idFile) }}">
            @csrf
            <button style="color:red;">Supprimer file</button>
        </form>

        <br><br>

        {{-- CALL NEXT --}}
        <form method="POST" action="{{ route('file.next', $service->fileAttente->idFile) }}">
            @csrf
            <button>Appeler suivant</button>
        </form>

    @endif

@else
    <p>Aucune file disponible</p>
@endif

<hr>

{{-- TICKETS --}}
@if(isset($tickets) && count($tickets) > 0)

    <h3>Liste des tickets</h3>

    @foreach($tickets as $ticket)

        <div style="border:1px solid black; margin:5px; padding:5px;">
            <p>
                Position : {{ $ticket->position }}
            </p>

            <p>
                Temps estimé : {{ $ticket->tempsEstime }} min
            </p>

        </div>
        

    @endforeach

@endif

<hr>

{{-- SERVICE MANAGEMENT --}}
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