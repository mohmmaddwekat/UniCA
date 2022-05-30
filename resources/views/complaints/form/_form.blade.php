<link href ="/assets/css/app.css" rel = "stylesheet">

<div class="form-body">
    
    <!-- Validation Errors -->
    <x-auth-validation-errors class="m-4" :errors="$errors" />
<div class="row">

    <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>{{__('Type Complaint')}}</label>
              <select class="form-control  selectpicker @error('type') is-invalid @enderror" name="type"   data-selected-text-format="count" data-live-search="true">
                <option>{{__('Nothing selected')}}</option>
                @foreach ($types as $type)
                    <option value="{{ $type }}" @if ($type == old('type', $complaintsForm['type'])) selected @endif>{{ $type }}</option>
                @endforeach
                
              </select>
            </div>

            <div class="form-group">
                <label for="exampleInputName1">{{__('Course Number')}}</label>
                <input type="text" class="form-control @error('course_number') is-invalid @enderror" name="course_number" value="{{ old('course_number', $complaintsForm['course_number']) }}" id="exampleInputName1" placeholder="{{__('Enter Course Number')}}" >
            </div>
            <div class="form-group">
              <label for="exampleInputName1">{{__('Section')}}</label>
              <input type="text" class="form-control @error('section') is-invalid @enderror" name="section" value="{{ old('section', $complaintsForm['section']) }}" id="exampleInputName1" placeholder="{{__('Enter Section')}}" >
          </div>
            
            <div class="form-group">
              <label for="exampleInputName1">{{__('Course Name')}}</label>
              <input type="text" class="form-control @error('course_name') is-invalid @enderror" name="course_name" value="{{ old('course_name', $complaintsForm['course_name']) }}" id="exampleInputName1" placeholder="{{__('Enter Course Name')}}" >
            </div>

          </div>
          <div class="col-md-6">


            <div class="form-group">
              <label for="exampleInputName1">{{__('Teacher Name')}}</label>
              <input type="text" class="form-control @error('teacher_name') is-invalid @enderror" name="teacher_name" value="{{ old('teacher_name', $complaintsForm['teacher_name']) }}" id="exampleInputName1" placeholder="{{__('Enter Teacher Name')}}" >
            </div>
            <div class="form-group">
              <label for="exampleInputName1">{{__('Days')}}</label>
              <input type="text" class="form-control @error('days') is-invalid @enderror" name="days" value="{{ old('days', $complaintsForm['days']) }}" id="exampleInputName1" placeholder="{{__('Enter Days (day/day or day/day/day.. or day)')}}" >
            </div>

            <div class="form-group">
              <label for="exampleInputName1">{{__('Hour')}}</label>
              <input type="text" class="form-control @error('hour') is-invalid @enderror" name="hour" value="{{ old('hour', $complaintsForm['hour']) }}" id="exampleInputName1" placeholder="{{__('Enter hour like 12:00-01:30 ')}}" >
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
