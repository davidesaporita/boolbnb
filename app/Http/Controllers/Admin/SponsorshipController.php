<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Apartment;
use App\SponsorPlan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Braintree;

class SponsorshipController extends Controller
{
    /**
     * Show sponsorship page.
     *
     * @return \Illuminate\Http\Response
     */
    public function pay(Apartment $apartment) 
    {

        $gateway = new Braintree\Gateway(config('braintree'));
        $client_token = $gateway->ClientToken()->generate(); 

        return view('admin.apartments.sponsorship.pay', compact('apartment', 'gateway', 'client_token'));
    }
    
    /**
     * Show sponsorship page.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkout(Request $request, Apartment $apartment) 
    {
        $data = $request->all();

        $gateway = new Braintree\Gateway(config('braintree'));
    
        $amount = $data["amount"];
        $nonce  = $data["payment_method_nonce"];
        $sponsorPlan_id = $data['sponsor_plan'];

        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);
    
        if ($result->success || !is_null($result->transaction)) {

            $transaction = $result->transaction;
            
            $start = Carbon::now();
            $sponsorPlan = SponsorPlan::find($sponsorPlan_id);
            $deadline = $start->copy()->addHours($sponsorPlan->hours);

            $fields = [
                'transaction_id' => $transaction->id,
                'amount' => $transaction->amount,
                'start' => $start,
                'deadline' => $deadline
            ];

            $apartment->sponsor_plans()->attach($sponsorPlan_id, $fields);

            // return redirect()->route('admin.apartments.sponsorship.transaction', ['transaction_id' => $transaction->id, 'apartment' => $apartment]);
            return redirect()->route('admin.apartments.show', ['transaction_id' => $transaction->id, 'apartment' => $apartment]);

        } else {
            $errorString = "";
    
            foreach($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }
        
            $_SESSION["errors"] = $errorString;
            return redirect()->route('admin.apartments.sponsorship.pay', ['apartment' => $apartment]);
        }
    }

    /**
     * Show transaction complete page. Temporarly out.
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function transaction($transaction_id, $apartment) 
    {   
        //return view('admin.apartments.sponsorship.success', compact('transaction_id', 'apartment'));
    }
}
