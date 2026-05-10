<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Agent</title>

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

        .navbar h2{
            margin:0;
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

        .title{
            margin-bottom:40px;
            color:#0F172A;
        }

        .cards{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
            gap:25px;
        }

        .card{
            background:white;
            padding:30px;
            border-radius:20px;

            box-shadow:0 5px 15px rgba(0,0,0,0.08);

            transition:0.3s;
        }

        .card:hover{
            transform:translateY(-5px);
        }

        .card h3{
            color:#0F172A;
            margin-bottom:15px;
        }

        .card p{
            color:#666;
            margin-bottom:20px;
        }

        .btn{
            display:inline-block;
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

<div class="navbar">

    <div class="nav-left">

        <img src="{{ asset('images/logo.png') }}" class="logo">
        <h2>QueueFlow</h2>

    </div>

    <div class="nav-right">

        <a href="{{ route('profile') }}" class="nav-btn">
            Mon profil
        </a>

        <a href="/logout" class="nav-btn">
            Déconnexion
        </a>

    </div>

</div>

<div class="container">

    <h1 class="title">
        Bienvenue {{ session('user_nom') }}
    </h1>

    <div class="cards">

        <div class="card">

            <h3>Gestion des services</h3>

            <p>
                Ajouter, modifier et supprimer les services et files.
            </p>

            <a href="/services" class="btn">
                Accéder
            </a>

        </div>

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