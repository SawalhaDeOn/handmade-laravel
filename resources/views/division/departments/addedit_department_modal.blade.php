  <!--begin::Modal content-->
  <div class="modal-content">
      <!--begin::Modal header-->
      <div class="modal-header" id="kt_modal_add_department_header">
          <!--begin::Modal title-->
          <h2 class="fw-bold">Add department</h2>
          <!--end::Modal title-->
          <!--begin::Close-->
          <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
              <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
              <span class="svg-icon svg-icon-1">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                          transform="rotate(-45 6 17.3137)" fill="currentColor" />
                      <rect x="7.41422" y="6" width="16" height="2" rx="1"
                          transform="rotate(45 7.41422 6)" fill="currentColor" />
                  </svg>
              </span>
              <!--end::Svg Icon-->
          </div>
          <!--end::Close-->
      </div>
      <!--end::Modal header-->
      <!--begin::Modal body-->
      <div class="modal-body scroll-y mx-5 my-7">
          <!--begin::Form-->

          <!--begin::Scroll-->
          <form id="kt_modal_add_department_form" class="form"
              data-editMode="{{ isset($department) ? 'enabled' : 'disabled' }}"
              action="{{ isset($department) ? route('departments-speciality.department.update', ['department' => $department->id]) : route('departments-speciality.department.store') }}">
              <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_department_scroll"
                  data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                  data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_department_header"
                  data-kt-scroll-wrappers="#kt_modal_add_department_scroll" data-kt-scroll-offset="300px">
                  <!--begin::Input group-->

                  <div class="fv-row mb-4">
                      <!--begin::Label-->
                      <label class="required fw-semibold fs-6 mb-2">Name</label>
                      <!--end::Label-->
                      <!--begin::Input-->
                      <input type="text" name="department_name" class="form-control form-control-solid mb-3 mb-lg-0"
                          placeholder="" value="{{ isset($department) ? $department->name : '' }}" />
                      <!--end::Input-->
                  </div>

                  <div class="fv-row mb-4">
                      <!--begin::Label-->
                      <label class="required fw-semibold fs-6 mb-2">Name English</label>
                      <!--end::Label-->
                      <!--begin::Input-->
                      <input type="text" name="department_name_en"
                          class="form-control form-control-solid mb-3 mb-lg-0" placeholder=""
                          value="{{ isset($department) ? $department->name_en : '' }}" />
                      <!--end::Input-->
                  </div>

                  <div class="fv-row mb-4">
                      <!--begin::Label-->
                      <label class="required fw-semibold fs-6 mb-2">Name Hebrew</label>
                      <!--end::Label-->
                      <!--begin::Input-->
                      <input type="text" name="department_name_he"
                          class="form-control form-control-solid mb-3 mb-lg-0" placeholder=""
                          value="{{ isset($department) ? $department->name_he : '' }}" />
                      <!--end::Input-->
                  </div>

                  <!--end::Input group-->
                  <!--end::Input group-->
                  <!--begin::Input group-->
              </div>
              <!--end::Scroll-->
              <!--begin::Actions-->
              <div class="text-center pt-15">
                  <button type="reset" class="btn btn-light me-3" data-kt-department-modal-action="cancel"
                      data-bs-dismiss="modal">Discard</button>
                  <button type="submit" class="btn btn-primary" data-kt-department-modal-action="submit">
                      <span class="indicator-label">Submit</span>
                      <span class="indicator-progress">Please wait...
                          <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                  </button>
              </div>
              <!--end::Actions-->
          </form>

          <!--end::Form-->
      </div>
      <!--end::Modal body-->
  </div>
  <!--end::Modal content-->
