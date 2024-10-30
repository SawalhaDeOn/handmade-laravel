<?php

namespace App\Http\Controllers\Conversations;

use App\Http\Controllers\Controller;
use App\Models\WhatsappHistory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class WhatsAppHistoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('GET')) {
            return view('conversations.whatsapp.index');
        }
        if ($request->isMethod('POST')) {
            $whatsappHistories = WhatsappHistory::getWhataaAppList([]);
            return DataTables::eloquent($whatsappHistories)
                ->editColumn('instance', function ($whatsappHistory) {
                    //$senderModel = $whatsappHistory->instance->getMorphClass();
                    //$instance = class_basename($senderModel);
                    return $whatsappHistory->instance_name;
                })

                ->make();
        }
    }
}
