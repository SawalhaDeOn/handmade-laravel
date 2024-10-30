<?php

namespace App\Http\Controllers\SMS;

use App\Enums\DropDownFields;
use App\Enums\Modules;
use App\Http\Controllers\Controller;
use App\Models\Constant;
use App\Models\Client;
use App\Models\ShortMessage;
use App\Models\SystemSmsNotification;
use Auth;
use Illuminate\Http\Request;

class ClientSMSController extends Controller
{
    public function view_clients_sms(Request $request, Client $client)
    {
        $clientSms = ShortMessage::where('client_id', $client->id)->with('type')
            ->orderBy('created_at', 'desc')->get();

        $smsDrawerView = view('sms.client_shortMessages', ['SmsMessages' => $clientSms])->render();

        return response()->json(['drawerView' => $smsDrawerView, 'clientName' => 'Client SMS - ' . $client->name]);
    }

    public function create(Request $request, Client $client)
    {
        $SHORT_MESSAGE_TYPES = Constant::where('field', DropDownFields::SHORT_MESSAGE)->where('module', Modules::MAIN)->get();
        $SHORT_MESSAGE_TEMPLATE = Constant::where('field', DropDownFields::SHORT_MESSAGE_TEMPLATE)->where('module', Modules::MAIN)->get();
        $createView = view('sms.addedit_modal', [
            'client' => $client,
            'callTask' => $client,
            'SHORT_MESSAGE_TYPES' => $SHORT_MESSAGE_TYPES,
            'SHORT_MESSAGE_TEMPLATE' => $SHORT_MESSAGE_TEMPLATE
        ])->render();
        return response()->json(['createView' => $createView]);
    }


    public function store(Request $request, Client $client)
    {
        $request->validate([
            'type_id' => 'required',
            'to' => 'required|max:15',
            'channel' => 'required',
            'text' => 'required|string',
        ]);

        // Implement sending sms
        $newSMS = new ShortMessage();

        $newSMS->type_id = $request->type_id;
        $newSMS->client_id = $client->id;
        $newSMS->to = $request->to;
        $newSMS->text = $request->text;
        $newSMS->save();

        $sms = new SystemSmsNotification();
        $sms->gateWay = 'Wheels';
        $sms->message = $request->text;
        $sms->mobile = $request->to;;
        $sms->channel = $request->channel;;
        $sms->module = 'Client';
        $sms->type_id = $request->type_id;
        $sms->sender_type = $request->type_id;
        $sms->sender_id = $client->id;
        $sms->sms_count = strlen($request->text) / 52;
        $sms->module_id =$client->id;
        $sms->save();

       // if ($sms->channel == "WhatsApp")
            //$this->sendWhatsapp($sms->to, $sms->message, 'graph', 'Tabibfind', 'Tabibfind');
        /*   else
               smsapi()->gateway('Wheels')->sendMessage($newSMS->to,  $newSMS->text );*/

        return response()->json(['status' => true, 'message' => 'SMS has been Sent successfully!']);
    }
}
