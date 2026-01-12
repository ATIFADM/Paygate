@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto py-12 px-4 sm:px-6 lg:px-8 text-center">

        <div class="mb-10">
            <div
                class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-green-100 dark:bg-green-900/30 mb-6 animate-bounce">
                <svg class="h-12 w-12 text-green-600 dark:text-green-400" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h2 class="text-4xl font-bold text-gray-900 dark:text-white tracking-tight mb-2">Payment Successful!</h2>
            <p class="text-lg text-gray-600 dark:text-gray-400">Thank you for your payment. A confirmation has been sent to
                your email.</p>
        </div>

        <div class="glass-glow rounded-3xl p-8 sm:p-12 text-left relative overflow-hidden shadow-2xl dark:shadow-black/50">
            <div class="flex justify-between items-start mb-8 pb-8 border-b border-gray-100 dark:border-gray-700">
                <div>
                    <p class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 uppercase tracking-wide">Receipt
                        For</p>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ $invoice->client_name }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $invoice->client_email }}</p>
                </div>
                <div class="text-right">
                    <p class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 uppercase tracking-wide">Amount
                        Paid</p>
                    <h3 class="text-3xl font-bold text-gray-900 dark:text-white mt-1">
                        ${{ number_format($invoice->amount, 2) }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $invoice->updated_at->format('M d, Y') }}</p>
                </div>
            </div>

            <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2 mb-8">
                <div class="bg-gray-50 dark:bg-slate-700/50 p-4 rounded-xl">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Invoice Number</dt>
                    <dd class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">#{{ $invoice->invoice_number }}
                    </dd>
                </div>
                <div class="bg-gray-50 dark:bg-slate-700/50 p-4 rounded-xl">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Payment Method</dt>
                    <dd class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">Credit Card (Stripe)</dd>
                </div>
                <div class="sm:col-span-2 bg-gray-50 dark:bg-slate-700/50 p-4 rounded-xl">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Service Description</dt>
                    <dd class="mt-1 text-base text-gray-900 dark:text-gray-200">{{ $invoice->service_description }}</dd>
                </div>
            </dl>

            <div class="mt-8 pt-6 border-t border-dashed border-gray-200 dark:border-gray-700 text-center">
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">A copy of this receipt has been emailed to you.</p>

                <div class="flex flex-col sm:flex-row justify-center space-y-3 sm:space-y-0 sm:space-x-4">
                    <a href="{{ route('home') }}"
                        class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-bold rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 shadow-lg hover:shadow-indigo-500/30 transition-all transform hover:-translate-y-1">
                        Create Another Invoice
                    </a>
                    <a href="{{ route('invoices.pdf', $invoice) }}"
                        class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 dark:border-gray-600 shadow-sm text-base font-medium rounded-xl text-gray-700 dark:text-gray-200 bg-white dark:bg-slate-700 hover:bg-gray-50 dark:hover:bg-slate-600 transition-colors">
                        <svg class="w-5 h-5 mr-2 -ml-1 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Download PDF Receipt
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection