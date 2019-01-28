@component($group, ['params' => $params = new FormgroupParams($parameters)])
    <input
        type="{{ $params->type }}"
        name="{{ $params->name }}"
        id="{{ $params->id }}"
        class="{{ $params->class }}"
        value="{{ $params->all->value }}"
        >

@endcomponent
