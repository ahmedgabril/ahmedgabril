<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class store extends Model
{
    use HasFactory;
    protected $guarded =[];
    public function prensh(){
        return $this->belongsTo(prensh::class,'prenshes_id');
    }
    public function shipment(){

        return $this->hasOne(shipment::class,'store_id');
    }
    
}
