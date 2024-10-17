@props(['label', 'name', 'id', 'options' => [], 'placeholder' => '', 'value' => '', 'disabled' => false])

<div class="mb-3">
    <label for="{{ $id }}" class="form-label">{{ $label }}:</label>

    <select 
        name="{{ $name }}" 
        id="{{ $id }}" 
        class="form-control mb-3 @error($name) is-invalid @enderror" 
        {{ $disabled ? 'disabled' : '' }}
    >
        <option value="">{{ $placeholder }}</option>
        @foreach ($options as $option)
            <option value="{{ $option->id ?? $option }}" 
                {{ old($name, $value) == ($option->id ?? $option) ? 'selected' : '' }}>
                {{ $option->name ?? $option }}
            </option>
        @endforeach
    </select>

    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
