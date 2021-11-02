<?php

namespace App\Http\Livewire;
use App\Models\loge;
use App\Models\prensh;
use App\Models\store;

use Livewire\Component;

class Stores extends Component
{
  
        use \Livewire\WithPagination;
        protected $paginationTheme = 'bootstrap';
        protected $listeners = ['getval','delete'];
        protected $queryString = ['searsh'=> ['except' => '']];
     
        public $realidfordelete ;
        public $dispatechupdate = "add" ;
        public $showmodelf = false;
        public $baranshid;  
        public $store_name,
        $store_des,$prenshes_id,$searsh = null,$orderby="desc",$pagenate=10;
        public $getindex;
        public function render()
        {
            $store = store::query()
            ->with(['prensh'=> function($q){
                $q->select("pre_name","id");
            }])
            ->where("store_name","LIKE", "%" . $this->searsh . "%")
            ->orderBy("id",$this->orderby)
            ->latest()
            ->paginate($this->pagenate);
            return view('livewire.stores', ['data'=> $store ,
    
            "counts" => store::count(),
             "preansh" => prensh::paginate(),
             
        ]);
   
        }
        public function updatedsearsh(){
    
           $this->resetPage();
        }
        public function updated($propertyName)
        {
            $this->validateOnly($propertyName, [
                'store_name' => 'required|unique:stores',
                'prenshes_id' => 'required'
            
            ],[
    
          "store_name.required" => "اسم المخزن مطلوب",
          "store_name.unique" => "اسم المخزن مسجل من قبل",
          "prenshes_id.required" => "اسم الفرع مطلوب",
    
            ]);
    
        }
        public function showmodel($action = ""){
            $this->showmodelf=false;
      

         if($this->showmodelf==false){
            $this->resetval();

            $this->dispatchBrowserEvent("show-model");
            $this->modeltitle = true;
         
    
      
         }
             
              
        }
        public function add(){
         
            $this->validate([
                'store_name' => 'required|unique:stores',
                'prenshes_id' => 'required'
            
            ],[
    
          "store_name.required" => "اسم المخزن مطلوب",
          "store_name.unique" => "اسم المخزن مسجل من قبل",
          "prenshes_id.required" => "اسم الفرع مطلوب",
    
            ]);
       
           
            $store = new store();
            $store->store_name = $this->store_name;
            $store->store_des = $this->store_des;
            $store->prenshes_id = $this->prenshes_id;
            $store->save();
            //$this->reset();
            $this->resetval();
            $this->dispatchBrowserEvent("add",['message'=> "تمت  اضافه البيانات بنجاح 🙂"]);
            //$this->dispatchBrowserEvent("resid");

           // session()->flash("message", "تم اضافه بيانات الفرع  بنجاح ");
         
            $getlog = new loge();
            $getlog->loges_action_id =  $store->id; 
            $getlog->loges_action_type =  "اضافه مخزن";
            $getlog->loges_action_by = auth()->user();
            $getlog->loges_action_des = "تم اضافه مخزن من قبل ".auth()->user();
            $getlog->save();
           return  redirect()->back();
    
    
        }
        
        public function edit($bid){
            $this->showmodelf= true;
            if($this->showmodelf){
                $this->dispatchBrowserEvent("show-model");
                $this->baranshid = $bid;
                $getdata = store::findOrFail($bid);
                $this->store_name = $getdata->store_name;
                $this->store_des = $getdata->store_des;
                $this->prenshes_id = $getdata->prenshes_id;
             
            }
            //
       
          
    
       
        
        }
    
    
        public function updateone(){
            $this->validate([
                'store_name' => 'required|unique:stores,store_name,'.$this->baranshid,
                 'prenshes_id' => 'required'
            ],[
    
        
                "store_name.required" => "اسم المخزن مطلوب",
                "store_name.unique" => "اسم المخزن مسجل من قبل",
                "prenshes_id.required" => "اسم الفرع مطلوب",
    
            ]);
          
           
          $updatedata = store::findOrFail($this->baranshid);
          $updatedata->store_name = $this->store_name;
          $updatedata->store_des = $this->store_des;
          $updatedata->prenshes_id = $this->prenshes_id;
       
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
    
             
            store::destroy($this->realidfordelete);
            $this->dispatchBrowserEvent("getdel",['message'=> "تمت  حذف  البيانات بنجاح 🙂"]);
            $getlog = new loge();
            $getlog->loges_action_id =  $this->realidfordelete; 
            $getlog->loges_action_type =  "حذف  بيانات مخزن";
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

            $this->store_des = "";
            $this->store_name = "";
            $this->prenshes_id = "";
        }
       
    
    }

