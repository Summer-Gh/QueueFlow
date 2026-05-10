<!DOCTYPE html>
<html>
<head>

    <style>

        body{
            font-family: DejaVu Sans;
            padding:40px;
            color:#0F172A;
            background:#F8FAFC;
        }

        .container{
            border:3px solid #0F172A;
            border-radius:20px;
            padding:40px;
            text-align:center;
            background:white;
        }

        .logo{
            width:110px;
            margin-bottom:20px;
        }

        h1{
            color:#0F172A;
            margin-bottom:10px;
        }

        .subtitle{
            color:#64748B;
            margin-bottom:30px;
        }

        .ticket-box{
            background:#F1F5F9;
            border-radius:18px;
            padding:30px;
            margin-top:20px;
        }

        .info{
            font-size:20px;
            margin-bottom:18px;
            color:#0F172A;
        }

        .highlight{
            color:#0284C7;
            font-weight:bold;
        }

        .footer{
            margin-top:35px;
            color:#64748B;
            font-size:14px;
        }

    </style>

</head>

<body>

<div class="container">

    <img
        src="{{ public_path('images/logo.png') }}"
        class="logo"
    >

    <h1>QueueFlow Ticket</h1>

    <p class="subtitle">
        Gestion intelligente des files d’attente
    </p>

    <div class="ticket-box">

        <p class="info">
            <strong>Utilisateur :</strong>
            <span class="highlight">
                {{ $ticket->user->nom }}
            </span>
        </p>

        <p class="info">
            <strong>Position actuelle :</strong>
            <span class="highlight">
                {{ $ticket->position }}
            </span>
        </p>

        <p class="info">
            <strong>Temps estimé :</strong>
            <span class="highlight">
                {{ $ticket->tempsEstime }} min
            </span>
        </p>

        <p class="info">
            <strong>Date :</strong>
            <span class="highlight">
                {{ date('d/m/Y H:i') }}
            </span>
        </p>

    </div>

    <div class="footer">

        Merci d’utiliser QueueFlow.

    </div>

</div>

</body>
</html>