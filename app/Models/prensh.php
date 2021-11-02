<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prensh extends Model
{
    use HasFactory;
    protected $guarded =[];
    public function store(){

        return $this->hasOne(store::class,'prenshes_id');
    }
    /////////////////relation with customer ///////////////////
    public function customer(){

        return $this->hasOne(customer::class,'prenshes_id');
    }
    public function drower(){

        return $this->hasOne(drower::class,'prenshe_id');
    }
    public function genry(){

        return $this->hasOne(genry::class,'prensh_id');
    }
    public function shipment(){

        return $this->hasOne(shipment::class,'prensh_id');
    }
}
