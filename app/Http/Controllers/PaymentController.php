<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Subscription;

class PaymentController extends Controller
{
    public function showSubscriptionOptions()
    {
        return view('user.choose_subscription');
    }

    public function checkout(Request $request)
    {
        $plan = $request->input('plan');
        $priceIds = [
            'silver' => 'price_1PxSNNBmpFO0L6kSFdyinjIx', 
            'gold' => 'price_1PxSenBmpFO0L6kSNkzhR6xP',   
            'platinum' => 'price_1PxSNhBmpFO0L6kSvEfykSFE' 
        ];
    
        $priceId = $priceIds[$plan] ?? $priceIds['silver'];
    
        Stripe::setApiKey(env('STRIPE_SECRET'));
    
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price' => $priceId,
                'quantity' => 1,
            ]],

            'mode' => 'subscription',
            'success_url' => route('subscription.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('subscription.cancel'),
        ]);
    
        return redirect($session->url);
    }
    

    public function success(Request $request)
    {
        $sessionId = $request->get('session_id');
        Stripe::setApiKey(env('STRIPE_SECRET'));
    
        // Retrieve the session
        $session = \Stripe\Checkout\Session::retrieve($sessionId);
    
        // Retrieve the subscription details using the subscription ID
        $subscriptionId = $session->subscription;
        $subscription = \Stripe\Subscription::retrieve($subscriptionId);
    
        if ($subscription->status === 'active') {
            $user = Auth::user();
            $planId = $subscription->items->data[0]->price->id; // Get the price ID
            $planName = $this->getPlanNameByPriceId($planId); // Map price ID to plan name
            $planLevel = $this->getPlanLevelByPriceId($planId); // Get plan level based on price ID
    
            // Create or update subscription record
            $subscriptionRecord = new Subscription([
                'user_id' => $user->id,
                'plan_name' => $planName,
                'price' => $subscription->items->data[0]->price->unit_amount / 100, // Convert to dollars
                'level' => $planLevel, 
                'started_at' => now(),
                'ended_at' => null,
            ]);
    
            $subscriptionRecord->save();
    
            return view('subscription.success');
        }
    
        return redirect()->route('subscription.choose')->with('error', 'Payment was not successful. Please try again.');
    }
    

    public function cancel()
    {
        return view('subscription.cancel');
    }

    private function getPlanNameByPriceId($priceId)
    {
        $priceMap = [
            'price_1PxSNNBmpFO0L6kSFdyinjIx' => 'silver',
            'price_1PxSenBmpFO0L6kSNkzhR6xP' => 'gold',
            'price_1PxSNhBmpFO0L6kSvEfykSFE' => 'platinum',
        ];
    
        return $priceMap[$priceId] ?? 1;
    }

    private function getPlanLevelByPriceId($priceId)
    {
        $levelMap = [
            'price_1PxSNNBmpFO0L6kSFdyinjIx' => 1, // silver
            'price_1PxSenBmpFO0L6kSNkzhR6xP' => 2, // gold
            'price_1PxSNhBmpFO0L6kSvEfykSFE' => 3, // platinum
        ];
    
        return $levelMap[$priceId] ?? 1; // Default to 1 (silver level) if not found
    }
}