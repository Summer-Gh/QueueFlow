<!DOCTYPE html>
<html>
<head>
    <title>{{ $service->nomService }}</title>

    <style>

        body{
            margin:0;
            font-family:Arial;
            background:#F1F5F9;
        }
        .navbar{
            background:#0F172A;
            padding:18px 40px;
            display:flex;
            justify-content:space-between;
            align-items:center;
        }
        .nav-left{
            display:flex;
            align-items:center;
            gap:15px;
            color:white;
        }
        .logo{
            width:55px;
            height:55px;
            object-fit:cover;
            border-radius:12px;
        }
        .nav-right{
            display:flex;
            gap:15px;
        }
        .nav-btn{
            background:#38BDF8;
            color:white;
            padding:10px 18px;
            border-radius:10px;
            text-decoration:none;
            font-weight:bold;
        }

        .logout{
            background:#38BDF8;
            color:white;
            padding:10px 18px;
            border-radius:10px;
            text-decoration:none;
            font-weight:bold;
        }

        .container{
            padding:40px;
        }

        .card{
            background:white;
            padding:30px;
            border-radius:20px;

            box-shadow:0 5px 15px rgba(0,0,0,0.08);

            margin-bottom:30px;
        }

        h1,h2,h3{
            color:#0F172A;
        }

        p{
            color:#475569;
        }

        button{
            padding:12px 18px;
            border:none;
            border-radius:10px;

            background:#38BDF8;
            color:white;

            font-weight:bold;
            cursor:pointer;
        }

        button:hover{
            opacity:0.9;
        }

        .danger{
            background:#ef4444;
        }

        .warning{
            background:#f59e0b;
        }

        .update-link{
            text-decoration:none;
            color:#38BDF8;
            font-weight:bold;
        }

        .message-success{
            background:#dcfce7;
            color:#166534;
            padding:15px;
            border-radius:10px;
            margin-bottom:20px;
        }

        .message-error{
            background:#fee2e2;
            color:#991b1b;
            padding:15px;
            border-radius:10px;
            margin-bottom:20px;
        }

        .ticket-box{
            background:#E0F2FE;
            padding:20px;
            border-radius:15px;
            margin-top:20px;
        }

        .ticket-list{
            border:1px solid #CBD5E1;
            padding:15px;
            border-radius:15px;
            margin-bottom:15px;
        }

        .footer{
            margin-top:60px;
            background:#0F172A;
            color:white;
            text-align:center;
            padding:25px;
        }
        .footer a{
            color:#38BDF8;
            text-decoration:none;
            font-weight:bold;
        }

    </style>

</head>
<body>
    @php
    $notifCount = \App\Models\notifications::where(
        'idUser',
        session('user_id')
        )->where('isRead', 0)->count();
    @endphp 

<div class="navbar">

    <div class="nav-left">

        <img src="{{ asset('images/logo.png') }}" class="logo">
        <h2>QueueFlow</h2>

    </div>

    <div class="nav-right">
        <a href="{{ route('notifications.index') }}"class="nav-btn">
            🔔 Notifications ({{ $notifCount }})
        </a>

        <a href="{{ route('profile') }}" class="nav-btn">
            Mon profil
        </a>

        <a href="/logout" class="nav-btn">
            Déconnexion
        </a>

    </div>

</div>

<div class="container">

    {{-- SUCCESS --}}
    @if(session('success'))

        <div class="message-success">
            {{ session('success') }}
        </div>

    @endif

    {{-- ERROR --}}
    @if(session('error'))

        <div class="message-error">
            {{ session('error') }}
        </div>

    @endif

    {{-- SERVICE --}}
    <div class="card">

        <h1>{{ $service->nomService }}</h1>

        <p>{{ $service->description }}</p>

    </div>

    {{-- FILE --}}
    @if($service->fileAttente)

    <div class="card">

        <h2>File disponible</h2>

        <p>
            <strong>Nom :</strong>
            {{ $service->fileAttente->nomFile }}
        </p>

        <p>
            <strong>Capacité :</strong>
            {{ $service->fileAttente->capacite }}
        </p>

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

                    <button>
                        Rejoindre file
                    </button>
                </form>

            @else

                <div class="ticket-box">

                    <h3>Mon Ticket</h3>

                    <p>
                        <strong>Position :</strong>
                        {{ $myTicket->position }}
                    </p>

                    <p>
                        <strong>Temps estimé :</strong>
                        {{ $myTicket->tempsEstime }} min
                    </p>

                    <p>
                        <strong>ID Utilisateur :</strong>
                        {{ $myTicket->idUser }}
                    </p>

                    <br>

                    {!! QrCode::size(200)->generate(
                        'Utilisateur ID: '.$myTicket->idUser.
                        ' | Position: '.$myTicket->position.
                        ' | Temps estimé: '.$myTicket->tempsEstime.' min'
                    ) !!}
                    <br><br>
                    <a href="{{ route('ticket.pdf', $myTicket->idTicket) }}"class="nav-btn">
                        Télécharger ticket PDF
                    </a>

                    @if($myTicket->position == 1)
                        <p style="
                            background:#dcfce7;
                            color:#166534;
                            padding:15px;
                            border-radius:10px;
                            font-weight:bold;
                            margin-top:20px;
                        ">
                            ✅ C'est votre tour !
                        </p>

                    @elseif($myTicket->position <= 3)

                        <p style="
                            background:#fef3c7;
                            color:#92400e;
                            padding:15px;
                            border-radius:10px;
                            font-weight:bold;
                            margin-top:20px;
                        ">
                            ⚠️ Votre tour approche !
                        </p>

                    @endif
                </div>

            @endif

        @endif

        {{-- ========================= --}}
        {{-- AGENT --}}
        {{-- ========================= --}}
        @if(session('role') == 'agent')

            <br>

            <a class="update-link"
               href="{{ route('file.update.form', $service->fileAttente->idFile) }}">

                Modifier file

            </a>

            <br><br>

            <form method="POST"
                  action="{{ route('file.delete', $service->fileAttente->idFile) }}">
                @csrf

                <button class="danger">
                    Supprimer file
                </button>

            </form>

            <br>

            <form method="POST"
                  action="{{ route('file.next', $service->fileAttente->idFile) }}">
                @csrf

                <button class="warning">
                    Appeler suivant
                </button>

            </form>

            <hr><br>

            <h3>Liste des tickets</h3>

            @forelse($tickets as $ticket)

                <div class="ticket-list">

                    <p>
                        <strong>Client :</strong>
                        {{ $ticket->user->nom }}
                    </p>

                    <p>
                        <strong>Position :</strong>
                        {{ $ticket->position }}
                    </p>

                    <p>
                        <strong>Temps estimé :</strong>
                        {{ $ticket->tempsEstime }} min
                    </p>

                </div>

            @empty

                <p>Aucun ticket</p>

            @endforelse

        @endif

    </div>

    @else

        <div class="card">
            <p>Aucune file disponible</p>
        </div>

    @endif


    <a class="update-link"
       href="{{ route('services.index') }}">

        ← Retour

    </a>

</div>

<div class="footer">

    <p>
        © 2026 QueueFlow — Gestion intelligente des files d’attente
    </p>

    <p>
        Suivez-nous sur Facebook :
        <a href="https://facebook.com">
            QueueFlow
        </a>
    </p>

</div>

</body>
</html>