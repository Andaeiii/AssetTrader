@extends('layouts.login')

@section('page_content')

<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Pay </div>
				<div class="panel-body">

					{{ Form::open(['route'=>'process_pay']) }}



						<fieldset>

								<div class="row">
									<div class="col-md-6">							

										<div class="form-group">
											<input class="form-control" placeholder="N350">
										</div>

									</div>
								</div>


							<button type="submit" class="btn btn-primary">Confirm payment</button>

						</fieldset>


					</form>

					{{ Form::close() }}

				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	

@stop