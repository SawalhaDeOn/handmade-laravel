<div class="modal-content">

    <div class="modal-header" id="kt_modal_showLead_header">
        <!--begin::Modal preparation_time-->

        <h3 class="fw-bold m-0">{{__('Lead Details')}}</h3>

        <!--end::Card title-->


        <!--end::Modal preparation_time-->
        <!--begin::Close-->
        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
            <span class="svg-icon svg-icon-1">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                            transform="rotate(-45 6 17.3137)" fill="currentColor"/>
                      <rect x="7.41422" y="6" width="16" height="2" rx="1"
                            transform="rotate(45 7.41422 6)" fill="currentColor"/>
                  </svg>
              </span>
            <!--end::Svg Icon-->
        </div>
        <!--end::Close-->
    </div>

    <div class="modal-body scroll-y ">
        <form id="kt_modal_add_lead_form" class="form"
              data-editMode="{{ isset($lead) ? 'enabled' : 'disabled' }}"
              action="{{ isset($lead) ? route('leads.addedit', ['Id' => $lead->id]) : route('leads.addedit') }}">
            <div class="card-body p-9">

            </div>
            <div class="text-center pt-15">
                <button type="reset" class="btn btn-light me-3" data-kt-lead-modal-action="cancel"
                        data-bs-dismiss="modal">{{__('Discard')}}
                </button>
                <button type="submit" class="btn btn-primary" data-kt-lead-modal-action="submit">
                    <span class="indicator-label">{{__('Submit')}}</span>
                    <span class="indicator-progress">{{__('Please wait...')}}
                          <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
            </div>
            <!--end::Actions-->
        </form>

    </div>
</div><!--begin::Card header-->







