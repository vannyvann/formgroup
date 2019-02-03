@if($params = new Vannyvann\Formgroup\FormgroupParams($params, $errors, $options, $config))

    @if($params->get('nullable') !== null)
        <input type="hidden" name="{{ $params->get('name') }}" value="{{ $params->get('nullable') }}">
    @endif
    
    <div class="custom-control custom-radio">
        <input {!! $params->basicOptions([
            'class' => 'custom-control-input',
            'type' => 'radio',
        ]) !!}>

        <label class="custom-control-label" for="{{ $params->get('id') }}">
            {{ $params->get('label') }}
        </label>
    </div>

@endif
