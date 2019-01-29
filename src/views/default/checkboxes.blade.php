@if($params = new Vannyvann\Formgroup\FormgroupParams($params, $errors, $options, $config))

    @component('formgroup::default.template', compact('params'))

        @foreach ($params->get('options') as $value => $name)
            <div class="custom-control custom-checkbox">
                <input {!! $params->basicOptions([
                    'class' => 'custom-control-input',
                    'type' => 'checkbox',
                    'id' => $name . $value,
                    'value' => $value,
                    'checked' => is_array($params->get('value')) && in_array($value, $params->get('value'))
                ]) !!}>

                <label class="custom-control-label" for="{{ $name . $value }}">
                    {{ $name }}
                </label>
            </div>
        @endforeach

    @endcomponent

@endif
