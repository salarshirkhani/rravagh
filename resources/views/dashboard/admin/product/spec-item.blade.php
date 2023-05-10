<tr>
    <td><input type="text" class="form-control w-100" name="specifications[{{ !empty($specification) ? $idx : 'IDX' }}][key]" value="{{ !empty($key) ? $key : (!empty($specification) ? $specification->key : '' )}}"></td>
    <td><input type="text" class="form-control w-100" name="specifications[{{ !empty($specification) ? $idx : 'IDX' }}][value]" value="{{ !empty($value) ? $value : (!empty($specification) ? $specification->value : '' )}}"></td>
    <td><button type="button" class="btn btn-xs btn-danger btn-remove-spec"><i class="fa fa-times"></i></button></td>
</tr>
