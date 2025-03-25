@props(['options' => [], 'selected' => '', 'disabled' => false])

<select {{ $attributes->merge(['class' => 'w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm']) }} @disabled($disabled)>
    @foreach ($options as $value => $label)
        <option value="{{ $value }}" @selected($selected == $value)>{{ $label }}</option>
    @endforeach
</select>
