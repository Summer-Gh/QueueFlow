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

.nav-btn{
    background:#38BDF8;
    color:white;

    padding:10px 18px;
    border-radius:10px;

    text-decoration:none;
    font-weight:bold;
}

.container{
    max-width:1000px;
    margin:auto;
    padding:40px;
}

h1{
    color:#0F172A;
    margin-bottom:30px;
}

.card{
    background:white;
    padding:25px;
    border-radius:20px;
    margin-bottom:20px;

    box-shadow:0 5px 15px rgba(0,0,0,0.08);

    transition:0.3s;
}

.card:hover{
    transform:translateY(-3px);
}

.card p{
    color:#334155;
    font-size:16px;
}

button{
    border:none;
    padding:12px 18px;
    border-radius:10px;

    cursor:pointer;

    color:white;
    font-weight:bold;

    transition:0.3s;
}

button:hover{
    opacity:0.9;
}

.read-btn{
    background:#38BDF8;
}

.danger{
    background:#ef4444;
}

.empty{
    background:white;
    padding:30px;
    border-radius:20px;
    text-align:center;

    color:#64748B;

    box-shadow:0 5px 15px rgba(0,0,0,0.08);
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
<div class="navbar">

    <div class="nav-left">

        <img
            src="{{ asset('images/logo.png') }}"
            class="logo"
        >

        <h2>QueueFlow</h2>

    </div>

    <a href="{{ route('services.index') }}"
       class="nav-btn">

        Retour

    </a>

</div>

<div class="container">
    <h1>Mes notifications</h1>
    @forelse($notifications as $notif)
    <div class="card" style="margin-bottom:20px;">
        <p>
            {{ $notif->message }}
        </p>
        <br>
        @if(!$notif->isRead)
        <form method="POST"
        action="{{ route('notifications.read', $notif->idNotif) }}">
        @csrf
        <button class="read-btn">
            Marquer comme lu
        </button>
        </form>
        @endif
        <br>
        <form method="POST"
          action="{{ route('notifications.delete', $notif->idNotif) }}">
          @csrf
          <button class="danger">
            Supprimer
          </button>

        </form>
    </div>
    @empty
    <p>Aucune notification</p>
    @endforelse
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