@extends('layouts.inner')


@section('page_content')
	
	<div class="inner_pg" style="min-height: 430px;">

			<!-- /.row -->
            <div class="row">
                
               <div class="col-md-12">


                  <table id="datatable" class="table-responsive">
                    <thead>
                      <tr>
                        <th>id</th>
                        <th>Item name</th>
                        <th>Type</th>
                        <th>Valued At</th>
                        <th>isDeclared</th>
                        <th>Date Created</th>
                        <th>Action</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php $i = 1; ?>
                      @foreach($assets as $a)
                      <tr>
                        <td>{{$i}}</td>
                        <td>{{$a->itemname}}</td>
                        <td>{{$a->asseType->name}}</td>
                        <td>{{$a->valued_at}}</td>
                        <td>{{($a->is_declared) ? 'Officially' : 'Not Yet'}}</td>
                        <td>{{$a->created_at}}</td>
                        <td><a href="/service/{{$a->id}}/logs">view</a></td>
                      </tr>

                      <?php $i++; ?>
                      
                      @endforeach

                    </tbody>

                  </table>
        </div>

            </div>

	</div>

@stop