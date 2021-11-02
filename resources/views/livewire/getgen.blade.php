<div style="margin-top:20px">
<div class="content-header">
        <div class="container-fluid">
          <div class="mb-2 row">
            <div class="col-sm-6">
              <h1 class="m-0">الرحلاات</h1>
          
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">اداره الرحلاات</li> /
                
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
                      <button type="button"  wire:click.prevent="showmodel" class="btn btn-block btn-outline-success"><i class="fas fa-plus-circle"></i> اضافه رحله </button>
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
                    <th> رقم الرحله</th>
                    <th>الفرع </th>
                    <th> التاريخ</th>

               
                    <th> <i class="fas fa-cogs"></i></th>

                  </tr>
                </thead>
                <tbody>
                    @forelse($data as $index => $getdata )
                  <tr>

                    <td>{{ $data->firstItem() + $index}}</td>
                    <td>{{ $getdata->gen_number }}</td>
        
                    </td>
                    <td><a href="/2020/bransh?searsh={{$getdata->prensh->pre_name }}">{{  $getdata->prensh->pre_name }}</a></td>

                 

                    <td>{{ $getdata->gen_date_start }}</td>


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
  <div class="modal fade"  wire:ignore.self id="modal-genry" style="display: none;" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            @if (!$showmodelf)
            <h4 class="modal-title">اضافه بيانات رحله جديد</h4>
            @else
            <h4 class="modal-title">تحديث بيانات رحله </h4>

            @endif
            
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
          
              <form wire:submit.prevent="{{!$showmodelf ? 'add' :'updateone'}}">
                 <div class="row">
                <div class="col-sm-6 form-group">
         
                <input class="form-control @error("gen_number")  is-invalid
                  
                @enderror" type="number" wire:model="gen_number" placeholder="(اجبارى*)رقم  الرحله"/>
                @error('gen_number')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             
                @enderror

                </div>
           
                <div class=" col-sm-6 form form-group" wire:ignore>

                    <select class="form-control select2bs4 select2 select2-hidden-accessible " data-placeholder="---"  wire:model="prensh_id" style="width: 100%;"  tabindex="-1" aria-hidden="true">
                       <option></option>
                      @foreach ($getpre as $getpreansh)
                      <option value="{{ $getpreansh->id }}" {{ $prensh_id ==  $getpreansh->id ? 'selected':'' }}> {{ $getpreansh->pre_name  }}</option> 
                      @endforeach
                    </select>

                </div>
                <div class="gethandel">
                @error('prensh_id')
                <span class="text-danger">
                  {{$message}}
                </span>
                @enderror 
               </div>
      
               
              
               <div   class=" col-sm-12 form-group" style="direction: ltr">
                <label>تاريخ الرحله مثال :<span class="text-danger">(01/07/1988)</span></label>

                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                  <input type="text"  wire:model="gen_date_start" class="form-control getval datetimepicker-input @error("gen_date_start")  is-invalid
                  
                @enderror"
                 data-target="#reservationdate">
            
                  <div class="input-group-append" id="icondate" data-target="#reservationdate" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
                                @error('gen_date_start')
                  <div class="invalid-feedback">
                    {{$message}}
                  </div>
               
                  @enderror
              </div>
         
                </div>
             @if ($showmodelf)
                <div class="col-sm-12 form-group " style="margin-top:32px">
    
              <select class="custom-select" wire:model="gen_status">
                  <option value="0" {{ $gen_status == '0'? 'selected':'' }}> قيد المراجعه </option>
                  <option value="1"  {{ $gen_status == '1'? 'selected':'' }}> فى الميناء  </option>
                   <option value="2"  {{ $gen_status == '2'? 'selected':'' }}> انتهت (تم التوصيل) </option>

                </select>
              </div>

        
         

            @endif
      
                <!-- /.input group -->
                      <div class=" col-sm-12 form-group">
                    <label for="">  ملاحظات </label>

  
                      <textarea class="form-control"wire:model="gen_des"   id="bransh" rows="5"></textarea>
             
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
                    <label for=""> رقم الرحله</label>

                
                  <input class="form-control" readonly type="text" wire:model="gen_number" />
                 
                  </div>
                  <div class=" col-sm-6 form form-group" wire:ignore>
                    <label for="">اسم الفرع</label>

                      <select class="form-control select2 select2-hidden-accessible" disabled data-placeholder="---"  wire:model="prensh_id" style="width: 100%;"  tabindex="-1" aria-hidden="true">
                         <option></option>
                        @foreach ($getpre as $getpreansh)
                        <option value="{{ $getpreansh->id }}" {{ $prensh_id ==  $getpreansh->id ? 'selected':'' }}> {{ $getpreansh->pre_name  }}</option> 
                        @endforeach
                      </select>
  
                  </div>
           

                      
                  <div class="col-sm-6 form-group">
                    <label for="">  تاريخ بدايه الرحله  </label>

           
                      <input class="form-control" readonly type="text" wire:model="gen_date_start" />
  
                      </div>
                        <div class="col-sm-6 form-group">
                    <label for="">  تاريخ انتهاء الرحله  </label>

           
                      <input class="form-control" readonly type="text" wire:model="gen_date_end" />
  
                      </div>
                <div class="col-sm-12 form-group " readonly style="margin-top:32px">
                        <label for=""> حاله الرحله  </label>

               <select class="custom-select" wire:model="gen_status" disabled>
                  <option value="0" {{ $gen_status == '0'? 'selected':'' }} > قيد المراجعه </option>
                  <option value="1"  {{ $gen_status == '1'? 'selected':'' }}> فى الميناء  </option>
                   <option value="2"  {{ $gen_status == '2'? 'selected':'' }}> انتهت (تم التوصيل) </option>

                </select>
              </div>
                <div class=" col-sm-12 form-group">
                    <label for="">  ملاحظات </label>

  
                      <textarea class="form-control"wire:model="gen_des" readonly  id="bransh" rows="5"></textarea>
             
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
    

<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">


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
      
  $('#modal-genry ,#modal-showdes').on('hidden.bs.modal',function () {
        livewire.emit('getval');
     
     });
     $('#reservationdate').datetimepicker({
      defaultDate: "2021/10/17",
      format: 'yyy/MM/DD',
      locale :'Ar'
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
       
        $("#reservationdate").on("change.datetimepicker",function(){
      
        @this.set("gen_date_start", $('.getval').val());
       });


       
    });
  

window.addEventListener('add',function(event){
  $("#modal-genry").modal("hide");
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

</script>
@endpush
<!--
$(function () {
  //Initialize Select2 Elements
  $('.select2').select2()

  //Initialize Select2 Elements
  $('.select2bs4').select2({
    theme: 'bootstrap4'
  })

  //Datemask dd/mm/yyyy
  $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
  //Datemask2 mm/dd/yyyy
  $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
  //Money Euro
  $('[data-mask]').inputmask()

  //Date picker
  $('#reservationdate').datetimepicker({
      format: 'L'
  });

  //Date and time picker
  $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

  //Date range picker
  $('#reservation').daterangepicker()
  //Date range picker with time picker
  $('#reservationtime').daterangepicker({
    timePicker: true,
    timePickerIncrement: 30,
    locale: {
      format: 'MM/DD/YYYY hh:mm A'
    }
  })
  //Date range as a button
  $('#daterange-btn').daterangepicker(
    {
      ranges   : {
        'Today'       : [moment(), moment()],
        'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month'  : [moment().startOf('month'), moment().endOf('month')],
        'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      startDate: moment().subtract(29, 'days'),
      endDate  : moment()
    },
    function (start, end) {
      $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
    }
  )

  //Timepicker
  $('#timepicker').datetimepicker({
    format: 'LT'
  })

  //Bootstrap Duallistbox
  $('.duallistbox').bootstrapDualListbox()

  //Colorpicker
  $('.my-colorpicker1').colorpicker()
  //color picker with addon
  $('.my-colorpicker2').colorpicker()

  $('.my-colorpicker2').on('colorpickerChange', function(event) {
    $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
  })

  $("input[data-bootstrap-switch]").each(function(){
    $(this).bootstrapSwitch('state', $(this).prop('checked'));
  })

})
// BS-Stepper Init
document.addEventListener('DOMContentLoaded', function () {
  window.stepper = new Stepper(document.querySelector('.bs-stepper'))
})

// DropzoneJS Demo Code Start
Dropzone.autoDiscover = false

// Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
var previewNode = document.querySelector("#template")
previewNode.id = ""
var previewTemplate = previewNode.parentNode.innerHTML
previewNode.parentNode.removeChild(previewNode)

var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
  url: "/target-url", // Set the url
  thumbnailWidth: 80,
  thumbnailHeight: 80,
  parallelUploads: 20,
  previewTemplate: previewTemplate,
  autoQueue: false, // Make sure the files aren't queued until manually added
  previewsContainer: "#previews", // Define the container to display the previews
  clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
})

myDropzone.on("addedfile", function(file) {
  // Hookup the start button
  file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
})

// Update the total progress bar
myDropzone.on("totaluploadprogress", function(progress) {
  document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
})

myDropzone.on("sending", function(file) {
  // Show the total progress bar when upload starts
  document.querySelector("#total-progress").style.opacity = "1"
  // And disable the start button
  file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
})

// Hide the total progress bar when nothing's uploading anymore
myDropzone.on("queuecomplete", function(progress) {
  document.querySelector("#total-progress").style.opacity = "0"
})

// Setup the buttons for all transfers
// The "add files" button doesn't need to be setup because the config
// `clickable` has already been specified.
document.querySelector("#actions .start").onclick = function() {
  myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
}
document.querySelector("#actions .cancel").onclick = function() {
  myDropzone.removeAllFiles(true)
}
// DropzoneJS Demo Code End -->