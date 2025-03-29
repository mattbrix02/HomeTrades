<?php

namespace App\Http\Controllers;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Gate;

class NotificationSeenController extends Controller
{
    public function __invoke(DatabaseNotification $notification){

        Gate::authorize('update', $notification);
        $notification->markAsRead();

        return redirect()->back()->with('success','Notififcation marked as Read');
    }
}
