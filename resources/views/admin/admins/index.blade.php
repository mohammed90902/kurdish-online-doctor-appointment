<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-center items-center relative min-h-[60px]">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                {{ __('Manage Admins') }}
            </h2>
            <div class="md:absolute md:left-0 mt-4 md:mt-0">
                <a href="{{ route('admin.admins.create') }}" class="bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-indigo-700 hover:to-blue-600 px-6 py-3 rounded-xl text-white font-bold shadow-lg hover:shadow-xl transition-all duration-300 flex items-center">
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    {{ __('Add New Admin') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="glass-card bg-green-100/80 border-l-4 border-green-500 text-green-700 px-6 py-4 rounded-xl mb-6 flex items-center shadow-lg animate-slideDown">
                    <svg class="w-6 h-6 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="glass-card bg-red-100/80 border-l-4 border-red-500 text-red-700 px-6 py-4 rounded-xl mb-6 flex items-center shadow-lg animate-slideDown">
                    <svg class="w-6 h-6 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            <div class="glass-card overflow-hidden shadow-xl rounded-2xl animate-fade-in">
                <div class="p-0">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50/50">
                                <tr>
                                    <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('Name') }}</th>
                                    <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('Email') }}</th>
                                    <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('Phone') }}</th>
                                    <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('Date Added') }}</th>
                                    <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white/50 divide-y divide-gray-100">
                                @foreach($admins as $admin)
                                <tr class="hover:bg-blue-50/30 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center text-white font-bold ml-3 shadow-md">
                                                {{ substr($admin->name, 0, 1) }}
                                            </div>
                                            <div class="text-sm font-bold text-gray-800">{{ $admin->name }}</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $admin->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-mono">{{ $admin->phone }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" dir="ltr">{{ $admin->created_at->format('Y/m/d H:i') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <form method="POST" action="{{ route('admin.admins.destroy', $admin->id) }}" class="inline" onsubmit="return confirm('{{ __('Are you sure you want to delete this admin?') }}')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 font-bold hover:underline bg-transparent border-none cursor-pointer">{{ __('Delete') }}</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach

                                @if($admins->isEmpty())
                                <tr>
                                    <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                                        {{ __('No other admins found') }}
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    @if($admins->hasPages())
                        <div class="px-6 py-4 bg-gray-50/50 border-t border-gray-100">
                            {{ $admins->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
