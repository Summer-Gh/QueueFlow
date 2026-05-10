<!DOCTYPE html>
<html>
<head>
    <title>Services</title>

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

        .logo-circle{
            width:40px;
            height:40px;
            border-radius:50%;
            background:#38BDF8;
        }

        .logout{
            background:#38BDF8;
            color:white;
            padding:10px 18px;
            border-radius:10px;
            text-decoration:none;
            transition:0.3s;
        }

        .logout:hover{
            background:#0ea5e9;
        }

        .container{
            padding:40px;
            max-width:1100px;
            margin:auto;
        }

        h1{
            color:#0F172A;
            margin-bottom:30px;
        }

        .service-card{
            background:white;
            padding:25px;
            border-radius:20px;
            margin-bottom:25px;

            box-shadow:0 5px 15px rgba(0,0,0,0.08);

            transition:0.3s;
        }

        .service-card:hover{
            transform:translateY(-3px);
        }

        .service-card h3{
            color:#0F172A;
            margin-top:0;
        }

        .service-card p{
            color:#666;
        }

        input{
            width:100%;
            padding:12px;
            margin-bottom:15px;

            border:1px solid #cbd5e1;
            border-radius:10px;

            box-sizing:border-box;

            font-size:15px;
        }

        button{
            padding:12px 18px;
            border:none;
            border-radius:10px;

            background:#38BDF8;
            color:white;

            font-weight:bold;
            cursor:pointer;

            transition:0.3s;
        }

        button:hover{
            opacity:0.9;
        }

        .danger{
            background:#ef4444;
        }

        .update{
            display:inline-block;
            margin-top:15px;
            margin-bottom:15px;

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

        .back-btn{
            display:inline-block;
            margin-top:20px;

            text-decoration:none;
            background:#0F172A;
            color:white;

            padding:12px 18px;
            border-radius:10px;
        }

        hr{
            border:none;
            border-top:1px solid #e2e8f0;
            margin:20px 0;
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

    <h1>Liste des services</h1>

    @if(session('success'))
        <div class="message-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="message-error">
            {{ session('error') }}
        </div>
    @endif


    {{-- ========================= --}}
    {{-- ADD SERVICE --}}
    {{-- ========================= --}}
    @if(session('role') == 'agent')

    <div class="service-card">

        <h3>Ajouter un service</h3>

        <form method="POST" action="{{ route('services.add') }}">
            @csrf

            <input type="text"
                   name="nomService"
                   placeholder="Nom du service"
                   required>

            <input type="text"
                   name="description"
                   placeholder="Description"
                   required>

            <button type="submit">
                Ajouter
            </button>

        </form>

    </div>

    @endif


    {{-- ========================= --}}
    {{-- SERVICES --}}
    {{-- ========================= --}}
    @forelse($services as $service)

    <div class="service-card">

        <a href="{{ route('services.show', $service->idService) }}"
           style="text-decoration:none; color:black;">

            <h3>{{ $service->nomService }}</h3>

            <p>{{ $service->description }}</p>

        </a>


        {{-- ========================= --}}
        {{-- AGENT ACTIONS --}}
        {{-- ========================= --}}
        @if(session('role') == 'agent')

            @if(!$service->fileAttente)

                <hr>

                <h4>Ajouter une file</h4>

                <form method="POST" action="{{ route('file.add') }}">
                    @csrf

                    <input type="hidden"
                           name="idService"
                           value="{{ $service->idService }}">

                    <input type="text"
                           name="nomFile"
                           placeholder="Nom de la file"
                           required>

                    <input type="number"
                           name="capacite"
                           placeholder="Capacité"
                           required>

                    <button type="submit">
                        Ajouter file
                    </button>

                </form>

            @else

                <p style="margin-top:15px; color:#64748b;">
                    Une file existe déjà pour ce service.
                </p>

            @endif


            <a href="{{ route('services.update.form', $service->idService) }}"
               class="update">

                Modifier service

            </a>

            <form method="POST"
                  action="{{ route('services.delete', $service->idService) }}">

                @csrf

                <button class="danger">
                    Supprimer service
                </button>

            </form>

        @endif

    </div>

    @empty

        <div class="service-card">
            <p>Aucun service disponible</p>
        </div>

    @endforelse


    <a href="/dashboard" class="back-btn">
        Retour au dashboard
    </a>

</div>
<div class="footer">

    <p>
        © 2026 QueueFlow — Gestion intelligente des files d’attente
    </p>

    <p>
        Suivez-nous sur Facebook :
        <a href="https://www.facebook.com/za9slaw">
            QueueFlow
        </a>
    </p>

</div>

</body>
</html>