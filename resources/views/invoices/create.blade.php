@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="text-center mb-12 animate-fade-in-up">
            <h1 class="text-4xl font-bold text-gray-900 tracking-tight">
                Create Invoice
            </h1>
            <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">
                Generate professional invoices and secure payments in seconds.
            </p>
        </div>

        <!-- Main Card -->
        <div
            class="glass-glow rounded-3xl overflow-hidden relative shadow-2xl animate-fade-in-up delay-100">
            <!-- Decorative subtle pattern -->
            <div
                class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 bg-gradient-to-br from-blue-500/20 to-cyan-500/20 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-pulse">
            </div>
            <div
                class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 bg-gradient-to-tr from-sky-500/20 to-teal-500/20 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-pulse delay-1000">
            </div>

            <div class="p-8 sm:p-12 relative z-10">
                <form action="{{ route('invoices.store') }}" method="POST" class="space-y-10">
                    @csrf

                    <!-- Client Information -->
                    <div>
                        <div class="flex items-center mb-8 border-b border-gray-100 pb-4">
                            <div class="bg-indigo-100 rounded-lg p-2 mr-4 shadow-sm">
                                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900">Client Details</h3>
                                <p class="text-sm text-gray-500">Who is this invoice for?</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-y-8 gap-x-8 sm:grid-cols-2">
                            <div class="group">
                                <label for="client_name"
                                    class="block text-sm font-semibold text-gray-700 mb-2 transition-colors group-focus-within:text-indigo-600">Full
                                    Name</label>
                                <input type="text" name="client_name" id="client_name" value="{{ old('client_name') }}"
                                    required placeholder="e.g. John Doe"
                                    class="block w-full rounded-xl border-gray-200 bg-gray-50/50 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 shadow-sm transition-all duration-200 py-3 px-4 text-gray-900 placeholder-gray-400">
                                @error('client_name')
                                    <p class="text-sm text-red-500 mt-1 pl-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="group">
                                <label for="client_email"
                                    class="block text-sm font-semibold text-gray-700 mb-2 transition-colors group-focus-within:text-indigo-600">Email
                                    Address</label>
                                <input type="email" name="client_email" id="client_email" value="{{ old('client_email') }}"
                                    required placeholder="john@example.com"
                                    class="block w-full rounded-xl border-gray-200 bg-gray-50/50 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 shadow-sm transition-all duration-200 py-3 px-4 text-gray-900 placeholder-gray-400">
                                @error('client_email')
                                    <p class="text-sm text-red-500 mt-1 pl-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="group">
                                <label for="client_phone"
                                    class="block text-sm font-semibold text-gray-700 mb-2 transition-colors group-focus-within:text-indigo-600">Phone
                                    Number <span
                                        class="text-gray-400 font-normal">(Optional)</span></label>
                                <input type="text" name="client_phone" id="client_phone" value="{{ old('client_phone') }}"
                                    placeholder="+1 (555) 000-0000"
                                    class="block w-full rounded-xl border-gray-200 bg-gray-50/50 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 shadow-sm transition-all duration-200 py-3 px-4 text-gray-900 placeholder-gray-400">
                            </div>

                            <div class="group">
                                <label for="company_name"
                                    class="block text-sm font-semibold text-gray-700 mb-2 transition-colors group-focus-within:text-indigo-600">Company
                                    Name <span
                                        class="text-gray-400 font-normal">(Optional)</span></label>
                                <input type="text" name="company_name" id="company_name" value="{{ old('company_name') }}"
                                    placeholder="e.g. Acme Corp"
                                    class="block w-full rounded-xl border-gray-200 bg-gray-50/50 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 shadow-sm transition-all duration-200 py-3 px-4 text-gray-900 placeholder-gray-400">
                            </div>

                            <div class="group sm:col-span-2">
                                <label for="client_address"
                                    class="block text-sm font-semibold text-gray-700 mb-2 transition-colors group-focus-within:text-indigo-600">Billing
                                    Address <span
                                        class="text-gray-400 font-normal">(Optional)</span></label>
                                <textarea name="client_address" id="client_address" rows="2"
                                    placeholder="123 Business St, City, Country"
                                    class="block w-full rounded-xl border-gray-200 bg-gray-50/50 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 shadow-sm transition-all duration-200 py-3 px-4 text-gray-900 placeholder-gray-400 resize-none">{{ old('client_address') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Service Details -->
                    <div>
                        <div class="flex items-center mb-8 border-b border-gray-100 pb-4">
                            <div class="bg-indigo-100 rounded-lg p-2 mr-4 shadow-sm">
                                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900">Service & Payment</h3>
                                <p class="text-sm text-gray-500">What is being paid for?</p>
                            </div>
                        </div>

                        <div class="space-y-8">
                            <!-- Smart Description Dropdown -->
                            <div class="group relative" x-data="{ open: false, selected: '' }">
                                <label for="service_description"
                                    class="block text-sm font-semibold text-gray-700 mb-2 transition-colors group-focus-within:text-indigo-600">
                                    Description <span class="text-xs text-indigo-500 font-normal ml-2">(Auto-saves new
                                        entries)</span>
                                </label>

                                <div class="relative">
                                    <textarea id="service_description" name="service_description" rows="3" required
                                        placeholder="Describe the service rendered..."
                                        class="block w-full rounded-xl border-gray-200 bg-gray-50/50 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 shadow-sm transition-all duration-200 py-3 px-4 text-gray-900 placeholder-gray-400 resize-none pr-10"
                                        onfocus="document.getElementById('description-dropdown').classList.remove('hidden')">{{ old('service_description') }}</textarea>

                                    <!-- Saved Descriptions Dropdown -->
                                    <div id="description-dropdown"
                                        class="absolute z-20 w-full mt-1 bg-white rounded-xl shadow-lg border border-gray-100 hidden max-h-60 overflow-y-auto">
                                        @if($savedDescriptions->isNotEmpty())
                                            <div class="py-1">
                                                <p
                                                    class="px-4 py-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                                    Saved Descriptions</p>
                                                @foreach($savedDescriptions as $desc)
                                                    <div
                                                        class="flex items-center justify-between hover:bg-gray-50 group/item cursor-pointer px-4 py-2">
                                                        <span class="text-sm text-gray-700 flex-grow"
                                                            onclick="document.getElementById('service_description').value = this.innerText; document.getElementById('description-dropdown').classList.add('hidden')">
                                                            {{ $desc->text }}
                                                        </span>
                                                        <button type="button" onclick="deleteDescription({{ $desc->id }}, this)"
                                                            class="text-gray-400 hover:text-red-500 p-1 opacity-0 group-hover/item:opacity-100 transition-opacity">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                    <!-- Close Dropdown Overlay -->
                                    <div class="fixed inset-0 z-10 hidden" id="dropdown-overlay"
                                        onclick="document.getElementById('description-dropdown').classList.add('hidden'); this.classList.add('hidden')">
                                    </div>
                                </div>

                                @error('service_description')
                                    <p class="text-sm text-red-500 mt-1 pl-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 gap-y-8 gap-x-8 sm:grid-cols-2">
                                <div class="group">
                                    <label for="amount"
                                        class="block text-sm font-semibold text-gray-700 mb-2 transition-colors group-focus-within:text-indigo-600">Amount</label>
                                    <div class="relative rounded-xl shadow-sm">
                                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                            <span
                                                class="text-gray-500 sm:text-lg font-bold select-none">$</span>
                                        </div>
                                        <input type="number" name="amount" id="amount" step="0.01"
                                            value="{{ old('amount') }}" required placeholder="0.00"
                                            class="block w-full rounded-xl border-gray-200 bg-gray-50/50 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 pl-8 py-3 px-4 text-gray-900 placeholder-gray-400 text-lg font-medium">
                                    </div>
                                    @error('amount')
                                        <p class="text-sm text-red-500 mt-1 pl-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="group">
                                    <label for="tax_amount"
                                        class="block text-sm font-semibold text-gray-700 mb-2 transition-colors group-focus-within:text-indigo-600">Tax
                                        Amount <span
                                            class="text-gray-400 font-normal">(Optional)</span></label>
                                    <div class="relative rounded-xl shadow-sm">
                                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                            <span
                                                class="text-gray-500 sm:text-lg font-bold select-none">+</span>
                                        </div>
                                        <input type="number" name="tax_amount" id="tax_amount" step="0.01"
                                            value="{{ old('tax_amount') }}" placeholder="0.00"
                                            class="block w-full rounded-xl border-gray-200 bg-gray-50/50 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 pl-8 py-3 px-4 text-gray-900 placeholder-gray-400 text-lg font-medium">
                                    </div>
                                </div>
                            </div>

                            <div class="group">
                                <label for="currency"
                                    class="block text-sm font-semibold text-gray-700 mb-2 transition-colors group-focus-within:text-indigo-600">Currency</label>
                                <div class="relative">
                                    <select id="currency" name="currency"
                                        class="appearance-none block w-full rounded-xl border-gray-200 bg-gray-50/50 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 shadow-sm py-3 px-4 text-gray-900 font-medium cursor-pointer">
                                        <option value="USD">USD ($) - US Dollar</option>
                                        <option value="EUR">EUR (€) - Euro</option>
                                        <option value="GBP">GBP (£) - British Pound</option>
                                    </select>
                                    <div
                                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div class="group">
                                <label for="cc_email"
                                    class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2 transition-colors">CC
                                    Email (Admin Notification)</label>
                                <input type="email" name="cc_email" id="cc_email"
                                    value="{{ old('cc_email', 's.atifrehman@yahoo.com') }}" readonly
                                    class="block w-full rounded-xl border-gray-200 bg-gray-100 cursor-not-allowed text-gray-500 focus:border-gray-200 focus:ring-0 shadow-sm py-3 px-4 select-none">
                                <p class="text-xs text-gray-400 mt-1 pl-1">This notification email is
                                    fixed.</p>
                            </div>
                        </div>
                    </div>

                    <div class="pt-8">
                        <button type="submit"
                            class="w-full group flex justify-center items-center py-5 px-8 border border-transparent rounded-2xl shadow-xl shadow-sky-500/30 text-lg font-extrabold text-white bg-gradient-to-r from-blue-600 via-cyan-500 to-sky-400 hover:from-blue-500 hover:via-cyan-400 hover:to-sky-300 focus:outline-none focus:ring-4 focus:ring-sky-500/50 transform hover:-translate-y-1 hover:scale-[1.01] transition-all duration-300">
                            <span class="mr-3">Generate & Send Invoice</span>
                            <svg class="w-6 h-6 group-hover:translate-x-1 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </button>
                        <div
                            class="mt-6 flex justify-center items-center space-x-4 text-gray-400 opacity-70 grayscale hover:grayscale-0 transition-all duration-500">
                            <span class="text-xs font-medium">POWERED BY</span>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/b/ba/Stripe_Logo%2C_revised_2016.svg"
                                alt="Stripe" class="h-6 opacity-80">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Script for Description Dropdown and Delete Logic -->
    <script>
        // Simple logic to handle dropdown toggle
        document.getElementById('service_description').addEventListener('focus', function () {
            document.getElementById('description-dropdown').classList.remove('hidden');
            document.getElementById('dropdown-overlay').classList.remove('hidden');
        });

        // Close dropdown when clicking outside (handled by overlay)
        document.getElementById('dropdown-overlay').addEventListener('click', function () {
            document.getElementById('description-dropdown').classList.add('hidden');
            this.classList.add('hidden');
        });

        function deleteDescription(id, btnElement) {
            // Prevent dropdown from closing immediately or selection happening
            event.stopPropagation();
            event.preventDefault();

            if (!confirm('Delete this saved description?')) return;

            fetch(`/invoice-descriptions/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Remove the element from DOM
                        btnElement.closest('div').remove();
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
@endsection