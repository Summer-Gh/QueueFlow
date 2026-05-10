<!DOCTYPE html>
<html>
<head>

    <style>

        body{
            font-family: Arial;
            text-align:center;
            padding:40px;
        }


        
        .ticket{
            border:2px solid #0F172A;
            border-radius:20px;
            padding:30px;
        }

        h1{
            color:#0F172A;
        }

        p{
            font-size:18px;
        }

    </style>

</head>
<body>

<div class="ticket">

    <h1>QueueFlow Ticket</h1>

    <p>
        Utilisateur :
        {{ $ticket->user->nom }}
    </p>

    <br><br>

    {!! QrCode::size(200)->generate(
        'Utilisateur ID: '.$ticket->idUser
    ) !!}

    <br><br>

    <p>
        Présentez ce QR code à l’agent.
    </p>

</div>

</body>
</html>