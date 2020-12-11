@extends('layouts.inner')


@section('page_content')
	
	<div class="inner_pg" style="min-height: 430px;">

			<!-- /.row -->
                
                
            	{{Form::open(['route'=>'add_beneficiary', 'files'=>true])}}



            <div class="row">

               <div class="col-md-3">

                  <div class="form-group">
                      <label>Enter Firstname</label>
                      <input name="r_fname" class="form-control" required="true">
                      <small class="help-block text-muted">enter fullname of asset here.</small>
                  </div>

                  <div class="form-group">
                      <label>Date of Birth</label>
                      <input type="date" name="r_dob" class="form-control" required="true">
                      <small class="help-block text-muted">enter fullname of asset here.</small>
                  </div>

                  <div class="form-group">
                      <label>Select Sex</label>
                      <select name="r_sex" class="form-control">
                          <option>.................</option>
                          <option value="male">Male</option>
                          <option value="female">Female</option>
                      </select>
                      <small class="help-block text-muted">enter fullname of asset here.</small>
                  </div>
               
               </div>



               <div class="col-md-3">

      					<div class="form-group">
      					    <label>/Enter Middlename</label>
      					    <input name="r_mname" class="form-control" required="true">
      					    <small class="help-block text-muted">enter fullname of asset here.</small>
      					</div>

                <div class="form-group">
                    <label>Select Relatives Status</label>
                   
				           	<div id="seloptn">
                        <select name="r_rship" class="form-control" required="true" onchange="setFileOption(this);">
                            <option>--------</option>
                            @foreach($relationships as $rs)
                            <option value="{{$rs->id}}" data-file="{{$rs->name}}">{{$rs->name}}</option>
                            @endforeach
                        </select>
                    </div>


                    <small class="help-block text-muted">station managers phone number</small>
                </div>

                <div class="form-group">
                    <label>Enter Phone Number</label>
                    <input name="r_phone" class="form-control" required="true">
                    <small class="help-block text-muted">enter mobile phone number here.</small>
                </div>


                  
               </div>




               <div class="col-md-3">

                  <div class="form-group">
        					    <label>Enter LastName</label>
        					    <input name="r_lname" class="form-control" required="true">
        					    <small class="help-block text-muted">enter fullname of asset here.</small>
        					</div>


                  <div class="form-group">
                    <label id="file_lb">Upload Photo of Person</label>
                    <input type="file" name="r_uplfile" class="form-control" placeholder="Street name"/>
                      <small class="help-block text-muted">enter fullname of asset here.</small>
                  </div>

                <div class="form-group">
                    <label>Enter BVN Number</label>
                    <input name="r_bvn" class="form-control" required="true">
                    <small class="help-block text-muted">enter fullname of asset here.</small>
                </div>


               </div>



            </div>

            <div class="row">
              <div class="col-md-3 isscode">
                <input name="r_issc" class="form-control" type="hidden" value="{{$iss_code}}">
                <small><b>SecureMe Relatives' Code</b> :: {{$iss_code}}</small>
              </div>
              <div class="col-md-3 col-md-offset-3" align="right">
                <button type="submit" class="btn btn-info">Submit Button</button>
              </div>
            </div>



               {{ Form::close() }}

	</div>

@stop