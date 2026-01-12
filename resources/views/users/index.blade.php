@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-10">
            <div>
                <h1 class="text-4xl font-bold text-gray-900 tracking-tight">User Management</h1>
                <p class="mt-2 text-gray-600">Manage system access and team members.</p>
            </div>
        </div>

        <!-- Create User Card -->
        <div class="glass-glow rounded-3xl p-8 mb-12 relative overflow-hidden">
             <!-- Decorative blobs -->
            <div class="absolute top-0 right-0 -mr-20 -mt-20 w-64 h-64 bg-blue-500/10 rounded-full blur-3xl opacity-50 pointer-events-none"></div>
            
            <h2 class="text-xl font-bold text-gray-900 mb-6 relative z-10">Add New User</h2>
            
            <form action="{{ route('users.store') }}" method="POST" class="relative z-10">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" required class="w-full rounded-xl border-gray-200 bg-white/50 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all py-2.5 px-4 text-gray-900" placeholder="John Doe">
                        @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required class="w-full rounded-xl border-gray-200 bg-white/50 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all py-2.5 px-4 text-gray-900" placeholder="john@example.com">
                        @error('email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                        <input type="password" name="password" required class="w-full rounded-xl border-gray-200 bg-white/50 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all py-2.5 px-4 text-gray-900" placeholder="••••••••">
                        @error('password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Role</label>
                        <select name="role" class="w-full rounded-xl border-gray-200 bg-white/50 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all py-2.5 px-4 text-gray-900">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                         @error('role') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="mt-6 text-right">
                    <button type="submit" class="inline-flex items-center px-6 py-2.5 border border-transparent text-sm font-bold rounded-xl text-white bg-gradient-to-r from-blue-600 to-sky-500 hover:from-blue-500 hover:to-sky-400 shadow-lg shadow-sky-500/30 transform hover:-translate-y-0.5 transition-all">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Create User
                    </button>
                </div>
            </form>
        </div>

        <!-- Users List -->
        <div class="glass-glow rounded-3xl overflow-hidden shadow-xl">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50/50 border-b border-gray-100">
                            <th class="px-8 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-8 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-8 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Role</th>
                            <th class="px-8 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Current Password</th>
                            <th class="px-8 py-5 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Joined</th>
                            <th class="px-8 py-5 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @foreach($users as $user)
                            <tr class="hover:bg-gray-50/50 transition-colors group">
                                <td class="px-8 py-5">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center text-white font-bold text-sm shadow-md">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <span class="ml-4 text-sm font-bold text-gray-900">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-5 text-sm text-gray-600">{{ $user->email }}</td>
                                <td class="px-8 py-5">
                                    @if($user->role === 'admin')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-purple-100 text-purple-700">Admin</span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-700">User</span>
                                    @endif
                                </td>
                                <td class="px-8 py-5">
                                    @if($user->system_generated_password)
                                        <div class="group/pass relative font-mono text-sm">
                                            <span class="blur-sm group-hover/pass:blur-none transition-all cursor-pointer select-all bg-gray-100 px-2 py-1 rounded border border-gray-200">
                                                {{ decrypt($user->system_generated_password) }}
                                            </span>
                                            <span class="text-[10px] text-gray-400 block mt-1">Auto-Rotated</span>
                                        </div>
                                    @else
                                        <span class="text-xs text-gray-400 italic">Manually Set</span>
                                    @endif
                                </td>
                                <td class="px-8 py-5 text-sm text-gray-500">
                                    {{ $user->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-8 py-5 text-right">
                                    @if(auth()->id() !== $user->id)
                                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this user?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-gray-400 hover:text-red-500 p-2 transition-colors">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
