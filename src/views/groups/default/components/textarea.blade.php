@if($params = new Vannyvann\Formgroup\FormgroupParams($params, $errors, $options, $config))

    @component('formgroup::groups.default.template', compact('params'))
        <textarea {!! $params->basicOptions(['class' => 'form-control']) !!}>{{ $params->get('value') }}</textarea>
    @endcomponent

@endif
