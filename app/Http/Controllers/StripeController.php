<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class StripeController extends Controller
{
    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Your cart is empty!');
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        $lineItems = [];
        foreach ($cart as $id => $details) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $details['name'],
                        'description' => $details['subtitle'] ?? 'Premium Pet Product',
                    ],
                    'unit_amount' => $details['price'] * 100, // Stripe expects amounts in cents
                ],
                'quantity' => $details['quantity'],
            ];
        }

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('stripe.success'),
            'cancel_url' => route('stripe.cancel'),
        ]);

        return redirect()->away($session->url);
    }

    public function subscribe(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        // Store pending subscription info to create record on success
        session()->put('pending_subscription', [
            'name' => $request->name,
            'price' => $request->price,
        ]);

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $request->name,
                        'description' => $request->subtitle ?? 'Pawtique Subscription Plan',
                    ],
                    'unit_amount' => $request->price * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('stripe.success'),
            'cancel_url' => route('stripe.cancel'),
        ]);

        return redirect()->away($session->url);
    }

    public function success()
    {
        $user = auth()->user();

        // 1. Create subscription record if one was pending (Direct Checkout)
        if (session()->has('pending_subscription') && $user) {
            $plan = session()->get('pending_subscription');
            \App\Models\PetClubSubscription::create([
                'user_id' => $user->id,
                'plan_name' => $plan['name'],
                'price' => $plan['price'],
                'email' => $user->email,
                'status' => 'active'
            ]);
            session()->forget('pending_subscription');
        }

        // 2. Also check the cart for any subscription items (IDs starting with 's')
        $cart = session()->get('cart', []);
        
        $orderItems = [];
        $totalQuantity = 0;
        $totalPrice = 0;

        foreach ($cart as $id => $item) {
            if (strpos($id, 's') === 0 && $user) {
                \App\Models\PetClubSubscription::create([
                    'user_id' => $user->id,
                    'plan_name' => $item['name'],
                    'price' => $item['price'],
                    'email' => $user->email,
                    'status' => 'active'
                ]);
            } elseif (strpos($id, 's') !== 0) {
                $orderItems[] = [
                    'id' => $id,
                    'name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                ];
                $totalQuantity += $item['quantity'];
                $totalPrice += $item['price'] * $item['quantity'];
            }
        }

        if (count($orderItems) > 0) {
            \App\Models\Order::create([
                'user_id' => $user ? $user->id : null,
                'items' => $orderItems,
                'total_quantity' => $totalQuantity,
                'total_price' => $totalPrice,
            ]);
        }

        session()->forget('cart');
        return view('stripe.success');
    }

    public function cancel()
    {
        return view('stripe.cancel');
    }
}
