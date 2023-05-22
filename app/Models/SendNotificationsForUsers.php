<?php

namespace App\Models;

use App\Notifications\EmailToUsers;
use App\Notifications\UsersNotifications;
use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class SendNotificationsForUsers extends Model
{
    use HasFactory;
//TODO: Поменять уведомление на конкретного поставщика
    public static function sendNotifyProvider($request)
    {
        $users = User::where('role', 'Provider')->get();
        $message = 'Moved equipment';
        if ($request->moveEquipment) {
            Notification::send($users, new UsersNotifications($message));
        }
        Log::channel('daily')->info(
            'Отправлено уведомление поставщикам. Отправил менеджер ' . Auth::id()
        );
    }
    public static function sendNotifyManager($request)
    {
        $users = User::where('role', 'Manager')->get();
        $message = 'add new equipment';
        if ($request->addEquipment) {
            Notification::send($users, new UsersNotifications($message));
        }
        Log::channel('daily')->info(
            'Отправлено уведомление управляющим. Отправил поставщик ' . Auth::id()
        );
    }

    public function sendEmailToProvider($request)
    {

    }

    public function sendEmailToManager($request)
    {
        $users = User::where('role', 'Manager')->get();
        $message = 'add new equipment';
        if ($request->addEquipment) {
            Notification::send($users, new EmailToUsers($message));
        }
        Log::channel('daily')->info(
            'Отправлено уведомление по почте управляющим. Отправил поставщик ' . Auth::id()
        );
    }

}
