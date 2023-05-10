<div class="form-group">
    <label for="input_{{ $name }}">{{ $label }}</label>
    <select id="input_{{ $name }}" name="{{ $name }}" @if(($disabled ?? false))disabled @endif class="form-control @isset($class) {{ $class }} @endisset" @isset($multiple) multiple @endisset>
        <option value="">بدون پدر</option >
        @foreach($hierarchy as $key => $data)
        @include('dashboard.admin.partials.form.form-group-hierarchy-option', ['name' => $name, 'key' => $key, 'data' => $data, 'level' => 0])
        @endforeach
    </select>
</div>
