<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Notifications\OrderNotification;
use App\Services\MsgFormat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class NotificationController extends Controller
{
    function send() {
        $admin = Admin::find(1);
        $admin->notify(new OrderNotification('Sama', 500));

        // Artisan::call("queue:stop");

        // dd($admin);

        // $f = new MsgFormat();

        // return $f->msg();
    }

    function read() {
        $admin = Admin::find(1);
        // $admin->notifications->markAsRead();
        return view('notify.read', compact('admin'));
    }

    function mark_read($id) {
        $admin = Admin::find(1);
        $admin->notifications->find($id)->markAsRead();

        return redirect()->back();
    }
}

// 'mine\'s'


// .
// =>
// ->
// ::
// ''
// ""
// \'
