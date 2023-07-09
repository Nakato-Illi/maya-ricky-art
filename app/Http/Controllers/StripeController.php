<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use Stripe;


class StripeController extends Controller
{
    public function call(Request $request) {
        try {
        \Stripe\Stripe::setApiKey('sk_test_51NRt9BJO5czArRdjtQ1bqVVlbF6WZ6JO4rydTkMjVC9cvgWFyyyqIvsqQnQmTg9hPAnkI83XhimoKe5wRqpSm1Ec008TmZ43L4');

        $customer =
            \Stripe\Customer::
            create(
                array(
            'name' => 'test',
            'description' => 'test description',
            'email' => 'email@gmail.com',
            'source' => $request->input('stripeToken'),
            "address" => ["city" => "San Francisco", "country" => "US", "line1" => "510 Townsend St", "postal_code" => "98140", "state" => "CA"]

        ));

            \Stripe\Charge::create ( array (
                "amount" => 300 * 100,
                "currency" => "usd",
                "customer" =>  $customer["id"],
                "description" => "Test payment."
            ) );
            Session::flash ( 'success-message', 'Payment done successfully !' );
            $title = 'Payment successful';
            return view ( 'resultpages.success' )->with('title', $title );
        } catch ( \Stripe\Error\Card $e ) {
            Session::flash ( 'fail-message', $e->get_message() );
            $title = 'Payment faild';
            return view ( 'resultpages.fail' )->with('title', $title );
        }
//        catch ( \Exception $e ) {
//            $title = 'Payment faild';
//            return view ( 'resultpages.fail' )->with('title', $title );
//        }
    }


//    public function stripe() {
//        return view('stripe');
//    }
//
//    public function stripePost(Request $request) {
//        Stripe\Stripe::setApiKey(env('STRIPE_SECRWT'));
//        Stripe\Charge::create([
//            "amount" => $request->price,
//            "currency" => "usd",
//            "source" => $request->stripeToken,
//            "description" => "This payment is for testing"
//        ]);
//        Session::flash('success', 'Payment successful!');
//        return back();
//    }
}
