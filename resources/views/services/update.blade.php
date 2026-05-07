<!DOCTYPE html>
<html>
<head>
    <title>Modifier Service</title>

    <style>

        body{
            margin:0;
            font-family:Arial;
            background:#F1F5F9;

            display:flex;
            justify-content:center;
            align-items:center;

            height:100vh;
        }

        .card{
            background:white;
            width:500px;
            padding:40px;
            border-radius:20px;

            box-shadow:0 5px 15px rgba(0,0,0,0.1);
        }

        h2{
            color:#0F172A;
            margin-bottom:25px;
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
        .back-btn{
            display:inline-block;
            margin-top:20px;
            background:#0F172A;
            color:white;
            padding:12px 18px;
            border-radius:10px;
            text-decoration:none;
            font-weight:bold;
        }
        

    </style>

</head>
<body>

<div class="card">

    <h2>Modifier Service</h2>

    <form method="POST" action="{{ route('services.update', $service->idService) }}">

        @csrf

        <input type="text"
               name="nomService"
               value="{{ $service->nomService }}">

        <input type="text"
               name="description"
               value="{{ $service->description }}">

        <button type="submit">
            Modifier
        </button>
        <a href="{{ route('services.index') }}"class="back-btn">
            <-Retour
        </a>

    </form>
    <br>
    

</div>

</body>
</html>
