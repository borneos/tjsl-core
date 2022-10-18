<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Responder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ResponderController extends Controller
{
    public function store(Request $request)
    {
        $attrs = $request->validate([
            'name'    => 'required',
            'email'   => 'required',
            'telp'    => 'required',
            'message' => 'sometimes'
        ]);
        $data = Responder::create($attrs);
        $arr["name"] = $data->name;
        $arr["email"] = "info@kamiumkm.com";
        $arr['resEmail'] = $data->email;
        $arr["subject"] = env('MAIL_FROM_NAME'). " $data->name";
        $arr["resMessage"] = $data->message ? $data->message : '-';
        $arr["sender"] = false;
        Mail::send('admin.responder.forward-email', $arr, function($send) use ($arr){
            $send->to($arr["email"])->subject($arr["subject"]);
        });
        $arr["subject"] = "no-replay Responder KamiUMKM";
        $arr["sender"] = true;
        Mail::send('admin.responder.forward-email', $arr, function($send) use ($arr){
            $send->to($arr["resEmail"])->subject($arr["subject"]);
        });
        return response()->json(['message' => 'Data saved successfully']);
    }
}
