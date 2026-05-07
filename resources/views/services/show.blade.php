<h1>{{ $service->nomService }}</h1>

<p>{{ $service->description }}</p>

<hr>

@if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p style="color:red;">{{ session('error') }}</p>
@endif

<hr>

@if($service->fileAttente)

    <h3>File disponible</h3>

    <p>Nom : {{ $service->fileAttente->nomFile }}</p>

    <p>Capacité : {{ $service->fileAttente->capacite }}</p>

    {{-- ========================= --}}
    {{-- USER --}}
    {{-- ========================= --}}
    @if(session('role') == 'utilisateur')

        @if(!$myTicket)

            <form method="POST" action="{{ route('file.join') }}">
                @csrf

                <input type="hidden"
                       name="idFile"
                       value="{{ $service->fileAttente->idFile }}">

                <button>Rejoindre file</button>
            </form>

        @else

            <hr>

            <h3>Mon Ticket</h3>

            <p>
                Position : {{ $myTicket->position }}
            </p>

            <p>
                Temps estimé :
                {{ $myTicket->tempsEstime }} min
            </p>

            {{-- QR CODE --}}
            {!! QrCode::size(200)->generate(
                'Utilisateur ID: '.$myTicket->idUser.
                ' | Position: '.$myTicket->position.
                ' | Temps estimé: '.$myTicket->tempsEstime.' min'
            ) !!}

            {{-- NOTIFICATION --}}
            @if($myTicket->position <= 3)

                <p style="color:red;">
                    ⚠️ Votre tour approche !
                </p>

            @endif

        @endif

    @endif

    {{-- ========================= --}}
    {{-- AGENT --}}
    {{-- ========================= --}}
    @if(session('role') == 'agent')

        <br>

        <a href="{{ route('file.update.form', $service->fileAttente->idFile) }}">
            Modifier file
        </a>

        <br><br>

        <form method="POST"
              action="{{ route('file.delete', $service->fileAttente->idFile) }}">
            @csrf

            <button style="color:red;">
                Supprimer file
            </button>
        </form>

        <br>

        {{-- CALL NEXT --}}
        <form method="POST"
              action="{{ route('file.next', $service->fileAttente->idFile) }}">
            @csrf

            <button>
                Appeler suivant
            </button>
        </form>

        <hr>

        {{-- TICKETS LIST --}}
        <h3>Liste des tickets</h3>

        @forelse($tickets as $ticket)

            <div style="border:1px solid black; padding:10px; margin:10px;">

                <p>
                    Client :
                    {{ $ticket->user->nom }}
                </p>

                <p>
                    Position :
                    {{ $ticket->position }}
                </p>

                <p>
                    Temps estimé :
                    {{ $ticket->tempsEstime }} min
                </p>

            </div>

        @empty

            <p>Aucun ticket</p>

        @endforelse

    @endif

@else

    <p>Aucune file disponible</p>

@endif

<hr>

@if(session('role') == 'agent')

    <a href="{{ route('services.update.form', $service->idService) }}">
        Modifier service
    </a>

    <br><br>

    <form method="POST"
          action="{{ route('services.delete', $service->idService) }}">
        @csrf

        <button style="color:red;">
            Supprimer service
        </button>
    </form>

@endif

<br>

<a href="{{ route('services.index') }}">
    Retour
</a>