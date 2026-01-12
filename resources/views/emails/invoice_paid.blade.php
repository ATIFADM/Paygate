<!DOCTYPE html>
<html>

<head>
    <title>Payment Received</title>
</head>

<body style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f0f9ff; padding: 40px 0;">
    <div
        style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 40px; border-radius: 16px; box-shadow: 0 4px 20px rgba(14, 165, 233, 0.1);">
        <!-- Logo Section -->
        <div style="text-align: center; margin-bottom: 30px;">
            @if(file_exists(public_path('images/logo.png')))
                <img src="{{ $message->embed(public_path('images/logo.png')) }}" alt="Binary Design Hub"
                    style="width: 150px; height: auto;">
            @else
                <div
                    style="background: linear-gradient(to right, #4f46e5, #0ea5e9); color: white; padding: 10px 20px; border-radius: 8px; font-weight: bold; font-size: 20px; display: inline-block;">
                    Binary DesignHub
                </div>
            @endif
        </div>
        <h1 style="color: #0f172a; margin-top: 0; font-size: 24px;">Payment Received!</h1>
        <p style="color: #475569; font-size: 16px; line-height: 1.6;">Hello {{ $invoice->client_name }},</p>
        <p style="color: #475569; font-size: 16px; line-height: 1.6;">We have received your payment for Invoice
            <strong>#{{ $invoice->invoice_number }}</strong>.
        </p>

        <div
            style="background-color: #f0fdf4; padding: 20px; border-radius: 12px; margin: 24px 0; border: 1px solid #bbf7d0;">
            <p style="margin: 0; color: #166534; text-align: center; font-weight: bold; font-size: 18px;">
                PAID: {{ $invoice->currency }} {{ number_format($invoice->amount, 2) }}
            </p>
        </div>

        <p style="color: #475569; font-size: 16px;">You can view or download your receipt at any time using the button
            below:</p>

        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td align="center">
                    <a href="{{ route('invoices.show', $invoice) }}"
                        style="background-color: #f1f5f9; color: #475569; padding: 12px 24px; text-decoration: none; border-radius: 8px; font-weight: bold; display: inline-block; border: 1px solid #e2e8f0;">
                        View Receipt
                    </a>
                </td>
            </tr>
        </table>

        <p style="color: #94a3b8; font-size: 14px; margin-top: 40px; text-align: center;">Thank you for your prompt
            payment.</p>
    </div>
</body>

</html>