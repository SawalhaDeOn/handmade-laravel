<!--begin::Modal content-->
<div class="modal-content">
    <!--begin::Modal header-->
    <div class="modal-header" id="kt_modal_add_slider_header">
        <!--begin::Modal title-->
        <h2 class="fw-bold">Add Slider</h2>
        <!--end::Modal title-->
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
    <!--end::Modal header-->
    <!--begin::Modal body-->
    <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
        <!--begin::Form-->

        <!--begin::Scroll-->
        <form id="kt_modal_add_slider_form" class="form" data-editMode="{{ isset($slider) ? 'enabled' : 'disabled' }}"
              action="{{ isset($slider) ? route('sliders.update', ['slider' => $slider->id]) : route('sliders.store') }}">
            <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_slider_scroll" data-kt-scroll="true"
                 data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                 data-kt-scroll-dependencies="#kt_modal_add_slider_header"
                 data-kt-scroll-wrappers="#kt_modal_add_slider_scroll" data-kt-scroll-offset="300px">
                <!--begin::Input group-->


                <!--begin::Input group-->



                <!--end::Input group-->
                <!--begin::Input group-->


            </div>
            <!--end::Input group-->
            <div class="card-body p-9">
                <div class="row">
                    <div class="col-md-6">
                        <div class="align-items-center d-flex flex-row me-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="active" name="active_c"
                                @isset($slider)
                                    @checked($slider->active == 1)

                                    @endisset>
                                <label class="form-check-label cursor-pointer text-primary fw-semibold fs-6"
                                       for="status">  {{ __('Active') }}</label>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="d-block fw-semibold fs-6 mb-5">Image</label>
                        <!--end::Label-->
                        <!--begin::Image placeholder-->
                        <style>
                            .image-input-placeholder {
                                background-image: url("{{ asset('media/svg/files/blank-image.svg') }}");
                            }

                            [data-bs-theme="dark"] .image-input-placeholder {
                                background-image: url("{{ asset('media/svg/files/blank-image-dark.svg') }}");
                            }
                        </style>
                        <!--end::Image placeholder-->
                        <!--begin::Image input-->
                        <div class="image-input image-input-outline image-input-placeholder ms-5"
                             data-kt-image-input="true">
                            <!--begin::Pslider existing avatar-->
                            <div class="image-input-wrapper w-125px h-125px"
                                 style="background-image: url('{{ isset($slider) ? ($slider->image_url != null ? asset('images/' . $slider->image_url) : asset('media/avatars/blank.png')) : asset('media/avatars/blank.png') }}')">
                            </div>
                            <!--end::Pslider existing avatar-->
                            <!--begin::Label-->
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                   data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change Image">
                                <i class="bi bi-pencil-fill fs-7"></i>
                                <!--begin::Inputs-->
                                <input type="file" name="image_url_link" accept=".png, .jpg, .jpeg" />

                                <!--end::Inputs-->
                            </label>
                            <!--end::Label-->
                            <!--begin::Cancel-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                  data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                              <i class="bi bi-x fs-2"></i>
                          </span>
                            <!--end::Cancel-->
                            <!--begin::Remove-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                  data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                              <i class="bi bi-x fs-2"></i>
                          </span>
                            <!--end::Remove-->
                        </div>
                        <!--end::Image input-->
                        <!--begin::Hint-->
                        <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                        <!--end::Hint-->
                    </div>
                    </div>

                    <div class="col-md-12">
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">{{ __('Name') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0"
                                   placeholder="name" value="{{ isset($slider) ? $slider->name : '' }}"/>
                            <!--end::Input-->
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">{{ __('Name En') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="name_en" class="form-control form-control-solid mb-3 mb-lg-0"
                                   placeholder="name_en" value="{{ isset($slider) ? $slider->name_en : '' }}"/>
                            <!--end::Input-->
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">{{ __('Name H') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="name_he" class="form-control form-control-solid mb-3 mb-lg-0"
                                   placeholder="name_he" value="{{ isset($slider) ? $slider->name_he : '' }}"/>
                            <!--end::Input-->
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">{{ __('Notes') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <textarea type="text" rows="2" name="notes"
                                      class="form-control form-control-solid mb-3 mb-lg-0"
                                      placeholder="name"> {{ isset($slider) ? $slider->notes : '' }} </textarea>
                            <!--end::Input-->
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">{{ __('Notes En') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <textarea type="text" rows="2" name="notes_en"
                                      class="form-control form-control-solid mb-3 mb-lg-0"
                                      placeholder="name"> {{ isset($slider) ? $slider->notes_en : '' }} </textarea>
                            <!--end::Input-->
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">{{ __('Notes H') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <textarea type="text" rows="2" name="notes_he"
                                      class="form-control form-control-solid mb-3 mb-lg-0"
                                      placeholder="name"> {{ isset($slider) ? $slider->notes_he : '' }} </textarea>
                            <!--end::Input-->
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">{{ __('Button Link') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <textarea type="text" rows="2" name="hlink"
                                      class="form-control form-control-solid mb-3 mb-lg-0"
                                      placeholder="name"> {{ isset($slider) ? $slider->hlink : '' }} </textarea>
                            <!--end::Input-->
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->

                </div>

                <!--end::Input group-->
            </div>
            <!--end::Scroll-->
            <!--begin::Actions-->
            <div class="text-center pt-15">
                <button type="reset" class="btn btn-light me-3" data-kt-sliders-modal-action="cancel"
                        data-bs-dismiss="modal">Discard
                </button>
                <button type="submit" class="btn btn-primary" data-kt-sliders-modal-action="submit">
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
