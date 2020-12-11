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
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Phone</th>
                        <th>Sex</th>
                        <th>How Related</th>
                        <th>iSSCode</th>
                        <th>Date Created</th>
                        <th>Action</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php $i = 1; ?>
                      @foreach($relatives as $r)
                      <tr>
                        <td>{{$i}}
                        <td>{{$r->firstname}}</td>
                        <td>{{$r->lastname}}</td>
                        <td>{{$r->phone}}</td>
                        <td>{{$r->sex}}</td>
                        <td>{{$r->relationship->name}}</td>
                        <td>{{$r->iss_code}}</td>
                        <td>{{rdate($r->created_at, 'short')}}</td>
                        <td>
                                <a href="/user/{{$r->id}}/view">
                                  <img src="/imgs/download.png" align="absmiddle" title="View /Edit Details" width="15"/>
                                </a>&nbsp;
                                <a href="/user/{{$r->id}}/del">
                                  <img src="/imgs/delete.png" align="absmiddle" title="Delete Profile" width="15"/>
                                </a>&nbsp;
                                <a href="javascript:;">
                                  <img src="/imgs/green_ball.png" align="absmiddle" title="Current Church Admin..." width="15"/>
                                </a>
                        </td>
                      </tr>

                      <?php $i++; ?>
                      
                      @endforeach

                    </tbody>

                  </table>
        </div>

            </div>

	</div>

@stop