<div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6">
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
                    <input type="text" data-kt-speciality-table-filter="search"
                        class="form-control form-control-solid w-250px ps-14" placeholder="Search Specialities" />
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-speciality-table-toolbar="base">
                    <!--begin::Add speciality-->
                    <button type="button" class="btn btn-primary" id="AddspecialityModal">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                        <span class="indicator-label">
                            <span class="svg-icon svg-icon-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect opaspeciality="0.5" x="11.364" y="20.364" width="16"
                                        height="2" rx="1" transform="rotate(-90 11.364 20.364)"
                                        fill="currentColor" />
                                    <rect x="4.36396" y="11.364" width="16" height="2" rx="1"
                                        fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->Add speciality
                        </span>
                        <span class="indicator-progress">
                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                    <!--end::Add speciality-->
                </div>
                <!--end::Toolbar-->

                <!--begin::Modal - Add task-->
                <div class="modal fade" id="kt_modal_add_speciality" tabindex="-1" aria-hidden="true">
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
            <!--begin::Table-->
            <table class="table table-bordered align-middle table-row-dashed fs-6 gy-5" id="kt_table_specialities">
                <!--begin::Table head-->
                <thead>
                    <!--begin::Table row-->
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th></th>
                        <th class="min-w-125px">speciality</th>
                        <th class="min-w-125px">Department</th>
                        <th class="text-end min-w-100px">Actions</th>
                    </tr>
                    <!--end::Table row-->
                </thead>
                <!--end::Table head-->

            </table>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>
</div>
@push('scripts')
    <script>
        var specialityTable = document.querySelector('#kt_table_specialities');

        var speciality_datatable = $(specialityTable).DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            searchDelay: 1050,
            pageLength: 10,
            lengthMenu: [10, 50, 100],
            ajax: {
                url: "{{ route('departments-speciality.specialities') }}",
                type: "POST",
            },
            columns: [{
                    data: 'id',
                    name: 'id',
                    visible: false,
                    searchable: false
                },
                {
                    data: 'name_locale',
                    name: 'name',
                },
                {
                    data: 'department.name_locale',
                    name: 'department.name_locale',
                    orderable: false,
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
                [1, "ASC"]
            ]
        });

        const filterspecialitySearch = document.querySelector('[data-kt-speciality-table-filter="search"]');
        filterspecialitySearch.onkeydown = debounce(keyPressCallback, 400);

        function keyPressCallback() {
            speciality_datatable.search(filterspecialitySearch.value).draw();
        }
    </script>

    <script>
        const element_speciality = document.getElementById('kt_modal_add_speciality');
        const modal_speciality = new bootstrap.Modal(element_speciality);

        function renderModal_speciality(url, button) {
            $.ajax({
                type: "GET",
                url: url,
                dataType: "json",
                success: function(response) {
                    // console.log(response);
                    $('#kt_modal_add_speciality').find('.modal-dialog').html(response.createView);
                    // $('#AddEditModal').modal('show');
                    modal_speciality.show();
                    KTScroll.createInstances();
                    KTImageInput.createInstances();

                    const form_speciality = element_speciality.querySelector('#kt_modal_add_speciality_form');
                    var validator_speciality = FormValidation.formValidation(
                        form_speciality, {
                            fields: {
                                'department_id': {
                                    validators: {
                                        notEmpty: {
                                            message: 'Department is required'
                                        }
                                    }
                                },
                                'name': {
                                    validators: {
                                        notEmpty: {
                                            message: 'Name is required'
                                        }
                                    }
                                },
                                'name_en': {
                                    validators: {
                                        notEmpty: {
                                            message: 'Name English is required'
                                        },
                                    }
                                },
                                'name_he': {
                                    validators: {
                                        notEmpty: {
                                            message: 'Name Hebrew is required'
                                        },
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


                    const submitButton = element_speciality.querySelector(
                        '[data-kt-speciality-modal-action="submit"]');
                    submitButton.addEventListener('click', function(e) {
                        // Prevent default button action
                        e.preventDefault();

                        const formAdd = document.getElementById('kt_modal_add_speciality_form');
                        // Validate form before submit
                        if (validator_speciality) {
                            validator_speciality.validate().then(function(status) {
                                console.log('validated!');

                                if (status == 'Valid') {
                                    // Show loading indication
                                    submitButton.setAttribute('data-kt-indicator',
                                        'on');
                                    // Disable button to avoid multiple click 
                                    submitButton.disabled = true;

                                    let data = $(formAdd).serialize();
                                    $.ajax({
                                        type: 'POST',
                                        url: $(formAdd).attr('action'),
                                        data: data,
                                        success: function(response) {
                                            toastr.success(response.message);
                                            form_speciality.reset();
                                            modal_speciality.hide();
                                            speciality_datatable.ajax.reload(null,
                                                false);
                                        },
                                        complete: function() {
                                            // KTUtil.btnRelease(btn);
                                            submitButton.removeAttribute(
                                                'data-kt-indicator');
                                            // Disable button to avoid multiple click 
                                            submitButton.disabled = false;
                                        },
                                        error: function(response, textStatus,
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


                    $('#department_id').select2({
                        dropdownParent: $('#kt_modal_add_speciality')
                    });


                },
                complete: function() {
                    if (button)
                        button.removeAttr('data-kt-indicator');
                }

            });
        }

        $(document).on('click', '.btnUpdatespeciality', function(e) {
            e.preventDefault();
            $(this).attr("data-kt-indicator", "on");
            const editURl = $(this).attr('href');
            renderModal_speciality(editURl, $(this));
        });

        $(document).on('click', '#AddspecialityModal', function(e) {
            e.preventDefault();
            $(this).attr("data-kt-indicator", "on");
            renderModal_speciality("{{ route('departments-speciality.speciality.create') }}", $(this));
        });

        $(document).on('click', '.btnDeletespeciality', function(e) {
            e.preventDefault();
            const URL = $(this).attr('href');
            const specialityName = $(this).attr('data-speciality-name');
            Swal.fire({
                text: "Are you sure you want to delete " + specialityName + "?",
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
                            speciality_datatable.ajax.reload(null, false);
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
@endpush
