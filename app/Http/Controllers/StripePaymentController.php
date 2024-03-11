<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Models\FootballClub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class StripePaymentController extends Controller
{
    // public function stripe()
    // {
    //     return view('partials.payment.stripe');
    // }

    // public function stripeCheckout(Request $request)
    // {
    //     $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
    //     // dd($stripe);
    //     $redirectUrl = route('stripe.checkout.success').'?session_id={CHECKOUT_SESSION_ID}';
    //     // dd($redirectUrl);

    //     $response = $stripe->checkout->sessions->create([
    //        'success_url' => $redirectUrl,
    //        'customer_email' => Auth::user()->email,
    //     //    'payment_method_types' => ['card'],
    //        'line_items' =>[
    //             [
    //                 'price_data' =>[
    //                     'product_data' => [
    //                         'name' => $request->product,
    //                     ],
    //                     'unit_amount' => 100* $request->price,
    //                     'currency' => 'USD',
    //                 ],
    //                 'quantity' => 1
    //             ],
    //         ],
    //         'mode' =>'payment',
    //         'allow_promotion_codes' =>false,
    //     ]);
        
    //     return redirect($response['url']);
    // }

    // public function stripeCheckoutSuccess(Request $request)
    // {
    //     $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
    //     $response = $stripe->checkout->sessions->retrieve($request->session_id);
    //     $club =  FootballClub::where('user_id',Auth::user()->id)->first();
    //     // dd($club);
    //     $club->update(['payment' => 'paid']);
    //     return redirect()->route('stripe')->with('message','Payment successfull');
    // }

    public function getStripe(Request $request)
    {
        return view('partials.payment.subscription');
    }


    public function postStripe(Request $request)
    {
        // dd($request->all());
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $price_id = $request->priceID;
 
        $success_url =  route('stripe.success');
        $cancel_url = route('stripe.cancel');
        $checkout_session = \Stripe\Checkout\Session::create([
            'line_items' => [[
              # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
            //   'price' => 'price_1Ot3XoSFl6BX5NQnwrpWkrY6',
              'price' => $price_id,
              'quantity' => 1,
            ]],
            'mode' => 'subscription',
            'success_url' => $success_url,
            'cancel_url' => $cancel_url,
          ]);
          return Redirect::to($checkout_session->url);
    }

    public function successTransaction()
    {
        $club =  FootballClub::where('user_id',Auth::user()->id)->first();
        // dd($club);
        $club->update(['payment' => 'paid']);
        return view('partials.payment.success_page');
    }

    public function cancelTransaction()
    {
        $club =  FootballClub::where('user_id',Auth::user()->id)->first();
        if($club->payment == 'paid'){
            $club->update(['payment' => 'not_paid']);   
        }
        return view('partials.payment.cancel_page');
    }
}
