<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    public function index(){
        return view('ckeckout.index');
    }
    public function stripe(){
        return view('checkout.stripe');
    }
    public function pay(Request $request){
        Stripe::setApiKey("sk_test_ETfx23YkzBcn4vpFaOr9t0IQ00lWxtRstb");
        Charge::create ([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com."
        ]);
        Session::flash('success', 'Payment successful!');

        return redirect(route('orders.create'));
    }
}
