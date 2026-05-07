<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>

    <style>

        body{
            margin:0;
            height:100vh;
            background:#0F172A;

            display:flex;
            justify-content:center;
            align-items:center;

            font-family:Arial;
        }

        .card{
            width:400px;
            background:white;
            padding:40px;
            border-radius:20px;
        }

        h2{
            text-align:center;
            color:#0F172A;
            margin-bottom:30px;
        }

        input{
            width:100%;
            padding:14px;
            margin-bottom:20px;

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

        button:hover{
            opacity:0.9;
        }

        .link{
            text-align:center;
            margin-top:20px;
        }

        .link a{
            color:#38BDF8;
            text-decoration:none;
        }

        .error{
            color:red;
            margin-bottom:15px;
            text-align:center;
        }

    </style>

</head>
<body>

<div class="card">

    <h2>Connexion</h2>

    @if(session('error'))
        <div class="error">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="/login">
        @csrf

        <input type="email" name="email" placeholder="Email">

        <input type="password" name="password" placeholder="Mot de passe">

        <button type="submit">
            Se connecter
        </button>
    </form>

    <div class="link">
        <a href="/register">
            Créer un compte
        </a>
    </div>

</div>

</body>
</html>