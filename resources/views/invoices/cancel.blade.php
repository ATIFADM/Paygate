@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto py-12 px-4 sm:px-6 lg:px-8 text-center">

        <div class="mb-10">
            <div
                class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-red-100 dark:bg-red-900/30 mb-6 animate-pulse">
                <svg class="h-12 w-12 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </div>
            <h2 class="text-4xl font-bold text-gray-900 dark:text-white tracking-tight mb-2">
                Payment Cancelled</h2>
            <p class="text-lg text-gray-600 dark:text-gray-400">The payment process was cancelled using the "Back" button
                or by closing the window.</p>
        </div>

        <div
            class="glass-glow rounded-3xl p-8 sm:p-12 text-center relative overflow-hidden shadow-2xl dark:shadow-black/50">
            <p class="text-gray-600 dark:text-gray-300 mb-8 text-lg">
                No charges were made. You can try paying again whenever you are ready.
            </p>

            <div class="flex justify-center space-x-4">
                <a href="{{ route('invoices.show', $invoice) }}"
                    class="inline-flex items-center px-8 py-3 border border-transparent text-base font-bold rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 shadow-lg hover:shadow-indigo-500/30 transition-all transform hover:-translate-y-1">
                    Try Payment Again
                </a>
                <a href="{{ route('home') }}"
                    class="inline-flex items-center px-6 py-3 border border-gray-300 dark:border-gray-600 shadow-sm text-base font-medium rounded-xl text-gray-700 dark:text-gray-200 bg-white dark:bg-slate-700 hover:bg-gray-50 dark:hover:bg-slate-600 transition-colors">
                    Return Home
                </a>
            </div>
        </div>
    </div>
@endsection