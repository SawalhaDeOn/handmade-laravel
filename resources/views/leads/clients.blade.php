<div class="card mb-5 mb-xl-10" id="kt_lead_details_view">
    <!--begin::Card header-->
    <div class="card-header">
        <!--begin::Card title-->
        <div class="card-title m-0 w-600px">
            <select class="form-select form-select-solid mb-3 mb-lg-0" id="client_id" data-control="select2"
                    name="client_id"
                    data-placeholder="Select client">
                <option></option>
                @foreach ($clients as $c)
                    <option value="{{ $c->id }}"
                    @isset($client)
                        @selected($client->id == $c->id)
                        @endisset>
                        {{ $c->name }}</option>
                @endforeach
            </select>
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
                    <label class="fw-semibold fs-6 mb-2"
                           data-input-name="{{__('Name')}}">{{__('Name')}}</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0"
                           placeholder="" value="{{ isset($client) ? $client->name : (isset($call)?$call->name:null) }}"/>
                    <!--end::Input-->
                </div>
            </div>
            <div class="col-md-4">
                <div class="fv-row mb-7">
                    <!--begin::Label-->
                    <label class="fw-semibold fs-6 mb-2"
                           data-input-name="{{__('Name En')}}">{{__('Name En')}}</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="text" name="name_en" class="form-control form-control-solid mb-3 mb-lg-0"
                           placeholder="" value="{{ isset($client) ? $client->name_en : (isset($call)?$call->name_en:null) }}"/>
                    <!--end::Input-->
                </div>
            </div>



            <div class="col-md-4">
                <div class="fv-row mb-7">
                    <!--begin::Label-->
                    <label class="fw-semibold fs-6 mb-2" data-input-name="City">
                        {{ __('City') }}</label>
                    <!--end::Label-->
                    <!--begin::Input-->

                    <select class="form-select form-select-solid mb-3 mb-lg-0" data-control="select2"
                            name="city_id"
                            data-placeholder="Select an option">
                        <option></option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}"
                            @isset($client)
                                @selected($client->city_id == $city->id)
                                @endisset>
                                {{ $city->name }}</option>
                        @endforeach
                    </select>
                    <!--end::Input-->
                </div>
            </div>

            <div class="col-md-4">
                <div class="fv-row mb-4">
                    <!--begin::Label-->
                    <label class=" fw-semibold fs-6 mb-2">{{__('Category')}}</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <select class="form-select form-select-solid mb-3 mb-lg-0" data-control="select2"
                            name="category" id="category" data-placeholder="Select an option">
                        <option></option>
                        @foreach ($CATEGORYS as $t)
                            <option value="{{ $t->id }}"
                            @if (isset($client))
                                @selected($client->category ==$t->id)
                                @endif>
                                {{ $t->name }}</option>
                        @endforeach
                    </select>
                    <!--end::Input-->
                </div>
            </div>

            <div class="col-md-4">
                <div class="fv-row mb-4">
                    <!--begin::Label-->
                    <label class=" fw-semibold fs-6 mb-2">{{__('Type')}}</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <select class="form-select form-select-solid mb-3 mb-lg-0" data-control="select2"
                            name="type_id" id="category" data-placeholder="Select an option">
                        <option></option>
                        @foreach ($TYPES as $t)
                            <option value="{{ $t->id }}"
                            @if (isset($client))
                                @selected($client->type_id ==$t->id)
                                @endif>
                                {{ $t->name }}</option>
                        @endforeach
                    </select>
                    <!--end::Input-->
                </div>
            </div>



            <div class="col-md-4">
                <div class="fv-row mb-7">
                    <!--begin::Label-->
                    <label class="fw-semibold fs-6 mb-2" data-input-name="Assign City">
                        {{ __('Region') }}</label>
                    <!--end::Label-->
                    <!--begin::Input-->

                    <select class="form-select form-select-solid mb-3 mb-lg-0" data-control="select2"
                            name="assign_city_id"
                            data-placeholder="Select an option">
                        <option></option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}"
                            @isset($client)
                                @selected($client->assign_city_id == $city->id)
                                @endisset>
                                {{ $city->name }}</option>
                        @endforeach
                    </select>
                    <!--end::Input-->
                </div>
            </div>
            <div class="col-md-4">
                <div class="fv-row mb-7">
                    <!--begin::Label-->
                    <label class="fw-semibold fs-6 mb-2"
                           data-input-name="{{__('Address')}}">{{__('Client Address')}}</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="text" name="address" class="form-control form-control-solid mb-3 mb-lg-0"
                           placeholder="" value="{{ isset($client) ? $client->address : '' }}"/>
                    <!--end::Input-->
                </div>
            </div>

            <div class="col-md-4">
                <div class="fv-row mb-7">
                    <!--begin::Label-->
                    <label class="fw-semibold fs-6 mb-2" data-input-name="Email">{{__('Email')}}</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="text" name="email" class="form-control form-control-solid mb-3 mb-lg-0"
                           placeholder="" value="{{ isset($client) ? $client->email : (isset($call)?$call->email:null)  }}"/>
                    <!--end::Input-->
                </div>
            </div>

            <div class="col-md-4">
                <div class="fv-row mb-7">
                    <!--begin::Label-->
                    <label class="fw-semibold fs-6 mb-2" data-input-name="Mobile">{{__('Mobile')}}</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="text" name="telephone" class="form-control form-control-solid mb-3 mb-lg-0"
                           placeholder="" value="{{ isset($client) ? $client->telephone : (isset($call)?$call->telephone:null)  }}"/>
                    <!--end::Input-->
                </div>
            </div>
            <div class="col-md-4">
                <div class="fv-row mb-7">
                    <!--begin::Label-->
                    <label class="fw-semibold fs-6 mb-2" data-input-name="Mobile">{{__('Whatsapp')}}</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="text" name="whatsapp" class="form-control form-control-solid mb-3 mb-lg-0"
                           placeholder="" value="{{ isset($client) ? $client->whatsapp : (isset($call)?$call->whatsapp:null)  }}"/>
                    <!--end::Input-->
                </div>
            </div>












        </div>


    </div>

</div>

<!--end::Card body-->



