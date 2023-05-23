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
    //Отправка уведомления поставщикам после того как управляющий переместил оборудование
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
    //Отправка уведомления управляющим после того как поставщик переместил оборудование
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



}
