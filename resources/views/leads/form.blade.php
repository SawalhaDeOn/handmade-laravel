<!--begin::Card header-->
<div class="card-header">
    <!--begin::Card title-->
    <div class="card-title m-0">
        <h3 class="fw-bold m-0">{{__('Lead Details')}}</h3>
    </div>
    <!--end::Card title-->
    <div class="card-toolbar">


    </div>
</div>
<!--begin::Card body-->
<div class="card-body p-9">
    <div class="row">
        <div class="col-md-6">
            <div class="fv-row mb-7">
                <div class="align-items-center d-flex flex-row me-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="active" name="active_c"
                        @isset($lead)
                            @checked($lead->active == 1)

                            @endisset>
                        <label class="form-check-label cursor-pointer text-primary fw-semibold fs-6"
                               for="status">  {{ __('Active') }}</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="fv-row mb-7">
                <div class="align-items-center d-flex flex-row me-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="active" name="intersted_c"
                        @isset($lead)
                            @checked($lead->intersted == 1)

                            @endisset>
                        <label class="form-check-label cursor-pointer text-primary fw-semibold fs-6"
                               for="status">  {{ __('Intersted') }}</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="fv-row mb-4">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">{{__('Status')}}</label>
                <!--end::Label-->
                <!--begin::Input-->
                <select class="form-select form-select-solid mb-3 mb-lg-0" data-control="select2"
                        name="status" id="status" data-placeholder="Select an option">
                    <option></option>
                    @foreach ($lead_status as $t)
                        <option value="{{ $t->id }}"
                        @if (isset($lead))
                            @selected($lead->status ==$t->id)
                            @endif>
                            {{ $t->name }}</option>
                    @endforeach
                </select>
                <!--end::Input-->
            </div>
        </div>

        <div class="col-md-6">
            <div class="fv-row mb-4">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">{{__('Action')}}</label>
                <!--end::Label-->
                <!--begin::Input-->
                <select class="form-select form-select-solid mb-3 mb-lg-0" data-control="select2"
                        name="type_idd" id="category" data-placeholder="Select an option">
                    <option></option>
                    @foreach ($lead_types as $t)
                        <option value="{{ $t->id }}"
                        @if (isset($lead))
                            @selected($lead->type_id ==$t->id)
                            @endif>
                            {{ $t->name }}</option>
                    @endforeach
                </select>
                <!--end::Input-->
            </div>
        </div>


    </div>
</div>






