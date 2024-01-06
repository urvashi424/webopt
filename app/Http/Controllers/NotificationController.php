<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Jobs\SendPushNotificationJob;
use App\Models\User;
use App\Notifications\PushNotification;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
class NotificationController extends Controller
{
    public function index()
    {
        return Inertia::render('Notification/Index');
    }

    public function store(Request $request)
    {

        User::all()->chunkWhile(function (string $value, int $key, Collection $chunk) use($request) {
            foreach ($chunk as $user) {
                dispatch(new SendPushNotificationJob(new PushNotification($request->title,$request->description),$user));
            }

        });

        return Response::success('Notification sent succesfully');
    }




}
