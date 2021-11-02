<?php

namespace App\Http\Livewire;

use App\Models\loge;
use App\Models\prensh;
use GuzzleHttp\Psr7\Message;
use Livewire\Component;

class Bransh extends Component
{
    use \Livewire\WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['getval','delete'];
    protected $queryString = ['searsh'=> ['except' => '']];
    public $modeltitle ;
    public $realidfordelete ;
    public $dispatechupdate = "add" ;
    public $showmodelf = false;
    public $baranshid;  
    public $pre_name,$pre_authr,$pre_authr_phone,$address
    ,$pre_phone,$searsh = null,$orderby="desc",$pagenate=10;
    public $getindex;
    public function render()
    {
        $pransh = prensh::query()
        ->where("pre_name","LIKE", "%" . $this->searsh . "%")
        ->orderBy("id",$this->orderby)
        ->latest()
        ->paginate($this->pagenate);
        return view('livewire.bransh', ['data'=> $pransh ,

        "counts" => prensh::count(),
    ]);
    }
    public function updatedsearsh(){

       $this->resetPage();
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'pre_name' => 'required|unique:prenshes',
        
        ],[

      "pre_name.required" => "اسم الفرع مطلوب",
      "pre_name.unique" => "اسم الفرع مسجل من قبل",


        ]);

    }
    public function showmodel(){
        $this->showmodelf=false;
          
     if($this->showmodelf==false){
        
        $this->dispatchBrowserEvent("show-model");
        $this->modeltitle = "اضافه فرع جديد";
     
        $this->resetval();
  
     }else{
    
        $this->modeltitle = "تعديل فرع جديد";
    
      

     }
         
          
    }
    public function add(){
       
      
        $this->validate([
            'pre_name' => 'required|unique:prenshes',
        
        ],[

      "pre_name.required" => "اسم الفرع مطلوب",
      "pre_name.unique" => "اسم الفرع مسجل من قبل",


        ]);
       
        $bransh = new prensh();
        $bransh->pre_name = $this->pre_name;
        $bransh->pre_authr = $this->pre_authr;
        $bransh->pre_phone = $this->pre_phone;
        $bransh->pre_authr_phone = $this->pre_authr_phone;
        $bransh->address = $this->address;
        $bransh->save();
   
        $this->dispatchBrowserEvent("add",['message'=> "تمت  اضافه البيانات بنجاح 🙂"]);
       // session()->flash("message", "تم اضافه بيانات الفرع  بنجاح ");
        $this->resetval();
        $getlog = new loge();
        $getlog->loges_action_id =  $bransh->id; 
        $getlog->loges_action_type =  "اضافه فرع";
        $getlog->loges_action_by = auth()->user();
        $getlog->loges_action_des = "تم اضافه فرع من قبل ".auth()->user();
        $getlog->save();


    }
    public function edit($bid){
        $this->showmodelf= true;
        if($this->showmodelf){
            $this->dispatchBrowserEvent("show-model");
            $this->modeltitle = "تعديل بيانات الفرع";
            $this->baranshid = $bid;
            $getdata = prensh::findOrFail($bid);
            $this->pre_name = $getdata->pre_name;
            $this->pre_authr = $getdata->pre_authr;
            $this->pre_phone = $getdata->pre_phone;
            $this->pre_authr_phone = $getdata->pre_authr_phone;
            $this->address = $getdata->address;
        }
        //
   
      

   
    
    }


    public function updateone(){
          
        $this->validate([
            'pre_name' => 'required|unique:prenshes,pre_name,'.$this->baranshid,
        
        ],[

      "pre_name.required" => "اسم الفرع مطلوب",
      "pre_name.unique" => "اسم الفرع مسجل من قبل"


        ]);
      
       
      $updatedata = prensh::findOrFail($this->baranshid);
      $updatedata->pre_name = $this->pre_name;
      $updatedata->pre_authr = $this->pre_authr;
      $updatedata->pre_phone = $this->pre_phone;
      $updatedata->pre_authr_phone = $this->pre_authr_phone;
      $updatedata->address = $this->address;
      $updatedata->save();
      $this->dispatchBrowserEvent("add",['message'=> "تمت  تحديث البيانات بنجاح 🙂"]);
      // session()->flash("message", "تم اضافه بيانات الفرع  بنجاح ");
       $this->resetval();
       $getlog = new loge();
       $getlog->loges_action_id =  $updatedata->id; 
       $getlog->loges_action_type =  "تعديل بيانات  فرع";
       $getlog->loges_action_by = auth()->user();
       $getlog->loges_action_des = "تم اضافه التعديل  من قبل ".auth()->user();
       $getlog->save();

    }
    public function getcurantid($getcurantid){
    $this->realidfordelete = $getcurantid;
    $this->dispatchBrowserEvent("getconfirm",['title'=> 'هل انت متأكد ??','message'=> 'لن تتمكن من استرجاع البيانات مره اخرى !']);
  

    }
    public function delete(){

         
        prensh::destroy($this->realidfordelete);
        $this->dispatchBrowserEvent("getdel",['message'=> "تمت  حذف  البيانات بنجاح 🙂"]);
        $getlog = new loge();
        $getlog->loges_action_id =  $this->realidfordelete; 
        $getlog->loges_action_type =  "حذف  بيانات  فرع";
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
    $this->pre_authr = "";
    $this->pre_authr_phone = "";
    $this->pre_phone = "";
    $this->pre_name = "" ;
    $this->address = "" ;
    }

}
