@if($params = new Vannyvann\Formgroup\FormgroupParams($params, $errors, $options, $config))

    @component('formgroup::groups.default.template', compact('params'))
        <input {!! $params->basicOptions(['class' => 'form-control', 'type' => 'text']) !!}>
    @endcomponent

@endif
