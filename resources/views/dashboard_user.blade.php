<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Utilisateur</title>

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
        }

        .container{
            padding:50px;
        }

        .card{
            background:white;
            padding:35px;
            border-radius:20px;

            width:400px;

            box-shadow:0 5px 15px rgba(0,0,0,0.08);
        }

        .card h3{
            color:#0F172A;
        }

        .card p{
            color:#666;
            margin:20px 0;
        }

        .btn{
            background:#38BDF8;
            color:white;
            padding:12px 20px;
            border-radius:10px;
            text-decoration:none;
            font-weight:bold;
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

    <div class="card">

        <h3>
            Bienvenue {{ session('user_nom') }}
        </h3>

        <p>
            Consultez les services disponibles et rejoignez une file.
        </p>

        <a href="/services" class="btn">
            Voir les services
        </a>

    </div>

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