@extends('metronic.index')

@section('title', 'Complains')
@section('subpageTitle', 'Complains')

@section('content')
    <!--begin::Content container-->
    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
        <!--begin::Col-->
        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                            <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                        rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                    <path
                                        d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                        fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <input type="text" data-kt-complains-table-filter="search"
                                class="form-control form-control-solid w-250px ps-14" placeholder="Search Complains" />
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--begin::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end" data-kt-complains-table-toolbar="base">
                            <!--begin::Filter-->
                            <!--begin::complains 1-->
                            <!--end::complains 1-->
                            <!--end::Filter-->
                            <!--begin::Add complains-->
                            <a href="{{ route('complains.create') }}" class="btn btn-primary" id="AddcomplainsModal">
                                <span class="indicator-label">
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2"
                                                rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor" />
                                            <rect x="4.36396" y="11.364" width="16" height="2" rx="1"
                                                fill="currentColor" />
                                        </svg>
                                    </span>
                                    Add Complain
                                </span>
                                <span class="indicator-progress">
                                    Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </a>
                            <!--end::Add complains-->
                        </div>
                        <!--end::Toolbar-->

                        <!--begin::Modal - Add task-->
                        <div class="modal fade" id="kt_modal_add_complains" tabindex="-1" aria-hidden="true">
                            <!--begin::Modal dialog-->
                            <div class="modal-dialog modal-dialog-centered mw-650px">

                            </div>
                            <!--end::Modal dialog-->
                        </div>
                        <!--end::Modal - Add task-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body py-4">

                    <div class="d-flex flex-wrap">
                        <!--begin::Stat-->
                        <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3 statsBlock blockui d-flex flex-row align-items-center"
                            style="">
                            <!--begin::Number-->
                            <div class="d-flex align-items-center">
                                <i class="ki-duotone ki-arrows-loop fs-3 text-warning me-2"><span
                                        class="path1"></span><span class="path2"></span></i>
                                <div class="fs-4 fw-bold text-gray-700" data-kt-countup="true" data-kt-countup-value="4500"
                                    id="totalNewComplainsCount" data-kt-countup-prefix="$" data-kt-initialized="1">-
                                </div>
                            </div>
                            <!--end::Number-->

                            <!--begin::Label-->
                            <a id="FilterNewComplains" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top"
                                title="filtering data to state <b class='text-warning'>'in process'</b> with <b>today</b> complains"
                                class="btn btn-sm btn-active-light-primary fw-semibold ms-3">New
                                Complains</a>
                            <!--end::Label-->
                        </div>
                        <!--end::Stat-->
                        <!--begin::Stat-->
                        <div class="border border-gray-300 border-dashed rounded py-3 px-3 mx-4 mb-3 statsBlock blockui d-flex flex-row align-items-center"
                            style="">
                            <!--begin::Number-->
                            <div class="d-flex align-items-center">
                                <i class="ki-duotone ki-arrows-loop fs-3 text-warning me-2"><span
                                        class="path1"></span><span class="path2"></span></i>
                                <div class="fs-4 fw-bold text-gray-700" data-kt-countup="true" data-kt-countup-value="4500"
                                    id="totalInProcessCount" data-kt-countup-prefix="$" data-kt-initialized="1">-
                                </div>
                            </div>
                            <!--end::Number-->

                            <!--begin::Label-->
                            <a id="FitlerInProcess" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top"
                                title="filtering data based on <b class='text-warning'>'in process'</b> state"
                                class="btn btn-sm btn-active-light-warning fw-semibold ms-3">In
                                Process</a>
                            <!--end::Label-->
                        </div>
                        <!--end::Stat-->
                        <!--begin::Stat-->
                        <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3 statsBlock blockui d-flex flex-row align-items-center"
                            style="">
                            <!--begin::Number-->
                            <div class="d-flex align-items-center">
                                <i class="ki-duotone ki-arrow-up fs-3 text-success me-2"><span class="path1"></span><span
                                        class="path2"></span></i>
                                <div class="fs-4 fw-bold text-gray-700" data-kt-countup="true" data-kt-countup-value="60"
                                    id="totalSuccessCount" data-kt-countup-prefix="%" data-kt-initialized="1">-</div>
                            </div>
                            <!--end::Number-->

                            <!--begin::Label-->
                            <a id="FilterSuccess" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top"
                                title="filtering data based on <b class='text-success'>'solved'</b> state"
                                class="btn btn-sm btn-active-light-success fw-semibold ms-3">Solved</a>
                            <!--end::Label-->
                        </div>
                        <!--end::Stat-->

                    </div>
                    <!--begin::Table-->
                    <table class="table table-bordered align-middle table-row-dashed fs-6 gy-5" id="kt_table_complains">
                        <!--begin::Table head-->
                        <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th class="mw-40px">ID</th>
                                <th class="min-w-125px">Patient Name</th>
                                <th class="min-w-125px">Patient ID</th>
                                <th class="all">Mobile</th>
                                <th class="min-w-125px">Patient Clinic</th>

                                <th class="min-w-125px">Complain Type</th>
                                <th class="min-w-125px">Complain</th>
                                <th class="min-w-125px">Source</th>
                                <th class="min-w-125px">Assigned To</th>
                                <th class="min-w-125px">Delay</th>
                                <th class="min-w-125px">Complain Date</th>
                                <th class="min-w-125px">Employee</th>
                                <th class="min-w-125px">Created date</th>
                                <th class="min-w-125px">Status</th>
                                <th class="text-end mw-100px">Actions</th>
                            </tr>
                            <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->

                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
    </div>
    <!--end::Content container-->
    <!--begin::Modal - Add task-->
    <div class="modal fade" id="kt_modal_complains" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-fullscreen">

        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - Add task-->
    <!--begin::Modal - Add task-->
    <div class="modal fade" id="kt_modal_assignUser" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-lg modal-dialog-centered ">

        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - Add task-->
    <!--begin::Modal - Add task-->
    <div class="modal fade" id="kt_modal_changeStatus" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-lg modal-dialog-centered ">

        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - Add task-->
    @include('calls.call_drawer')

    @include('sms.sms_drawer')
    <div id="kt_drawer_patient_call_sms_logs" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true"
         data-kt-drawer-close="#kt_drawer_patient_call_sms_logs_close" data-kt-drawer-overlay="true"
         data-kt-drawer-width="{default:'100%', 'md': '50%'}">
        <div class="card w-100 rounded-0 patient_call_sms_logs">
            <!--begin::Card-->
            <!--begin::Card header-->
            <div class="card-header pe-5">
                <!--begin::Title-->
                <div class="card-title">
                    <!--begin::User-->
                    <div class="d-flex justify-content-center flex-column me-3">
                        <span class="fs-4 fw-bold text-gray-900 text-hover-primary me-1 lh-1"></span>
                    </div>
                    <!--end::User-->
                </div>
                <!--end::Title-->

                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-light-primary"
                         id="kt_drawer_patient_call_sms_logs_close">
                        <span class="svg-icon svg-icon-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.3"
                                      d="M6 19.7C5.7 19.7 5.5 19.6 5.3 19.4C4.9 19 4.9 18.4 5.3 18L18 5.3C18.4 4.9 19 4.9 19.4 5.3C19.8 5.7 19.8 6.29999 19.4 6.69999L6.7 19.4C6.5 19.6 6.3 19.7 6 19.7Z"
                                      fill="currentColor"/>
                                <path
                                    d="M18.8 19.7C18.5 19.7 18.3 19.6 18.1 19.4L5.40001 6.69999C5.00001 6.29999 5.00001 5.7 5.40001 5.3C5.80001 4.9 6.40001 4.9 6.80001 5.3L19.5 18C19.9 18.4 19.9 19 19.5 19.4C19.3 19.6 19 19.7 18.8 19.7Z"
                                    fill="currentColor"/>
                            </svg>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body hover-scroll-overlay-y">

            </div>
            <!--end::Card body-->
            <!--end::Card-->

        </div>
    </div>


@endsection


@push('scripts')
    <script>
        function renderReadMore(data) {
            var maxLength = 50; // Maximum character limit for truncated content
            var content = data.length > maxLength ? data.substr(0, maxLength) + '...' : data;
            var output = '<div>';
            output += '<span class="truncated">' + content + '</span>';

            if (data.length > maxLength) {
                output += '<span class="full-content" style="display: none;">' + data + '</span>';
                output += '<a href="#" class="btn btn-light-primary btn-sm px-2 py-1 read-more">Read More</a>';
            }

            output += '</div>';
            return output;
        }

        $('#kt_table_complains').on('click', '.read-more', function(e) {
            e.preventDefault();
            var row = $(this).closest('tr');
            var column = $(this).closest('td');

            var fullContent = column.find('.full-content');
            var truncatedContent = column.find('.truncated');

            if (fullContent.is(':visible')) {
                fullContent.hide();
                truncatedContent.show();
                $(this).text('Read More');
            } else {
                fullContent.show();
                truncatedContent.hide();
                $(this).text('Read Less');
            }
        });

        var params = {
            status: null
        };
        const columnDefs = [{
                data: 'id',
                name: 'id',
                responsivePriority: 1,
            },
            {
                data: 'patient.name_locale',
                name: 'patient.name_locale',
                responsivePriority: 2,
            },
            {
                data: 'patient.idcard_no',
                name: 'patient.idcard_no',
            },
            {
                data: 'patient.mobile',
                name: 'patient.mobile',
            },
            {
                data: function (row, type, set) {

                    if (row.patient.patient_clinic)
                        return row.patient.patient_clinic.name

                    return '';
                },

                name: 'patient.patient_clinic.name',
            },
            {
                data: 'complain_type',
                name: 'complain_type',
            },
            {
                data: 'complain',
                name: 'complain',
                render: function(data, type, row, meta) {
                    if (type === 'display') {
                       // var tempalte = renderReadMore(data);
                       // return tempalte;
                    }
                    return data;
                },
            },
            {
                data: 'source',
                name: 'source',
            },
            {
                data: function (row, type, set) {

                    if (row.assigned_user)
                        return row.assigned_user.name+ " "+row.assigned_user.mobile;

                    return '';
                },
                name: 'assigned_user.name',
                orderable: false,
                searchable: false
            },
            {
                data: 'delay',
                name: 'delay',
                render: function(data, type) {
                    if (type === 'display') {
                        if (data)
                            return '<span class="badge badge-light-danger fs-7 m-1"">' + data +
                                ' Days Delay</span>';
                    }
                    return data;
                },
                responsivePriority: 4,
            },
            {
                data: 'complain_date',
                name: 'complain_date',
            },
            {
                data: 'user.name',
                name: 'user.name',
            },
            {
                data: 'created_at',
                name: 'created_at',
                visible: false
            },
            {
                data: 'status',
                name: 'status',
                render: function(data, type) {
                    if (type === 'display') {
                        if (data == 'in process')
                            return '<span class="badge badge-light-warning fs-7 m-1"">In process</span>';
                        if (data == 'solved')
                            return '<span class="badge badge-light-success fs-7 m-1"">Solved</span>';
                    }
                    return data;
                },
                responsivePriority: 3,
            },
            {
                data: 'action',
                name: 'action',
                className: 'text-end',
                orderable: false,
                searchable: false,
                responsivePriority: 5,
            }
        ];
        var datatable = createDataTable('#kt_table_complains', columnDefs,
            "{{ route('complains.index') }}", [
                [11, "DESC"],params
            ]);

        datatable.on('xhr', function(e, settings, json) {
            $('#totalNewComplainsCount').text(json['new_complains_count']);
            $('#totalInProcessCount').text(json['in_process_count']);
            $('#totalSuccessCount').text(json['solved_count']);
        });
    </script>
    <script>
        const filterSearch = document.querySelector('[data-kt-complains-table-filter="search"]');
        filterSearch.onkeydown = debounce(keyPressCallback, 400);

        function keyPressCallback() {
            // datatable.columns(1).search(filterSearch.value).draw();
        }

        $(function() {
            //
            //
            //
            $(document).on('click', '#FilterNewComplains', function(e) {
                params['status'] = 'status_new_complains';
                datatable.ajax.reload(null, false);
            })
            $(document).on('click', '#FitlerInProcess', function(e) {
                params['status'] = 'status_in_process';
                datatable.ajax.reload(null, false);
            })
            $(document).on('click', '#FilterSuccess', function(e) {
                params['status'] = 'status_solved';
                datatable.ajax.reload(null, false);
            })
        })
    </script>

    <script>
        const validatorAssignUserFields = {};
        const RequiredInputListAssignUser = {
            'assigned_user_id': 'select',
        }
        const kt_modal_assignUser = document.getElementById('kt_modal_assignUser');
        const modal_kt_assignUrl = new bootstrap.Modal(kt_modal_assignUser);

        $(document).on('click', '.btnAssginUser', function(e) {
            e.preventDefault();
            const assginUrl = $(this).attr('href');
            globalRenderModal(
                assginUrl,
                $(this), '#kt_modal_assignUser',
                modal_kt_assignUrl,
                validatorAssignUserFields,
                '#kt_modal_assignUser_form',
                datatable,
                '[data-kt-assginUser-modal-action="submit"]', RequiredInputListAssignUser);
        });


        const validatorChangeStatusFields = {};
        const RequiredInputListComplainChnageStatus = {
            'complain_status': 'select',
        }
        const kt_modal_changeStatus = document.getElementById('kt_modal_changeStatus');
        const modal_kt_changeStatus = new bootstrap.Modal(kt_modal_changeStatus);

        $(document).on('click', '.btnChangeStatus', function(e) {
            e.preventDefault();
            const changeStatusUrl = $(this).attr('href');
            globalRenderModal(
                changeStatusUrl,
                $(this), '#kt_modal_changeStatus',
                modal_kt_changeStatus,
                validatorChangeStatusFields,
                '#kt_modal_changeStatus_form',
                datatable,
                '[data-kt-changeStatus-modal-action="submit"]', RequiredInputListComplainChnageStatus);
        });

        $(document).on('click', '.btnDeletecomplain', function(e) {
            e.preventDefault();
            const URL = $(this).attr('href');
            const ComplainName = $(this).attr('data-complain-name');
            Swal.fire({
                html: "Are you sure you want to delete " + ComplainName + "?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, delete!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                }
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: "DELETE",
                        url: URL,
                        dataType: "json",
                        success: function(response) {
                            datatable.ajax.reload(null, false);
                            Swal.fire({
                                text: response.message,
                                icon: "success",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        },
                        complete: function() {},
                        error: function(response, textStatus,
                            errorThrown) {
                            toastr.error(response
                                .responseJSON
                                .message);
                        },
                    });

                } else if (result.dismiss === 'cancel') {}

            });
        });
    </script>

    <script>
        var patient_call_sms_logs = document.querySelector(".patient_call_sms_logs");
        var blockUI_patient_call_sms_logs = new KTBlockUI(patient_call_sms_logs, {
            message: '<div class="blockui-message"><span class="spinner-border text-primary"></span> Please wait...</div>',
        });
        $(document).ready(function () {
            $(document).on('click', '.ShowPatientCallsSmsLogs', function (e) {
                e.preventDefault();
                const url = $(this).attr('href');
                var drawerElement = document.querySelector("#kt_drawer_patient_call_sms_logs");
                var drawer = KTDrawer.getInstance(drawerElement);
                drawer.show();

                $(patient_call_sms_logs).find('.card-body').html('');

                blockUI_patient_call_sms_logs.block();

                $.ajax({
                    type: "GET",
                    url: url,
                    dataType: "json",
                    success: function (response) {
                        // console.log(response);
                        $(patient_call_sms_logs).find('.card-title span').text(response
                            .patientName);
                        $(patient_call_sms_logs).find('.card-body').html(response.drawerView);
                    },
                    complete: function () {
                        blockUI_patient_call_sms_logs.release();
                        // blockUI.release();
                    }

                });

            });
        });
    </script>

    @include('calls.scripts')
    @include('sms.scripts')
@endpush
