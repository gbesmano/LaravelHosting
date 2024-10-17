@props(['label', 'name', 'id', 'type' => 'text', 'placeholder' => '', 'value' => '', 'disabled' => false, 'min' => null, 'max' => null])

<div class="mb-3">
    <label for="{{ $id }}" class="form-label">{{ $label }}:</label>
    <input
        name="{{ $name }}"
        id="{{ $id }}"
        type="{{ $type }}"
        class="form-control mb-3 @error($name) is-invalid @enderror"
        placeholder="{{ $placeholder }}"
        value="{{ old($name, $value) }}"
        {{ $disabled ? 'disabled' : '' }}
        {{ $min !== null ? "min=$min" : '' }}
        {{ $max !== null ? "max=$max" : '' }}
    >
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
