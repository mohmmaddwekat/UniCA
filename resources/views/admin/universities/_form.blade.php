<link href ="/assets/css/app.css" rel = "stylesheet">

<div class="form-body">

    <!-- Validation Errors -->
    <x-auth-validation-errors class="m-4" :errors="$errors" />
    <div class="row">

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="type_username_id">{{ __('Key') }}</label>
                        <input type="text" class="form-control @error('key') is-invalid @enderror" name="key"
                            value="{{ old('key', $university['key']) }}" id="key"
                            placeholder="{{ __('Enter key') }}">
                    </div>

                    <div class="form-group">
                        <label for="type_username_id">{{ __('University ID') }}</label>
                        <input type="text" class="form-control @error('type_username_id') is-invalid @enderror"
                            name="type_username_id"
                            value="{{ old('type_username_id', $university['type_username_id']) }}"
                            id="type_username_id" placeholder="{{ __('Enter University ID') }}">
                    </div>

                    <div class="form-group">
                        <label for="university_name">{{ __('University Name') }}</label>
                        <input type="text" class="form-control @error('university_name') is-invalid @enderror"
                            name="university_name"
                            value="{{ old('university_name', $university['university_name']) }}" id="university_name"
                            placeholder="{{ __('Enter University Name') }}">
                    </div>
                    <div class="form-group">
                        <label for="phone_number">{{ __('Phone Number') }}</label>
                        <input type="tel" class="form-control @error('phone_number') is-invalid @enderror"
                            name="phone_number" value="{{ old('phone_number', $university['phone_number']) }}"
                            id="phone_number" placeholder="{{ __('Enter Phone Number') }}">
                    </div>

                </div>
                <div class="col-md-6">

                    <div class="form-group">
                        <label for="address">{{ __('Address') }}</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" name="address"
                            value="{{ old('address', $university['address']) }}" id="address"
                            placeholder="{{ __('Enter Address') }}">
                    </div>

                    <div class="form-group">
                        <label for="address">{{ __('Email') }}</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email', $university['email']) }}" id="email"
                            placeholder="{{ __('Enter Email') }}">
                    </div>



                    <div class="form-group">
                        <label>{{ __('City') }}</label>
                        <select class="form-control  selectpicker @error('city_id') is-invalid @enderror" name="city_id"
                            data-selected-text-format="count" data-live-search="true">
                            <option>{{ __('Nothing selected') }}</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city['id'] }}" @if ($city->id == old('city_id', $university['city_id'])) selected @endif>
                                    {{ $city['name'] }}</option>
                            @endforeach
                        </select>


                    </div>
                </div>


            </div>
        </div>
        <!-- /.row -->
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">{{ $savelabel }}</button>
    </div>
</div>
</div>
