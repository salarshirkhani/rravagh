<tr>
    <td><input type="text" class="form-control w-100" name="tags[{{ !empty($tag) ? $idx : 'IDX' }}][name]" value="{{ !empty($name) ? $name : (!empty($tag) ? $tag->name : '' )}}"></td>
    <td><button type="button" class="btn btn-xs btn-danger btn-remove-tag"><i class="fa fa-times"></i></button></td>
</tr>
