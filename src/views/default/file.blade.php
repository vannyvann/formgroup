@if($params = new Vannyvann\Formgroup\FormgroupParams($params, $errors, $options, $config))

    @component('formgroup::default.template', compact('params'))
        <br>
        <input {!! $params->basicOptions(['type' => 'file']) !!}>
    @endcomponent

@endif
