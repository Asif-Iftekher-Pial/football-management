<?php

namespace App\Http\Controllers;

use App\Models\FootballClub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StripePaymentController extends Controller
{
    public function stripe()
    {
        return view('partials.payment.stripe');
    }

    public function stripeCheckout(Request $request)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        // dd($stripe);
        $redirectUrl = route('stripe.checkout.success').'?session_id={CHECKOUT_SESSION_ID}';
        // dd($redirectUrl);

        $response = $stripe->checkout->sessions->create([
           'success_url' => $redirectUrl,
           'customer_email' => Auth::user()->email,
        //    'payment_method_types' => ['card'],
           'line_items' =>[
                [
                    'price_data' =>[
                        'product_data' => [
                            'name' => $request->product,
                        ],
                        'unit_amount' => 100* $request->price,
                        'currency' => 'USD',
                    ],
                    'quantity' => 1
                ],
            ],
            'mode' =>'payment',
            'allow_promotion_codes' =>false,
        ]);
        
        return redirect($response['url']);
    }

    public function stripeCheckoutSuccess(Request $request)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $response = $stripe->checkout->sessions->retrieve($request->session_id);
        $club =  FootballClub::where('user_id',Auth::user()->id)->first();
        // dd($club);
        $club->update(['payment' => 'paid']);
        return redirect()->route('stripe')->with('message','Payment successfull');
    }
}
