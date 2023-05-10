<div class="select_box">
    <x-select-group label="{{ $label }}" :model="$model ?? null" id="input_{{ $name }}" name="{{ $name }}">
        @foreach($options as $value => $text)
            <option value="{{ $value }}"
                    @if(old($name) == $value) selected @endif>{{ $text }}</option>
        @endforeach
    </x-select-group>
</div>
