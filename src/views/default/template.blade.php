<div class="form-group">
    @include('formgroup::default.label')
    {{ $slot  }}
    @include('formgroup::default.error')
    @include('formgroup::default.hint')
</div>
