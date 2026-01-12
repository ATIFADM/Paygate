<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Webhook;
use Stripe\Exception\SignatureVerificationException;
use App\Models\Invoice;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoicePaid;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');

        try {
            $event = Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            return response('', 400);
        } catch (SignatureVerificationException $e) {
            // Invalid signature
            return response('', 400);
        }

        // Handle the event
        if ($event->type == 'checkout.session.completed') {
            $session = $event->data->object;
            $invoice = Invoice::where('stripe_session_id', $session->id)->first();

            if ($invoice) {
                $invoice->update([
                    'status' => 'paid',
                    'stripe_payment_intent' => $session->payment_intent,
                    'paid_at' => now(),
                ]);

                Mail::to($invoice->client_email)
                    ->cc('s.atifrehman@yahoo.com')
                    ->send(new InvoicePaid($invoice));
            }
        }

        return response('', 200);
    }
}
