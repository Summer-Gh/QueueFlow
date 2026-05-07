<!DOCTYPE html>
<html>
<head>
    <title>QueueFlow</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial, Helvetica, sans-serif;
        }

        body{
            height:100vh;
            background:#0F172A;
            display:flex;
            justify-content:center;
            align-items:center;
            overflow:hidden;
        }

        .background-circle{
            position:absolute;
            border-radius:50%;
            background:#38BDF8;
            opacity:0.08;
        }

        .circle1{
            width:350px;
            height:350px;
            top:-100px;
            left:-100px;
        }

        .circle2{
            width:250px;
            height:250px;
            bottom:-80px;
            right:-80px;
        }

        .card{
            position:relative;
            z-index:10;

            width:600px;
            background:white;
            padding:50px;
            border-radius:25px;

            text-align:center;

            box-shadow:0 10px 35px rgba(0,0,0,0.25);
        }

        .logo{
            width:120px;
            height:120px;
            border-radius:50%;

            margin:auto;
            margin-bottom:25px;

            background:#38BDF8;

            display:flex;
            justify-content:center;
            align-items:center;

            color:white;
            font-size:22px;
            font-weight:bold;
        }

        h1{
            color:#0F172A;
            font-size:42px;
            margin-bottom:15px;
        }

        .subtitle{
            color:#555;
            line-height:1.8;
            font-size:16px;
            margin-bottom:35px;
        }

        .features{
            display:flex;
            gap:15px;
            margin-bottom:35px;
        }

        .feature{
            flex:1;
            background:#F8FAFC;
            padding:18px;
            border-radius:15px;
            border:1px solid #E2E8F0;
        }

        .feature h3{
            color:#0F172A;
            margin-bottom:8px;
            font-size:15px;
        }

        .feature p{
            font-size:13px;
            color:#666;
        }

        .buttons{
            margin-top:10px;
        }

        .btn{
            display:inline-block;
            padding:14px 28px;
            border-radius:12px;
            text-decoration:none;
            font-weight:bold;
            margin:10px;
            transition:0.3s;
        }

        .login{
            background:#0F172A;
            color:white;
        }

        .register{
            background:#38BDF8;
            color:white;
        }

        .btn:hover{
            transform:translateY(-3px);
        }

        .footer{
            margin-top:30px;
            color:#999;
            font-size:13px;
        }

    </style>

</head>
<body>

<div class="background-circle circle1"></div>
<div class="background-circle circle2"></div>

<div class="card">

    <div class="logo">
        LOGO
    </div>

    <h1>QueueFlow</h1>

    <p class="subtitle">
        Une plateforme moderne de gestion des files d’attente permettant
        aux utilisateurs de rejoindre une file, suivre leur ticket
        et recevoir des notifications intelligentes.
    </p>

    <div class="features">

        <div class="feature">
            <h3>🎫 Tickets</h3>
            <p>Génération automatique des tickets.</p>
        </div>

        <div class="feature">
            <h3>🔔 Notifications</h3>
            <p>Alertes automatiques pour les clients.</p>
        </div>

        <div class="feature">
            <h3>⚡ Rapidité</h3>
            <p>Gestion fluide des files d’attente.</p>
        </div>

    </div>

    <div class="buttons">

        <a href="/login" class="btn login">
            Connexion
        </a>

        <a href="/register" class="btn register">
            Inscription
        </a>

    </div>

    <div class="footer">
        QueueFlow © 2026
    </div>

</div>

</body>
</html>