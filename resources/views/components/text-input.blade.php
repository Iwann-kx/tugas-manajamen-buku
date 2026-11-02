@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-[#d6dfd3] bg-[#fbfcfa] focus:border-[#709276] focus:ring-[#709276] rounded-md shadow-sm']) }}>
