<?php

namespace App\Services;

use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Invoice;

class StripeService
{
    public function __construct()
    {
        // Constructor left empty to allow instantiation without keys
    }

    private function setStripeKey()
    {
        $apiKey = config('services.stripe.secret');
        if (!$apiKey) {
            throw new \Exception("Stripe API Key is missing. Please set STRIPE_SECRET in your .env file.");
        }
        Stripe::setApiKey($apiKey);
    }

    public function createCheckoutSession(Invoice $invoice)
    {
        $this->setStripeKey();
        return Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => strtolower($invoice->currency),
                        'unit_amount' => (int) (($invoice->amount + ($invoice->tax_amount ?? 0)) * 100), // Stripe expects cents
                        'product_data' => [
                            'name' => 'Invoice #' . $invoice->invoice_number,
                            'description' => $invoice->service_description,
                        ],
                    ],
                    'quantity' => 1,
                ]
            ],
            'mode' => 'payment',
            'success_url' => route('payment.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('payment.cancel', ['invoice' => $invoice->id]),
            'metadata' => [
                'invoice_id' => $invoice->id,
                'invoice_number' => $invoice->invoice_number,
            ],
        ]);
    }
}
