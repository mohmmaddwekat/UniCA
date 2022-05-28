<x-auth-validation-errors class="m-4" :errors="$errors" />

<div class="card-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputName1">{{ __('Name Department') }}</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name', $department['name']) }}" id="exampleInputName1"
                    placeholder="{{ __('Enter Name') }}">
            </div>

        </div>
        <!-- /.col -->
        <div class="col-md-6">
            <div class="form-group">
                <label>{{ __('College') }}</label>
                <select class="form-control  selectpicker @error('college') is-invalid @enderror" name="college"
                    data-selected-text-format="count" data-live-search="true">
                    <option>{{ __('Nothing selected') }}</option>
                    @foreach ($colleges as $college)
                        <option value="{{ $college->id }}" @if (old('college', $college->id == $department->college_id)) selected @endif>
                            {{ $college->name }}</option>
                    @endforeach
                </select>

            </div>

        </div>
    </div>
    <!-- /.row -->
    <!-- /.row -->
</div>
<div class="card-body">
    <div class="row">

        <div class="col-md-6">

            <div class="form-group">
                <label for="name">{{ __('ID') }}</label>

                <span>{{ $key }}</span><input type="text"
                    class="form-control @error('type_username_id') is-invalid @enderror" name="type_username_id"
                    value="{{ old('type_username_id', $user['type_username_id']) }}" id="type_username_id"
                    placeholder="{{ __('Enter ID') }}">
            </div>

            <div class="form-group">
                <label for="fullname">{{ __('Full Name') }}</label>
                <input type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname"
                    value="{{ old('fullname', $user['name']) }}" id="fullname"
                    placeholder="{{ __('Enter Full Name') }}">

            </div>




        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">{{ __('Email') }}</label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email', $user['email']) }}" id="email" placeholder="{{ __('Enter Email') }}">


            </div>


        </div>
    </div>
</div>

<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{ __($savelabel) }}</button>

</div>
