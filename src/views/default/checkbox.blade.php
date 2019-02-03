@if($params = new Vannyvann\Formgroup\FormgroupParams($params, $errors, $options, $config))

    @if($params->get('nullable') !== null)
        <input type="hidden" name="{{ $params->get('name') }}" value="{{ $params->get('nullable') }}">
    @endif

    <div class="custom-control custom-checkbox">
        <input {!! $params->basicOptions([
            'class' => 'custom-control-input',
            'type' => 'checkbox'
        ]) !!}>

        <label class="custom-control-label" for="{{ $params->get('id') }}">
            {{ $params->get('label') }}
        </label>

    </div>

@endif
