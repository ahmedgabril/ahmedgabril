<?php

namespace App\Http\Livewire;
use App\Models\loge;
use App\Models\customer;
use App\Models\prensh;
use Livewire\Component;

class Handelcustomer extends Component
{
    use \Livewire\WithPagination;
        protected $paginationTheme = 'bootstrap';
        protected $listeners = ['getval','delete'];
        protected $queryString = ['searsh'=> ['except' => '']];
     
        public $realidfordelete ;
        public $dispatechupdate = "add" ;
        public $showmodelf = false;
        public $globalids;  
        public $customer_name,$customer_phone,
        $customer_phone2,
        $customer_des,
        $prenshes_id,
        $searsh = null,$orderby="desc",
        $pagenate=10;
        public $getindex;
        public function render()
        {
            $customer = customer::query()
            ->with(['prensh'=> function($q){
                $q->select("pre_name","id");
            }])
            ->where("customer_name","LIKE", "%" . $this->searsh . "%")
            ->Orwhere("customer_phone","LIKE", "%" . $this->searsh . "%")

            ->orderBy("id",$this->orderby)
            ->latest()
            ->paginate($this->pagenate);
            return view('livewire.handelcustomer', ['data'=> $customer ,
    
            "counts" => customer::count(),
             "preansh" => prensh::paginate(),
             
        ]);
   
        }
        public function updatedsearsh(){
    
           $this->resetPage();
        }
        public function updated($propertyName)
        {
            $this->validateOnly($propertyName, [
                'customer_name' => 'required|unique:customers',
                'prenshes_id' => 'required',
                'customer_phone' => 'required'
            
            ],[
    
          "customer_name.required" => "اسم العميل مطلوب",
          "customer_name.unique" => "اسم العميل مسجل من قبل",
          "prenshes_id.required" => "اسم الفرع مطلوب",
          "customer_phone.required" => " رقم الموبايل مطلوب",

    
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
                'customer_name' => 'required|unique:customers',
                'prenshes_id' => 'required',
                'customer_phone' => 'required'
            
            ],[
    
          "customer_name.required" => "اسم العميل مطلوب",
          "customer_name.unique" => "اسم العميل مسجل من قبل",
          "prenshes_id.required" => "اسم الفرع مطلوب",
          "customer_phone.required" => " رقم الموبايل مطلوب",

    
            ]);
    
       
           
            $customer = new customer();
            $customer->customer_name = $this->customer_name;
            $customer->customer_des = $this->customer_des;
            $customer->customer_phone = $this->customer_phone;
            $customer->customer_phone2 = $this->customer_phone2;
            $customer->prenshes_id = $this->prenshes_id;

            $customer->save();
            //$this->reset();
            $this->resetval();
            $this->dispatchBrowserEvent("add",['message'=> "تمت  اضافه البيانات بنجاح 🙂"]);
            //$this->dispatchBrowserEvent("resid");

           // session()->flash("message", "تم اضافه بيانات الفرع  بنجاح ");
         
            $getlog = new loge();
            $getlog->loges_action_id =  $customer->id; 
            $getlog->loges_action_type =  "اضافه عميل جديد";
            $getlog->loges_action_by = auth()->user();
            $getlog->loges_action_des = "تم اضافه عميل من قبل ".auth()->user();
            $getlog->save();
           return  redirect()->back();
    
    
        }
        
        public function edit($bid){
            $this->showmodelf= true;
            if($this->showmodelf){
                $this->dispatchBrowserEvent("show-model");
                $this->globalids = $bid;
                $getdata = customer::findOrFail($bid);
                $this->customer_name = $getdata->customer_name;
                $this->customer_des = $getdata->customer_des;
                $this->prenshes_id = $getdata->prenshes_id;
                $this->customer_phone = $getdata->customer_phone;
                $this->customer_phone2 = $getdata->customer_phone2;
             
            }
            //
          
        }
    
        public function showdes($bid){
        
                $getdata = customer::findOrFail($bid);
                $this->customer_name = $getdata->customer_name;
                $this->customer_des = $getdata->customer_des;
                $this->prenshes_id = $getdata->prenshes_id;
                $this->customer_phone = $getdata->customer_phone;
                $this->customer_phone2 = $getdata->customer_phone2;
       
        }
    
        public function updateone(){
            $this->validate([
                'customer_name' => 'required|unique:customers,customer_name,'.$this->globalids,
                'prenshes_id' => 'required',
                'customer_phone' => 'required'
            
            ],[
    
          "customer_name.required" => "اسم العميل مطلوب",
          "customer_name.unique" => "اسم العميل مسجل من قبل",
          "prenshes_id.required" => "اسم الفرع مطلوب",
          "customer_phone.required" => " رقم الموبايل مطلوب",

    
            ]);
    
          
           
          $updatedata = customer::findOrFail($this->globalids);
          $updatedata->customer_name =   $this->customer_name;
          $updatedata->customer_des = $this->customer_des;
          $updatedata->prenshes_id = $this->prenshes_id;
          $updatedata->customer_phone = $this->customer_phone;
          $updatedata->customer_phone2 = $this->customer_phone2;


      
          $updatedata->save();
          $this->dispatchBrowserEvent("add",['message'=> "تمت  تحديث البيانات بنجاح 🙂"]);
          // session()->flash("message", "تم اضافه بيانات الفرع  بنجاح ");
          $this->resetval();

           $getlog = new loge();
           $getlog->loges_action_id =  $updatedata->id; 
           $getlog->loges_action_type =  "تعديل بيانات  عميل";
           $getlog->loges_action_by = auth()->user();
           $getlog->loges_action_des = "تم اضافه التعديل  من قبل ".auth()->user();
           $getlog->save();
    
        }
        public function getcurantid($getcurantid){
        $this->realidfordelete = $getcurantid;
        $this->dispatchBrowserEvent("getconfirm",['title'=> 'هل انت متأكد ??','message'=> 'لن تتمكن من استرجاع البيانات مره اخرى !']);
      
    
        }
        public function delete(){
    
             
            customer::destroy($this->realidfordelete);
            $this->dispatchBrowserEvent("getdel",['message'=> "تمت  حذف  البيانات بنجاح 🙂"]);
            $getlog = new loge();
            $getlog->loges_action_id =  $this->realidfordelete; 
            $getlog->loges_action_type =  "حذف  بيانات عميل";
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

            $this->customer_des = "";
            $this->customer_name = "";
            $this->prenshes_id = "";
            $this->customer_phone = "";
            $this->customer_phone2 = "";

        }
       
}
