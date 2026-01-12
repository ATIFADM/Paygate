@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white tracking-tight">Access Dashboard</h2>
                <p class="mt-2 text-gray-600 dark:text-gray-400">Welcome back, {{ auth()->user()->name }}!</p>
            </div>
            <a href="{{ route('invoices.create') }}"
                class="inline-flex items-center px-6 py-3 border border-transparent rounded-xl shadow-lg shadow-sky-500/30 text-sm font-bold text-white bg-gradient-to-r from-blue-600 via-cyan-500 to-sky-400 hover:from-blue-500 hover:via-cyan-400 hover:to-sky-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500 transform hover:-translate-y-1 transition-all duration-200">
                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Create New Invoice
            </a>
        </div>

        <!-- Stats Overview -->
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 mb-8">
            <div class="glass-glow rounded-xl p-5 relative overflow-hidden group">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-gradient-to-br from-indigo-500/20 to-purple-500/20 rounded-full blur-xl group-hover:scale-150 transition-transform duration-500"></div>
                <div class="flex items-center relative z-10">
                    <div class="flex-shrink-0 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg p-3 shadow-lg shadow-indigo-500/30">
                         <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">My Invoices</dt>
                            <dd class="flex items-baseline">
                                <span class="block text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-indigo-400 dark:from-white dark:to-indigo-200">{{ $invoices->count() }}</span>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="glass-glow rounded-3xl overflow-hidden shadow-xl dark:shadow-black/50 animate-fade-in-up delay-200">
            <div class="px-8 py-6 border-b border-gray-100 dark:border-gray-700 bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm flex justify-between items-center">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">My Invoices</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50/50 dark:bg-slate-800/50 border-b border-gray-100 dark:border-gray-700">
                            <th class="px-8 py-5 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Invoice</th>
                            <th class="px-8 py-5 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Client</th>
                            <th class="px-8 py-5 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Amount</th>
                            <th class="px-8 py-5 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                            <th class="px-8 py-5 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Date</th>
                            <th class="px-8 py-5 text-right text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @forelse($invoices as $invoice)
                            <tr class="hover:bg-gray-50/50 dark:hover:bg-slate-800/50 transition-colors group">
                                <td class="px-8 py-5">
                                    <span class="font-bold text-gray-900 dark:text-white">{{ $invoice->invoice_number }}</span>
                                </td>
                                <td class="px-8 py-5">
                                    <div class="text-sm font-bold text-gray-900 dark:text-white">{{ $invoice->client_name }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ $invoice->client_email }}</div>
                                </td>
                                <td class="px-8 py-5">
                                    <span class="font-bold text-gray-900 dark:text-white">{{ $invoice->currency }} {{ number_format($invoice->amount, 2) }}</span>
                                </td>
                                <td class="px-8 py-5">
                                    @if($invoice->status === 'paid')
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300 border border-green-200 dark:border-green-800">Paid</span>
                                    @else
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-amber-100 dark:bg-amber-900/30 text-amber-800 dark:text-amber-300 border border-amber-200 dark:border-amber-800">Pending</span>
                                    @endif
                                </td>
                                <td class="px-8 py-5 text-sm text-gray-500 dark:text-gray-400">
                                    {{ $invoice->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-8 py-5 text-right text-sm font-medium">
                                    <a href="{{ route('invoices.show', $invoice) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300 font-bold hover:underline">View</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                                    <p class="text-lg font-medium">No invoices found</p>
                                    <a href="{{ route('invoices.create') }}" class="mt-2 text-indigo-600 dark:text-indigo-400 hover:underline">Create your first invoice</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
