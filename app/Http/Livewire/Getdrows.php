<?php

namespace App\Http\Livewire;
use App\Models\drower;
use App\Models\loge;
use App\Models\prensh;
use Livewire\Component;

class Getdrows extends Component
{
    use \Livewire\WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['getval','delete'];
    protected $queryString = ['searsh'=> ['except' => '']];
 
    public $realidfordelete ;
    public $dispatechupdate = "add" ;
    public $showmodelf = false;
    public $globalids;  
    public $drowers_name,
    $drowers_total_amount,
    $drowers_des,
    $prensh_id,
    $searsh = null,
    $orderby="desc",
    $pagenate=10;
    public $getindex;
    public function render()
    {
        $drower = drower::query()
        ->with(['prensh'=> function($q){
            $q->select("pre_name","id");
        }])
        ->where("drowers_name","LIKE", "%" . $this->searsh . "%")

        ->orderBy("id",$this->orderby)
        ->latest()
        ->paginate($this->pagenate);
        return view('livewire.getdrows', ['data'=> $drower ,

        "counts" => drower::count(),
         "preansh" => prensh::paginate(),
         
    ]);

    }
    public function updatedsearsh(){

       $this->resetPage();
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'drowers_name' => 'required|unique:drowers',
            'prensh_id' => 'required',
        
        
        ],[

      "drowers_name.required" => "اسم الخزنه مطلوب",
      "drowers_name.unique" => "اسم الخزنه مسجل من قبل",
      "prensh_id.required" => "اسم الفرع مطلوب",
     


        ]);

    }
    public function showmodel($action = ""){
        $this->showmodelf=false;
  

     if($this->showmodelf==false){
        //$this->resetval();

        $this->dispatchBrowserEvent("show-model");
        $this->modeltitle = true;
     

  
     }
         
          
    }
    public function add(){
     
        $this->validate([
            'drowers_name' => 'required|unique:drowers',
            'prensh_id' => 'required',
        
        
        ],[

      "drowers_name.required" => "اسم الخزنه مطلوب",
      "drowers_name.unique" => "اسم الخزنه مسجل من قبل",
      "prensh_id.required" => "اسم الفرع مطلوب",
     


        ]);

   
        $drower = new drower();
        $drower->drowers_name = $this->drowers_name;
        $drower->drowers_des = $this->drowers_des;
   
        $drower->prensh_id = $this->prensh_id;
        $drower->save();
        $this->reset();
        //$this->resetval();
        $this->dispatchBrowserEvent("add",['message'=> "تمت  اضافه البيانات بنجاح 🙂"]);
        //$this->dispatchBrowserEvent("resid");

       // session()->flash("message", "تم اضافه بيانات الفرع  بنجاح ");
     
        $getlog = new loge();
        $getlog->loges_action_id =  $drower->id; 
        $getlog->loges_action_type =  "اضافه خزنه";
        $getlog->loges_action_by = auth()->user();
        $getlog->loges_action_des = "تم اضافه خزنه من قبل ".auth()->user();
        $getlog->save();
       return  redirect()->back();


    }

    
    public function edit($bid){
        $this->showmodelf= true;
        if($this->showmodelf){
            $this->dispatchBrowserEvent("show-model");
            $this->globalids = $bid;
            $getdata = drower::findOrFail($bid);
            $this->drowers_name = $getdata->drowers_name;
            $this->drowers_des = $getdata->drowers_des;
            $this->prensh_id = $getdata->prensh_id;
  
         
        }
        //
      
    }

    public function showdes($bid){
    
            $getdata = drower::findOrFail($bid);
            $this->drowers_name = $getdata->drowers_name;
            $this->drowers_des = $getdata->drowers_des;
            $this->prensh_id = $getdata->prensh_id;
            $this->drowers_total_amount =  number_format($getdata->drowers_total_amount,2);
   
    }

    public function updateone(){
        $this->validate([
            'drowers_name' => 'required|unique:drowers,drowers_name,'.$this->globalids,
            'prensh_id' => 'required',
        
        
        ],[

      "drowers_name.required" => "اسم الخزنه مطلوب",
      "drowers_name.unique" => "اسم الخزنه مسجل من قبل",
      "prensh_id.required" => "اسم الفرع مطلوب",
     


        ]);

      
       
      $updatedata = drower::findOrFail($this->globalids);
      $updatedata->drowers_name =   $this->drowers_name;
      $updatedata->drowers_des = $this->drowers_des;
      $updatedata->prensh_id = $this->prensh_id;
  
      $updatedata->save();
      $this->dispatchBrowserEvent("add",['message'=> "تمت  تحديث البيانات بنجاح 🙂"]);
      // session()->flash("message", "تم اضافه بيانات الفرع  بنجاح ");
      $this->resetval();

       $getlog = new loge();
       $getlog->loges_action_id =  $updatedata->id; 
       $getlog->loges_action_type =  "تعديل بيانات  خزنه";
       $getlog->loges_action_by = auth()->user();
       $getlog->loges_action_des = "تم اضافه التعديل  من قبل ".auth()->user();
       $getlog->save();

    }
    public function getcurantid($getcurantid){
    $this->realidfordelete = $getcurantid;
    $this->dispatchBrowserEvent("getconfirm",['title'=> 'هل انت متأكد ??','message'=> 'لن تتمكن من استرجاع البيانات مره اخرى !']);
  

    }
    public function delete(){

         
        drower::destroy($this->realidfordelete);
        $this->dispatchBrowserEvent("getdel",['message'=> "تمت  حذف  البيانات بنجاح 🙂"]);
        $getlog = new loge();
        $getlog->loges_action_id =  $this->realidfordelete; 
        $getlog->loges_action_type =  "حذف  بيانات خزنه";
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

        $this->drowers_name = "";
        $this->drowers_des = "";
        $this->prensh_id = "";


    }

}
