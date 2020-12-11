@extends('layouts.index')


@section('page_content')

        <div id="page-wrapper">


            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">{{$pg_title}}</h1>
                    <small class="help-block text-muted">your orders summary.....</small>
                </div>
                  
                <!-- /.col-lg-12 -->
            </div>


            <div class="row">
                <div class="col-lg-12">
                </div>
                <!-- /.col-lg-12 -->

            </div>

            <br/>


            <div class="row">
                <div class="col-md-4">

                    <?php
                        $tinfo = $order->amount . ', on <b>' . $order->created_at . '</b>';
                        $ath = unserialize($order->transaction->authorization_info);
                    ?>


                    <div class="form-group">
                        <label>Profile Email Address</label><br/>
                        <span>{{$order->emailaddr}}</span>
                    </div>
                    <div class="form-group">
                        <label>Amount Paid, Date </label><br/>
                        <span>{!! addNaira(intval($order->amount)) !!}</span>
                    </div>
                    <div class="form-group">
                        <label>Date of Subscription</label><br/>
                        <span>{{rdate($order->created_at, 'medium')}} </span>
                    </div>
                    <div class="form-group">
                        <label>Status</label><br/>
                        <span>{{$order->status}}</span>
                    </div>
               

                     <form id="xptrform" method="post" action="/pay/proceed">
                        {{Form::token()}}

                      <input type="hidden" name="email" value="{{$order->user->email}}">
                      <input type="hidden" name="reference" value="{{$order->transaction->trans_ref}}"/> 
                      <input type="hidden" name="key" value="{{config('paystack.secretKey')}}">
                      <input id="ps_amount" type="hidden" name="amount" value="{{intval($order->amount) * 100}}">
                      <input id="xpmdata" type="hidden" name="metadata" value="{{$metadt}}">  <!-- fix value for paystack..--->
                     
                      <br/>
                      <br/>

                      <div class="btn-group" role="group" aria-label="Basic example">
                         <button class="btn btn-success" type="submit"> CheckOut </button>
                        <a class="btn btn-danger" href="/payment/{{$order->transaction->trans_ref}}/del"> Cancel Order </a>
                      </div>


                  </form>


                </div>
            </div>

        </div>
        <!-- /#page-wrapper -->


        @stop