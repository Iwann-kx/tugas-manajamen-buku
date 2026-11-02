<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-[#193c30] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#245541] focus:bg-[#245541] active:bg-[#142f25] focus:outline-none focus:ring-2 focus:ring-[#8eaf91] focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
