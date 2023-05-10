<div class="contect_form3">
    <label>{{ $label }}</label>
    <textarea style="height: 6em" name="{{ $name }}" rows="{{ $rows ?? 5 }}">{{ old($name, $value ?? '') }}</textarea>
</div>
