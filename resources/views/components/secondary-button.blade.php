<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-6 py-3 bg-white/80 border border-gray-300 rounded-xl font-semibold text-sm text-gray-700 hover:bg-white hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-25 transition-all duration-300']) }}>
    {{ $slot }}
</button>
