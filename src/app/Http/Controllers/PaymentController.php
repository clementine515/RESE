<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class PaymentController extends Controller
{
    public function handlePayment(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $menu = $request->input('menu');
        $price = 0;

        if ($menu === '松') {
            $price = 100 * 100;
        } elseif ($menu === '竹') {
            $price = 75 * 100;
        } elseif ($menu === '梅') {
            $price = 50 * 100;
        }

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => $menu . ' メニュー',
                    ],
                    'unit_amount' => $price,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('done'),
        ]);

        return redirect()->away($session->url);
    }
}