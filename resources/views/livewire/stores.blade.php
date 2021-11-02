<div>

    <div class="content-header">
        <div class="container-fluid">
          <div class="mb-2 row">
            <div class="col-sm-6">
              <h1 class="m-0">المخازن</h1>
          
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">اداره المخازن</li> /

                <li class="breadcrumb-item"><a href="/2020">الصفحه الرئسيه</a></li> 
                <li class="breadcrumb-item"><a href="{{ route('bransh') }}"> الفروع </a></li> 
                <li class="breadcrumb-item"><a href="{{ route('customer') }}"> العملاء</a></li> 

              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!--end header-->
      <div class="row">
        <div class="col-12">
          <div class="card" >
            <div class="card-header">
        
                <div class="row"> 
                  <div class="card-tools col-sm-12">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <!--
                      <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                      </button>-->
                    </div>
                  <div class=" col-sm-3 form-group" style="margin-top:32px">
                      <button type="button"  wire:click.prevent="showmodel" class="btn btn-block btn-outline-success"><i class="fas fa-plus-circle"></i> اضافه مخزن </button>
                  </div>
           
                
              
                      <div class="input-group input-group-sm col-sm-4" style="margin-top:32px; border-right: 1px !important;">
                  
                        <input class="form-control form-control-navbar" wire:model.debounce.500ms="searsh" type="search" placeholder="Search" aria-label="بحث">
                    
                      </div>
 
       
          

       
         
            <div class="col-sm-3 form-group " style="margin-top:32px">
    
              <select class="custom-select" wire:model="orderby">
                <option value="asc" {{ $orderby == 'asc'? 'selected':'' }}>من الاقدم </option>
                <option value="desc"  {{ $orderby == 'desc'? 'selected':'' }}>من الاحدث  </option>
                
                </select>
              </div>
              
              <div class="col-sm-2 form-group"style="margin-top:32px" >

                  <select class="custom-select" wire:model="pagenate">
                    <option selected>5</option>
                      <option >10</option>
                      <option> 20</option>
                      <option> 30</option>
                      <option> 100</option>
                      <option> 150</option>
                      <option> 200</option>


                    </select>
                  </div>

        
        
            
        
        
          </div>
     
               <!-- /.row hadear -->   
    
            </div>
        <!-- /.card hadear --> 
            <div class="p-0 card-body table-responsive" style="height: auto;">
              <table class="table table-head-fixed text-nowrap table-striped table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>المخزن</th>
                    <th>الفرع التابع له </th>
                    <th> ملاحظات</th>
                    <th> <i class="fas fa-cogs"></i></th>


                  
                  </tr>
                </thead>
                <tbody>
                    @forelse($data as $index => $getdata )
                  <tr>

                    <td>{{ $data->firstItem() + $index}}</td>
                    <td>{{ $getdata->store_name }}</td>
                    <td><a href="/2020/bransh?searsh={{$getdata->prensh->pre_name }}">{{  $getdata->prensh->pre_name }}</a></td>
                  
                    <td>{{ $getdata->store_des }}</td>
                    <td style="display: none">{{ $getindex = $index }}</td>


                     <td>
                       <a href="#" wire:click.prevent="edit({{$getdata->id}})" ><i class="fa fa-edit text-success"></i></a>
                       <a href="#" wire:click.prevent="getcurantid({{ $getdata->id }})"><i class="fas fa-trash text-danger"></i></a>

                      </td>
                  </tr>
                  @empty
                  <tr class="text-center" style="background-color: rgb(235 79 79)!important;">
                  <td colspan="6"style="height: 33px"> 
                    <p class="text-center text-light" style="font-size:16px" >لاتوجد  نتائج</p>

                    <img src="{{ asset('dist/img/empty.svg') }}">

                  </td></tr>
                  @endforelse
                 
       
     
                </tbody>
          
              </table>
         
                <div class="mt-4 d-flex justify-content-sm-between">
                  <div class="col-sm-8">{{$data->links()}}</div>
                  <div class="col-sm-4 shows" style="font-size: 13px;">
                   عرض <span class="text-success">{{ $data->firstItem() + $getindex}}</span> من اجمالى السجلات <span class="text-primary">{{ $counts }}</span>

                  </div>
         
              </div>
      
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
  <!--model add -->
  <div class="modal fade"  wire:ignore.self id="modal-store" style="display: none;" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            @if (!$showmodelf)
            <h4 class="modal-title">اضافه بيانات مخزن جديد</h4>
            @else
            <h4 class="modal-title">تحديث بيانات مخزن </h4>

            @endif
            
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
          
              <form wire:submit.prevent="{{!$showmodelf ? 'add' :'updateone'}}">
       
                <div class="form-group">
         
                <input class="form-control @error("store_name")  is-invalid 
                  
                @enderror" type="text" wire:model="store_name" placeholder="(اجبارى*)اسم المخزن"/>
                @error('store_name')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             
                @enderror

                </div>
           
                <div class="form-group" wire:ignore>
          
           
                    <select class="form-control select2bs4 select2 select2-hidden-accessible" data-placeholder="---"  wire:model="prenshes_id" style="width: 100%;"  tabindex="-1" aria-hidden="true">
                       <option></option>
                      @foreach ($preansh as $getpreansh)
                      <option value="{{ $getpreansh->id }}" {{ $prenshes_id ==  $getpreansh->id ? 'selected':'' }}> {{ $getpreansh->pre_name  }}</option> 
                      @endforeach
                    </select>

                </div>
                @error('prenshes_id')
                <div class="text-danger" style="margin-bottom: 10px;
                margin-top: -10px;">
                  {{$message}}
                </div>
                @enderror 
       
      
               

                <!-- /.form-group -->
       
              
              <div class="form-group">

                    <textarea class="form-control"wire:model="store_des"   id="bransh" rows="3" placeholder="(اختيارى)العنوان"></textarea>
                
       
         
                </div>
         
          <div class="justify-content-sm-center modal-footer">
            @if (!$showmodelf)
            <button type="submit"  class="btn btn-primary"> <i class="ml-2 fa fa-save"></i> حفظ</button>
            @else
            <button type="submit"  class="btn btn-primary"> <i class="ml-2 fa fa-save"></i>   التغيرات حفظ</button>

            @endif
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="ml-2 fa fa-times"></i> الغاء</button>
          </div>
        
      </form>
    </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  </div>
  <!--end model add-->


</div>
@push('styles')
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">

@endpush

@push('scripts')
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

<script>
    $(document).ready(function() {
      $('#modal-store').on('hidden.bs.modal',function () {
            livewire.emit('getval');
           
          
        });
       $('.select2').select2();
       
       $('.select2bs4').select2({
        theme: 'bootstrap4',
        placeholder: "---",
        allowClear: true
       });
       Livewire.hook('message.processed', (message, component) => {
        $('.select2').select2();
       })

       $(".select2bs4").on("change",function(){
 
        @this.set("prenshes_id", $(this).val());
       });
    });
    
  

window.addEventListener('add',function(event){
  $("#modal-store").modal("hide");
  //toastr.success(event.detail.message,"نجاح");
  Swal.fire({
  position: 'top-start',
  icon: 'success',
  title: event.detail.message,
  showConfirmButton: false,
  timer: 3000
});

}) ;
window.addEventListener('show-model',function(){
  $("#modal-store").modal("show");

}) ;
window.addEventListener("getconfirm",function(event){
      Swal.fire({
      title: event.detail.title,
      text: event.detail.message,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#28a745',
      cancelButtonColor: '#d33',
      confirmButtonText: 'نعم , اريد الحذف !'
    }).then((result) => {
      if (result.isConfirmed) {
      
        livewire.emit('delete')
      }
    })
});

window.addEventListener("getdel",function(event){

  Swal.fire(
          'تم الحذف!',
          event.detail.message,
          'success'
        )
});
/*
window.addEventListener('resid',function(){
  @this.set("prenshes_id", "");

}) ;*/
</script>
@endpush