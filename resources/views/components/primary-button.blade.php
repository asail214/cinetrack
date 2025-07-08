<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-6 py-3 bg-accent border border-accent rounded-md font-semibold text-base text-white uppercase tracking-widest hover:bg-accent-hover focus:bg-accent-hover active:bg-accent focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 shadow transition-all duration-150']) }}>
    {{ $slot }}
</button>
