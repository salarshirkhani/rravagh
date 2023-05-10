<div class="modal fade show" id="modal-lf" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">اضافه کردن محصول</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <x-card type="info">
        <form style="padding:10px;" action="{{ route('dashboard.admin.users.addorder') }}" method="post" role="form" class="form-horizontal " enctype="multipart/form-data">
            <input type="hidden"  name="status" value="byadmin" >    
            <input type="hidden"  name="user_id" value="{{$user->id}}" >    
            <x-select-group name="product_id" label="محصول" required :model="$model ?? null">
              @foreach($products as $category)
                  <x-select-item :value="$category->id">{{ $category->name }}</x-select-item>
              @endforeach
            </x-select-group>
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
  