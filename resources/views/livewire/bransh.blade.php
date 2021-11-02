<div>
    <div class="content-header">
        <div class="container-fluid">
          <div class="mb-2 row">
            <div class="col-sm-6">
              <h1 class="m-0">اداره الفروع</h1>
          
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">اداره الفروع</li> /
                
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
                        <button type="button"  wire:click.prevent="showmodel" class="btn btn-block btn-outline-success"><i class="fas fa-plus-circle"></i> اضافه فرع </button>
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
                      <th>الفرع</th>
                      <th>تليفون </th>
                      <th>مدير الفرع</th>
                      <th> العنوان</th>
                      <th> <i class="fas fa-cogs"></i></th>
 

                    
                    </tr>
                  </thead>
                  <tbody>
                     
                      @forelse($data as $index => $getdata )
                    <tr>

                      <td>{{ $data->firstItem() + $index}}</td>
                      <td>{{ $getdata->pre_name }}</td>
                      <td>{{ $getdata->pre_phone }}</td>
                      <td>{{ $getdata->pre_authr }}</td>
                      <td>{{ $getdata->address }}</td>
                      <td style="display: none">{{ $getindex = $index }}</td>


                       <td>
                         <a href="#" wire:click.prevent="edit({{$getdata->id}})" ><i class="fa fa-edit text-success"></i></a>
                         <a href="#" wire:click.prevent="getcurantid({{ $getdata->id }})"><i class="fas fa-trash text-danger"></i></a>

                        </td>
                    </tr>
                    @empty
                    <tr class="text-center" style="background-color: rgb(235 79 79)!important;">
                    <td colspan="6" style="height: 33px"> 
                      <p class="text-center text-light" >لاتوجد  نتائج</p>

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
    <div class="modal fade"  wire:ignore.self id="modal-default" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">{{ $modeltitle }}</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
            
                <form wire:submit.prevent="{{!$showmodelf ? 'add' :'updateone'}}">
        <div class="row">
             
                <div class="col-sm-6 form-group">
                  <input class="form-control @error("pre_name")  is-invalid 
                    
                  @enderror" type="text" wire:model="pre_name" placeholder="(اجبارى*)اسم الفرع"/>
                  @error('pre_name')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
               
                  @enderror
                </div>
                
                <div class="col-sm-6 form-group">
                    <input class="form-control" type="text" wire:model="pre_authr" placeholder=" (اختيارى)اسم مدير الفرع"/>
                  </div>
                  <div class="col-sm-6 form-group">
                    <input class="form-control" type="number" wire:model="pre_phone"  placeholder=" (اختيارى)تليفون الفرع "/>
                  </div>
                  <div class="col-sm-6 form-group">
                    <input class="form-control" type="number" wire:model="pre_authr_phone"  placeholder=" (اختيارى)....تليفون مدير الفرع "/>
                  </div>
                  <div class="col-sm-12 form-group">
                  

                      <textarea class="form-control"wire:model="address"   id="bransh" rows="3" placeholder="(اختيارى)العنوان"></textarea>
                  
                  </div>
           
        </div>
            </div>
            <div class="justify-content-sm-center modal-footer">
              
                <button type="submit"  class="btn btn-primary"> <i class="ml-2 fa fa-save"></i> حفظ</button>

              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="ml-2 fa fa-times"></i> الغاء</button>
            </div>
        </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    <!--end model add-->
</div>
@push('scripts')
   
<script>
   $(document).ready(function() {
      $('#modal-default').on('hidden.bs.modal',function () {
            livewire.emit('getval');
           
          
        });
   });
  window.addEventListener('add',function(event){
    $("#modal-default").modal("hide");
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
    $("#modal-default").modal("show");
  
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
  </script>
@endpush
