@if($params = new Vannyvann\Formgroup\FormgroupParams($params, $errors, $options, $config))

    @component('formgroup::default.template', compact('params'))
        <select {!! $params->basicOptions(['class' => 'form-control']) !!}>
            @if($placeholder = $params->get('placeholder'))
                <option>{{ $placeholder }}</option>
            @endif

            @foreach ($params->get('options') as $value => $name)
                <option
                value="{{ $value }}"
                {{ $value === $params->get('value') ? 'selected' : '' }}>{{ $name }}</option>
            @endforeach
        </select>
    @endcomponent

@endif
