@extends('metronic.index')

@section('title', 'Settings - Menu WebSite')
@section('subpageTitle', 'Settings')
@section('subpageName', 'Menu WebSite')

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
                       WebSite Manager
                    </div>
                    <!--end::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">

                        <button type="button" class="btn btn-primary" id="btnRefresh">
                            <span class="indicator-label">
                                <!-- SVG Icon for Refresh -->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="23" height="24" viewBox="0 0 23 24" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M21 13V13.5C21 16 19 18 16.5 18H5.6V16H16.5C17.9 16 19 14.9 19 13.5V13C19 12.4 19.4 12 20 12C20.6 12 21 12.4 21 13ZM18.4 6H7.5C5 6 3 8 3 10.5V11C3 11.6 3.4 12 4 12C4.6 12 5 11.6 5 11V10.5C5 9.1 6.1 8 7.5 8H18.4V6Z"
                                            fill="currentColor" />
                                        <path opacity="0.3"
                                              d="M21.7 6.29999C22.1 6.69999 22.1 7.30001 21.7 7.70001L18.4 11V3L21.7 6.29999ZM2.3 16.3C1.9 16.7 1.9 17.3 2.3 17.7L5.6 21V13L2.3 16.3Z"
                                              fill="currentColor" />
                                    </svg>
                                </span>
                                Refresh
                            </span>
                            <span class="indicator-progress">
                                Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>

                        <button type="button" class="btn btn-danger" id="btnCreateMenu" style="margin: 20px;">
                            <span class="indicator-label">
                                <!-- SVG Icon for Create Menu -->
                            <span class="svg-icon svg-icon-2">
                                <svg width="23" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor"/>
                                    <rect x="11" y="7" width="2" height="10" rx="1" fill="currentColor"/>
                                    <rect x="7" y="11" width="10" height="2" rx="1" fill="currentColor"/>
                                </svg>
                            </span>
                            Create Menu
                        </span>
                                            <span class="indicator-progress">
                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                        </button>
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-3 pb-10">
                    <div class="row justify-content-center">
                        <div class="col-md-6 menuList" id="kt_block_ui_1_target">
                            @include('menuWebsite.menulist', ['menus' => $menus])
                        </div>
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
    </div>
    <!--end::Content container-->

    <!--begin::Modal - Add/Edit task-->
    <div class="modal fade" id="kt_modal_add_edit_menu" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">

        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - Add/Edit task-->

@endsection

@push('scripts')
    <script>
        const element = document.getElementById('kt_modal_add_edit_menu');
        const modal = new bootstrap.Modal(element);

        var target = document.querySelector("#kt_block_ui_1_target");
        var blockUI = new KTBlockUI(target);



        // Handle refreshing the menu list
        $(document).on('click', '#btnRefresh', function(e) {
            e.preventDefault();
            blockUI.block();
            $(this).attr('data-kt-indicator', 'on').attr('disabled', 'disabled');
            reloadMenuList($(this));
        });


        function reloadMenuList(button) {
            $.ajax({
                type: "POST",
                url: "{{ route('menuWebsite.index') }}",
                dataType: "json",
                success: function(response) {
                    $(".menuList").html(response.listView);
                    toastr.success(response.message);
                },
                complete: function() {
                    if (button)
                        button.removeAttr('data-kt-indicator').removeAttr("disabled");
                    if (blockUI.isBlocked()) {
                        blockUI.release();
                    }
                },
                error: function(response, textStatus, errorThrown) {
                    toastr.error(response.responseJSON.message);
                },
            });
        }
        $(document).on('click', '#btnCreateMenu', function(e) {
            e.preventDefault();
            renderModal("{{ route('menuWebsite.create') }}", $(this));
        });

        function renderModal(url, button) {
            $.ajax({
                type: "GET",
                url: url,
                dataType: "json",
                success: function(response) {
                    $('#kt_modal_add_edit_menu').find('.modal-dialog').html(response.createView || response.editView);
                    modal.show();
                    KTScroll.createInstances();

                    const form = element.querySelector('#kt_modal_add_edit_menu_form');

                    var validator = FormValidation.formValidation(
                        form, {
                            fields: {
                                'menu_name': {
                                    validators: {
                                        notEmpty: {
                                            message: 'Menu name is required'
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

                    const submitButton = element.querySelector('[data-kt-menus-modal-action="submit"]');
                    submitButton.addEventListener('click', function(e) {
                        e.preventDefault();

                        var formAddEdit = $("#kt_modal_add_edit_menu_form");
                        if (validator) {
                            validator.validate().then(function(status) {
                                if (status == 'Valid') {
                                    submitButton.setAttribute('data-kt-indicator', 'on');
                                    submitButton.disabled = true;
                                    let data = formAddEdit.serialize();

                                    $.ajax({
                                        type: 'POST',
                                        url: formAddEdit.attr('action'),
                                        data: data,
                                        success: function(response) {
                                            toastr.success(response.message);
                                            form.reset();
                                            modal.hide();
                                            $("#btnRefresh").click();
                                        },
                                        complete: function() {
                                            submitButton.removeAttribute('data-kt-indicator');
                                            submitButton.disabled = false;
                                        },
                                        error: function(response, textStatus, errorThrown) {
                                            toastr.error(response.responseJSON.message);
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

                    $('#parent_id').select2({
                        dropdownParent: $('#kt_modal_add_edit_menu'),
                        allowClear: true
                    });

                    autosize($('.kt_autosize'));
                },
                complete: function() {
                    if (button)
                        button.removeAttr('data-kt-indicator').removeAttr("disabled");
                },
                error: function(response, textStatus, errorThrown) {
                    toastr.error(response.responseJSON.message);
                },
            });
        }

        $(document).on('click', '.btnEditMenuItem', function(e) {
            e.preventDefault();
            $(this).attr('data-kt-indicator', 'on').attr('disabled', 'disabled');
            const editUrl = $(this).attr('data-edit-url');
            renderModal(editUrl, $(this));
        });


    </script>
@endpush
