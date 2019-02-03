@if($label = $params->get('label'))
    <label for="{{ $params->get('id') }}" class="{{ $params->error && $params->config('label.errorClass') ? $params->config('label.errorClass') : '' }}">
        {{ $label }}
    </label>
@endif
