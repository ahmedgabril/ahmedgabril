<div >
<div class="content-header">
        <div class="container-fluid">
          <div class="mb-2 row">
            <div class="col-sm-4">
              <h1 class="m-0">الخزنه</h1>
          
            </div><!-- /.col -->
            <div class="col-sm-8">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">اداره الخزنه</li> /
                
                <li class="breadcrumb-item"><a href="/2020">الرئسيه</a></li> 
                <li class="breadcrumb-item"><a href="{{ route('bransh') }}"> الفروع </a></li> 
                <li class="breadcrumb-item"><a href="{{ route('srores') }}"> المخازن</a></li> 
                 <li class="breadcrumb-item"><a href="{{ route('customer') }}"> العملاء</a></li> 
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
       
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
                      <button type="button"  wire:click.prevent="showmodel" class="btn btn-block btn-outline-success"><i class="fas fa-plus-circle"></i> اضافه خزنه </button>
                  </div>
           
                
              
                      <div class="input-group input-group-sm col-sm-4" style="margin-top:32px; border-right: 1px !important;">
                  
                        <input class="form-control form-control-navbar" wire:model.debounce.500ms="searsh" type="search" placeholder="بحث" aria-label="Search">
                    
                      </div>
 
       
          

       
         
            <div class="col-sm-3 form-group " style="margin-top:32px">
    
              <select class="custom-select" wire:model="orderby">
                  <option value="asc">من الاحدث </option>
                  <option value="desc">من الاقدم  </option>
                  
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
                    <th>اسم الخزنه</th>
                    <th>الفرع </th>
                    <th> التاريخ</th>

               
                    <th> <i class="fas fa-cogs"></i></th>

                  </tr>
                </thead>
                <tbody>
                    @forelse($data as $index => $getdata )
                  <tr>

                    <td>{{ $data->firstItem() + $index}}</td>
                    <td>{{ $getdata->drowers_name }}</td>
        
                    </td>
                    <td><a href="/2020/bransh?searsh={{$getdata->prensh->pre_name }}">{{  $getdata->prensh->pre_name }}</a></td>

                 

                    <td>{{ Str::substr($getdata->created_at,0, 10) }}</td>


                    <td style="display: none">{{ $getindex = $index }}</td>

                     <td>
                      <a href="#" data-target="#modal-showdes" data-toggle="modal" wire:click.prevent="showdes({{$getdata->id}})" ><i class="fa fa-eye text-primary"></i></a>
                       <a href="#" wire:click.prevent="edit({{$getdata->id}})" ><i class="fa fa-edit text-success"></i></a>
                       <a href="#" wire:click.prevent="getcurantid({{ $getdata->id }})"><i class="fas fa-trash text-danger"></i></a>

                      </td>
                  </tr>
                  @empty
                  <tr class="text-center" style="background-color: rgb(235 79 79)!important;">
                  <td colspan="5" style="height:33px"> 
                    <p class="text-center text-light"style="font-size:15px">لاتوجد  نتائج</p>

                    <img src="{{ asset('dist/img/empty.svg') }}" style= "width: 69px;
                                                     height: 33px;">
                  </td></tr>
                  @endforelse
                 
       
     
                </tbody>
          
              </table>
         
                <div class="mt-4 d-flex justify-content-sm-between">
                  <div class="col-sm-8">{{$data->links()}}</div>
                  <div class="col-sm-4 shows" style="font-size: 13px">
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
  <div class="modal fade"  wire:ignore.self id="modal-drowers" style="display: none;" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            @if (!$showmodelf)
            <h4 class="modal-title">اضافه بيانات خزنه جديد</h4>
            @else
            <h4 class="modal-title">تحديث بيانات خزنه </h4>

            @endif
            
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
          
              <form wire:submit.prevent="{{!$showmodelf ? 'add' :'updateone'}}">
                 <div class="row">
                <div class="col-sm-6 form-group">
         
                <input class="form-control @error("drowers_name")  is-invalid
                  
                @enderror" type="text" wire:model="drowers_name" placeholder="(اجبارى*)اسم الخزنه"/>
                @error('drowers_name')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             
                @enderror

                </div>
           
                <div class=" col-sm-6 form form-group" wire:ignore>

                    <select class="form-control select2bs4 select2 select2-hidden-accessible " data-placeholder="---"  wire:model="prensh_id" style="width: 100%;"  tabindex="-1" aria-hidden="true">
                       <option></option>
                      @foreach ($preansh as $getpreansh)
                      <option value="{{ $getpreansh->id }}" {{ $prensh_id ==  $getpreansh->id ? 'selected':'' }}> {{ $getpreansh->pre_name  }}</option> 
                      @endforeach
                    </select>

                </div>
                <div class=" gethandel col-sm-12">
                @error('prensh_id')
                <span class="text-danger">
                  {{$message}}
                </span>
                @enderror 
               </div>
      
               
   
                    
               

              
              <div class=" col-sm-12 form-group">

                    <textarea class="form-control"wire:model="drowers_des"   id="bransh" rows="5" placeholder="(اختيارى)ملاحظات"></textarea>
           
                </div>
         
          <div class="justify-content-sm-center modal-footer">
            @if (!$showmodelf)
            <button type="submit"  class="btn btn-primary"> <i class="ml-2 fa fa-save"></i> حفظ</button>
            @else
            <button type="submit"  class="btn btn-primary"> <i class="ml-2 fa fa-save"></i>    حفظ التغيرات</button>

            @endif

            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="ml-2 fa fa-times"></i> الغاء</button>
          </div>
        </div>
      </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  </div>
  <!--end model add-->
    <!--model show description -->
    <div class="modal fade"  wire:ignore.self id="modal-showdes" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
       
            <div class="modal-body">
            
                <form>
                   <div class="row">
                  <div class="col-sm-6 form-group">
                    <label for="">اسم العميل</label>

                
                  <input class="form-control" readonly type="text" wire:model="drowers_name" />
                 
                  </div>
                  <div class=" col-sm-6 form form-group" wire:ignore>
                    <label for="">اسم الفرع</label>

                      <select class="form-control select2 select2-hidden-accessible" disabled data-placeholder="---"  wire:model="prensh_id" style="width: 100%;"  tabindex="-1" aria-hidden="true">
                         <option></option>
                        @foreach ($preansh as $getpreansh)
                        <option value="{{ $getpreansh->id }}" {{ $prensh_id ==  $getpreansh->id ? 'selected':'' }}> {{ $getpreansh->pre_name  }}</option> 
                        @endforeach
                      </select>
  
                  </div>
           

                      
                  <div class="col-sm-12 form-group">
                    <label for="">رصيد الخزنه المتاح </label>

           
                      <input class="form-control" readonly type="text" wire:model="drowers_total_amount" />
  
                      </div>

                <div class=" col-sm-12 form-group">
                    <label for="">  ملاحظات </label>

  
                      <textarea class="form-control"wire:model="drowers_des" readonly  id="bransh" rows="5"></textarea>
             
                  </div>
           
            <div class="justify-content-sm-center modal-footer">
           
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="ml-2 fa fa-times"></i> الغاء</button>
            </div>
          </div>
        </form>
          </div>
          <!--modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    </div>
    <!--end model add-->
    
   
</div>
@push('styles')
    
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">

<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

<style>
    .gethandel{
    margin-top: auto;
    margin-right: auto;
    font-size: 13px;
    position: absolute;
    top: 63px;
    left: auto;
    right: 251px;
    }
    @media (max-width: 575px){
        .gethandel{
    margin-top: auto;
    margin-right: auto;
    font-size: 13px;
    position: absolute;
    top: 137px;
    left: auto;
    right: 9px;
 }
}
</style>
@endpush

@push('scripts')
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

<script>
    $(document).ready(function() {
      
  $('#modal-drowers').on('hidden.bs.modal',function () {
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
 
        @this.set("prensh_id", $(this).val());
       });
    });
    
  

window.addEventListener('add',function(event){
  $("#modal-drowers").modal("hide");
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
  $("#modal-drowers").modal("show");

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
        );
});

</script>
@endpush
