@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 rounded-xl shadow-sm w-full px-4 py-3 transition-all duration-300 bg-white/80 hover:bg-white']) }}>
