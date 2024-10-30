<?php

namespace App\Http\Controllers;

use App\Enums\DropDownFields;
use App\Enums\Modules;
use App\Models\Attachment;
use App\Models\AttModel;
use App\Models\Constant;
use App\Models\Hospital;
use App\Models\Patient;
use App\Models\TypesModel;
use App\Models\WhatsappHistory;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat\Wizard\Locale;

use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index(Request $request)
    {

        return view('dashboard.index', []);
    }

    public
    function getUnreadMessages(Request $request)
    {
        $token = -1;
        $instanace_id = -1;
        self::$data['role'] = \Auth::user("admin")->role;
        self::$data['user_id'] = \Auth::user()->SysUsr_ID;
        if ($request->sender == "EMC") {
            $token = 'EMC';
            $instanace_id = 'EMC';
            $type = 'graph';
        }
        //self::updateWhatsAppMessages(10, $token, $instanace_id);
        $limit = $request->limit ? $request->limit : 10;
        $page = $request->page ? $request->page : 0;
        if ($request->type == "count") {
            $messages = WhatsappHistory::getWhataaAppList([], 1, 0, 0, 0, $token, 0, 2);
            return $messages->count();
        }
        self::$data['sender'] = $request->sender;
        self::$data['token'] = $token;
        self::$data['lang'] = \Auth::user("admin")->lang;
        $lastChat = WhatsappHistory::where('instance_name', $token)->orderBy('time', 'desc')->get()->first();

        if ($lastChat)
            $now = Carbon::parse(date('Y-m-d H:i:s', $lastChat->time));
        else
            $now = Carbon::now();


        $messages = WhatsappHistory::select('chatId', \Illuminate\Support\Facades\DB::raw('max(time) as time'))->where('instance_name', $token);
        $search = $request->input('inputsearch');

        if (isset($search) && $search) {
            $messages = $messages->where(function ($q) use ($search) {
                $q->where('whatsapp_histories.body', 'like', "%" . $search . "%");
                $q->orwhere('whatsapp_histories.senderName', 'like', "%" . $search . "%");
                $q->orwhere('whatsapp_histories.chatName', 'like', "%" . $search . "%");
                $q->orwhere('whatsapp_histories.chatId', 'like', "%" . $search . "%");
            });
        }

        self::$data['senders'] = $messages->orderby(DB::raw('max(time)'), 'desc')->groupBy('chatId')->paginate($limit, $columns = ['*'], 'page', $page);
        $filter = [];
        $filter['key'] = $search;
        self::$data['inputsearch'] = $filter;
        self::$data['role'] = \Auth::user()->role;
        self::$data['user_id'] = \Auth::user()->SysUsr_ID;
        self::$data['page'] = 2;
        if ($page > 0) {

            return view('dashboard.unreadWhatsAppMore', self::$data);
        }
        return view('dashboard.unreadWhatsApp', self::$data);
        /*        else
                    return redirect(self::$data['cp_route_name']);*/


    }

    public
    function getWhatsAppMessage(Request $request)
    {
        $token = -1;
        $instanace_id = -1;
        if ($request->sender == "EMC") {
            $token = 'EMC';
            $instanace_id = 'EMC';
            $type = 'graph';
        } else
            redirect()->to("" . self::$data['web_url'])->send();
        self::$data["patient"] = $request->patient;
        self::$data["sender"] = $request->sender;
        self::$data["mobile"] = $request->mobile;
        self::$data['lang'] = \Auth::user("admin")->lang;
        self::$data["role"] = \Auth::user("admin")->role;
        self::$data['user_id'] = \Auth::user()->SysUsr_ID;
        $search = $request->input('inputsearch');
        $filter = [];
        $filter['key'] = $search;
        self::$data['inputsearch'] = $filter;
        if (!$request->mobile || strlen($request->mobile) < 6)
            return "Error in Mobile No";
        $limit = 50;
        //self::updateWhatsAppMessages(20, $token, $instanace_id);
        $messages = WhatsappHistory::getWhataaAppList($filter, 0, 0, 0, $request->mobile, $token)->orderby('time', 'desc');
        if ($request->limit)
            $messages = $messages->whereNull('ack');
        $messages = $messages->take($limit)->get();
        self::$data["messages"] = $messages;

        foreach ($messages as $m)
            $m->update(['ack' => 'viewed']);

        self::$data["message"] = $request->message;
        if ($request->limit || $request->search == 1)
            return view('dashboard.newchat', self::$data);

        return view('dashboard.chat', self::$data);
    }

    public
    function sendWhatsappChat(Request $request)
    {
        try {
            $token = -1;
            $instanace_id = -1;
            $type = 0;
            if ($request->sender == "EMC") {
                $token = 'EMC';
                $instanace_id = 'EMC';
                $type = 'graph';
            }
            if ($token == -1 && $request->ajax())
                return response(['status' => false, 'message' => "error no sender"], 401);
            if ($token == -1 && !$request->ajax())
                redirect()->to("" . self::$data['web_url'])->send();

            if (str_contains($instanace_id, 'FB')) {

                self::sendWhatsapp($request->mobile, $request->message, $type, $token, $instanace_id);
            } else {
                $mobile = self::refineMobile($request->mobile,0);
//return $mobile." ". $request->message." ". $type." ". $token." ". $instanace_id;
                self::sendWhatsapp($mobile, $request->message, $type, $token, $instanace_id);

            }
            // self::sendWhatsapp($mobile, $request->message, $type, $token, $instanace_id);
            return response(array('status' => 2, 'message' => 'Done'));
        } catch (Exception $ex) {
            return response(array('status' => 0, 'message' => $ex->getMessage()));
        }
    }

    public function createAtt(Request $request)
    {
        $sender = $request->sender;
        $mobile = $request->mobile;

        $attachmentConstants = Constant::where('module', Modules::Patient)
            ->where('field', DropDownFields::ATTACHMENT_TYPE)->get();
        $createView = view('dashboard.attachments.addedit_modal', [
            'sender' => $sender,
            'mobile' => $mobile,
            'attachmentConstants' => $attachmentConstants,
            'selectedConstant' => []
        ])->render();

        return response()->json(['createView' => $createView]);
    }


    public function storeAtt(Request $request, Patient $patient)
    {
        $request->attachment_file->store('patients/attachments');

        $attachment = new Attachment([
            'attachable_id'=>$request->mobile,
            'attachment_type_id' => $request->attachment_type_id,
            'file_hash' => $request->attachment_file->hashName(),
            'file_name' => $request->attachment_file->getClientOriginalName(),
        ]);

        if ($attachment) {
            $link = "https://elite.developon.co/attachments/" . $attachment->file_hash;
            $instanace_id = -1;
            $token = -1;

            if ($request->sender == "EMC") {
                $token = 'EMC';
                $instanace_id = 'EMC';
                $type = 'graph';
            }
            if ($token == -1)
                return redirect('/');


            $this->sendWhatsappFile($request->mobile, $link, $attachment->file_name, $type, $token, $instanace_id);

            return response()->json(['status' => true, 'message' => 'Attachment has been added successfully!']);
        } else {
            return response()->json(['status' => true, 'message' => 'Attachment has been added successfully!']);
        }


    }





}
