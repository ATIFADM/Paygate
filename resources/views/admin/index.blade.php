@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Dashboard</h2>
                <p class="mt-2 text-gray-600">Manage invoices and track payments.</p>
            </div>
            <a href="{{ route('home') }}"
                class="hidden sm:inline-flex items-center px-6 py-3 border border-transparent rounded-xl shadow-lg shadow-sky-500/30 text-sm font-bold text-white bg-gradient-to-r from-blue-600 via-cyan-500 to-sky-400 hover:from-blue-500 hover:via-cyan-400 hover:to-sky-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500 transform hover:-translate-y-1 transition-all duration-200">
                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                New Invoice
            </a>
        </div>

        <!-- User Performance Cards -->
        <div class="mb-10">
            <h3 class="text-xl font-bold text-gray-900 mb-4">Top Performers</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($usersWithStats as $user)
                <div class="glass-glow rounded-2xl p-4 relative overflow-hidden group hover:-translate-y-1 transition-transform duration-300">
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-16 h-16 bg-gradient-to-br from-blue-500/20 to-sky-500/20 rounded-full blur-xl"></div>
                    <div class="flex items-center space-x-4 relative z-10">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-sky-500 flex items-center justify-center text-white font-bold text-lg shadow-lg">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">{{ $user->name }}</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $user->invoices_count }} <span class="text-xs font-normal text-gray-400">inv</span></p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Global Stats Overview -->
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-3 mb-8">
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
                            <dt class="text-sm font-medium text-gray-500 truncate">Total Invoices</dt>
                            <dd class="flex items-baseline">
                                <span class="block text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-indigo-400">{{ $invoices->count() }}</span>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            
            <div class="glass-glow rounded-xl p-5 relative overflow-hidden group">
                 <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-gradient-to-br from-emerald-500/20 to-teal-500/20 rounded-full blur-xl group-hover:scale-150 transition-transform duration-500"></div>
                <div class="flex items-center relative z-10">
                    <div class="flex-shrink-0 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-lg p-3 shadow-lg shadow-emerald-500/30">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Total Revenue (Est.)</dt>
                            <dd class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-emerald-600 to-teal-500">
                                ${{ number_format($invoices->where('status', 'paid')->sum('amount'), 2) }}
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center mb-10">
                <div>
                    <h1 class="text-4xl font-bold text-gray-900 tracking-tight">Admin Dashboard</h1>
                    <p class="mt-2 text-gray-600">Manage invoices and track payments</p>
                </div>
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 flex items-center space-x-6 border border-white/20 shadow-xl">
                     <div class="text-center">
                         <span class="block text-2xl font-bold text-gray-900">{{ $invoices->count() }}</span>
                         <span class="text-xs text-indigo-600 uppercase tracking-wide font-bold">Total</span>
                     </div>
                     <div class="h-10 w-px bg-gray-200"></div>
                     <div class="text-center">
                        <span class="block text-2xl font-bold text-emerald-600">{{ $invoices->where('status', 'paid')->count() }}</span>
                        <span class="text-xs text-emerald-600 uppercase tracking-wide font-bold">Paid</span>
                    </div>
                </div>
            </div>
            
            <div class="glass-glow rounded-3xl overflow-hidden shadow-xl animate-fade-in-up delay-200">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50/50 border-b border-gray-100">
                                <th class="px-8 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Invoice</th>
                                <th class="px-8 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Client</th>
                                <th class="px-8 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Created By</th>
                                <th class="px-8 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Amount</th>
                                <th class="px-8 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-8 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-8 py-5 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                            @forelse($invoices as $invoice)
                                <tr class="hover:bg-gray-50/50 transition-colors group">
                                    <td class="px-8 py-5">
                                        <span class="font-bold text-gray-900">{{ $invoice->invoice_number }}</span>
                                    </td>
                                    <td class="px-8 py-5">
                                        <div class="text-sm font-bold text-gray-900">{{ $invoice->client_name }}</div>
                                        <div class="text-xs text-gray-500">{{ $invoice->client_email }}</div>
                                    </td>
                                    <td class="px-8 py-5">
                                         <div class="flex items-center">
                                            <div class="w-6 h-6 rounded-full bg-gray-200 flex items-center justify-center text-xs font-bold text-gray-600 mr-2">
                                                {{ $invoice->user ? substr($invoice->user->name, 0, 1) : '?' }}
                                            </div>
                                            <span class="text-sm text-gray-600">{{ $invoice->user->name ?? 'Unknown' }}</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5">
                                        <span class="font-bold text-gray-900">{{ $invoice->currency }} {{ number_format($invoice->amount, 2) }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($invoice->status === 'paid')
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 border border-green-200">
                                                Paid
                                            </span>
                                        @else
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-amber-100 text-amber-800 border border-amber-200">
                                                Pending
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $invoice->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('invoices.pdf', $invoice) }}"
                                            class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300 bg-indigo-50 dark:bg-indigo-900/30 hover:bg-indigo-100 dark:hover:bg-indigo-900/50 px-3 py-1.5 rounded-md transition-colors mr-2">
                                            PDF
                                        </a>
                                        <form action="{{ route('admin.invoices.destroy', $invoice) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this invoice?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300 bg-red-50 dark:bg-red-900/30 hover:bg-red-100 dark:hover:bg-red-900/50 px-3 py-1.5 rounded-md transition-colors">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-12 h-12 text-gray-300 dark:text-gray-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            <p class="text-lg font-medium">No invoices found</p>
                                            <a href="{{ route('home') }}" class="mt-2 text-indigo-600 dark:text-indigo-400 hover:underline">Create your first invoice</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection