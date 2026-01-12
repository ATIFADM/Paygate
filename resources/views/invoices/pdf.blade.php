<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Invoice {{ $invoice->invoice_number }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            font-size: 14px;
            line-height: 1.5;
            color: #333;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
        }

        .title {
            font-size: 32px;
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }

        table td {
            padding: 5px;
            vertical-align: top;
        }

        table tr td:nth-child(2) {
            text-align: right;
        }

        .heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .item td {
            border-bottom: 1px solid #eee;
        }

        .item.last td {
            border-bottom: none;
        }

        .total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        .status-paid {
            color: green;
            font-weight: bold;
            border: 2px solid green;
            padding: 5px 10px;
            border-radius: 4px;
            display: inline-block;
        }

        .status-pending {
            color: #f59e0b;
            font-weight: bold;
            border: 2px solid #f59e0b;
            padding: 5px 10px;
            display: inline-block;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table>
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                <div class="title">INVOICE</div>
                                <strong>Invoice #:</strong> {{ $invoice->invoice_number }}<br>
                                <strong>Date:</strong> {{ $invoice->created_at->format('M d, Y') }}<br>
                            </td>
                            <td>
                                <!-- Binary Design Hub Logo (GD Safe) -->
                                <div style="margin-bottom: 10px;">
                                    @if(extension_loaded('gd'))
                                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/logo.png'))) }}"
                                            style="width: 150px; height: auto;" alt="Binary Design Hub Logo">
                                    @else
                                        <div
                                            style="background: linear-gradient(to right, #4f46e5, #0ea5e9); color: white; padding: 10px 20px; border-radius: 8px; font-weight: bold; font-size: 20px; display: inline-block;">
                                            Binary DesignHub
                                        </div>
                                    @endif
                                </div>
                                Binary DesignHub<br>
                                3663 N Sam Houston Pkwy E,<br>
                                Houston, TX 77032, United States<br>
                                Email: info@binarydesignhub.com
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                <strong>Bill To:</strong><br>
                                {{ $invoice->client_name }}<br>
                                @if($invoice->company_name)
                                    {{ $invoice->company_name }}<br>
                                @endif
                                {{ $invoice->client_email }}<br>
                                @if($invoice->client_phone)
                                    {{ $invoice->client_phone }}<br>
                                @endif
                                @if($invoice->client_address)
                                    {!! nl2br(e($invoice->client_address)) !!}
                                @endif
                            </td>
                            <td style="text-align: right;">
                                <strong>Status:</strong><br>
                                @if($invoice->status === 'paid')
                                    <span class="status-paid">PAID</span>
                                @else
                                    <span class="status-pending">{{ strtoupper($invoice->status) }}</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>Item Description</td>
                <td>Price</td>
            </tr>

            <tr class="item last">
                <td>{{ $invoice->service_description }}</td>
                <td>{{ $invoice->currency }} {{ number_format($invoice->amount, 2) }}</td>
            </tr>

            @if($invoice->tax_amount > 0)
                <tr class="item">
                    <td>Tax</td>
                    <td>{{ $invoice->currency }} {{ number_format($invoice->tax_amount, 2) }}</td>
                </tr>
            @endif

            <tr class="total">
                <td></td>
                <td>Total: {{ $invoice->currency }}
                    {{ number_format($invoice->amount + ($invoice->tax_amount ?? 0), 2) }}
                </td>
            </tr>
        </table>

        <div style="margin-top: 40px; font-size: 12px; color: #777; text-align: center;">
            <p>Thank you for your business!</p>
            @if($invoice->status === 'paid')
                <p>Payment ID: {{ $invoice->stripe_payment_intent }} | Paid on:
                    {{ $invoice->paid_at ? $invoice->paid_at->format('Y-m-d H:i') : '' }}
                </p>
            @endif
        </div>
    </div>
</body>

</html>