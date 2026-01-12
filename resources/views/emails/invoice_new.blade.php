<!DOCTYPE html>
<html>

<head>
    <title>New Invoice</title>
</head>

<body style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f0f9ff; padding: 40px 0;">
    <div
        style="max-w: 600px; margin: 0 auto; background-color: #ffffff; padding: 40px; border-radius: 16px; box-shadow: 0 4px 20px rgba(14, 165, 233, 0.1);">
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

        <h1 style="color: #0f172a; margin-top: 0; font-size: 24px;">Hello, {{ $invoice->client_name }}</h1>
        <p style="color: #475569; font-size: 16px; line-height: 1.6;">A new invoice has been generated for you.</p>

        <div style="background-color: #f1f5f9; padding: 20px; border-radius: 12px; margin: 24px 0;">
            <p style="margin: 8px 0; color: #334155;"><strong>Amount:</strong> <span
                    style="color: #0ea5e9; font-size: 18px; font-weight: bold;">{{ $invoice->currency }}
                    {{ number_format($invoice->amount + ($invoice->tax_amount ?? 0), 2) }}</span>
            </p>
            @if($invoice->tax_amount > 0)
                <p style="margin: 4px 0; color: #64748b; font-size: 14px;">(Subtotal:
                    {{ number_format($invoice->amount, 2) }} + Tax: {{ number_format($invoice->tax_amount, 2) }})
                </p>
            @endif
            <p style="margin: 8px 0; color: #334155;"><strong>Service:</strong> {{ $invoice->service_description }}</p>
        </div>

        <p style="color: #475569; margin-bottom: 24px;">Please pay by clicking the button below:</p>

        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td align="center">
                    <a href="{{ route('invoices.pay', $invoice) }}"
                        style="background: linear-gradient(to right, #2563eb, #06b6d4, #38bdf8); color: white; padding: 16px 32px; text-decoration: none; border-radius: 12px; font-weight: bold; font-size: 16px; display: inline-block; box-shadow: 0 10px 15px -3px rgba(14, 165, 233, 0.3);">
                        Pay Now &rarr;
                    </a>
                </td>
            </tr>
        </table>

        <p style="color: #94a3b8; font-size: 14px; margin-top: 40px; text-align: center;">Thank you for your business!
        </p>
    </div>
</body>

</html>