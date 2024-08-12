@props(['value'])

@if($value)
    <span class="text-green-800">{{ __('Yes') }}</span>
@else
    <span class="text-red-800">{{ __('No') }}</span>
@endif
