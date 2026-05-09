<!DOCTYPE html>
<html>
<head>

    <title>Mon Profil</title>

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

        .container{
            padding:50px;

            display:flex;
            justify-content:center;
        }

        .card{
            background:white;
            width:500px;

            padding:35px;
            border-radius:20px;

            box-shadow:0 5px 15px rgba(0,0,0,0.08);
        }

        h1{
            color:#0F172A;
            margin-bottom:30px;
        }

        input{
            width:100%;
            padding:14px;

            margin-bottom:18px;

            border:1px solid #CBD5E1;
            border-radius:10px;

            box-sizing:border-box;
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

        .danger{
            background:#ef4444;
        }

        .success{
            background:#dcfce7;
            color:#166534;

            padding:15px;
            border-radius:10px;

            margin-bottom:20px;
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

        <img src="{{ asset('images/logo.png') }}"
             class="logo">

        <h2>QueueFlow</h2>

    </div>

    <div class="nav-right">
        <a href="{{ route('notifications.index') }}"class="nav-btn">
            🔔 Notifications ({{ $notifCount }})
        </a>

        <a href="/services" class="nav-btn">
            Services
        </a>

        <a href="/logout" class="nav-btn">
            Déconnexion
        </a>

    </div>

</div>

<div class="container">

    <div class="card">

        <h1>Mon Profil</h1>

        @if(session('success'))

            <div class="success">
                {{ session('success') }}
            </div>

        @endif

        <form method="POST"
              action="{{ route('profile.update') }}">

            @csrf

            <input type="text"
                   name="nom"
                   value="{{ $user->nom }}">

            <input type="email"
                   name="email"
                   value="{{ $user->email }}">

            <input type="password"
                   name="password"
                   placeholder="Nouveau mot de passe">

            <button>
                Modifier
            </button>

        </form>

        <br><hr><br>

        <form method="POST"
              action="{{ route('profile.delete') }}">

            @csrf

            <button class="danger">
                Supprimer mon compte
            </button>

        </form>

    </div>

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