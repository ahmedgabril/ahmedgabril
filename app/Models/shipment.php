<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shipment extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

public function customer(){
return $this->BelongsTo(customer::class,'customers_id');


  }
  public function genry(){
    return $this->BelongsTo(genry::class,'genries_id');
    
    
      }
      public function prensh(){
        return $this->BelongsTo(prensh::class,'prensh_id');
        
        
          } 
          public function store(){
            return $this->BelongsTo(store::class,'store_id');
            
            
              } 

}
