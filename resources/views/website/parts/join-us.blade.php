<div class="container">
    <section id="services" class="join-us-container">
        <div class="title">{{ __('Join Us') }}</div>
        <p>{{ __('If you are a craftsman and would like to showcase your products, please fill out the form below. We will contact you soon.') }}</p>

        <div class="d-flex justify-content-center flex-wrap">
            <div class="text1">{{ __('Historical Value') }}</div>
            <div class="text2">{{ __('Handmade') }}</div>
            <div class="text3">{{ __('Palestinian Creativity') }}</div>
        </div>

        <form action="leadForm2" method="post" class="join-us-form mt-4" id="formy" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
            <div class="row">
                <div class="col-md-4 form-group">
                    <label for="name">{{ __('Name') }}</label>
                    <input type="text" id="name" name="name" placeholder="{{ __('Name') }}" class="form-control" required>
                </div>
                <div class="col-md-4 form-group">
                    <label for="facebook">{{ __('Facebook Link') }}</label>
                    <input type="url" id="facebook" name="facebook" placeholder="{{ __('Facebook Link') }}" class="form-control">
                </div>
                <div class="col-md-4 form-group">
                    <label for="email">{{ __('Email') }}</label>
                    <input type="email" id="email" name="email" placeholder="{{ __('Email') }}" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 form-group">
                    <label for="product-type">{{ __('Product Type') }}</label>
                    <input type="text" id="product_type" name="product_type" placeholder="{{ __('Product Type') }}" class="form-control" required>
                </div>
                <div class="col-md-4 form-group">
                    <label for="instagram">{{ __('Instagram Link') }}</label>
                    <input type="url" id="instagram" name="instagram" placeholder="{{ __('Instagram Link') }}" class="form-control">
                </div>
                <div class="col-md-4 form-group">
                    <label for="whatsapp">{{ __('Whatsapp Number') }}</label>
                    <input type="tel" id="whatsapp" name="whatsapp" placeholder="{{ __('Whatsapp Number') }}" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 form-group">
                    <label for="brand">{{ __('Brand') }}</label>
                    <input type="text" id="brand" name="brand" placeholder="{{ __('Brand') }}" class="form-control">
                </div>
                <div class="col-md-4 form-group">
                    <label for="phone">{{ __('Phone Number') }}</label>
                    <input type="tel" maxlength="10" id="phone" name="phone" placeholder="{{ __('Phone Number') }}" class="form-control" required>
                </div>
                <div class="col-md-4 form-group">
                    <label for="product-image">{{ __('Product Image') }}</label>
                    <div class="input-wrapper">
                        <div class="file-input-wrapper">
                            <input type="file" id="product-image" name="product_image" class="form-control" accept="image/*" required style="display: none;">
                            <label for="product-image" class="icon-label">
                                <svg width="33" height="33" viewBox="0 0 33 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.3992 29.9818H20.3893C27.0477 29.9818 29.7111 27.3184 29.7111 20.66V12.6699C29.7111 6.01151 27.0477 3.34814 20.3893 3.34814H12.3992C5.74076 3.34814 3.07739 6.01151 3.07739 12.6699V20.66C3.07739 27.3184 5.74076 29.9818 12.3992 29.9818Z" stroke="#7F7F00" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12.3992 14.0015C13.8701 14.0015 15.0625 12.8091 15.0625 11.3382C15.0625 9.86723 13.8701 8.6748 12.3992 8.6748C10.9282 8.6748 9.73581 9.86723 9.73581 11.3382C9.73581 12.8091 10.9282 14.0015 12.3992 14.0015Z" stroke="#7F7F00" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M3.96964 25.9201L10.5348 21.5123C11.5869 20.8065 13.105 20.8864 14.0505 21.6987L14.4899 22.0849C15.5286 22.9771 17.2066 22.9771 18.2453 22.0849L23.7851 17.3308C24.8238 16.4386 26.5017 16.4386 27.5404 17.3308L29.7111 19.1951" stroke="#7F7F00" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container d-flex flex-column justify-content-center align-items-center" style="height: 35vh;">
                <div class="row w-100 justify-content-center">
                    <div class="col-md-6 form-group d-flex align-items-center justify-content-center">
                        <input type="checkbox" id="terms" name="terms" required class="custom-checkbox">
                        <label class="check-box" for="terms">{{ __('Agree To Terms') }}</label>
                    </div>
                </div>
                <button type="submit" id="submit_contact1" class="submit-join">{{ __('Submit') }}</button>
            </div>
        </form>
    </section>
</div>
