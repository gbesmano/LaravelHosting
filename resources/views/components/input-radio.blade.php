@props(['name' => $name])
<div>
    @foreach($options as $option)
    <div>
        
        <input type="radio" name="{{ $name }}" value="{{ $option['value'] }}" class="form-check-input mb-3"> {{ $option['label'] }}
    </div>
    @endforeach
</div>
