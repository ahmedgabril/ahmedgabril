<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class genry extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function prensh(){
   return $this->BelongsTo(prensh::class,'prensh_id');

    }
    public function shipment(){
        return $this->hasOne(shipment::class,'genries_id');
     
         }
}
