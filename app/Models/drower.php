<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class drower extends Model
{
    use HasFactory;

protected $guarded = [];
    public function prensh(){

        return $this->belongsTo(prensh::class,'prensh_id');
     
    }
}
