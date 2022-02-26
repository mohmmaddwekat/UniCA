




<div class="form-body">
    
        <!-- Validation Errors -->
        <x-auth-validation-errors class="m-4" :errors="$errors" />
    <div class="row">

        <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputName1">{{__('Name City')}}</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $city['name']) }}" id="exampleInputName1" placeholder="{{__('Enter Name')}}" required>

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
