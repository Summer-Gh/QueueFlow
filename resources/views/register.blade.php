<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>

    <style>

        body{
            margin:0;
            min-height:100vh;
            background:#0F172A;

            display:flex;
            justify-content:center;
            align-items:center;

            font-family:Arial;
            padding:30px;
        }

        .card{
            width:450px;
            background:white;
            padding:40px;
            border-radius:20px;
        }

        h2{
            text-align:center;
            color:#0F172A;
            margin-bottom:25px;
        }

        input{
            width:100%;
            padding:14px;
            margin-bottom:18px;

            border:1px solid #ccc;
            border-radius:10px;

            box-sizing:border-box;
        }

        button{
            width:100%;
            padding:14px;

            background:#38BDF8;
            color:white;

            border:none;
            border-radius:10px;

            font-weight:bold;
            cursor:pointer;
        }

        .errors{
            background:#fee2e2;
            color:#991b1b;
            padding:10px;
            border-radius:10px;
            margin-bottom:20px;
        }

        .link{
            text-align:center;
            margin-top:20px;
        }

        .link a{
            color:#38BDF8;
            text-decoration:none;
        }

    </style>

</head>
<body>

<div class="card">

    <h2>Inscription</h2>

    @if($errors->any())

        <div class="errors">

            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach

        </div>

    @endif

    <form method="POST" action="/register">

        @csrf

        <input type="text" name="nom" placeholder="Nom">

        <input type="email" name="email" placeholder="Email">

        <input type="password" name="password" placeholder="Mot de passe">

        <input type="password" name="c_password" placeholder="Confirmer le mot de passe">

        <input type="text" name="telephone" placeholder="Téléphone">

        <button type="submit">
            S'inscrire
        </button>

    </form>

    <div class="link">
        <a href="/login">
            Déjà un compte ?
        </a>
    </div>

</div>

</body>
</html>