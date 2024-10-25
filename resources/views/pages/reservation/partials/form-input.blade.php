<div class="form-group row">
    <label for="{{ $name }}" class="col-sm-4 col-form-label">{{ $label }}</label>
    <div class="col-sm-8">
        <input type="{{ $type }}" class="form-control" id="{{ $name }}" name="{{ $name }}"
            value="{{ old($name, $value) }}" required @disabled($isDisabled)>
    </div>
</div>
