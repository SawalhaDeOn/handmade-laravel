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
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PatientCallController extends Controller
{

    public function view_patients_calls(Request $request, Patient $patient)
    {
        $patientCalls = Call::where('patient_id', $patient->id)->with(
            'callAction',
            'patientAction',
            'user',
        )
            ->withCount('callQuestionnaireResponses')
            ->orderBy('created_at', 'desc')->get();



        $marketingCalls = MarketingCallAction::where('patient_id', $patient->id)
            ->with(['user', 'callAction', 'sickFund'])
            ->orderBy('created_at', 'desc')->get();


        $outgoingCalls = view('calls.patient_outgoing_calls_card', [
            'calls' => $patientCalls->where('call_type', 'outgoing_call'),
            'patient' => $patient,
        ])->render();

        $incomingCalls = view('calls.patient_incoming_calls_card', [
            'calls' => $patientCalls->where('call_type', 'incoming_call'),
            'patient' => $patient,
        ])->render();
        $marketingCallsView = view('calls.patient_marketing_calls_card', [
            'calls' => $marketingCalls,
            'patient' => $patient,
        ])->render();

        $result =  $outgoingCalls . '<div class="separator separator-dashed my-4"></div>' . $incomingCalls . '<div class="separator separator-dashed my-4"></div>' .
            $marketingCallsView;

        return response()->json(['drawerView' => $result, 'patientName' => 'Patient Calls - ' . $patient->name .'-'.$patient->mobile]);
    }

    public function view_call_questionnaire_responses(Request $request, Call $call)
    {
        $call->load('callQuestionnaireResponses');
        // $call->load('callQuestionnaireResponses.questionnaire');
        // $call->load('callQuestionnaireResponses.question');
        $questionnaire = $call->callQuestionnaireResponses->pluck('questionnaire')->first();
        $patient = $call->callQuestionnaireResponses->pluck('patient')->first();
        $call = $call->callQuestionnaireResponses->pluck('call')->first();
        // dd($questionnaire->title);
        // foreach ($call->callQuestionnaireResponses as $key => $value) {
        //     dd($value);
        // }
        $viewResult = view('calls.questionnaire_responses_table', [
            'responses' => $call->callQuestionnaireResponses,
            'questionnaire' => $questionnaire,
            'call' => $call
        ])->render();

        return response()->json(['drawerView' => $viewResult, 'patientName' => 'Patient Calls - ' . $patient->name]);
    }

    public function create(Request $request, Patient $patient)
    {

        $callActions = Constant::where('field',  DropDownFields::CALL_ACTION)->where('module', Modules::MAIN)->get();
        $callPatientActions = Constant::where('field',  DropDownFields::CALL_PATIENT_ACTION)->where('module', Modules::MAIN)->get();

        $questionnaires = CallQuestionnaire::all();

        $EMPLOYEES = [];

        if (Auth::user()->hasRole('super-admin')) {
            $EMPLOYEES = User::all();
        } else {
            $EMPLOYEES = User::where('id', Auth::user()->id)->get();
        }

        $createView = view('calls.addedit_modal', [
            'patient' => $patient,
            'CALL_ACTION' => $callActions,
            'CALL_PATIENT_ACTIONS' => $callPatientActions,
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

    public function store(Request $request, Patient $patient)
    {
        $request->validate([
            'call_action_id' => 'required',
            'patient_action_id' => 'required',
            'user_id' => Rule::requiredIf(Auth::user()->hasRole('super-admin')),
            'next_call' => 'required',
            'notes' => 'required',
        ]);
        $newCall = new Call();

        $newCall->patient_id = $patient->id;
        $newCall->call_action_id = $request->call_action_id;
        $newCall->patient_action_id = $request->patient_action_id;
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
                        'patient_id' => $patient->id,
                        'call_questionnaire_id' => $call_questionnaire_key,
                        'cq_question_id' => $quetionId,
                        'answer' => $questionResponse
                    ]);
                }
            }
        }

        return response()->json(['status' => true, 'message' => 'Call has been added successfully!']);
    }


    public function edit(Request $request, Patient $patient, Call $Call)
    {
        $createView = view('calls.addedit_modal', ['call' => $Call])->render();
        return response()->json(['createView' => $createView]);
    }

    public function update(Request $request, Patient $patient, Call $Call)
    {
        $request->validate([
            'call_action_id' => 'required',
            'patient_action_id' => 'required',
            'user_id' => Rule::requiredIf(Auth::user()->hasRole('super-admin')),
            'next_call' => 'required',
            'notes' => 'required',
        ]);

        $Call->patient_id =  $patient->id;
        $Call->call_action_id = $request->call_action_id;
        $Call->patient_action_id = $request->patient_action_id;
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
