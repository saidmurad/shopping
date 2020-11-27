<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $fillable = ['name' , 'description' , 'image' ];

    public function items()
    {
        return $this->hasMany('App\item');
    }

    public function delete()
    {
        // delete all related photos 
        $this->items()->delete();
       
        // delete the user
        return parent::delete();
    }
    
}
