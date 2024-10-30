<div id="kt_drawer_chat" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true"
     data-kt-drawer-close="#kt_drawer_chat_close" data-kt-drawer-overlay="true"
     data-kt-drawer-width="{default:'100%', 'md': '50%'}">
    <div class="card w-100 rounded-0 chat">
        <!--begin::Card-->
        <!--begin::Card header-->
        <div class="card-header pe-5">

            <!--begin::Title-->
            <div class="card-title">
                <!--begin::User-->
                <h4 class="font-weight-bold m-0">Messages <span id="senderN"></span></h4>
                <!--end::User-->
            </div>
            <!--end::Title-->

            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-light-primary"
                     id="kt_drawer_chat_close">
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
            <form data-kt-search-element="form" class="w-100 position-relative mb-5" autocomplete="off">
                <!--begin::Hidden input(Added to disable form autocomplete)-->
                <input type="hidden" wfd-invisible="true">
                <!--end::Hidden input-->

                <!--begin::Icon-->
                <i class="ki-duotone searchWhatClick ki-magnifier fs-2 fs-lg-1 text-gray-500 position-absolute top-50 ms-5 translate-middle-y"><span class="path1"></span><span class="path2"></span></i>                    <!--end::Icon-->

                <!--begin::Input-->
                <input type="text" class="form-control searchinputWhat form-control-lg form-control-solid px-15" name="inputsearchWhat" value="" placeholder="Search " data-kt-search-element="input">
                <!--end::Input-->

                <!--begin::Spinner-->
                <span class="position-absolute top-50 end-0 translate-middle-y lh-0 me-5 d-none" data-kt-search-element="spinner" wfd-invisible="true">
                        <span class="spinner-border h-15px w-15px align-middle text-gray-500"></span>
                    </span>
                <!--end::Spinner-->

                <!--begin::Reset-->
                <span class="btn btn-flush btn-active-color-primary position-absolute top-50 end-0 translate-middle-y lh-0 me-5 searchWhatClose" data-kt-search-element="clear" wfd-invisible="true">
                        <i class="ki-duotone ki-cross fs-2 fs-lg-1 me-0"><span class="path1"></span><span class="path2"></span></i>                    </span>
                <!--end::Reset-->
            </form>

            {{--<div class="input-group mb-10">
                <div class="input-group-prepend searchWhatClick">
														<span class="input-group-text">
															<span class="svg-icon svg-icon ">
																<!--begin::Svg Icon | path:cp/assets/media/svg/icons/General/Search.svg-->
																<svg xmlns="http://www.w3.org/2000/svg" width="24px"
                                                                     height="24px" viewBox="0 0 24 24" version="1.1">
																	<g stroke="none" stroke-width="1" fill="none"
                                                                       fill-rule="evenodd">
																		<rect x="0" y="0" width="24" height="24"/>
																		<path
                                                                            d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z"
                                                                            fill="#000000" fill-rule="nonzero"
                                                                            opacity="0.3"/>
																		<path
                                                                            d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z"
                                                                            fill="#000000" fill-rule="nonzero"/>
																	</g>
																</svg>
                                                                <!--end::Svg Icon-->
															</span>
														</span>
                </div>
                <input type="text" class="form-control searchinputWhat" name="inputsearchWhat"
                       placeholder="Search..."/>
                <div class="input-group-append searchWhatClose">
														<span class="input-group-text ">
															<i class="quick-search-close ki ki-close icon text-muted"></i>
														</span>
                </div>
            </div>--}}
            <input type="hidden" name="sender" id="ssender" value="-1">
            <div class="offcanvas-wrapper mb-5 scroll-pull unread_messages">
            </div>

        </div>
        <!--end::Card body-->
        <!--end::Card-->

    </div>
</div>
