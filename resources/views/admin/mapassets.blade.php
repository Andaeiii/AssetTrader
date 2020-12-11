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
                        <th>Asset Type</th>
                        <th>Valued At</th>
                        <th>Mapped To</th>
                        <th>Date Created</th>
                        <th>Action</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php $i = 1; ?>

                      {{--pr($user_objs, true)--}}

                      @foreach($objs as $a)


                      <tr>
                        <td>{{$i}}</td>
                        <td>{{$a->assetitem}}</td>
                        <td><b>{{$a->assetype}} Asset</b></td>
                        <td>{{$a->value}}</td>
                        @if(intval($a->amapid) > 0)
                        <td> mapped</td>
                        @else
                        <td>------ not yet  ------</td>
                        @endif
                        <td>{{ rdate($a->cdate, 'medium') }}</td>
                        <td>
                            @if(intval($a->amapid) > 0)
                               <a href="/mapping/{{$a->amapid}}/del" title="remove mapping...">
                                <i class="fa fa-map" style="color:#FF0000 !important;"></i></a>
                                &nbsp;
                                <a href="javascript:;" onclick="viewMapInfo({{$a->amapid}})" title="view mapping info...">
                                  <img src="/imgs/download.png" width="15">
                                </a>
                            @else
                               <a href="javascript:;" onclick="mapAssetsTo({{$a->id}});" title="map item...">
                                <i class="fa fa-map"></i></a>
                            @endif
                          <span class="assldr" id="assldr_{{$a->id}}"><img src="/ajax/ajax4.gif" align="absmiddle"/></span>
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