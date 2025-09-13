@props(['type' => 'submit', 'label' => 'LOGIN'])

<button type="{{ $type }}" 
    {{ $attributes->merge(['class' => 'w-full py-2 bg-blue-600 hover:bg-blue-700 hover:bg-blue-700 text-white font-bold rounded-lg hover:bg-blue-700']) }}>
    {{ $label }}
</button>