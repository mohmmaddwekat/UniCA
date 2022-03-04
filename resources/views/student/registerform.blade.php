


<div class="form-body">
    
    <!-- Validation Errors -->
    <x-auth-validation-errors class="m-4" :errors="$errors" />
<div class="row">

<form action = "{{ URL('/ResetPassword') }}" method="post">


  {{ csrf_field() }}

      <div class="card-body">
          <div class="row">
            <div class="col-md-6">

            </div>   
            <div class="form-group">
      <label for="id"><b>Student ID</b></label>
      <input type="text" placeholder="Enter Student ID" name="id" required>

  </div>
      
  </div>
      <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
      </div>
  </div>
</form>
</div>
