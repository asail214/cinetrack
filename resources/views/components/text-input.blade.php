@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-[#23272b] text-white border border-[#444] focus:border-accent focus:ring-accent rounded-md shadow-sm placeholder-gray-400 px-4 py-2 transition-all duration-150']) }}>
