@extends('metronic.index')


@section('title', 'Complains -' . 'Add new Complain')
@section('subpageTitle', 'Complains ')
@section('subpageName', 'Add new Complain')


@section('content')
    @if ($errors->any())
        <div class="alert alert-danger d-flex align-items-center p-5 mb-10">
            <i class="ki-duotone ki-shield-tick fs-2hx text-danger me-4"><span class="path1"></span><span
                    class="path2"></span></i>
            <div class="d-flex flex-column">
                <h4 class="mb-1 text-danger">Something went wrong!</h4>
                <span>Please check your inputs, the error messages are :.</span>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    @if (session('status'))
        <div class="alert alert-success d-flex align-items-center p-5">
            <span class="svg-icon svg-icon-2hx svg-icon-success me-3">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5"
                          fill="currentColor"/>
                    <path
                        d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                        fill="currentColor"/>
                </svg>
            </span>
            <div class="d-flex flex-column">
                <h4 class="mb-1 text-success"> {{ session('status') }}</h4>
            </div>
        </div>
    @endif
    <!--begin::Content container-->
    <div class="card mb-5 mb-xl-5" id="kt_Complain_form_tabs">
        <div class="card-body pt-0 pb-0">
            <div class="d-flex flex-column flex-lg-row justify-content-between">
                <!--begin::Navs-->
                <ul id="myTab"
                    class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold order-lg-1 order-2">

                    <li class="nav-item mt-2">
                        <a class="nav-link text-active-primary ms-0 me-6 px-2 py-5 active" data-bs-toggle="tab"
                           data-bs-target="#kt_tab_pane_1" href="#kt_tab_pane_1">
                            <span class="svg-icon svg-icon-2 me-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M6 20C6 20.6 5.6 21 5 21C4.4 21 4 20.6 4 20H6ZM18 20C18 20.6 18.4 21 19 21C19.6 21 20 20.6 20 20H18Z"
                                        fill="currentColor"/>
                                    <path opacity="0.3"
                                          d="M21 20H3C2.4 20 2 19.6 2 19V3C2 2.4 2.4 2 3 2H21C21.6 2 22 2.4 22 3V19C22 19.6 21.6 20 21 20ZM12 10H10.7C10.5 9.7 10.3 9.50005 10 9.30005V8C10 7.4 9.6 7 9 7C8.4 7 8 7.4 8 8V9.30005C7.7 9.50005 7.5 9.7 7.3 10H6C5.4 10 5 10.4 5 11C5 11.6 5.4 12 6 12H7.3C7.5 12.3 7.7 12.5 8 12.7V14C8 14.6 8.4 15 9 15C9.6 15 10 14.6 10 14V12.7C10.3 12.5 10.5 12.3 10.7 12H12C12.6 12 13 11.6 13 11C13 10.4 12.6 10 12 10Z"
                                          fill="currentColor"/>
                                    <path
                                        d="M18.5 11C18.5 10.2 17.8 9.5 17 9.5C16.2 9.5 15.5 10.2 15.5 11C15.5 11.4 15.7 11.8 16 12.1V13C16 13.6 16.4 14 17 14C17.6 14 18 13.6 18 13V12.1C18.3 11.8 18.5 11.4 18.5 11Z"
                                        fill="currentColor"/>
                                </svg>
                            </span>
                            Patient
                        </a>
                    </li>
                    <!--end::Nav item-->
                    <!--begin::Nav item-->
                    <li class="nav-item mt-2" id="tab-menu-has-schedule">
                        <a class="nav-link text-active-primary ms-0 me-6 px-2 py-5" data-bs-toggle="tab"
                           data-bs-target="#kt_tab_pane_2" href="#kt_tab_pane_2">
                            <span class="svg-icon svg-icon-2 me-2">
                            </span>
                            Complain </a>
                    </li>
                    <!--end::Nav item-->
                    <!--begin::Nav item-->
                    <li class="nav-item mt-2">
                        <a class="nav-link text-active-primary ms-0 me-6 px-2 py-5 {{ isset($patient) ? '' : 'disabled' }}"
                           data-bs-toggle="tab" data-bs-target="#kt_tab_pane_3" href="#kt_tab_pane_3">
                            <span class="svg-icon svg-icon-2 me-2">
                            </span>
                            History </a>
                    </li>
                    <li class="nav-item mt-2">
                        <a class="nav-link text-active-primary ms-0 me-6 px-2 py-5 {{ isset($patient) ? '' : 'disabled' }}"
                           data-bs-toggle="tab" data-bs-target="#kt_tab_pane_4" href="#kt_tab_pane_4">
                            <span class="svg-icon svg-icon-2 me-2">
                            </span>
                            Attachments </a>
                    </li>
                    <!--end::Nav item-->
                    <!--begin::Nav item-->

                </ul>

                <div class="d-flex my-4 justify-content-end order-lg-2 order-1">
                    <a href="{{ route('complains.index') }}" class="btn btn-sm btn-light me-2"
                       id="kt_user_follow_button">
                        <!--begin::Indicator label-->
                        <span class="svg-icon svg-icon-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.3" x="2" y="2" width="20" height="20"
                                      rx="10" fill="currentColor"/>
                                <rect x="7" y="15.3137" width="12" height="2" rx="1"
                                      transform="rotate(-45 7 15.3137)" fill="currentColor"/>
                                <rect x="8.41422" y="7" width="12" height="2" rx="1"
                                      transform="rotate(45 8.41422 7)" fill="currentColor"/>
                            </svg>
                        </span>
                        Exit
                    </a>

                    <a href="#" class="btn btn-sm btn-primary ms-5" data-kt-Complain-action="submit">
                        <span class="indicator-label">
                            <span class="svg-icon svg-icon-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.3" x="2" y="2" width="20" height="20"
                                          rx="10" fill="currentColor"/>
                                    <path
                                        d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                        fill="currentColor"/>
                                </svg>
                            </span>
                            Save Form</span>
                        <span class="indicator-progress">
                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </a>
                </div>
            </div>
            <!--begin::Navs-->
        </div>
    </div>
    <!--end::Content container-->
    <!--begin::Modal - Add task-->

    <form class="tab-content" id="myTabContent" method="post"
          action="{{ route('complains.addedit', ['Id' => isset($complain) ? $complain->id : '']) }}?{{ isset($patient) ? 'patient_id=' . $patient->id : '' }}">
        @csrf
        <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
            <div class="card mb-5 mb-xl-10" id="kt_patient_details_view">
                <!--begin::Card body-->
                <div class="card-body p-9">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="fv-row">
                                <!--begin::Label-->
                                <label class="fw-semibold fs-6 mb-2" data-input-name="ID Card Type">Search for
                                    Patient ID or Name : </label>
                                <!--end::Label-->
                                <!--begin::Input-->

                                <select class="form-select form-select-solid mb-3 mb-lg-0 patientSearchSelector"
                                        id="patient_id" name="patient_id" data-placeholder="Select an option">
                                    @isset($patient)
                                        <option value="{{ $patient->id }}">{{ $patient->name_locale }}</option>
                                    @endisset
                                </select>
                                <span class="text-muted fs-7">* Clearing selection will add new patient record</span>
                                <!--end::Input-->
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            {!! $patientForm !!}
        </div>
        <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel">
            <div class="card mb-5 mb-xl-10" id="kt_patient_details_view">
                <!--begin::Card header-->
                <div class="card-header">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">Complain Details</h3>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--begin::Card header-->

                <!--begin::Card body-->
                <div class="card-body p-9">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2" data-input-name="Complain Date">Complain
                                    Date</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <div class="position-relative d-flex align-items-center">
                                    <!--begin::Icon-->
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                                    <span class="svg-icon svg-icon-2 position-absolute mx-4">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.3"
                                                  d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z"
                                                  fill="currentColor"></path>
                                            <path
                                                d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z"
                                                fill="currentColor"></path>
                                            <path
                                                d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z"
                                                fill="currentColor"></path>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <!--end::Icon-->
                                    <!--begin::Datepicker-->
                                    <input type="text" name="complain_date"
                                           class="form-control form-control-solid ps-12 flatpickr-input mb-3 mb-lg-0"
                                           autocomplete="off" placeholder=""
                                           value="{{ isset($complain)
                                            ? ($complain->complain_date
                                                ? $complain->complain_date->format('Y-m-d')
                                                : old('complain_date'))
                                            : old('complain_date') }}"/>
                                    <!--end::Datepicker-->
                                </div>

                                <!--end::Input-->
                            </div>
                        </div>
                        <div class="col-md-4">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fw-semibold fs-6 mb-2" data-input-name="Complain Type">Complain
                                    Type</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <select class="form-select form-select-solid mb-3 mb-lg-0" data-control="select2"
                                        multiple
                                        id="complain_type_id" name="complain_type_id[]"
                                        data-placeholder="Select an option">
                                    <option></option>
                                    @foreach ($complainTypes as $complainType)
                                        <option value="{{ $complainType->id }}" data-name="{{ $complainType->name }}"
                                            {{ in_array($complainType->id, $SELECTED_COMPLAIN_TYPES) ? 'selected="selected"' : '' }}>
                                            {{ $complainType->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <!--end::Input-->
                            </div>
                        </div>

                        <div class="col-md-4 {{ count($complainClinicTeams) > 0 ? '' : 'd-none' }}"
                             id="clinicTeamSelector">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fw-semibold fs-6 mb-2" data-input-name="Clinic Team">Clinic Team</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <select class="form-select form-select-solid mb-3 mb-lg-0" data-control="select2"
                                        id="clinic_team_id" name="clinic_team_id" data-placeholder="Select an option">
                                    <option></option>
                                    @foreach ($clinicTeam as $clinicTeamMember)
                                        <option value="{{ $clinicTeamMember->id }}"
                                            {{ in_array($clinicTeamMember->id, $complainClinicTeams) ? 'selected="selected"' : '' }}>
                                            {{ $clinicTeamMember->name_locale }}
                                        </option>
                                    @endforeach
                                </select>
                                <!--end::Input-->
                            </div>
                        </div>
                        <div class="col-md-4 {{ count($complainMedicalTeams) > 0 ? '' : 'd-none' }}"
                             id="medicalTeamSelector">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fw-semibold fs-6 mb-2" data-input-name="Medical Team">Medical
                                    Team</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <select class="form-select form-select-solid mb-3 mb-lg-0" data-control="select2"
                                        id="medical_team_id" name="medical_team_id" data-placeholder="Select an option">
                                    <option></option>
                                    @foreach ($medicalTeam as $medicalTeamMember)
                                        <option value="{{ $medicalTeamMember->id }}"
                                            {{ in_array($medicalTeamMember->id, $complainMedicalTeams) ? 'selected="selected"' : '' }}>
                                            {{ $medicalTeamMember->name_locale }}
                                        </option>
                                    @endforeach
                                </select>
                                <!--end::Input-->
                            </div>
                        </div>
                        <div class="col-md-4">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fw-semibold fs-6 mb-2" data-input-name="Assign to user">Assgin</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <select class="form-select form-select-solid mb-3 mb-lg-0" data-control="select2"
                                        id="assigned_user_id" name="assigned_user_id"
                                        data-placeholder="Select an option">
                                    <option></option>
                                    @foreach ($systemUsers as $systemUser)
                                        <option value="{{ $systemUser->id }}"
                                        @isset($complain)
                                            @selected($complain->assigned_user_id == $systemUser->id)
                                            @endisset>
                                            {{ $systemUser->name }}</option>
                                    @endforeach
                                </select>
                                <!--end::Input-->
                            </div>
                        </div>
                        <div class="col-md-4">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2"
                                       data-input-name="Complain Status">Status</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <select class="form-select form-select-solid mb-3 mb-lg-0" data-control="select2"
                                        id="complain_status" name="complain_status" data-placeholder="Select an option">
                                    <option></option>
                                    @foreach ($complainStatuses as $status)
                                        <option value="{{ $status }}"
                                        @isset($complain)
                                            @selected($complain->status == $status)
                                            @endisset>
                                            {{ ucfirst($status) }}</option>
                                    @endforeach
                                </select>
                                <!--end::Input-->
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2"
                                       data-input-name="Complain Text">Complain</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <textarea class="form-control form-control-solid mb-3 mb-lg-0"
                                          name="complain">{{ isset($complain) ? $complain->complain : '' }}</textarea>
                                <!--end::Input-->
                            </div>

                        </div>
                    </div>
                </div>
                <!--end::Card body-->
            </div>
        </div>
        <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel">
            <div class="card mb-5 mb-xl-10" id="kt_patient_history_view">
                <!--begin::Card header-->
                <div class="card-header">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">Patient History</h3>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--begin::Card header-->

                <!--begin::Card body-->
                <div class="card-body p-9">
                    <div class="row">
                        <div class="col-md-12" id="historyTabData">

                        </div>
                    </div>
                </div>
                <!--end::Card body-->
            </div>
        </div>
        <div class="tab-pane fade" id="kt_tab_pane_4" role="tabpanel">
            <div class="card mb-5 mb-xl-10" id="kt_patient_attachments_view">
                @isset($complain)
                    <!--begin::Card header-->
                    <div class="card-header">
                        <!--begin::Card title-->
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Complain Attachments</h3>
                        </div>
                        <div class="card-toolbar">
                            @can('complain_edit')
                                <a href="#" class="btn btn-sm btn-success ms-5" id="AddAttachmentModal">
                            <span class="indicator-label">
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.3" x="2" y="2" width="20" height="20"
                                              rx="10" fill="currentColor"/>
                                        <rect x="10.8891" y="17.8033" width="12" height="2" rx="1"
                                              transform="rotate(-90 10.8891 17.8033)" fill="currentColor"/>
                                        <rect x="6.01041" y="10.9247" width="12" height="2" rx="1"
                                              fill="currentColor"/>
                                    </svg>
                                </span>
                                Add New Attachment</span>
                                    <span class="indicator-progress">
                                Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                                </a>
                            @endcan
                        </div>
                    </div>

                    <!--begin::Card body-->
                    <div class="card-body p-9">
                        <table class="table table-bordered align-middle table-row-dashed fs-6 gy-5"
                               id="kt_table_complain_attachments">
                            <!--begin::Table head-->
                            <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th>ID</th>
                                <th class="min-w-100px mw-100px">File Name</th>
                                <th class="min-w-100px mw-100px">Type</th>
                                <th class="min-w-100px mw-100px">Source</th>
                                <th class="min-w-100px mw-100px">Created at</th>
                                <th class="">Actions</th>
                            </tr>
                            <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->

                        </table>
                    </div>
                    <!--end::Card body-->
                @endisset
            </div>
        </div>
    </form>
    <div class="modal fade" id="kt_modal_add_attachment" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-lg modal-dialog-centered">

        </div>
        <!--end::Modal dialog-->
    </div>

    <!--begin::Modal - Add task-->
    <div class="modal fade" id="kt_modal_addedit_appointment" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">

        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - Add task-->

    <!--begin::Modal - Add task-->
    <div class="modal fade" id="kt_modal_addedit_Complain" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">

        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - Add task-->

    @include('calls.questionnaire_logs_drawer')

@endsection
{{-- @push('styles')
    <link rel="stylesheet" href="{{ asset('plugins/custom/fullcalendar/fullcalendar.bundle.css') }}">
    <style>
        .flatpickr-day {
            color: var(--bs-text-dark);
            font-weight: 600 !important;
        }
    </style>
@endpush --}}
@push('scripts')
    @isset($complain)
        <script>
            var table = document.querySelector('#kt_table_complain_attachments');

            var datatable = $(table).DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                searchDelay: 1050,
                pageLength: 10,
                lengthMenu: [10, 50, 100],
                ajax: {
                    url: "{{ route('complains.attachments', ['complain' => $complain->id]) }}",
                    type: "POST",
                    data: function (d) {
                        // var params = {};
                        // $('.datatable-input').each(function() {
                        //     var i = $(this).data('col-index');
                        //     if (params[i]) {
                        //         params[i] += '|' + $(this).val();
                        //     } else {
                        //         params[i] = $(this).val();
                        //     }
                        // });
                        // d.params = params;
                    }
                },
                columns: [{
                    data: 'id',
                    name: 'id',
                },
                    {
                        // className: 'd-flex align-items-center',
                        data: 'title',
                        name: 'title',
                    },

                    {
                        data: function (row, type, set) {
                            if (type === 'display') {
                                return row.attachment_type.name;
                            }
                            return row.attachment_type_id;
                        },
                        name: 'attachment_type_id',
                    },
                    {
                        data: 'source',
                        name: 'source',
                    },
                    {
                        data: {
                            _: 'created_at.display',
                            sort: 'created_at.timestamp',
                        },
                        name: 'created_at',
                        visible: true,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        className: 'text-end',
                        orderable: false,
                        searchable: false
                    }
                ],
                order: [
                    [0, "DESC"]
                ]
            });
        </script>
        <script>
            const element = document.getElementById('kt_modal_add_attachment');
            const modal = new bootstrap.Modal(element);

            function renderModal(url, button) {
                $.ajax({
                    type: "GET",
                    url: url,
                    dataType: "json",
                    success: function (response) {
                        // console.log(response);
                        $('#kt_modal_add_attachment').find('.modal-dialog').html(response.createView);
                        // $('#AddEditModal').modal('show');
                        modal.show();
                        KTScroll.createInstances();
                        KTImageInput.createInstances();

                        const form = element.querySelector('#kt_modal_add_attachment_form');

                        var validator = FormValidation.formValidation(
                            form, {
                                fields: {
                                    'attachment_type_id': {
                                        validators: {
                                            notEmpty: {
                                                message: 'Attachment type is required'
                                            }
                                        }
                                    },
                                    'attachment_file': {
                                        validators: {
                                            notEmpty: {
                                                message: 'Attachment file is required'
                                            }
                                        }
                                    },
                                },

                                plugins: {
                                    trigger: new FormValidation.plugins.Trigger(),
                                    bootstrap: new FormValidation.plugins.Bootstrap5({
                                        rowSelector: '.fv-row',
                                        eleInvalidClass: '',
                                        eleValidClass: ''
                                    })
                                }
                            }
                        );

                        // Submit button handler
                        const submitButton = element.querySelector('[data-kt-attachments-modal-action="submit"]');
                        submitButton.addEventListener('click', function (e) {
                            // Prevent default button action
                            e.preventDefault();

                            var formAddEdit = $("#kt_modal_add_attachment_form");
                            // Validate form before submit
                            if (validator) {
                                validator.validate().then(function (status) {
                                    console.log('validated!');

                                    if (status == 'Valid') {
                                        // Show loading indication
                                        submitButton.setAttribute('data-kt-indicator',
                                            'on');
                                        // Disable button to avoid multiple click
                                        submitButton.disabled = true;
                                        var attachment_file = $(form).find(
                                            'input[type="file"]');

                                        var formData = new FormData();

                                        $.each(formAddEdit.serializeArray(), function (i,
                                                                                       field) {
                                            formData.append(field.name, field.value);
                                        });

                                        formData.append('attachment_file', attachment_file[0].files[
                                            0]);

                                        console.log(formData);
                                        $.ajax({
                                            type: 'POST',
                                            url: formAddEdit.attr('action'),
                                            data: formData,
                                            processData: false,
                                            contentType: false,
                                            cache: false,
                                            success: function (response) {
                                                toastr.success(response.message);
                                                form.reset();
                                                modal.hide();
                                                datatable.ajax.reload(null, false);
                                            },
                                            complete: function () {
                                                // KTUtil.btnRelease(btn);
                                                submitButton.removeAttribute(
                                                    'data-kt-indicator');
                                                // Disable button to avoid multiple click
                                                submitButton.disabled = false;
                                            },
                                            error: function (response, textStatus,
                                                             errorThrown) {
                                                toastr.error(response.responseJSON
                                                    .message);
                                            },
                                        });

                                    } else {
                                        Swal.fire({
                                            text: "Sorry, looks like there are some errors detected, please try again.",
                                            icon: "error",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: {
                                                confirmButton: "btn btn-primary"
                                            }
                                        });
                                    }
                                });
                            }
                        });


                        $('#attachment_type_id').select2({
                            dropdownParent: $('#kt_modal_add_attachment')
                        });

                    },
                    complete: function () {
                        if (button)
                            button.removeAttr('data-kt-indicator');
                    }

                });
            }

            $(document).on('click', '.btnUpdateAttachment', function (e) {
                e.preventDefault();
                $(this).attr("data-kt-indicator", "on");
                const editURl = $(this).attr('href');
                renderModal(editURl, $(this));
            });

            $(document).on('click', '#AddAttachmentModal', function (e) {
                e.preventDefault();
                $(this).attr("data-kt-indicator", "on");
                renderModal("{{ route('complains.attachments.create', ['complain' => $complain->id]) }}", $(this));
            });
        </script>


        <script>
            $(document).on('click', '.btnDeleteComplainAttachment', function (e) {
                e.preventDefault();
                const URL = $(this).attr('href');
                const attachmentName = $(this).attr('data-attachment-name');
                Swal.fire({
                    text: "Are you sure you want to delete " + attachmentName + "?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if (result.value) {
                        $.ajax({
                            type: "DELETE",
                            url: URL,
                            dataType: "json",
                            success: function (response) {
                                datatable.ajax.reload(null, false);
                                Swal.fire({
                                    text: response.message,
                                    icon: "success",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            },
                            complete: function () {
                            },
                            error: function (response, textStatus,
                                             errorThrown) {
                                toastr.error(response
                                    .responseJSON
                                    .message);
                            },
                        });

                    } else if (result.dismiss === 'cancel') {
                    }

                });
            });
        </script>
    @endisset
    {{-- <script src="{{ asset('plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script> --}}
    <script>
        const form = document.getElementById('myTabContent');
        $(function () {
            $(".patientSearchSelector").select2({
                ajax: {
                    url: "{{ route('patients.searchByNameOrId') }}",
                    dataType: 'json',
                    delay: 300,
                    data: function (params) {
                        return {
                            q: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function (data, params) {
                        // parse the results into the format expected by Select2
                        // since we are using custom formatting functions we do not need to
                        // alter the remote JSON data, except to indicate that infinite
                        // scrolling can be used
                        params.page = params.page || 1;

                        return {
                            results: data.items,
                            pagination: {
                                more: (params.page * 10) < data.total_count
                            }
                        };
                    },
                    cache: false
                },
                placeholder: 'Search for Patient',
                minimumInputLength: 2,
                allowClear: true,
            });

            var tabContentEl = document.querySelector("#myTabContent");
            var tabContentElblockUI = new KTBlockUI(tabContentEl, {
                message: '<div class="bg-white blockui-message position-absolute" style="top:25px;"><span class="spinner-border text-primary"></span> Loading...</div>',
            });
            $(document).on('select2:select', '#patient_id', function (e) {
                const value = $(this).val();
                tabContentElblockUI.block();
                var url = "{{ route('complains.create') }}";
                window.location = url + '?patient_id=' + value;
            });


            $(document).on('select2:clear', '#patient_id', function (e) {
                tabContentElblockUI.block()
                var url = "{{ route('complains.create') }}";
                window.location = url;
            });

            renderValidate();
            renderSelect2();

        });

        function renderSelect2() {

            $('[data-control="select2"]').select2();

            $('#sick_fund_id').select2({
                allowClear: true
            });
        }


        function renderValidate() {


            // Log the list of registered plugins

            validator = FormValidation.formValidation(
                form, {
                    fields: {
                        'register_date': {
                            validators: {
                                notEmpty: {
                                    message: 'Register date is required',
                                },
                            },
                        },
                        'birth_date': {
                            validators: {
                                notEmpty: {
                                    message: 'Birth date is required',
                                },
                            },
                        },
                        'email': {
                            validators: {
                                emailAddress: {
                                    message: 'The value is not a valid email address',
                                },
                            },
                        },
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: '.fv-row',
                            eleInvalidClass: '',
                            eleValidClass: ''
                        })
                    }
                }
            );

            validator.on('core.form.invalid', function (event) {
                const fields = validator.getFields();
                $.each(fields, function (element) {
                    validator.validateField(element)
                        .then(function (status) {
                            // status can be one of the following value
                            // 'NotValidated': The element is not yet validated
                            // 'Valid': The element is valid
                            // 'Invalid': The element is invalid
                            if (status == 'Invalid')
                                console.log(element);
                        });
                });
            });


            var dueDate = $(form.querySelector('[name="register_date"]'));
            dueDate.flatpickr({
                enableTime: false,
                dateFormat: "Y-m-d",
                maxDate: "today",
                allowInput: true,
            });
            var dueDatebirth_date = $(form.querySelector('[name="birth_date"]'));
            dueDatebirth_date.flatpickr({
                enableTime: false,
                dateFormat: "Y-m-d",
                maxDate: "today",
                allowInput: true,
            });

            var requestDate = $(form.querySelector('[name="request_date"]'));
            requestDate.flatpickr({
                enableTime: false,
                dateFormat: "Y-m-d",
                allowInput: true,
            });


            var ComplainDate = $(form.querySelector('[name="complain_date"]'));
            ComplainDate.flatpickr({
                enableTime: false,
                dateFormat: "Y-m-d",
                allowInput: true,
                defaultDate: new Date()
            });


            const RequiredInputList = {
                'id_type': 'select',
                'idcard_no': 'input',
                'register': 'select',
                // 'register_date': 'input',
                'name': 'input',
                'name_en': 'input',
                'name_he': 'input',
                // 'birth_date': 'input',
                'branch_id': 'select',
                'marital_status_id': 'select',
                'blood_type': 'select',
                'gender': 'select',
                'mobile': 'input',
                'tel1': 'input',
                'membership_type': 'select',
                'membership_subtype': 'select',
                'complain_date': 'input',
                'complain_status': 'select',
                'complain': 'textarea'
            }


            for (var key in RequiredInputList) {
                // console.log("key " + key + " has value " + RequiredInputList[key]);
                var fieldName = $(RequiredInputList[key] + ["[name=" + key + "]"]).closest(".fv-row").find(
                    "label[data-input-name]").attr('data-input-name');

                const NameValidators = {
                    validators: {
                        notEmpty: {
                            message: fieldName + ' is required',
                        },
                    },
                };

                validator.addField(key, NameValidators);
                // validator.addField($(this).find('.constantNames').attr('name'),
                //                         NameValidators);
            }

            const submitButton = document.querySelector('[data-kt-Complain-action="submit"]');
            submitButton.addEventListener('click', function (e) {
                // Prevent default button action
                e.preventDefault();

                var formAddEdit = $("#kt_modal_constant_form");
                // Validate form before submit
                if (validator) {
                    validator.validate().then(function (status) {
                        console.log('validated!');
                        if (status == 'Valid') {
                            console.log('valid!');
                            form.submit();
                        } else {
                            Swal.fire({
                                text: "Sorry, looks like there are you missed some required fields, please try again.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            });
                        }
                    })
                }
            });


        }
    </script>

    @isset($patient)
        <script>
            var kt_patient_history_view = document.querySelector("#kt_patient_history_view");
            var kt_patient_history_viewblockUI = new KTBlockUI(kt_patient_history_view, {
                message: '<div class="bg-white blockui-message position-absolute" style="top:25px;"><span class="spinner-border text-primary"></span> Loading...</div>',
            });
            var tab1DataFetched = false;
            const tabs = document.querySelectorAll('[data-bs-toggle="tab"]');
            tabs.forEach(tab => {
                tab.addEventListener('shown.bs.tab', e => {
                    // Week tab
                    if (tab.getAttribute('href') === '#kt_tab_pane_3' && !tab1DataFetched) {
                        // Fetch data for Tab 1 using AJAX
                        var url = new URL("{{ route('patients.getHistroy') }}");
                        var params = new URLSearchParams();
                        params.append('patient', "{{ $patient->id }}");
                        url.search = params.toString();
                        kt_patient_history_viewblockUI.block();
                        $.ajax({
                            url: url.toString(),
                            method: 'GET',
                            success: function (response) {
                                // Update the content of the tab with the fetched data
                                $('#historyTabData').html(response.result);
                                // Set the flag to indicate that data has been fetched
                                tab1DataFetched = true;
                            },
                            error: function (error) {
                                console.log('Error fetching data for Tab 1:', error);
                            },
                            complete: function (result) {
                                kt_patient_history_viewblockUI.release();
                            }
                        });
                    }

                });
            });
        </script>
    @endisset
    <script>
        $(function () {
            $(document).on('select2:select', '#complain_type_id', function (e) {
                const value = $(this).val();
                var data = e.params.data;
                var teamType = $(data.element).attr('data-name');
                if (teamType == 'Clinic Team') {
                    $('#clinicTeamSelector').removeClass('d-none');
                } else if (teamType == 'Medical Team') {
                    $('#medicalTeamSelector').removeClass('d-none');
                }
            });

            $(document).on('select2:unselect', '#complain_type_id', function (e) {
                const value = $(this).val();
                var data = e.params.data;
                var teamType = $(data.element).attr('data-name');
                if (teamType == 'Clinic Team') {
                    $('#clinicTeamSelector').addClass('d-none');
                } else if (teamType == 'Medical Team') {
                    $('#medicalTeamSelector').addClass('d-none');
                }
            });

        });
    </script>
@endpush
