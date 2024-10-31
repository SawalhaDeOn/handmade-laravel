<?php

namespace App\Http\Controllers\SMS;

use App\Enums\DropDownFields;
use App\Enums\Modules;
use App\Http\Controllers\Controller;
use App\Models\Constant;
use App\Models\Patient;
use App\Models\ShortMessage;
use App\Models\SystemSmsNotification;
use Auth;
use Illuminate\Http\Request;

class PatientSMSController extends Controller
{
    public function view_patients_sms(Request $request, Patient $patient)
    {
        $patientSms = ShortMessage::where('patient_id', $patient->id)->with('type')
            ->orderBy('created_at', 'desc')->get();

        $smsDrawerView = view('sms.patient_shortMessages', ['SmsMessages' => $patientSms])->render();

        return response()->json(['drawerView' => $smsDrawerView, 'patientName' => 'Patient SMS - ' . $patient->name]);
    }

    public function create(Request $request, Patient $patient)
    {
        $SHORT_MESSAGE_TYPES = Constant::where('field',  DropDownFields::SHORT_MESSAGE)->where('module', Modules::MAIN)->get();
        $SHORT_MESSAGE_TEMPLATE = Constant::where('field',  DropDownFields::SHORT_MESSAGE_TEMPLATE)->where('module', Modules::MAIN)->get();
        $createView = view('sms.addedit_modal', [
            'patient' => $patient,
            'SHORT_MESSAGE_TYPES' => $SHORT_MESSAGE_TYPES,
            'SHORT_MESSAGE_TEMPLATE' => $SHORT_MESSAGE_TEMPLATE
        ])->render();
        return response()->json(['createView' => $createView]);
    }


    public function store(Request $request, Patient $patient)
    {
        $request->validate([
            'type_id' => 'required',
            'to' => 'required|max:15',
            'text' => 'required|string',
        ]);

        // Implement sending sms

        $newSMS = new ShortMessage();

        $newSMS->type_id = $request->type_id;
        $newSMS->patient_id = $patient->id;
        $newSMS->to = $request->to;
        $newSMS->text = $request->text;
        $newSMS->save();

        $sms=new SystemSmsNotification();
        $sms->mobile=$patient->mobile;
        $sms->gateway='EliteMedical';
        $sms->sender_type=$patient->getMorphClass();
        $sms->sender_id=$patient->id;
        //$sms->module='Patient';
        $sms->message=$newSMS->text;
        $sms->type_id= $newSMS->type_id ;
        $sms->sms_count=strlen($newSMS->text)/52;
       // $sms->module_id = $patient->id;
        $sms->save();

        smsapi()->gateway('EliteMedical')->sendMessage($newSMS->to,  $newSMS->text );
        return response()->json(['status' => true, 'message' => 'SMS has been Sent successfully!']);
    }
}
