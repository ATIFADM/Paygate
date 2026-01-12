<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Invoice Portal') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Light Mode Vibrant Mesh Gradient */
        .mesh-gradient {
            background-color: #f0f9ff;
            background-image:
                radial-gradient(at 40% 20%, hsla(228, 100%, 90%, 1) 0px, transparent 50%),
                radial-gradient(at 80% 0%, hsla(189, 100%, 90%, 1) 0px, transparent 50%),
                radial-gradient(at 0% 50%, hsla(190, 100%, 92%, 1) 0px, transparent 50%),
                radial-gradient(at 80% 50%, hsla(210, 100%, 92%, 1) 0px, transparent 50%),
                radial-gradient(at 0% 100%, hsla(195, 100%, 92%, 1) 0px, transparent 50%),
                radial-gradient(at 80% 100%, hsla(200, 100%, 92%, 1) 0px, transparent 50%),
                radial-gradient(at 0% 0%, hsla(215, 100%, 92%, 1) 0px, transparent 50%);
            background-attachment: fixed;
        }

        .glass-glow {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow: 0 8px 32px 0 rgba(14, 165, 233, 0.15);
        }
    </style>
</head>

<body class="antialiased font-sans text-gray-900">
    <div class="min-h-screen mesh-gradient transition-colors duration-300">

        <!-- Navigation -->
        <nav class="bg-white/70 backdrop-blur-md shadow-sm border-b border-white/20 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center group">
                            <div class="bg-indigo-50 p-1.5 rounded-lg mr-2 group-hover:scale-105 transition-transform">
                                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <span class="text-xl font-bold text-gray-900">
                                Binary DesignHub
                            </span>
                        </a>
                        <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                            <a href="{{ route('home') }}"
                                class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 transition-colors">
                                New Invoice
                            </a>
                            @can('admin')
                                <a href="{{ route('admin.index') }}"
                                    class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 transition-colors">
                                    Dashboard
                                </a>
                                <a href="{{ route('users.index') }}"
                                    class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 transition-colors">
                                    Users
                                </a>
                            @endcan
                        </div>
                    </div>

                    <div class="flex items-center ml-6 space-x-4">
                        @auth
                            <div class="flex items-center space-x-4">
                                <span
                                    class="text-sm font-medium text-gray-700 hidden sm:block">{{ auth()->user()->name }}</span>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="text-sm font-bold text-red-600 hover:text-red-800 transition-colors">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        @else
                            <a href="{{ route('login') }}"
                                class="text-sm font-bold text-gray-700 hover:text-indigo-600 transition-colors">Login</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <main class="py-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                @if(session('success'))
                    <div
                        class="mb-6 rounded-md bg-green-50 dark:bg-green-900/30 p-4 border border-green-200 dark:border-green-800">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-green-800 dark:text-green-300">
                                    {{ session('success') }}
                                </h3>
                            </div>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 rounded-md bg-red-50 dark:bg-red-900/30 p-4 border border-red-200 dark:border-red-800">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800 dark:text-red-300">
                                    {{ session('error') }}
                                </h3>
                            </div>
                        </div>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>


        <footer class="mt-auto py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <p class="text-center text-gray-400 text-sm">
                    &copy; {{ date('Y') }} Invoice Portal. All payments secured by Stripe.
                </p>
            </div>
        </footer>
    </div>
</body>

</html>