<div style="margin-top:20px">
    <div class="content-header">
            <div class="container-fluid">
              <div class="mb-2 row">
                <div class="col-sm-4">
                  <h1 class="m-0">الاعلانات</h1>
              
                </div><!-- /.col -->
                <div class="col-sm-8">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">اداره الاعلانات</li> /
                    
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
                          <button type="button"  wire:click.prevent="showmodel" class="btn btn-block btn-outline-success"><i class="fas fa-plus-circle"></i> اضافه اعلان </button>
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
                        <th> عنوان الاعلان</th>
                        <th>حاله الاعلان </th>
                        
    
                   
                        <th> <i class="fas fa-cogs"></i></th>
    
                      </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $index => $getdata )
                      <tr>
    
                        <td>{{ $data->firstItem() + $index}}</td>
                        <td>{{ subStr($getdata->addsimages_title,0,30) }}</td>
            
                        </td>
    
                     
    
                        <td>
                          @if($getdata->status == 0)
                          <span class="badge bg-danger">غير مفعل </span>
                          @else 
                          <span class="badge bg-success"> مفعل </span>
                           @endif
                        </td>
           
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
                <h4 class="modal-title">اضافه بيانات اعلان  جديد</h4>
                @else
                <h4 class="modal-title">تحديث بيانات اعلان </h4>
    
                @endif
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
              
                  <form wire:submit.prevent="{{!$showmodelf ? 'add' :'updateone'}}">
                     <div class="row">
                      <div class=" col-sm-12 form-group">
                        <label for="">  عنوان الاعلان </label>
    
      
                          <textarea class="form-control @error("addsimages_title")  is-invalid  @enderror" wire:model="addsimages_title" placeholder=" [اجبارى ] الحد الاقصى للحروف 110"   id="bransh" rows="3"></textarea>
                          @error('addsimages_title')
                          <div class="invalid-feedback">
                            {{$message}}
                          </div>
                       
                          @enderror
                      </div>
                      <div class=" col-sm-12 form-group">
                        <label for="">الاعلان</label>
    
      
                          <textarea class="form-control @error("addsimages_des")  is-invalid  @enderror" wire:model="addsimages_des" placeholder="  نص الاعلان اجبارى [الحد الاقصى للحروف 500 حرف ]  "   id="bransh" rows="5"></textarea>
                          @error('addsimages_des')
                          <div class="invalid-feedback">
                            {{$message}}
                          </div>
                       
                          @enderror
                      </div>
             
             
  
                    <div class="col-sm-6 form-group" style="margin-top:32px">
                      <label for="">حد ظهور الاعلان</label>
                  <select class="custom-select" wire:model="limte">
                    
                      <option value="1"  {{ $limte == '1'? 'selected':'' }}>1 يوم</option>
                      <option value="2"  {{ $limte == '2'? 'selected':'' }}> 2 يوم </option>
                       <option value="3"  {{ $limte == '3'? 'selected':'' }}> 3 يوم</option>
                       <option value="4"  {{ $limte == '4'? 'selected':'' }}> اسبوع</option>

    
                    </select>
                  </div>

                  <div class="col-sm-6 form-group" style="margin-top:32px">
                    <label for=""> حاله الاعلان</label>
                <select class="custom-select" wire:model="status">
                  
               
                    <option value="1" selected {{ $status == '1'? 'selected':'' }}> مفعل </option>
                     <option value="0"  {{ $status == '0'? 'selected':'' }}> غير مفعل </option>
             

  
                  </select>
                </div>
            
             
    
          
          
                    <!-- /.input group -->
                   
               
               
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
              
               <div class="row">
                   <div class=" col-sm-12 form-group">
                        <label for="">  عنوان الاعلان </label>
    
      
                          <textarea class="form-control @error("addsimages_title")  is-invalid  @enderror" wire:model="addsimages_title" readonly placeholder=" [اجبارى ] الحد الاقصى للحروف 110"   id="bransh" rows="3"></textarea>
                          @error('addsimages_title')
                          <div class="invalid-feedback">
                            {{$message}}
                          </div>
                       
                          @enderror
                      </div>
                      <div class=" col-sm-12 form-group">
                        <label for="">الاعلان</label>
    
      
                          <textarea readonly  class="form-control @error("addsimages_des")  is-invalid  @enderror" wire:model="addsimages_des" placeholder="  نص الاعلان اجبارى [الحد الاقصى للحروف 500 حرف ]  "   id="bransh" rows="5"></textarea>
                          @error('addsimages_des')
                          <div class="invalid-feedback">
                            {{$message}}
                          </div>
                       
                          @enderror
                      </div>
             
             
  
                    <div class="col-sm-6 form-group" style="margin-top:32px">
                      <label for="">حد ظهور الاعلان</label>
                  <select class="custom-select" wire:model="limte" disabled>
                    
                      <option value="1"  {{ $limte == '1'? 'selected':'' }}>1 يوم</option>
                      <option value="2"  {{ $limte == '2'? 'selected':'' }}> 2 يوم </option>
                       <option value="3"  {{ $limte == '3'? 'selected':'' }}> 3 يوم</option>
                       <option value="4"  {{ $limte == '4'? 'selected':'' }}> اسبوع</option>

    
                    </select>
                  </div>

                  <div class="col-sm-6 form-group" style="margin-top:32px">
                    <label for=""> حاله الاعلان</label>
                <select class="custom-select" wire:model="status" disabled>
                  
               
                    <option value="1" selected {{ $status == '1'? 'selected':'' }}> مفعل </option>
                     <option value="0"  {{ $status == '0'? 'selected':'' }}> غير مفعل </option>
             

  
                  </select>
                </div>
            
             
    
                   
               
              <div class="justify-content-sm-center modal-footer">
         
    
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="ml-2 fa fa-times"></i> الغاء</button>
              </div>
          
                    <!-- /.input group -->
            
            
             </div>
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