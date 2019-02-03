@if($params = new Vannyvann\Formgroup\FormgroupParams($params, $errors, $options, $config))

    @component('formgroup::default.template', compact('params'))

        @foreach ($params->get('options') as $value => $name)
            <div class="custom-control custom-checkbox">
                <input {!! $params->basicOptions([
                    'class' => 'custom-control-input',
                    'type' => 'checkbox',
                    'id' => $params->get('id') . $value,
                    'checked' => in_array($value, $params->get('checked')),
                    'value' => $value
                ]) !!}>

                <label class="custom-control-label" for="{{ $params->get('id') . $value }}">
                    {{ $name }}
                </label>
            </div>
        @endforeach

    @endcomponent

@endif
