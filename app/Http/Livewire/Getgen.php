<?php

namespace App\Http\Livewire;
use Carbon\Carbon;
use App\Models\genry;
use App\Models\loge;
use App\Models\prensh;
use Livewire\Component;

class Getgen extends Component
{
    use \Livewire\WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['getval','delete'];
    protected $queryString = ['searsh'=> ['except' => '']];
 
    public $realidfordelete ;
    public $dispatechupdate = "add" ;
    public $showmodelf = false;
    public $globalids;  
    public $gen_date_start;
    public $gen_date_end,

    $gen_status,
    $gen_number ,
    $gen_des,
    $prensh_id,
    $searsh = null,
    $orderby="desc",
    $pagenate=10;
    public $getindex;
    public function mount(){
    $this->gen_date_start = Carbon::today();

    }
    public function render()
    {
        $genry = genry::query()
        ->with(['prensh'=> function($q){
            $q->select("pre_name","id");
        }])
        ->where("gen_number","LIKE", "%" . $this->searsh . "%")

        ->orderBy("id",$this->orderby)
        ->latest()
        ->paginate($this->pagenate);
        return view('livewire.getgen', ['data'=> $genry ,

        "counts" => genry::count(),
         "getpre" => prensh::get(),
         
    ]);

    }
    public function updatedsearsh(){

       $this->resetPage();
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'gen_number' => 'required|unique:genries',
            'gen_date_start' => 'required',
            'prensh_id' => 'required',

        
        
        ],[

      "gen_number.required" => "رقم الرحله مطلوب",
      "gen_number.unique" => "رقم الرحله مسجل من قبل",
      "gen_date_start.required" => "تاريخ  الرحله مطلوب ",

      "prensh_id.required" => "اسم الفرع مطلوب",
     


        ]);

    }
    public function showmodel(){
        $this->showmodelf=false;
  
   
     if($this->showmodelf==false){
   

        $this->dispatchBrowserEvent("show-model");
        $this->modeltitle = true;
     
        $getid =genry::orderBy('id',"desc")->first();
        if($getid !== null){
            $this->gen_number = $getid->gen_number+1;

        }else {
            $this->gen_number = $this->gen_number;
        }
  
     }
         
          
    }
    public function add(){
        $this->validate([
            'gen_number' => 'required|unique:genries',
            'gen_date_start' => 'required',
            'prensh_id' => 'required',

        
        
        ],[

      "gen_number.required" => "رقم الرحله مطلوب",
      "gen_number.unique" => "رقم الرحله مسجل من قبل",
      "gen_date_start.required" => "تاريخ  الرحله مطلوب ",
      "prensh_id.required" => "اسم الفرع مطلوب",
     


        ]);
   
        $genry = new genry();
        $genry->gen_number = $this->gen_number;
        $genry->gen_date_start = $this->gen_date_start;
        
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


    }

    
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
}
