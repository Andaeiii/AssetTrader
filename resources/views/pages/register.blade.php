@extends('layouts.login')

@section('page_content')

<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Register Info</div>
				<div class="panel-body">

					{{ Form::open(['route'=>'register_user']) }}



						<fieldset>

								<div class="row">
									<div class="col-md-6">							

										<div class="form-group">
											<input class="form-control" placeholder="E-mail" name="email" type="email" autofocus="" readonly="">
										</div>

										<div class="form-group">
											<input class="form-control" placeholder="Password" name="password" type="password" value="">
										</div>
										
										<div class="form-group">
											<input class="form-control" placeholder="BVN Number" name="email" type="email" readonly="true">
										</div>

										<div class="form-group">
											<input class="form-control" placeholder="Date Of Birth" name="password" type="password" value="">
										</div>

										<button type="submit" class="btn btn-primary">Login</button>
										
									</div>


									<div class="col-md-6">

										<div class="form-group">
											<input class="form-control" placeholder="Firstname" name="email" type="email" autofocus="" readonly="">
										</div>

										<div class="form-group">
											<input class="form-control" placeholder="MiddleName" name="password" type="password" value="" >
										</div>
										
										<div class="form-group">
											<input class="form-control" placeholder="Lastname" name="email" type="email" autofocus="" readonly="">
										</div>

										<div class="form-group">
											<input class="form-control" placeholder="State Of Origin" name="state" type="password" value="">
										</div>


									</div>
								</div>


						</fieldset>


					</form>

					{{ Form::close() }}

				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	

@stop