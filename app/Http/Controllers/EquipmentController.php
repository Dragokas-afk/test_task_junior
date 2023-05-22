<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\SendNotificationsForUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class EquipmentController extends Controller
{
    // TODO: Validation Filters
// TODO: Normal Redirects


    public function index()
    {
        Log::channel('daily')->info(
            'Пользователь перешел на страницу id: ' . Auth::id() . ' ' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']
        );
        return view('newEquipment');

    }

    public function indexList()
    {
        Log::channel('daily')->info(
            'Пользователь перешел на страницу id: ' . Auth::id() . ' ' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']
        );
        return view('equipmentList', [
            'newEquipmentList' => Equipment::where('status', 'Новое')->get(),
            'stocks' => \App\Models\Stock::all()]);

    }

    public function replaceEquipment(Request $request)
    {

        Equipment::replaceEquipment($request);
        SendNotificationsForUsers::sendNotifyProvider($request);

        return back()->with(['success' => 'Успешно перемещен']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createEquipment(Request $request)
    {

        Equipment::createEquipment($request);
        SendNotificationsForUsers::sendNotifyManager($request);

        return back()->with(['success' => 'Успешно']);
    }


}
