@extends('layouts.inner')


@section('page_content')
	
	<div class="inner_pg" style="min-height: 430px;">

			<!-- /.row -->
            <div class="row">
                
                
            	{{Form::open(['route'=>'add_asset', 'files'=>true])}}

               <div class="col-md-4">
               
               </div>

               <div class="col-md-3">

					<div class="form-group">
					    <label>Name Of Asset</label>
					    <input name="as_name" class="form-control" required="true">
					    <small class="help-block text-muted">enter fullname of asset here.</small>
					</div>

                    <div class="form-group">
                        <label>Type Of Asset</label>
                       
  						<div id="seloptn">
                            <select name="as_type" class="form-control" required="true" onchange="setFileOption(this);">
                                <option>--------</option>
                                @foreach($assetypes as $at)
                                <option value="{{$at->id}}" data-file="{{$at->filetype}}">{{$at->name}} Assets</option>
                                @endforeach
                            </select>
                        </div>


                        <small class="help-block text-muted">station managers phone number</small>
                    </div>

					<div class="form-group">
					    <label>Description</label>
					    <textarea name="as_description" class="form-control" required="true"></textarea>
					    <small class="help-block text-muted">enter branch name here.</small>
					</div>


                    <br/>

                    <button type="submit" class="btn btn-info">Submit Button</button>
                  
               </div>




               <div class="col-md-3">

                  <input id="as_img" type="hidden" name="as_is_img" value="docs"/>

                  <div class="form-group">
        					    <label>Valued At</label>
        					    <input name="as_value" class="form-control" required="true">
        					    <small class="help-block text-muted">enter fullname of asset here.</small>
        					</div>


                  <div class="form-group">
                    <label id="file_lb">Associated Documents</label>
                    <input type="file" name="as_file" class="form-control" placeholder="Street name"/>
                  </div>

                  
        					<div class="form-group">
        					    <label>Other Details</label>
        					    <textarea name="as_details" class="form-control" required="true"></textarea>
        					    <small class="help-block text-muted">enter branch name here.</small>
        					</div>




               </div>





               {{ Form::close() }}

            </div>

	</div>

@stop