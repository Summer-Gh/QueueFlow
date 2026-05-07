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
            color:white;
            padding:20px 40px;

            display:flex;
            justify-content:space-between;
            align-items:center;
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

    </style>

</head>
<body>

<div class="navbar">

    <h2>QueueFlow - Utilisateur</h2>

    <a href="/logout" class="logout">
        Déconnexion
    </a>

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

</body>
</html>