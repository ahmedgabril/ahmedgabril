<?php

namespace App\Http\Livewire;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use App\Models\shipment;
use App\Models\customer;
use App\Models\genry;
use App\Models\prensh;
use App\Models\store;
use App\Models\drower;
use Carbon\Carbon;


use Livewire\Component;

class Getsheepment extends Component
{
    use \Livewire\WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['getval','delete'];
    protected $queryString = ['searsh'=> ['except' => '']];
 
    public $realidfordelete ;
    public $dispatechupdate = "add" ;
    public $globalids; 
    public $showadd = true,
    
    $updatemode = false;
    

/////////shipment//////
  

  public
  $i,
  $gethandel ,
    $genries_id ,
    $customers_id  ,
    $customer_phone,
    $drowers_id,
    $prensh_id ,
    $store_id,
    $ship_consignee_name ,
    $ship_consignee_adress ,
    $ship_consignee_phone1 ,
    $ship_code_number ,
    $ship_date ,
    $ship_des ,
    $ship_consignee_phone2;
    /////////////shiptols////////
   public 
   $tol=[],
 
   //$sihptols_type=[] ,
    //$sihptols_count=[],
   // $sihptols_prodect_name=[] ,
    $sihptols_total_price ,
    $shipments_id ;
   
    /////////////
   public $searsh = null,
    $orderby="desc",
    $pagenate=10;
    public $getindex;
   
   
    public function  mount(){
        $this->ship_date =  Carbon::today(); 
   
     
    }
  
  public function addnewr(){
    $this->i ++ ;
//dd($this->tol);
   

  }

  public function delr($i){
       dd($i);
     // $this->i --;
      dd($this->tol);
    //unset($this->tols[$index]);
    //$this->tols= array_values($this->tols);
    //unset($this->tol[$index]);
 
   

   }
    public function render()
    {

        if($this->customers_id !== null){
            $this->getcustomerphone();

        }
     
        $sheepment = shipment::query()
        ->with(['genry'=>function($q){
           $q->select('gen_number','id');
        }])->with(['customer'=>function($q){
            $q->select('customer_name','customer_phone','id');
        }])->with(['prensh'=>function($q){
           $q->select('pre_name','id');
        }])->with(['store'=>function($q){
            $q->select('store_name','id');
         }])
    
   
        ->where("ship_consignee_phone1","LIKE", "%" . $this->searsh . "%")
        ->where("ship_consignee_phone2","LIKE", "%" . $this->searsh . "%")
        ->where("ship_code_number","LIKE", "%" . $this->searsh . "%")
        ->where("ship_consignee_name","LIKE", "%" . $this->searsh . "%")

        ->orderBy("id",$this->orderby)
        ->latest()
        ->paginate($this->pagenate);
        return view('livewire.getsheepment', ['data'=> $sheepment ,

        "counts" => shipment::count(),
         "customer" => customer::select('customer_name','customer_phone','id')->paginate(),
         "genry" => genry::select('gen_number','id')->paginate(),
         "prensh" => prensh::select('pre_name','id')->paginate(),
         "store" => store::select('store_name','id')->paginate(),
         "drower" => drower::select('drowers_name','id')->paginate(),


         
    ]);





    }
        
    public function updatedsearsh(){

       $this->resetPage();
    }
   public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'genries_id' => 'required',
            'customers_id' => 'required',
            'prensh_id' => 'required',
            'ship_code_number' => 'required|unique:shipments',
            'ship_consignee_name' => 'required',
            'ship_consignee_phone1' => 'required',
            'ship_date' => 'required',
            'ship_consignee_adress' => 'required',
            //'sihptols_prodect_name' => 'required|unique:sihptols',
            //'sihptols_count' => 'required',
            //'sihptols_type' => 'required',
            'sihptols_total_price' => 'required',

            

        ],[

      "genries_id.required" => "رقم الرحله مطلوب",
      "customers_id.required" => "اسم الراسل مطلوب",
      "prensh_id.required" => "اسم الفرع مطلوب",

      "ship_code_number.required" => "كود االفاتوره مطلوب",
      "ship_code_number.unique" => "كود الفاتوره مسجل من قبل",
      "ship_consignee_name.required" => "اسم المرسل اليه مطلوب",
      "ship_consignee_phone1.required" => "تليفون المرسل اليه مطلوب",
      "ship_consignee_adress.required" => "عنوان المرسل اليه مطلوب",
      "ship_date.required" => "تاريخ الفاتوره مطلوب",
      //"sihptols_prodect_name.required" => "اسم المنتج مطلوب",
     // "sihptols_prodect_name.unique" => "اسم المنتج مسجل من قيل",

      //"sihptols_count.required" => "  العدد او الكميه مطلوب",
      //"sihptols_type.required" => "  نوع الصنف مطلوب",
      "sihptols_total_price.required" => "  اجالى سعر الفاتوره مطلوب",




        ]);

    }
    public function getcustomerphone(){

      $getv = customer::where('id',$this->customers_id)->select("customer_phone")->first();
 
             $this->customer_phone = $getv->customer_phone;

     
    }
   
    public function add(){
        dd($this->tol);
        //dd($this->i);
     
       /* $this->validate([
            'genries_id' => 'required',
            'customers_id' => 'required',
            'prensh_id' => 'required',
            'ship_code_number' => 'required|unique:shipments',
            'ship_consignee_name' => 'required',
            'ship_consignee_phone1' => 'required',
            'ship_date' => 'required',
            'ship_consignee_adress' => 'required',
           // 'sihptols_prodect_name' => 'required|unique:sihptols',
            //'sihptols_count' => 'required',
            //'sihptols_type' => 'required',
            'sihptols_total_price' => 'required',


        ],[

      "genries_id.required" => "رقم الرحله مطلوب",
      "customers_id.required" => "اسم الراسل مطلوب",
      "prensh_id.required" => "اسم الفرع مطلوب",

      "ship_code_number.required" => "كود االفاتوره مطلوب",
      "ship_code_number.unique" => "كود الفاتوره مسجل من قبل",
      "ship_consignee_name.required" => "اسم المرسل اليه مطلوب",
      "ship_consignee_phone1.required" => "تليفون المرسل اليه مطلوب",
      "ship_consignee_adress.required" => "عنوان المرسل اليه مطلوب",
      "ship_date.required" => "تاريخ الفاتوره مطلوب",
     // "sihptols_prodect_name.required" => "اسم المنتج مطلوب",
     // "sihptols_prodect_name.unique" => "اسم المنتج مسجل من قيل",

      //"sihptols_count.required" => "  العدد او الكميه مطلوب",
      //"sihptols_type.required" => "  نوع الصنف مطلوب",
      "sihptols_total_price.required" => "  اجالى سعر الفاتوره مطلوب",



        ]);
        
 */

   
     /*   $genry = new genry();
        $genry->gen_number = $this->gen_number;
        $genry->gen_date_start = $this->gen_date_start;
        $genry->gen_date_end = $this->gen_date_end;
        $genry->gen_des	 = $this->gen_des	;
        $genry->prensh_id = $this->prensh_id;
        $genry->save();
       // $this->reset();
        $this->resetval();
        $this->dispatchBrowserEvent("add",['message'=> "تمت  اضافه البيانات بنجاح 🙂"]);
        //$this->dispatchBrowserEvent("resid");

       // session()->flash("message", "تم اضافه بيانات الفرع  بنجاح ");
     
        $getlog = new loge();
        $getlog->loges_action_id =  $genry->id; 
        $getlog->loges_action_type =  "اضافه رحله";
        $getlog->loges_action_by = auth()->user();
        $getlog->loges_action_des = "تم اضافه رحله من قبل ".auth()->user();
        $getlog->save();
       return  redirect()->back();
 */
    }
    
   


  /*  
    public function edit($bid){
        $this->showmodelf= true;
        if($this->showmodelf){
            $this->dispatchBrowserEvent("show-model");
            $this->globalids = $bid;
            $getdata = genry::findOrFail($bid);
            $this->gen_number = $getdata->gen_number;
            $this->gen_date_start = $getdata->gen_date_start;
            $this->gen_date_end = $getdata->gen_date_end;
            $this->prensh_id = $getdata->prensh_id;
            $this->gen_des =  $getdata->gen_des;
            $this->gen_status =  $getdata->gen_status;

  
         
        }
        //
      
    }


    public function showdes($bid){
    
        $getdata = genry::findOrFail($bid);
        $this->gen_number = $getdata->gen_number;
        $this->gen_date_start = $getdata->gen_date_start;
        $this->gen_date_end = $getdata->gen_date_end;
        $this->prensh_id = $getdata->prensh_id;
        $this->gen_des =  $getdata->gen_des;
        $this->gen_status =  $getdata->gen_status;
   
    }

    public function updateone(){
        $this->validate([
            'gen_number' => 'required|unique:genries,gen_number,'.$this->globalids,
            'gen_date_start' => 'required',
            'prensh_id' => 'required',

        
        
        ],[

      "gen_number.required" => "رقم الرحله مطلوب",
      "gen_number.unique" => "رقم الرحله مسجل من قبل",
      "gen_date_start.required" => "تاريخ  الرحله مطلوب ",

      "prensh_id.required" => "اسم الفرع مطلوب",
     


        ]);

      
       
      $updatedata = genry::findOrFail($this->globalids);
      $updatedata->gen_number =   $this->gen_number;
      $updatedata->gen_des = $this->gen_des;
      $updatedata->gen_date_start = $this->gen_date_start;
      $updatedata->prensh_id = $this->prensh_id;
     $updatedata->gen_status  = $this->gen_status; 


       if(  $updatedata->gen_status == 2){
        $updatedata->gen_date_end = Carbon::today();

       }else {
        $updatedata->gen_date_end = null;
       }
      
 
      $updatedata->save();
      $this->dispatchBrowserEvent("add",['message'=> "تمت  تحديث البيانات بنجاح 🙂"]);
      // session()->flash("message", "تم اضافه بيانات الفرع  بنجاح ");
      $this->resetval();

       $getlog = new loge();
       $getlog->loges_action_id =  $updatedata->id; 
       $getlog->loges_action_type =  "تعديل بيانات  رحله";
       $getlog->loges_action_by = auth()->user();
       $getlog->loges_action_des = "تم اضافه التعديل  من قبل ".auth()->user();
       $getlog->save();

    }
    public function getcurantid($getcurantid){
    $this->realidfordelete = $getcurantid;
    $this->dispatchBrowserEvent("getconfirm",['title'=> 'هل انت متأكد ??','message'=> 'لن تتمكن من استرجاع البيانات مره اخرى !']);
  

    }
    public function delete(){

         
        genry::destroy($this->realidfordelete);
        $this->dispatchBrowserEvent("getdel",['message'=> "تمت  حذف  البيانات بنجاح 🙂"]);
        $getlog = new loge();
        $getlog->loges_action_id =  $this->realidfordelete; 
        $getlog->loges_action_type =  "حذف  بيانات رحله";
        $getlog->loges_action_by = auth()->user();
        $getlog->loges_action_des = "تمت عمليه الحذف من قبل ".auth()->user();
        $getlog->save();
    }
    
    

    public function getval()
    {
        $this->resetval();
        $this->resetErrorBag();
        $this->resetValidation();
       
    }
    public function resetval(){

        $this->gen_number = "";
        $this->gen_status = "";
        $this->prensh_id = "";
        $this->gen_date_start = "";
        $this->gen_des = "";
        $this->gen_date_end = "";


    }
   */
}
