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

        <button>
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
