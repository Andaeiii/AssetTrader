@extends('layouts.index')


@section('page_contents)

        <div id="page-wrapper">


            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">{{$pg_title}}</h1>
                    <small class="help-block text-muted">save or print out subscription information...</small>
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
                        <label>User Authentication Code / Email :: </label><br/>
                        <span>{{$order->user->profile->fullname}} / {{$order->emailaddr}}</span>
                    </div>
                    <div class="form-group">
                        <label>Amount Paid, Date :: </label><br/>
                        <span>{!! addNaira(intval($order->amount)) !!}</span>
                    </div>
                    <div class="form-group">
                        <label>Date of Subscription</label><br/>
                        <span>({{$order->created_at}} months</span>
                    </div>
                    <div class="form-group">
                        <label>Status :: </label><br/>
                        <span>{{$order->status}}, {{$order->transaction->status}}</span>
                    </div>
               

                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a style="text-align:left;" class="btn btn-success" href="/">Print Information </a>
                    </div>


                  </form>


                </div>
            </div>

        </div>
        <!-- /#page-wrapper -->


        @stop