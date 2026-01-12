<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Binary DesignHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Outfit', 'sans-serif'] },
                }
            }
        }
    </script>
    <style>
        .mesh-gradient {
            background-color: #f0f9ff;
            background-image:
                radial-gradient(at 0% 0%, hsla(253, 16%, 7%, 0.1) 0, transparent 50%),
                radial-gradient(at 50% 0%, hsla(225, 39%, 30%, 0.1) 0, transparent 50%),
                radial-gradient(at 100% 0%, hsla(198, 100%, 30%, 0.1) 0, transparent 50%);
        }

        .glass-panel {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow: 0 8px 32px 0 rgba(14, 165, 233, 0.15);
        }
    </style>
</head>

<body class="mesh-gradient min-h-screen flex items-center justify-center p-4">

    <div class="glass-panel w-full max-w-md rounded-3xl p-8 sm:p-10 relative overflow-hidden">
        <!-- Decorative blobs -->
        <div class="absolute top-0 right-0 -mr-16 -mt-16 w-32 h-32 bg-sky-200 rounded-full blur-2xl opacity-50"></div>
        <div class="absolute bottom-0 left-0 -ml-16 -mb-16 w-32 h-32 bg-blue-200 rounded-full blur-2xl opacity-50">
        </div>

        <div class="relative z-10">
            <div class="text-center mb-10">
                <div class="flex justify-center mb-10">
                    <div class="relative group">
                        <div
                            class="absolute -inset-4 bg-gradient-to-r from-indigo-500 to-cyan-500 rounded-full blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200">
                        </div>
                        <div
                            class="relative bg-white dark:bg-slate-800 p-5 rounded-2xl shadow-xl border border-white/20">
                            <svg class="w-12 h-12 text-indigo-600 dark:text-indigo-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Welcome Back</h1>
                <p class="text-gray-500 mt-2 text-sm">Sign in to Binary DesignHub</p>
            </div>

            <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input type="email" name="email" id="email" required
                        class="w-full px-4 py-3 rounded-xl bg-white/50 border border-gray-200 focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 transition-all outline-none"
                        placeholder="admin@example.com">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" id="password" required
                        class="w-full px-4 py-3 rounded-xl bg-white/50 border border-gray-200 focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 transition-all outline-none"
                        placeholder="••••••••">
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember"
                            class="w-4 h-4 rounded border-gray-300 text-sky-600 focus:ring-sky-500">
                        <span class="ml-2 text-sm text-gray-600">Remember me</span>
                    </label>
                </div>

                <button type="submit"
                    class="w-full py-3.5 rounded-xl bg-gradient-to-r from-blue-600 to-sky-500 text-white font-bold shadow-xl shadow-sky-500/20 hover:shadow-sky-500/40 transform hover:-translate-y-0.5 transition-all">
                    Sign In
                </button>
            </form>
        </div>
    </div>

</body>

</html>