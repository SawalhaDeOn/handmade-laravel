<?php

namespace App\Http\Controllers\Conversations;

use App\Enums\DropDownFields;
use App\Enums\Modules;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Constant;
use App\Models\Lead;
use App\Models\TawkHistory;
use App\Models\WhatsappHistory;
use App\Models\WhatsappHistoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;

class TawkController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('GET')) {
            return view('conversations.tawk.index');
        }
        if ($request->isMethod('POST')) {
            $tawkHistories = TawkHistory::with('status')->select('*');
            if ($request->input('params')) {
                $search_params = $request->input('params');
                if ($search_params['search'] != null) {
                    $search = $search_params['search'];
                    $value = $request->$search;
                    $tawkHistories->where(function ($q) use ($value) {
                        $q->where('telephone', 'like', "%" . $value . "%");
                        $q->orwhere('message_msg', 'like', "%" . $value . "%");
                    });

                }
            }
            return DataTables::eloquent($tawkHistories)
                ->filterColumn('message_msg', function ($query, $keyword) use ($request) {
                    $value = $request->telephone;
                    $query->where(function ($q) use ($value) {
                        $q->where('telephone', 'like', "%" . $value . "%");
                        $q->orwhere('message_msg', 'like', "%" . $value . "%");
                    });
                })
                ->editColumn('message_msg', function ($tawkHistory) use ($request) {
                    return substr($tawkHistory->message_msg, 0, 100);
                })
                ->editColumn('telephone', function ($tawkHistory) use ($request) {

                    if (strlen($tawkHistory->telephone) < 5)
                        return $tawkHistory->telephone;

                    $un_read = WhatsappHistory::getWhataaAppList([], 1, 0, 0, substr($tawkHistory->telephone, 0, 12), 0, 0, 2)->count();

                    $chat = ' <div class="btn-group" role="group">
                             <a title="" href="/getWhatsAppMessage?mobile=' . substr($tawkHistory->telephone, 0, 12) . '&patient=' . $tawkHistory->sender_name . '&sender=EMC" sender="EMC" title="Whatapp' . $tawkHistory->sender_name . '-' . substr($tawkHistory->telephone, 0, 12) . ':" class="chatWhat" target="_blank">
						   <i class="la la-whatsapp text-success"></i>
						   <span class="badge badge-light" id="count' . $tawkHistory->id . '">' . $un_read . '</span>
						   </a>

              </div>';

                    return $chat . '<span class="nav-text"> ' . substr($tawkHistory->telephone, 0, 12) . ' </span>';
                })
                ->editColumn('time', function ($tawkHistory) {
                    return Carbon::parse($tawkHistory->time)->format('Y-m-d');
                })
                ->editColumn('status.name', function ($tawkHistory) {
                    if ($tawkHistory->status())
                        return $tawkHistory->status->name;
                    else
                        return 'NA';
                })
                ->addColumn('action', function ($tawkHistory) {


                    $statusBtn = '<a href="' . route('conversations.tawk.changeStatus', ['tawk' => $tawkHistory->id]) . '" class="btn btn-icon btn-active-light-primary w-30px h-30px btnChangeStatus">
                    <span class="svg-icon svg-icon-3">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.3" d="M10 4H21C21.6 4 22 4.4 22 5V7H10V4Z" fill="currentColor"/>
                    <path d="M10.4 3.60001L12 6H21C21.6 6 22 6.4 22 7V19C22 19.6 21.6 20 21 20H3C2.4 20 2 19.6 2 19V4C2 3.4 2.4 3 3 3H9.20001C9.70001 3 10.2 3.20001 10.4 3.60001ZM12 16.8C11 16.8 10.2 16.4 9.5 15.8C8.8 15.1 8.5 14.3 8.5 13.3C8.5 12.8 8.59999 12.3 8.79999 11.9L10 13.1V10.1C10 9.50001 9.6 9.10001 9 9.10001H6L7.29999 10.4C6.79999 11.3 6.5 12.2 6.5 13.3C6.5 14.8 7.10001 16.2 8.10001 17.2C9.10001 18.2 10.5 18.8 12 18.8C12.6 18.8 13 18.3 13 17.8C13 17.2 12.6 16.8 12 16.8ZM16.7 16.2C17.2 15.3 17.5 14.4 17.5 13.3C17.5 11.8 16.9 10.4 15.9 9.39999C14.9 8.39999 13.5 7.79999 12 7.79999C11.4 7.79999 11 8.19999 11 8.79999C11 9.39999 11.4 9.79999 12 9.79999C12.9 9.79999 13.8 10.2 14.5 10.8C15.2 11.5 15.5 12.3 15.5 13.3C15.5 13.8 15.4 14.3 15.2 14.7L14 13.5V16.5C14 17.1 14.4 17.5 15 17.5H18L16.7 16.2Z" fill="currentColor"/>
                    <path opacity="0.3" d="M12 16.8C11 16.8 10.2 16.4 9.5 15.8C8.8 15.1 8.5 14.3 8.5 13.3C8.5 12.8 8.59999 12.3 8.79999 11.9L7.29999 10.4C6.79999 11.3 6.5 12.2 6.5 13.3C6.5 14.8 7.10001 16.2 8.10001 17.2C9.10001 18.2 10.5 18.8 12 18.8C12.6 18.8 13 18.3 13 17.8C13 17.2 12.6 16.8 12 16.8Z" fill="currentColor"/>
                    <path opacity="0.3" d="M15.5 13.3C15.5 13.8 15.4 14.3 15.2 14.7L16.7 16.2C17.2 15.3 17.5 14.4 17.5 13.3C17.5 11.8 16.9 10.4 15.9 9.39999C14.9 8.39999 13.5 7.79999 12 7.79999C11.4 7.79999 11 8.19999 11 8.79999C11 9.39999 11.4 9.79999 12 9.79999C12.9 9.79999 13.8 10.2 14.5 10.8C15.1 11.5 15.5 12.4 15.5 13.3Z" fill="currentColor"/>
                    </svg>
                    </span>
                    </a>';
                    $tawkBtn = '<a href="https://dashboard.tawk.to/#/inbox/5e52b5a2a89cda5a1887877e/all/chats/chat/'.$tawkHistory->chatId.'" class="btn btn-icon btn-active-light-primary w-30px h-30px " target="_blank">
                    <span class="svg-icon svg-icon-3">
                    <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Communication/Group-chat.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <title>Chat</title>
    <desc>Chat</desc>
    <defs/>
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path d="M16,15.6315789 L16,12 C16,10.3431458 14.6568542,9 13,9 L6.16183229,9 L6.16183229,5.52631579 C6.16183229,4.13107011 7.29290239,3 8.68814808,3 L20.4776218,3 C21.8728674,3 23.0039375,4.13107011 23.0039375,5.52631579 L23.0039375,13.1052632 L23.0206157,17.786793 C23.0215995,18.0629336 22.7985408,18.2875874 22.5224001,18.2885711 C22.3891754,18.2890457 22.2612702,18.2363324 22.1670655,18.1421277 L19.6565168,15.6315789 L16,15.6315789 Z" fill="#000"/>
        <path d="M1.98505595,18 L1.98505595,13 C1.98505595,11.8954305 2.88048645,11 3.98505595,11 L11.9850559,11 C13.0896254,11 13.9850559,11.8954305 13.9850559,13 L13.9850559,18 C13.9850559,19.1045695 13.0896254,20 11.9850559,20 L4.10078614,20 L2.85693427,21.1905292 C2.65744295,21.3814685 2.34093638,21.3745358 2.14999706,21.1750444 C2.06092565,21.0819836 2.01120804,20.958136 2.01120804,20.8293182 L2.01120804,18.32426 C1.99400175,18.2187196 1.98505595,18.1104045 1.98505595,18 Z M6.5,14 C6.22385763,14 6,14.2238576 6,14.5 C6,14.7761424 6.22385763,15 6.5,15 L11.5,15 C11.7761424,15 12,14.7761424 12,14.5 C12,14.2238576 11.7761424,14 11.5,14 L6.5,14 Z M9.5,16 C9.22385763,16 9,16.2238576 9,16.5 C9,16.7761424 9.22385763,17 9.5,17 L11.5,17 C11.7761424,17 12,16.7761424 12,16.5 C12,16.2238576 11.7761424,16 11.5,16 L9.5,16 Z" fill="#000" opacity="0.3"/>
    </g>
</svg
                    </span>
                    </a>';


                    $removeBtn = $this->deleteButton(
                        route('conversations.tawk.delete', ['tawk' => $tawkHistory->id]),
                        'btnDeletetawkHistory',
                        'data-$tawkHistory-name="Delete"'
                    );
                    return $statusBtn . $removeBtn . $tawkBtn;
                })
                ->rawColumns(['telephone', 'action'])
                ->make();
        }
    }

    public function changeStatus(Request $request, TawkHistory $tawk)
    {
        if ($request->isMethod('GET')) {
            $tawkStatuses = Constant::where('module', Modules::TAWK)->where('field', DropDownFields::status)->get();;

            $createView = view('conversations.tawk.changeStatus_modal', ['tawk' => $tawk, 'tawkStatuses' => $tawkStatuses])->render();
            return response()->json([
                'createView' => $createView
            ]);
        }
        if ($request->isMethod('POST')) {

            $request->validate([
                'status_id' => 'required',
            ]);
            $status=\App\Models\Constant::where('module', \App\Enums\Modules::CLIENT)->where('name', 'data loss')->get()->first();
            $status=$status?$status->id:null;
            $category=\App\Models\Constant::where('module', \App\Enums\Modules::CLIENT)->where('name', 'Normal')->get()->first();
            $category=$category?$category->id:null;
            $type=\App\Models\Constant::where('module', \App\Enums\Modules::CLIENT)->where('name', 'From Website')->get()->first();
            $type=$type?$type->id:null;
            $status_lead=\App\Models\Constant::where('module', \App\Enums\Modules::LEAD)->where('name', 'processing')->get()->first();
            $status_lead=$status_lead?$status_lead->id:null;
            $move_lead=\App\Models\Constant::where('module', \App\Enums\Modules::TAWK)->where('name', 'Send To Leads')->get()->first();
            $move_lead=$move_lead?$move_lead->id:null;
            $tawk->update($request->all());

            if($tawk->status_id==$move_lead) {
                $client = Client::create(["name" => $request->visit_name, "telephone" =>$request->telephone, "email" => $request->visit_email, "status" => $status, "type_id" => $type, "category" => $category]);
                $lead = Lead::create(["client_id" => $client->id, "status" => $status_lead]);
            }

            return response()->json(['status' => true, 'message' => 'Tawk History status updated successfully']);
        }
    }


    public function delete(Request $request, TawkHistory $tawk)
    {
        $tawk->delete();
        return response()->json(['status' => true, 'message' => 'TawkHistory Deleted Successfully !']);
    }
}
