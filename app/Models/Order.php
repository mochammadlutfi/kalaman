<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';
    protected $primaryKey = 'id';


    
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    
    public function project(){
        return $this->hasMany(Project::class, 'order_id');
    }

    public function paket(){
        return $this->belongsTo(Paket::class, 'paket_id');
    }
}
