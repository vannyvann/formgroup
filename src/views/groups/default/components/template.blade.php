<div class="form-group">
    @include('formgroup::groups.default.components.label')
    {{ $slot  }}
    @include('formgroup::groups.default.components.error')
    @include('formgroup::groups.default.components.hint')
</div>
