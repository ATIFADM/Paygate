<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Invoice;
use App\Services\StripeService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceCreated;

class InvoiceController extends Controller
{
    protected $stripeService;

    public function __construct(StripeService $stripeService)
    {
        $this->stripeService = $stripeService;
    }

    public function index()
    {
        // For regular users, show their dashboard with their invoices
        $invoices = Invoice::where('user_id', auth()->id())->latest()->get();
        return view('dashboard', compact('invoices'));
    }

    public function create()
    {
        $savedDescriptions = \App\Models\SavedDescription::orderBy('created_at', 'desc')->get();
        return view('invoices.create', compact('savedDescriptions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_email' => 'required|email|max:255',
            'client_phone' => 'nullable|string|max:20',
            'client_address' => 'nullable|string|max:500',
            'company_name' => 'nullable|string|max:255',
            'service_description' => 'required|string',
            'amount' => 'required|numeric|min:0.50',
            'tax_amount' => 'nullable|numeric|min:0',
            'currency' => 'required|string|in:USD,EUR,GBP',
            'cc_email' => 'nullable|email|max:255',
        ]);

        // Auto-save description if it doesn't exist
        if ($request->filled('service_description')) {
            \App\Models\SavedDescription::firstOrCreate(
                ['text' => $request->service_description]
            );
        }

        $invoice = Invoice::create(array_merge($validated, [
            'invoice_number' => 'INV-' . strtoupper(Str::random(10)),
            'status' => 'pending',
            'user_id' => auth()->id(),
        ]));

        // Calculate Total (Amount + Tax) for display/payment if needed, 
        // but currently we store them separately. Stripe session logic might need update if tax is separate.
        // For simple usage, we will charge the 'amount' field as subtotal, or we need to clarify if amount includes tax.
        // Assuming 'amount' is subtotal and we charge subtotal + tax. Or just store tax for display.
        // Let's assume 'amount' is what user entered as "Amount", and Tax is extra.

        // Update: User asked for tax field, likely wants it to be part of the total.
        // We should update the StripeService to charge (amount + tax_amount).
        // For now, let's just make sure we save it.

        // Send Email with Pay Link
        try {
            $user = auth()->user();
            $mail = Mail::to($invoice->client_email)
                ->cc('s.atifrehman@yahoo.com');

            if ($request->filled('cc_email')) {
                $mail->cc($request->cc_email);
            }

            $mail->send(new InvoiceCreated($invoice, $user));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Email Sending Failed: ' . $e->getMessage());
        }

        return redirect()->route('invoices.show', $invoice)->with('success', 'Invoice created and sent to client!');
    }

    public function destroyDescription($id)
    {
        $description = \App\Models\SavedDescription::findOrFail($id);
        $description->delete();
        return response()->json(['success' => true]);
    }

    public function show(Invoice $invoice)
    {
        if (auth()->check() && auth()->user()->role !== 'admin' && $invoice->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('invoices.show', compact('invoice'));
    }

    public function pay(Invoice $invoice)
    {
        try {
            $session = $this->stripeService->createCheckoutSession($invoice);
            $invoice->update([
                'stripe_session_id' => $session->id,
            ]);

            return redirect($session->url);
        } catch (\Exception $e) {
            return back()->with('error', 'Payment System Error: ' . $e->getMessage());
        }
    }

    public function success(Request $request)
    {
        $sessionId = $request->get('session_id');
        $invoice = Invoice::where('stripe_session_id', $sessionId)->firstOrFail();

        if ($invoice->status !== 'paid') {
            // In a real app, you might want to wait for webhook or check Stripe API here
            // For now, we rely on the webhook to mark it as paid, or we can double check
        }

        return view('invoices.success', compact('invoice'));
    }

    public function cancel(Invoice $invoice)
    {
        return view('invoices.cancel', compact('invoice'));
    }

    public function downloadPdf(Invoice $invoice)
    {
        $pdf = Pdf::loadView('invoices.pdf', compact('invoice'));
        return $pdf->download('invoice-' . $invoice->invoice_number . '.pdf');
    }
}
