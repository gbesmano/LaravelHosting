@props(['label', 'name', 'id', 'type' => 'text', 'placeholder' => '', 'value' => '', 'disabled' => false])

<div class="mb-3">
    <label for="{{ $id }}" class="form-label">{{ $label }}:</label>
    <textarea
        name="{{ $name }}"
        id="{{ $id }}"
        type="{{ $type }}"
        class="form-control mb-3 @error($name) is-invalid @enderror"
        placeholder="{{ $placeholder }}"
        {{ $disabled ? 'disabled' : '' }}
    >{{ old($name, $value) }}</textarea>
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
