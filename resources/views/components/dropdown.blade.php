@props(['options' => []])

<select 
    {{ $attributes->merge([
        'class' => 'appearance-none border border-gray-300 rounded-md px-1 py-0 w-24 bg-white text-gray-700
                    bg-[url(\'data:image/svg+xml;utf8,<svg fill="none" stroke="gray" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path></svg>\')]
                    bg-no-repeat bg-[length:1rem] bg-[position:right_0.5rem_center]
                    focus:ring-1 focus:ring-indigo-400 focus:outline-none text-[10px]'
    ]) }}
    x-model="$parent.{{ $attributes->get('x-model') }}"
>
    @foreach ($options as $value => $label)
        <option value="{{ $value }}">{{ $label }}</option>
    @endforeach
</select>
