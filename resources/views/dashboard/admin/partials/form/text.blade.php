<div class="contect_form3">
    <label>{{ $label }}</label>
    <input type="{{ $type ?? 'text' }}" name="{{ $name }}" @isset($min) min="{{ $min }}" @endisset value="{{ ($type ?? 'text') == 'password' ? '' : old($name, $value ?? '') }}">
</div>
