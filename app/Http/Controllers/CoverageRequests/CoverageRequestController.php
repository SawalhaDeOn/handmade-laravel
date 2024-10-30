<?php

namespace App\Http\Controllers\CoverageRequests;

use App\Enums\DropDownFields;
use App\Enums\Modules;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Constant;
use App\Models\CoverageRequest;
use App\Models\CoverageRequestMedication;
use App\Models\CoverageRequestTreatment;
use App\Models\CoverageRequestType;
use App\Models\CoverageTreatmentProcedure;
use App\Models\Medication;
use App\Models\Patient;
use App\Models\Procedure;
use App\PatientService;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class CoverageRequestController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('GET')) {
            return view('coverageRequests.index');
        }
        if ($request->isMethod('POST')) {

            $currentDate = date('Y-m-d');

            $totalStats = DB::table('coverage_requests')
                ->selectRaw("count(case when status = 'in process' and request_date = '$currentDate' then 1 end) as new_coverage_requests_count")
                ->selectRaw("count(case when status = 'in process' then 1 end) as in_process")
                ->selectRaw("count(case when status = 'approved' then 1 end) as approved")
                ->selectRaw("count(case when status = 'declined' then 1 end) as declined")
                ->where('deleted_at', null)
                ->first();

            $totalStats = get_object_vars($totalStats);

            $coverageRequests = CoverageRequest::with(
                'patient',
                'patient.branch',
                'patient.patientClinic',
                'patient.sickFund',
                'coverageRequestType',
                'procedure',
                'medication',
                'urgencyType',
                'appointment',
                'source',
                'user',
            )->select('coverage_requests.*');

            if ($request->input('params')) {
                $search_params = $request->input('params');
                if ($search_params['status'] != null) {
                    $status = $search_params['status'];
                    if ($status == 'status_new_requests') {
                        $coverageRequests->where('status', 'in process');
                        $coverageRequests->where('request_date', $currentDate);
                    }
                    if ($status == 'status_in_process') {
                        $coverageRequests->where('status', 'in process');
                    }
                    if ($status == 'status_approved') {
                        $coverageRequests->where('status', 'approved');
                    }
                    if ($status == 'status_declined') {
                        $coverageRequests->where('status', 'declined');
                    }
                }
            }

            return DataTables::eloquent($coverageRequests)
                ->editColumn('source', function ($coverageRequest) {
                    if ($coverageRequest->source == null)
                        return 'CRM';
                    $actionModel = $coverageRequest->source->getMorphClass();
                    $Module = class_basename($actionModel);
                    $route = route('patient_calls_actions.create', ['patient_id' => $coverageRequest->patient_id, 'patientCallAction' => $coverageRequest->source->id]);
                    $link = '<a href="' . $route . '">' . 'CallAction' . '-' . $coverageRequest->source->id . '</a>';
                    return $link;
                })
                ->editColumn('urgency_type.name', function ($coverageRequest) {
                    return isset($coverageRequest->urgencyType) ? $coverageRequest->urgencyType->name : "";
                })
                ->editColumn('appointment', function ($coverageRequest) {
                    if ($coverageRequest->appointment == null)
                        return '';
                    $actionModel = $coverageRequest->appointment->getMorphClass();
                    $Module = class_basename($actionModel);

                    if ($Module == 'InternalAppointment') {
                        $route = route('internal_appointments.create', [
                            'patient_id' => $coverageRequest->patient_id,
                            'Id' => $coverageRequest->appointment->id,
                            'internalAppointment' => $coverageRequest->appointment->id
                        ]);
                    }
                    if ($Module == 'ExternalAppointment') {
                        $route = route('external_appointments.create', [
                            'patient_id' => $coverageRequest->patient_id,
                            'Id' => $coverageRequest->appointment->id,
                            'externalAppointment' => $coverageRequest->appointment->id
                        ]);
                    }
                    // TODO: Check appointment type if it's internal or external and route to the correct edit path
                    $link = '<a href="' . $route . '">' . $Module . '-' . $coverageRequest->appointment->id . '</a>';
                    return $link;
                })
                ->addColumn('coverage_type', function ($coverageRequest) {
                    return '';
                })
                ->addColumn('procedure_code', function ($coverageRequest) {
                    $result='';
                   if( $coverageRequest->procedure)
                    {
                        foreach ($coverageRequest->procedure as $p )
                        {
                            $result.=Procedure::find($p->procedure_id)->code.", ";
                        }
                    }
                    return $result;
                })
                ->addColumn('medication_code', function ($coverageRequest) {
                    $result='';
                    if( $coverageRequest->medication)
                    {
                        foreach ($coverageRequest->medication as $p )
                        {
                            $result.=Medication::find($p->medication_id)->code.", ";
                        }
                    }
                    return $result;
                })
                ->addColumn('attachment', function ($coverageRequest) {
                    return '';
                })
                ->editColumn('coverage_date', function ($coverageRequest) {
                    $result = '';
                    if ($coverageRequest->coverage_date == null)
                        $result .= '';
                    else
                        $result .= $coverageRequest->coverage_date->format('Y-m-d');

                    if ($coverageRequest->request_date == null)
                        $result .= '';
                    else
                        $result .= " Service Date: " . $coverageRequest->request_date->format('Y-m-d');
                    return $result;
                })
                ->editColumn('request_date', function ($coverageRequest) {
                    if ($coverageRequest->request_date == null)
                        return '';
                    return $coverageRequest->request_date->format('Y-m-d');
                })
                ->addColumn('action', function ($coverageRequest) {

                    $statusBtn = '<a href="' . route('coverage_requests.changeStatus', ['coverageRequest' => $coverageRequest->id]) . '" class="btn btn-icon btn-active-light-primary w-30px h-30px btnChangeStatus">
                    <span class="svg-icon svg-icon-3">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.3" d="M10 4H21C21.6 4 22 4.4 22 5V7H10V4Z" fill="currentColor"/>
                    <path d="M10.4 3.60001L12 6H21C21.6 6 22 6.4 22 7V19C22 19.6 21.6 20 21 20H3C2.4 20 2 19.6 2 19V4C2 3.4 2.4 3 3 3H9.20001C9.70001 3 10.2 3.20001 10.4 3.60001ZM12 16.8C11 16.8 10.2 16.4 9.5 15.8C8.8 15.1 8.5 14.3 8.5 13.3C8.5 12.8 8.59999 12.3 8.79999 11.9L10 13.1V10.1C10 9.50001 9.6 9.10001 9 9.10001H6L7.29999 10.4C6.79999 11.3 6.5 12.2 6.5 13.3C6.5 14.8 7.10001 16.2 8.10001 17.2C9.10001 18.2 10.5 18.8 12 18.8C12.6 18.8 13 18.3 13 17.8C13 17.2 12.6 16.8 12 16.8ZM16.7 16.2C17.2 15.3 17.5 14.4 17.5 13.3C17.5 11.8 16.9 10.4 15.9 9.39999C14.9 8.39999 13.5 7.79999 12 7.79999C11.4 7.79999 11 8.19999 11 8.79999C11 9.39999 11.4 9.79999 12 9.79999C12.9 9.79999 13.8 10.2 14.5 10.8C15.2 11.5 15.5 12.3 15.5 13.3C15.5 13.8 15.4 14.3 15.2 14.7L14 13.5V16.5C14 17.1 14.4 17.5 15 17.5H18L16.7 16.2Z" fill="currentColor"/>
                    <path opacity="0.3" d="M12 16.8C11 16.8 10.2 16.4 9.5 15.8C8.8 15.1 8.5 14.3 8.5 13.3C8.5 12.8 8.59999 12.3 8.79999 11.9L7.29999 10.4C6.79999 11.3 6.5 12.2 6.5 13.3C6.5 14.8 7.10001 16.2 8.10001 17.2C9.10001 18.2 10.5 18.8 12 18.8C12.6 18.8 13 18.3 13 17.8C13 17.2 12.6 16.8 12 16.8Z" fill="currentColor"/>
                    <path opacity="0.3" d="M15.5 13.3C15.5 13.8 15.4 14.3 15.2 14.7L16.7 16.2C17.2 15.3 17.5 14.4 17.5 13.3C17.5 11.8 16.9 10.4 15.9 9.39999C14.9 8.39999 13.5 7.79999 12 7.79999C11.4 7.79999 11 8.19999 11 8.79999C11 9.39999 11.4 9.79999 12 9.79999C12.9 9.79999 13.8 10.2 14.5 10.8C15.1 11.5 15.5 12.4 15.5 13.3Z" fill="currentColor"/>
                    </svg>
                    </span>
                    </a>';

                    $editBtn = $this->editButton(
                        route('coverage_requests.create', [
                            'patient_id' => $coverageRequest->patient_id,
                            'Id' => $coverageRequest->id,
                            'coverageRequest' => $coverageRequest->id
                        ]),
                        'btnUpdatecoverageRequest'
                    );

                    $deleteMsg = ' Coverage Request for <b>Patient Name</b> : ' .
                        $coverageRequest->patient->name_locale;
                    if ($coverageRequest->coverage_date != null) {
                        $deleteMsg .= ' <b>Coverage Date</b> :' .
                            $coverageRequest->coverage_date->format('Y-m-d');
                    }

                    $removeBtn = $this->deleteButton(
                        route('coverage_requests.delete', ['coverageRequest' => $coverageRequest->id]),
                        'btnDeletecoverageRequest',
                        'data-coverageRequest-name="' . $deleteMsg . '"'
                    );
                    return $statusBtn . $editBtn . $removeBtn;
                })
                ->rawColumns(['source', 'appointment', 'action'])
                ->with('new_coverage_requests_count', $totalStats['new_coverage_requests_count'])
                ->with('in_process_count', $totalStats['in_process'])
                ->with('approved_count', $totalStats['approved'])
                ->with('declined_count', $totalStats['declined'])
                ->make();
        }
    }

    public function create(Request $request)
    {
        $Constants = Constant::where('module', Modules::Patient)->get();
        $ALHAYAT_BRANCHES = $Constants->Where('field', DropDownFields::ALHAYAT_BRANCHES);
        $MARITAL_STATUS = $Constants->Where('field', DropDownFields::MARITAL_STATUS);
        $MEMBERSHIP_TYPE = $Constants->Where('field', DropDownFields::MEMBERSHIP_TYPE);
        $MEMBERSHIP_SUBTYPE = $Constants->Where('field', DropDownFields::MEMBERSHIP_SUBTYPE);
        $SICK_FUND = $Constants->Where('field', DropDownFields::SICK_FUND);

        $IDENTITY_TYPES = Constant::where('module', Modules::MAIN)->where('field', DropDownFields::IDENTITY_TYPE)->get();

        $CITIES = City::all();
        $BLOOD_TYPE = DropDownFields::BLOOD_TYPE;


        $patientForm = '';
        $patient = null;
        $coverageRequest = null;

        if ($request->has('coverageRequest')) {
            $coverageRequest = CoverageRequest::find($request->get('coverageRequest'));
            $coverageRequest->load(
                'patient',
                'coverageRequestType',
                'urgencyType',
                'appointment',
                'source',
                'medication',
                'treatment',
                'treatment.codes',
                'user',
            );
        }

        if ($request->has('patient_id')) {
            $patient = Patient::find($request->get('patient_id'));
            $patientForm = view('patients.form', [
                'ALHAYAT_BRANCHES' => $ALHAYAT_BRANCHES,
                'MARITAL_STATUS' => $MARITAL_STATUS,
                'MEMBERSHIP_TYPE' => $MEMBERSHIP_TYPE,
                'MEMBERSHIP_SUBTYPE' => $MEMBERSHIP_SUBTYPE,
                'IDENTITY_TYPES' => $IDENTITY_TYPES,
                'CITIES' => $CITIES,
                'BLOOD_TYPE' => $BLOOD_TYPE,
                'SICK_FUND' => $SICK_FUND,
                'patient' => $patient
            ])->render();
        } else {
            $patientForm = view('patients.form', [
                'ALHAYAT_BRANCHES' => $ALHAYAT_BRANCHES,
                'MARITAL_STATUS' => $MARITAL_STATUS,
                'MEMBERSHIP_TYPE' => $MEMBERSHIP_TYPE,
                'MEMBERSHIP_SUBTYPE' => $MEMBERSHIP_SUBTYPE,
                'IDENTITY_TYPES' => $IDENTITY_TYPES,
                'CITIES' => $CITIES,
                'BLOOD_TYPE' => $BLOOD_TYPE,
                'SICK_FUND' => $SICK_FUND,
            ])->render();
        }

        $coverageRequestStatuses = ['in process', 'approved', 'declined'];
        $coverageRequestTypes = CoverageRequestType::all();
        $medications = Medication::active()->get();
        $coverageREQUESTConstants = Constant::where('module', Modules::COVERAGE_REQUEST)->get();
        $coverageRequestPeroids = $coverageREQUESTConstants->where('field', DropDownFields::MEDICATION_COVERAGE_PERIOD);
        $treatmentSerivceTypes = $coverageREQUESTConstants->where('field', DropDownFields::TREATMENT_SERVICE_TYPE);
        $coverageUrgencyTypes = $coverageREQUESTConstants->where('field', DropDownFields::UERGANCY_COVERAGE_REQUEST);

        $procedureCodes = Procedure::active()->get();

        return view('coverageRequests.addedit', compact(
            'patientForm',
            'patient',
            'coverageRequest',
            'coverageRequestStatuses',
            'coverageRequestTypes',
            'medications',
            'coverageRequestPeroids',
            'treatmentSerivceTypes',
            'procedureCodes',
            'coverageUrgencyTypes'
        ));
    }

    public function coverageRequest(Request $request, $Id = null)
    {
        // dd($request->all());
        $patient_id = null;
        $coverageRequest = null;

        $request->validate([
            //=-=-=-=-=
            'id_type' => 'required',
            'idcard_no' => [
                'required',
                Rule::unique('patients')->ignore($request->patient_id)
            ],
            'register' => 'required|max:50',
            'register_date' => 'required|date',
            'name' => 'required|max:50',
            'name_en' => 'required|max:50',
            'name_he' => 'required|max:50',
            'birth_date' => 'required|date',
            'branch_id' => 'required|numeric',
            //'marital_status_id' => 'required|numeric',
           // 'blood_type' => 'required|string|max:3',
            'gender' => 'required',
            'mobile' => 'required|max:15',
            'tel1' => 'required|max:15',
           // 'membership_type' => 'required|numeric',
            //'membership_subtype' => 'required|numeric',
            'clinical_history' => 'nullable|max:255',
            'email' => 'nullable|email',
        ]);


        if ($request->has('patient_id')) {

            $coverageRequest = CoverageRequest::updateOrCreate(
                ['id' => $Id],
                [
                    'urgency_type_id' => $request->urgency_type_id,
                    'patient_id' => $request->patient_id,
                    'coverage_request_type_id' => $request->coverage_request_type_id,
                    'coverage_date' => $request->coverage_date,
                    'request_date' => $request->request_date,
                    'status' => $request->coverage_request_status,
                    'user_id' => Auth::user()->id,
                ]
            );
            $patient = Patient::find($request->patient_id);

            PatientService::Update($request, $patient);

            if ($request->coverage_request_type_id == CoverageRequest::MEDICATION) {
                $coverageRequestMedication = CoverageRequestMedication::updateOrCreate([
                    'coverage_request_id' => $coverageRequest->id,
                ], [
                    'medication_id' => $request->medication_id,
                    'quantity' => $request->medication_quantity,
                    'period_id' => $request->medication_period,
                ]);
            }

            if ($request->coverage_request_type_id == CoverageRequest::TREATMENT) {
                $coverageRequestTreatment = CoverageRequestTreatment::updateOrCreate([
                    'coverage_request_id' => $coverageRequest->id,
                ], [
                    'service_date' => $request->treatment_service_date,
                    'service_type_id' => $request->treatment_service_type_id,
                ]);

                //Procedure codes
                foreach ($request->treatment_procedure_code as $code) {
                    CoverageTreatmentProcedure::create([
                        'coverage_request_id' => $coverageRequest->id,
                        'cr_treatment_id' => $coverageRequestTreatment->id,
                        'procedure_id' => $code,
                    ]);
                }

                //TODO Sync
            }

            $message = "";

            $coverageRequest != null ? $message = "Request was successfully Updated!" : $message = "Request was successfully added!";
            return redirect()->route('coverage_requests.create', [
                'patient_id' => $request->patient_id,
                'Id' => $coverageRequest->id,
                'coverageRequest' => $coverageRequest->id
            ])
                ->with('status', $message);
        } else {

            DB::beginTransaction();

            try {
                //code...
                $patient = PatientService::Create($request);

                $coverageRequest = CoverageRequest::updateOrCreate(
                    ['id' => $Id],
                    [
                        'patient_id' => $patient->id,
                        'coverage_request_type_id' => $request->coverage_request_type_id,
                        'request_date' => $request->request_date,
                        'status' => $request->coverage_request_status,
                        'user_id' => Auth::user()->id,
                    ]
                );
                DB::commit();
            } catch (\Throwable $th) {
                DB::rollBack();
                throw $th;
            }

            $message = "";

            $coverageRequest != null ? $message = "Request was successfully Updated!" : $message = "Request was successfully added!";
            return redirect()->route('coverage_requests.create', [
                'patient_id' => $request->patient_id,
                'Id' => $coverageRequest->id,
                'coverageRequest' => $coverageRequest->id
            ])
                ->with('status', $message);
        }
    }

    public function changeStatus(Request $request, CoverageRequest $coverageRequest)
    {
        if ($request->isMethod('GET')) {
            $coverageRequestStatuses = ['in process', 'approved', 'declined'];
            $coverageRequest->load('patient');
            $createView = view('coverageRequests.changeStatus_modal', ['coverageRequest' => $coverageRequest, 'coverageRequestStatuses' => $coverageRequestStatuses])->render();
            return response()->json([
                'createView' => $createView
            ]);
        }
        if ($request->isMethod('POST')) {

            $request->validate([
                'coverage_request_status' => 'required',
            ]);

            $coverageRequest->status = $request->coverage_request_status;
            $coverageRequest->save();

            return response()->json(['status' => true, 'message' => 'Coverage request status updated successfully']);
        }
    }
}
