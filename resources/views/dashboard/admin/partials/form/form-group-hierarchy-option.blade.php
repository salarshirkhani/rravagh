<option  value="{{ $key }}" @if($key == old($name) || $key == ($value ?? null)) selected @endif>
    @for($i=0;$i<$level;$i++)&emsp;@endfor&#x2524;&#x2500; {{ $data['name'] }}
</option>
@foreach($data['children'] as $key2 => $data2)
    @include('dashboard.admin.partials.form.form-group-hierarchy-option', ['name' => $name, 'key' => $key2, 'data' => $data2, 'level' => $level + 1])
@endforeach
