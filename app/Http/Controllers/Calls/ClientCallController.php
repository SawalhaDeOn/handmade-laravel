<?php

namespace App\Http\Controllers\Calls;

use App\Enums\DropDownFields;
use App\Enums\Modules;
use App\Http\Controllers\Controller;
use App\Models\Call;
use App\Models\CallQuestionnaire;
use App\Models\CallQuestionnaireResponse;
use App\Models\Constant;
use App\Models\MarketingCallAction;
use App\Models\Client;
use App\Models\ShortMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ClientCallController extends Controller
{

    public function view_clients_calls(Request $request, Client $client)
    {
        $clientCalls = Call::where('client_id', $client->id)->with(
            'callAction',
            'clientAction',
            'user',
        )
            ->withCount('callQuestionnaireResponses')
            ->orderBy('created_at', 'desc')->get();





        $outgoingCalls = view('calls.client_outgoing_calls_card', [
            'calls' => $clientCalls->where('call_type', 'outgoing_call'),
            'client' => $client,
        ])->render();
        $clientSms = ShortMessage::where('client_id', $client->id)->with('type')
            ->orderBy('created_at', 'desc')->get();

        $incomingCalls = view('calls.client_incoming_calls_card', [
            "SmsMessages"=>$clientSms,
            'client' => $client,
        ])->render();




        $result =  $outgoingCalls . '<div class="separator separator-dashed my-4"></div>' . $incomingCalls . '<div class="separator separator-dashed my-4"></div>' ;


        return response()->json(['drawerView' => $result, 'clientName' => 'Client Calls - ' . $client->name]);
    }

    public function view_call_questionnaire_responses(Request $request, Call $call)
    {
        $call->load('callQuestionnaireResponses');
        // $call->load('callQuestionnaireResponses.questionnaire');
        // $call->load('callQuestionnaireResponses.question');
        $questionnaire = $call->callQuestionnaireResponses->pluck('questionnaire')->first();

        $call = $call->callQuestionnaireResponses->pluck('call')->first();
        $client = $call->client();
        // dd($questionnaire->title);
        // foreach ($call->callQuestionnaireResponses as $key => $value) {
        //     dd($value);
        // }
        $viewResult = view('calls.questionnaire_responses_table', [
            'responses' => $call->callQuestionnaireResponses,
            'questionnaire' => $questionnaire,
            'call' => $call
        ])->render();

        return response()->json(['drawerView' => $viewResult, 'clientName' => 'Client Calls - ' ]);
    }

    public function create(Request $request, Client $client)
    {

        $callActions = Constant::where('field',  DropDownFields::CLIENT_CALL_ACTION)->where('module', Modules::CLIENT)->get();
        $callClientActions = Constant::where('field',  DropDownFields::CLIENT_ACTION)->where('module', Modules::CLIENT)->get();

        $questionnaires = CallQuestionnaire::all();

        $EMPLOYEES = [];

        if (Auth::user()->hasRole('super-admin')) {
            $EMPLOYEES = User::all();
        } else {
            $EMPLOYEES = User::where('id', Auth::user()->id)->get();
        }

        $createView = view('calls.addedit_modal', [
            'client' => $client,
            'CALL_ACTION' => $callActions,
            'CALL_CLIENT_ACTIONS' => $callClientActions,
            'EMPLOYEES' => $EMPLOYEES,
            'questionnaires' => $questionnaires
        ])->render();
        return response()->json(['createView' => $createView]);
    }


    private function EnsureUserId($user_id)
    {
        if (Auth::user()->hasRole('super-admin')) {
            return $user_id;
        } else {
            return Auth::user()->id;
        }
    }

    public function store(Request $request, Client $client)
    {
        $request->validate([
            'call_action_id' => 'required',
            'client_action_id' => 'required',
            'user_id' => Rule::requiredIf(Auth::user()->hasRole('super-admin')),
            'next_call' => 'required',
            'notes' => 'required',
        ]);
        $newCall = new Call();

        $newCall->client_id = $client->id;
        $newCall->call_action_id = $request->call_action_id;
        $newCall->client_action_id = $request->client_action_id;
        $newCall->user_id = $this->EnsureUserId($request->user_id);
        $newCall->next_call = $request->next_call;
        $newCall->notes = $request->notes;
        $newCall->call_type = 'outgoing_call';

        $newCall->save();

        if ($request->has('call_questionnaire')) {
            foreach ($request->call_questionnaire as $call_questionnaire_key => $questionIds) {
                foreach ($questionIds['questionId'] as $quetionId => $questionResponse) {
                    CallQuestionnaireResponse::create([
                        'call_id' => $newCall->id,
                        'module' => 'client',
                        'call_questionnaire_id' => $call_questionnaire_key,
                        'cq_question_id' => $quetionId,
                        'answer' => $questionResponse
                    ]);
                }
            }
        }

        return response()->json(['status' => true, 'message' => 'Call has been added successfully!']);
    }


    public function edit(Request $request, Client $client, Call $Call)
    {
        $createView = view('calls.addedit_modal', ['call' => $Call])->render();
        return response()->json(['createView' => $createView]);
    }

    public function update(Request $request, Client $client, Call $Call)
    {
        $request->validate([
            'call_action_id' => 'required',
            'client_action_id' => 'required',
            'user_id' => Rule::requiredIf(Auth::user()->hasRole('super-admin')),
            'next_call' => 'required',
            'notes' => 'required',
        ]);

        $Call->client_id =  $client->id;
        $Call->call_action_id = $request->call_action_id;
        $Call->client_action_id = $request->client_action_id;
        $Call->user_id = $this->EnsureUserId($request->user_id);
        $Call->next_call =  $request->next_call;
        $Call->notes =  $request->notes;

        $Call->save();
        return response()->json(['status' => true, 'message' => 'Call Updated']);
    }

    public function delete(Request $request, Call $Call)
    {
        $Call->delete();
        return response()->json(['status' => true, 'message' => 'Call Deleted Successfully !']);
    }
}
