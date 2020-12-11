@extends('layouts.login')

@section('page_content')

<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Log in</div>
				<div class="panel-body">




						<fieldset>
							<div class="form-group">
								<label>Enter BVN Number</label>
							</div>
					
							<button type="submit" class="btn btn-primary" onclick="processBVN()">Process BVN</button>
							
						</fieldset>



				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	

@stop