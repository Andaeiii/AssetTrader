<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Paystack;
use App\Transaction;

use Carbon\Carbon;

use DB;

class PayController extends Controller{
    
/**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */

public function addPayment(){
    return view('pages.pay');
}

public function processPay(Request $request){
    return redirect()->to('/dashboard');
}

    public function redirectToGateway(){
       return Paystack::getAuthorizationUrl()->redirectNow();
    }



    public function handleGatewayCallback(){

        $pd = Paystack::getPaymentData();        
        $data = $pd['data'];
        $orderid = $data['metadata']['order_id'];

        DB::beginTransaction();

     	try{
        	$t = Transaction::where('trans_ref', $data['reference'])->first();
        	$t->gateway_res = $data['gateway_response'];
        	$t->paid_at = $data['paid_at'];
        	$t->channel = $data['channel'];
        	$t->ip_address = $data['ip_address'];
        	$t->message = $pd['message'];
        	$t->status = $data['status'];
        	$t->logs = serialize($data['log']);
        	$t->authorization_info = serialize($data['authorization']);
        	$t->save();

        	$o = Order::find(intval($orderid));
        	$o->status = 'Completed';
        	$o->save();

        	DB::commit();

        }catch(Exception $e){
        	//error in acton..
        	DB::rollback();
        	$o = Order::find(intval($orderid));
        	$o->status = 'failed';
        	$o->save();
        }

        return redirect()->to('/order/'. $orderid .'/info');

    }

   
    public function doStep1(Request $request){
    	// pr($request->all(), true);

    	 DB::transaction(function()use($request){
 
	    	//save the transaction table... 
			$t = new Transaction;
			$t->status = 'started';
	    	$t->trans_ref = $request->input('trans_ref');
			$t->save();

			//save the payment table... 
	    	$o = new Payment;
            $o->plan_id = $request->input('pid');                   
	    	$o->auth_code = $request->input('authcode');
	    	$o->church_id = intval($request->input('cid'));
	    	$o->begin_date = intval($sub_id);
			$o->end_date = $this->getSubscriptionEndDate($b_date, $sub_id);
	    	$o->amount = $amount;
			$o->status = 'started';             
			$o->save();

		});

    	return redirect()->to('/payment/to/'.$this->arr['payment_id']);
	
    }





    public function getPayDetails($uid){

		$dt = Carbon::now()->toDateString();
		$active = Order::with(['plan','transaction'])
						->where('user_id', $uid)
						->whereDate('end_date', '<', $dt)		
						->first();
    	//pr($active, true);
    	return view('pages.paymentinfo')
    			->with('pg_title', 'Order Info.')
    			->with('order', $active);
    }

    public function orderinfo($id){
    	$now = Carbon::now();
    	$order = Order::with('transaction')->find($id);

    	return view('pages.orderinfo')
    			->with('pg_title', 'Order Info.')
    			->with('order', $order);
    }



}
