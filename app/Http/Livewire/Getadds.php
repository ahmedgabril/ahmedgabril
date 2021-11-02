<?php

namespace App\Http\Livewire;
use App\Models\addsimage;
use App\Models\loge;

use Livewire\Component;

class Getadds extends Component
{
  

    use \Livewire\WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['getval','delete'];
    protected $queryString = ['searsh'=> ['except' => '']];
 
    public $realidfordelete ;
    public $dispatechupdate = "add" ;
    public $showmodelf = false;
    public $globalids;  
   public
    $addsimages_title,
    $addsimages_url ,
    $addsimages_des,
    $status,
    $limte,

    $searsh = null,
    $orderby="desc",
    $pagenate=10;
    public $getindex;
 
    public function render()
    {
        $genry = addsimage::query()
    
        ->where("addsimages_title","LIKE", "%" . $this->searsh . "%")
        ->Orwhere("status","LIKE", "%" . $this->searsh . "%")


        ->orderBy("id",$this->orderby)
        ->latest()
        ->paginate($this->pagenate);
        return view('livewire.getadds', ['data'=> $genry ,

        "counts" => addsimage::count(),
      
         
    ]);

    }
    public function updatedsearsh(){

       $this->resetPage();
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'addsimages_title' => 'required|max:110',
            'addsimages_des' => 'required|max:500',
      

        
        
        ],[

      "addsimages_title.required" => "العنوان الرئيسى مطلوب",
      "addsimages_title.max" => "الحد الاقصى للحرف 110 حرف",
      "addsimages_des.required" => "نص الاعلان مطلوب",
      "addsimages_des.max" => "الحد الاقصى للحرف 500 حرف",


     
     


        ]);

    }
    public function showmodel(){
        $this->showmodelf=false;
  
   
     if($this->showmodelf==false){
   

        $this->dispatchBrowserEvent("show-model");
        $this->modeltitle = true;
     
  
     }
         
          
    }
    public function add(){
        $this->validate([
            'addsimages_title' => 'required|max:110',
            'addsimages_des' => 'required|max:500',
            

        
        
        ],[

      "addsimages_title.required" => "العنوان الرئيسى مطلوب",
      "addsimages_title.max" => "الحد الاقصى للحرف 110 حرف",
      "addsimages_des.required" => "نص الاعلان مطلوب",
      "addsimages_des.max" => "الحد الاقصى للحرف 500 حرف",


     
     


        ]);
   
        $addmessage = new addsimage();
        $addmessage->addsimages_title = $this->addsimages_title;
        $addmessage->addsimages_des = $this->addsimages_des;
        
        $addmessage->addsimages_url	= $this->addsimages_url	;
        $addmessage->status = $this->status;
        $addmessage->limte = $this->limte;

        $addmessage->save();
       $this->reset();
 
        $this->dispatchBrowserEvent("add",['message'=> "تمت  اضافه البيانات بنجاح 🙂"]);
        //$this->dispatchBrowserEvent("resid");

       // session()->flash("message", "تم اضافه بيانات الفرع  بنجاح ");
     
        $getlog = new loge();
        $getlog->loges_action_id =  $addmessage->id; 
        $getlog->loges_action_type =  "اضافه اعلان";
        $getlog->loges_action_by = auth()->user();
        $getlog->loges_action_des = "تم اضافه اعلان من قبل ".auth()->user();
        $getlog->save();
       return  redirect()->back();


    }

    
    public function edit($bid){
        $this->showmodelf= true;
        if($this->showmodelf){
            $this->dispatchBrowserEvent("show-model");
            $this->globalids = $bid;
            $addsimage = addsimage::findOrFail($bid);
            $this->addsimages_title = $addsimage->addsimages_title;
            $this->addsimages_des= $addsimage->addsimages_des;
            $this->addsimages_url= $addsimage->addsimages_url;
            $this->status = $addsimage->status;
            $this->limte =  $addsimage->limte;
      

 
         
        }
        //
      
    }


    public function showdes($bid){
    
        $addsimage = addsimage::findOrFail($bid);
        $this->addsimages_title = $addsimage->addsimages_title;
        $this->addsimages_des= $addsimage->addsimages_des;
        $this->addsimages_url= $addsimage->addsimages_url;
        $this->status = $addsimage->status;
        $this->limte =  $addsimage->limte;
   
    }

    public function updateone(){
        $this->validate([
            'addsimages_title' => 'required|max:110',
            'addsimages_des' => 'required|max:500',
            

        
        
        ],[

      "addsimages_title.required" => "العنوان الرئيسى مطلوب",
      "addsimages_title.max" => "الحد الاقصى للحرف 110 حرف",
      "addsimages_des.required" => "نص الاعلان مطلوب",
      "addsimages_des.max" => "الحد الاقصى للحرف 500 حرف",


     
     


        ]);
      
       
      $updatedata = addsimage::findOrFail($this->globalids);
      $updatedata->addsimages_title = $this->addsimages_title;
      $updatedata->addsimages_des = $this->addsimages_des;
      
      $updatedata->addsimages_url= $this->addsimages_url	;
      $updatedata->status = $this->status;
      $updatedata->limte = $this->limte;


      
 
      $updatedata->save();
      $this->dispatchBrowserEvent("add",['message'=> "تمت  تحديث البيانات بنجاح 🙂"]);
      // session()->flash("message", "تم اضافه بيانات الفرع  بنجاح ");
      //$this->resetval();

       $getlog = new loge();
       $getlog->loges_action_id =  $updatedata->id; 
       $getlog->loges_action_type =  "تعديل بيانات  اعلان";
       $getlog->loges_action_by = auth()->user();
       $getlog->loges_action_des = "تم اضافه التعديل  من قبل ".auth()->user();
       $getlog->save();

    }
    public function getcurantid($getcurantid){
    $this->realidfordelete = $getcurantid;
    $this->dispatchBrowserEvent("getconfirm",['title'=> 'هل انت متأكد ??','message'=> 'لن تتمكن من استرجاع البيانات مره اخرى !']);
  

    }
    public function delete(){

         
        addsimage::destroy($this->realidfordelete);
        $this->dispatchBrowserEvent("getdel",['message'=> "تمت  حذف  البيانات بنجاح 🙂"]);
        $getlog = new loge();
        $getlog->loges_action_id =  $this->realidfordelete; 
        $getlog->loges_action_type =  "حذف  بيانات اعلان";
        $getlog->loges_action_by = auth()->user();
        $getlog->loges_action_des = "تمت عمليه الحذف من قبل ".auth()->user();
        $getlog->save();
    }
    
    

    public function getval()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
       
    }
 
}
