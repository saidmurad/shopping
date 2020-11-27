<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    protected $fillable = ['name' ,'category_id', 'description' , 'image','isDeleted','price','barcode','location' ];

    public function category()
    {
        return $this->belongsTo('App\category');
    }
    

    public function orders()
    {
        return $this->belongsToMany('App\order')->withPivot('quantity', 'total')->withTimestamps();
    }

    public function delete()
    {
        // delete all related photos 
        $this->orders()->delete();
       
        // delete the user
        return parent::delete();
    }
}
