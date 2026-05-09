<?php

namespace App\Http\Controllers;

use App\Models\Notifications;

class NotificationController extends Controller
{
    // LIST
    public function index()
    {
        $notifications = Notifications::where(
            'idUser',
            session('user_id')
        )->orderBy('idNotif', 'desc')->get();

        return view(
            'notifications.index',
            compact('notifications')
        );
    }

    // MARK AS READ
    public function read($id)
    {
        $notif = Notifications::find($id);

        if($notif){

            $notif->isRead = 1;

            $notif->save();
        }

        return back();
    }

    // DELETE
    public function delete($id)
    {
        $notif = Notifications::find($id);

        if($notif){

            $notif->delete();
        }

        return back();
    }
}