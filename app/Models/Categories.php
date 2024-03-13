<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pizza;

class Categories extends Model
{
    use HasFactory;
    protected $table='categories';
    protected $primaryKey='c_id';
    protected $fillable=['id','size','price'];

    public function pizza(){
        return $this->hasMany(Pizza::class,'id','id');
    }
}

