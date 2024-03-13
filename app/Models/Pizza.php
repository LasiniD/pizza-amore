<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categories;

class Pizza extends Model
{
    use HasFactory;
    protected $table='pizza';
    protected $primaryKey='id';
    protected $fillable=['name','description'];

    public function category(){
        return $this->belongsTo(Categories::class);
    }
}
