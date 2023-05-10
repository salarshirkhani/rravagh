<div class="modal fade show" id="modal-lg" aria-modal="true" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">تغییر وضعیت کاربری</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <x-card type="info">
      <form style="padding:10px;" action="{{ route('dashboard.admin.users.changerole') }}" method="post" role="form" class="form-horizontal " enctype="multipart/form-data">
        <x-select-group name="role" label="وضعیت کاربر" required :model="$model ?? null">
              <x-select-item value="buyer">کاربر عادی</x-select-item>
              <x-select-item value="seller">خریدار عمده</x-select-item>
              <x-select-item value="teacher">مدرس</x-select-item>
        </x-select-group>         
        <input type="hidden"  name="user_id" value="{{$user->id}}" >    

          {{ csrf_field() }}
           <x-card-footer>
           </x-card-footer>
          
       </x-card>

      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
        <button type="submit"  class="btn btn-primary toastrDefaultInfo">اضافه کردن</button>
      </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
