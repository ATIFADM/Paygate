@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto">
        <!-- Success Message -->
        @if(session('success'))
            <div
                class="mb-8 rounded-2xl bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 p-4 shadow-sm animate-fade-in-down">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800 dark:text-green-300">
                            {{ session('success') }}
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Main Invoice Card -->
        <div class="glass-glow rounded-3xl overflow-hidden relative shadow-2xl dark:shadow-black/50">
            <!-- Decorative subtle pattern -->
            <div
                class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 bg-gradient-to-br from-blue-500/10 to-cyan-500/10 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-3xl opacity-50">
            </div>
            <div
                class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 bg-gradient-to-tr from-sky-500/10 to-teal-500/10 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-3xl opacity-50">
            </div>

            <div class="p-8 sm:p-12 relative z-10">
                <!-- Header -->
                <div
                    class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 border-b border-gray-100 dark:border-gray-700 pb-8">
                    <div>
                        <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">
                            Invoice #{{ $invoice->invoice_number }}
                        </h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Issued on {{ $invoice->created_at->format('M d, Y') }}
                        </p>
                    </div>
                    <div class="mt-4 sm:mt-0">
                        @if($invoice->status === 'paid')
                            <span
                                class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-bold bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 border border-green-200 dark:border-green-800 shadow-sm">
                                <span class="w-2 h-2 mr-2 bg-green-500 rounded-full"></span>
                                PAID
                            </span>
                        @else
                            <span
                                class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-bold bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300 border border-amber-200 dark:border-amber-800 shadow-sm">
                                <span class="w-2 h-2 mr-2 bg-amber-500 rounded-full animate-pulse"></span>
                                PENDING
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Invoice Details -->
                <div
                    class="bg-white/50 dark:bg-slate-800/50 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 mb-8 backdrop-blur-sm">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                        <div>
                            <h4 class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400 font-bold mb-3">
                                Billed To</h4>
                            <p class="text-lg text-gray-900 dark:text-white font-bold">{{ $invoice->client_name }}</p>
                            <p class="text-gray-600 dark:text-gray-400">{{ $invoice->client_email }}</p>

                            @if($invoice->client_phone)
                                <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">{{ $invoice->client_phone }}</p>
                            @endif

                            @if($invoice->company_name)
                                <p class="text-gray-500 dark:text-gray-400 text-sm mt-1 font-medium">
                                    {{ $invoice->company_name }}
                                </p>
                            @endif

                            @if($invoice->client_address)
                                <p class="text-gray-500 dark:text-gray-400 text-sm mt-2 whitespace-pre-line">
                                    {{ $invoice->client_address }}
                                </p>
                            @endif
                        </div>
                        <div class="sm:text-right">
                            <h4 class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400 font-bold mb-3">
                                Total Amount</h4>
                            <p
                                class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-sky-500 dark:from-sky-400 dark:to-cyan-300">
                                {{ $invoice->currency }}
                                {{ number_format($invoice->amount + ($invoice->tax_amount ?? 0), 2) }}
                            </p>
                            @if($invoice->tax_amount > 0)
                                <p class="text-sm text-gray-400 dark:text-gray-500 mt-1">
                                    Subtotal: {{ number_format($invoice->amount, 2) }} <span class="mx-1">|</span> Tax:
                                    {{ number_format($invoice->tax_amount, 2) }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Service Description -->
                <div class="mb-10">
                    <h4 class="text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400 font-bold mb-3">Service
                        Description</h4>
                    <div
                        class="bg-gray-50 dark:bg-slate-900/50 rounded-xl p-5 text-gray-700 dark:text-gray-300 leading-relaxed border border-gray-100 dark:border-gray-700/50">
                        {{ $invoice->service_description }}
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4 justify-end">
                    <a href="{{ route('invoices.pdf', $invoice) }}"
                        class="inline-flex justify-center items-center px-6 py-3 border border-gray-200 dark:border-gray-700 shadow-sm text-sm font-bold rounded-xl text-gray-700 dark:text-gray-200 bg-white dark:bg-slate-800 hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        <svg class="w-5 h-5 mr-2 -ml-1 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        Download PDF
                    </a>

                    @if($invoice->status !== 'paid')
                        <a href="{{ route('invoices.pay', $invoice) }}"
                            class="inline-flex justify-center items-center px-8 py-3 border border-transparent text-sm font-bold rounded-xl text-white bg-gradient-to-r from-blue-600 via-cyan-500 to-sky-400 hover:from-blue-500 hover:via-cyan-400 hover:to-sky-300 shadow-lg shadow-sky-500/30 transition-all transform hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-sky-500/50">
                            Pay Now &rarr;
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection