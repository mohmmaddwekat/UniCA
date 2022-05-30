<link href ="/assets/css/app.css" rel = "stylesheet">

<x-auth-validation-errors class="m-4" :errors="$errors" />

<div class="card-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputName1">{{ __('Name College') }}</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror"
                    name="name" value="{{ old('name', $college->name) }}" id="exampleInputName1"
                    placeholder="{{ __('Enter Name') }}" >


            </div>



        </div>
        <!-- /.col -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputName1">{{ __('College Number') }}</label>
                <input type="text"
                    class="form-control @error('college_number') is-invalid @enderror"
                    name="college_number" value="{{ old('college_number', $college->college_number) }}"
                    id="exampleInputName1" placeholder="{{ __('Enter College Number') }}"
                    required>

            </div>
        </div>
    </div>
    <!-- /.row -->
    <!-- /.row -->
</div>

<p class="pl-2">Dean Department</p>

<div class="card-body">
  <div class="row">

      <div class="col-md-6">

          <div class="form-group">
              <label for="name">{{ __('ID') }}</label>
              
              <span>{{ $key }}</span><input type="text" class="form-control @error('type_username_id') is-invalid @enderror"
                  name="type_username_id" value="{{ old('type_username_id', $user['type_username_id']) }}"
                  id="type_username_id" placeholder="{{ __('Enter ID') }}">
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
                  value="{{ old('email', $user['email']) }}" id="email"
                  placeholder="{{ __('Enter Email') }}">


          </div>


      </div>
  </div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary">{{ __($savelabel) }}</button>

</div>