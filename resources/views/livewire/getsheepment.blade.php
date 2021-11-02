<div>
   <div class="content-header">
        <div class="container-fluid">
          <div class="mb-2 row">
            <div class="col-sm-4">
              <h1 class="m-0">فواتير الشحن</h1>
          
            </div><!-- /.col -->
            <div class="col-sm-8">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active"> اداره فواتير الشحن </li> /
                
                <li class="breadcrumb-item"><a href="/2020">الرئسيه</a></li> 
                <li class="breadcrumb-item"><a href="{{ route('bransh') }}"> الفروع </a></li> 
                <li class="breadcrumb-item"><a href="{{ route('srores') }}"> المخازن</a></li> 
                 <li class="breadcrumb-item"><a href="{{ route('customer') }}"> العملاء</a></li> 
                  <li class="breadcrumb-item"><a href="{{ route('genry') }}"> الرحلاات</a></li> 

              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
  
             <div class=" col-sm-3 form-group" style="margin-top:32px;margin-right:2px">
                <button type="button"  wire:click.prevent="$toggle('showadd')=" class="btn btn-block btn-outline-success"><i class="fas fa-plus-circle"></i> 
                  @if ($updatemode)
                  تعديل  فاتوره 

                  @endif
                  اضافه فاتوره 
                
                </button>
            </div>
            @if ($showadd)
              
          
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
             </div>
             </div>
     
               <!-- /.row hadear -->   
            <div class="p-0 card-body " style="height: auto;">
        
      <form >
         <div class="row" style="margin:10px">
          <div class="text-center col-sm-12" style="margin-bottom: 30px"> <label for="" class="text-primary">بيانات الفاتوره</label></div>

          <div class="col-sm-6 form-group">
            <label>كود الفاتوره</label>

            <input class="form-control @error("ship_code_number")  is-invalid
              
            @enderror" type="number" wire:model="ship_code_number" placeholder="(اجبارى*)رقم  الفاتوره"/>
            @error('ship_code_number')
            <div class="invalid-feedback">
              {{$message}}
            </div>
         
            @enderror

            </div>
       

            <div   class=" col-sm-6 form-group" style="direction: ltr">
              <label>تاريخ الفاتوره مثال :<span class="text-danger">(01/07/2021)</span></label>

              <div class="input-group date" id="reservationdate" data-target-input="nearest">
                <input type="text"  wire:model="ship_date" class="form-control getval1 datetimepicker-input @error("ship_date")  is-invalid
                
              @enderror"
               data-target="#reservationdate">
          
                <div class="input-group-append" id="icondate" data-target="#reservationdate" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
              @error('ship_date')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             
                @enderror
            </div>
       
              </div>
         
        
           <div class=" col-sm-6 form form-group" wire:ignore>
            <label>اختر رقم الرحله</label>
               <div class="@error("genries_id")  is-invalid
              
               @enderror">
                <select class="form-control select2bs4 select2 select2-hidden-accessible genry " data-placeholder="---"  wire:model="genries_id" style="width: 100%;"  tabindex="-1" aria-hidden="true">
                   <option></option>
                  @foreach ($genry as $getgenry)
                  <option value="{{ $getgenry->id }}" {{ $genries_id ==  $getgenry->id ? 'selected':'' }}> {{ $getgenry->gen_number  }}</option> 
                  @endforeach
                </select>   
                @error('genries_id')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
                @enderror 
               </div>
    
        </div>

      
           
               <div class=" col-sm-6 form form-group" wire:ignore>
                <label>اختر اسم الفرع</label>
                <div class="@error("prensh_id")  is-invalid
              
                @enderror">
                   <select class="form-control select2bs4 select2 select2-hidden-accessible prenash " data-placeholder="---"  wire:model="prensh_id" style="width: 100%;"  tabindex="-1" aria-hidden="true">
                      <option></option>
                     @foreach ($prensh as $getpreansh)
                     <option value="{{ $getpreansh->id }}" {{ $prensh_id ==  $getpreansh->id ? 'selected':'' }}> {{ $getpreansh->pre_name  }}</option> 
                     @endforeach
                   </select>
                   @error('prensh_id')
                   <div class="invalid-feedback">
                    {{$message}}
                  </div>
                   @enderror 
          
                 </div>
               </div>
     
     
          


              <div class=" col-sm-6 form form-group" wire:ignore>
                <label>اختر اسم المخزن</label>
                <div class=" @error("store_id")  is-invalid
              
                @enderror">
                   <select class="form-control select2bs4 select2 select2-hidden-accessible store" data-placeholder="---"  wire:model="store_id" style="width: 100%;"  tabindex="-1" aria-hidden="true">
                      <option></option>
                     @foreach ($store as $getstore)
                     <option value="{{ $getstore->id }}" {{ $store_id ==  $getstore->id ? 'selected':'' }}> {{ $getstore->store_name  }}</option> 
                     @endforeach
                   </select>
                   @error('store_id')
                   <div class="invalid-feedback">
                    {{$message}}
                  </div>
                   @enderror 
                </div>
               </div>
           
             
         
              

              <div class=" col-sm-6 form form-group" wire:ignore>
                <label>اختر  الخزنه</label>
                <div class="@error("drowers_id")  is-invalid
              
                @enderror">
                   <select class="form-control select2bs4 select2 select2-hidden-accessible drower" data-placeholder="---"  wire:model="drowers_id" style="width: 100%;"  tabindex="-1" aria-hidden="true">
                      <option></option>
                     @foreach ($drower as $getdrower)
                     <option value="{{ $getdrower->id }}" {{ $drowers_id ==  $getdrower->id ? 'selected':'' }}> {{ $getdrower->drowers_name  }}</option> 
                     @endforeach
                   </select>
                   @error('drowers_id')
                   <div class="invalid-feedback">
                    {{$message}}
                  </div>
                   @enderror 
                </div>
               </div>
     
      
        
              <div class="text-center col-sm-12" style="margin-bottom: 30px"> <label for="" class="text-primary">بيانات الراسل</label></div>
            
              <div class=" col-sm-6 form form-group" wire:ignore>
                <label>اختر اسم العميل او الراسل</label>

             <div class=" border-1 border-red @error("customers_id") border border-danger  is-invalid
              
                @enderror">
                <select class="select2bs4 select2 select2-hidden-accessible" id="customer"  data-placeholder="---"  wire:model="customers_id" style="width: 100%;"  tabindex="-1" aria-hidden="true">
                   <option></option>
                  @foreach ($customer as $getcustomer)
                  <option  value="{{ $getcustomer->id }}" {{ $customers_id ==  $getcustomer->id ? 'selected':'' }}> {{ $getcustomer->customer_name  }}</option> 
                  @endforeach
                </select>
                @error('customers_id')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
                @enderror 
             </div>
            </div>
         

           <div class="col-sm-6 form-group">
            <label>موبايل العميل</label>
      
            <input class="form-control" type="number" wire:model="customer_phone" placeholder="(اختيارى)  رقم موبايل العميل"/>
            </div>
              
    <div class="text-center col-sm-12" style="margin-bottom: 30px"> <label for="" class="text-primary">بيانات المرسل اليه</label></div>
    <div class="col-sm-12 form-group">
      <label>اسم المرسل اليه </label>

      <input class="form-control @error("ship_consignee_name")  is-invalid
        
      @enderror" type="text" wire:model="ship_consignee_name" placeholder="(اجبارى*)اسم المرسل اليه  "/>
      @error('ship_consignee_name')
      <div class="invalid-feedback">
        {{$message}}
      </div>
   
      @enderror

      </div>
      <div class="col-sm-6 form-group">
        <label>موبايل اساسى</label>
  
        <input class="form-control @error("ship_consignee_phone1")  is-invalid
          
        @enderror" type="number" wire:model="ship_consignee_phone1" placeholder="(اجبارى*)  رقم الموبايل الاساسى"/>
        @error('ship_consignee_phone1')
        <div class="invalid-feedback">
          {{$message}}
        </div>
     
        @enderror
  
        </div>
        <div class="col-sm-6 form-group">
          <label>موبايل احتياطى</label>
    
          <input class="form-control" type="number" wire:model="ship_consignee_phone2" placeholder="(اختيارى)  رقم الموبايل الاحتياطى"/>
          </div>


          <div class=" col-sm-12 form-group">
            <label for=""> عنوان المرسل اليه </label>


              <textarea class="form-control @error("ship_consignee_adress")  is-invalid
          
              @enderror" wire:model="ship_consignee_adress"   id="bransh" rows="5" placeholder="العنوان)(*اجبارى))"></textarea>
              @error('ship_consignee_adress')
              <div class="invalid-feedback">
                {{$message}}
              </div>
           
              @enderror
          </div>
      <div class="text-center col-sm-12" style="margin-bottom: 30px"> <label for="" class="text-primary">  متعلقات الفاتوره</label></div>
        
      <div class="col-sm-12 form-group">
        <label>  اجمالى سعر الفاتوره  </label>

        <input class="form-control @error("sihptols_total_price")  is-invalid
          
        @enderror" type="number" wire:model="sihptols_total_price" placeholder="(اجبارى*)    اجمالى سعر الفاتوره"/>
        @error('sihptols_total_price')
        <div class="invalid-feedback">
          {{$message}}
        </div>
     
        @enderror

        </div>
         </div>
      </form>  
     
        <form  class="form repeater-default" style="margin: 15px ;padding: 5px;">




            <div data-repeater-list="group-a">
              

                <div data-repeater-item="" style="">
                  @for ($t= 0;$t<=$i; $t++)
 
                  <div class="row justify-content-between">
                   
                    <div class=" col-sm-4 form-group">
                      <label> اسم الصنف</label>
              
                      <input class="form-control @error("tol.sihptols_prodect_name")  is-invalid
                        
                      @enderror" type="text" wire:model="tol.sihptols_prodect_name.{{  $t }}" placeholder="(اجبارى*)  اسم الصنف او المنتج"/>
                      @error('tol.sihptols_prodect_name')
                      <div class="invalid-feedback">
                        {{$message}}
                      </div>
                   
                      @enderror
              
                      </div>
                      <div class=" col-sm-3 form-group">
                        <label>  الوحده </label>
                
                        <input class="form-control @error("tol.sihptols_type")  is-invalid
                          
                        @enderror" type="text" wire:model="tol.sihptols_type.{{  $t }}" placeholder="(اجبارى*)  وحده الصنف"/>
                        @error('tol.sihptols_type')
                        <div class="invalid-feedback">
                          {{$message}}
                        </div>
                     
                        @enderror
                
                        </div>
                        <div class="col-sm-3 form-group">
                          <label>  العدد  </label>
                  
                          <input class="form-control @error("tol.sihptols_count")  is-invalid
                            
                          @enderror" type="number" wire:model="tol.sihptols_count.{{  $t }}" placeholder="(اجبارى*)  الكميه او العدد"/>
                          @error('tol.sihptols_count')
                          <div class="invalid-feedback">
                            {{$message}}
                          </div>
                       
                          @enderror
                  
                          </div>
                       @if($t !== 0)
                  
                        <div class="pt-4 col-sm-2 form-group d-flex align-items-center" style="margin-top:6px">
                          <button class="px-1 btn btn-danger text-nowrap"  wire:click.prevent="delr({{$t}})" type="button"> <i class="bx bx-x"></i>
                            حذف
                          </button>
                        </div>
                     @endif
                      </div>
               
                    
                      @endfor  
                        <hr>
                    </div>
                  </div>
                   
                  <div class="form-group">
                      <div class="p-0 col">
                        <button class="btn btn-primary" wire:click.prevent="addnewr"  type="button"><i class="bx bx-plus"></i>
                          اضافه
                        </button>
                      </div>
                    </div>

              </form> 
       
        
         <div class="justify-content-sm-center modal-footer">
           @if (!$updatemode)
           <button type="button" wire:click.prevent="{{!$updatemode ? 'add' :'updateone'}}" class="btn btn-primary"> <i class="ml-2 fa fa-save"></i> حفظ</button>
           <button type="button"  wire:click.prevent="{{!$updatemode ? 'add' :'updateone'}}"class="btn btn-success"> <i class="ml-2 fa fa-print "></i>  حفظ وطباعه</button>

           @else
           <button type="submit" wire:click.prevent="{{!$updatemode ? 'add' :'updateone'}}" class="btn btn-primary"> <i class="ml-2 fa fa-save"></i>    حفظ التغيرات</button>
           <button type="submit"  wire:click.prevent="{{!$updatemode ? 'add' :'updateone'}}" class="btn btn-success"> <i class="ml-2 fa fa-print"></i>  حفظ وطباعه</button>

           @endif

           <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="ml-2 fa fa-times"></i> الغاء</button>
         </div>
       </div>
 
    
    </div><!--end card -->
   </div>
       
   @else
                
          
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
              
           
                
              
                      <div class="input-group input-group-sm col-sm-4" style="margin-top:32px; border-right: 1px !important;">
                  
                        <input class="form-control form-control-navbar" wire:model.debounce.500ms="searsh" type="search" placeholder="بحث" aria-label="Search">
                    
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
                    <th> رقم الفاتوره</th>
                    <th>اسم الراسل</th>
                    
                    <th>اسم المرسل اليه</th>
                
                    <th> الرحله</th>
                     <th> الفرع</th>

                    <th> <i class="fas fa-cogs"></i></th>
                  </tr>

                </thead>
                <tbody>
                    @forelse($data as $index => $getdata )
                  <tr>

                    <td>{{ $data->firstItem() + $index}}</td>
                    <td>{{ $getdata->ship_code_number}}</td>
                    <td>{{ $getdata->customer->customer_name}}</td>
                     <td>{{ $getdata->ship_consignee_name}}</td>
                    <td>{{ $getdata->genry->gen_number}}</td>

                    <td><a href="/2020/bransh?searsh={{$getdata->prensh->pre_name }}">{{  $getdata->prensh->pre_name }}</a></td>


                     <td>
                      <a href="#" data-target="#modal-showdes" data-toggle="modal" wire:click.prevent="showdes({{$getdata->id}})" ><i class="fa fa-eye text-primary"></i></a>
                       <a href="#" wire:click.prevent="edit({{$getdata->id}})" ><i class="fa fa-edit text-success"></i></a>
                       <a href="#" wire:click.prevent="getcurantid({{ $getdata->id }})"><i class="fas fa-trash text-danger"></i></a>

                      </td>
                  </tr>
                  @empty
                  <tr class="text-center" style="background-color: rgb(235 79 79)!important;">
                  <td colspan="8" style="height:33px"> 
                    <p class="text-center text-light"style="font-size:15px">لاتوجد  نتائج</p>

                    <img src="{{ asset('dist/img/empty.svg') }}" style= "width: 69px; height: 33px;">
                                                   
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

  @endif

</div>
@push('styles')
    

<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">


@endpush

@push('scripts')

<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('dist/js/pages/jquery.repeater.min.js') }}"></script>
<script>
    $(document).ready(function() {
      
      $('#reservationdate').datetimepicker({
      format: 'yyy/MM/DD',
      locale :'Ar'
        });
  
 
       $('.select2').select2();
       
       $('.select2bs4').select2({
        theme: 'bootstrap4',
        placeholder: "---",
       // allowClear: true
       });
       
  
       
       Livewire.hook('message.processed', (message, component) => {
        $('.select2').select2();
       })
       $(".genry").on("change",function(){
      @this.set("genries_id", $(this).val());
     });
     $(".drower").on("change",function(){
      @this.set("drower_id", $(this).val());
     });
       $(".store").on("change",function(){
         @this.set("store_id", $(this).val());
          });
          $(".prenash").on("change",function(){
            @this.set("prensh_id", $(this).val());
            });
            $("#customer").on("change",function(){
            @this.set("customers_id", $(this).val());

            });
         
  
      $("#reservationdate").on("change.datetimepicker",function(){
      @this.set("ship_date", $('.getval1').val());
     });

       
    });
    
    $('.repeater-default').repeater({
    show: function () {
    $(this).slideDown();
  },
  hide: function (deleteElement) {
  
      $(this).slideUp(deleteElement);
  
  }
});
  
/*
window.addEventListener('add',function(event){

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
  $("#modal-genry").modal("show");

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
*/
</script>
@endpush