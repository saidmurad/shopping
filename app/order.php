<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $fillable = ['user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function items()
    {
        return $this->belongsToMany('App\item')->withPivot('quantity', 'total')->withTimestamps();
    }

    

    public function deliveryLocations()
    {
        return $this->hasMany('App\deliveryLocation');
    }

    public function delete()
    {
        // delete all related items 
        $this->items()->delete();
        $this->deliveryLocations()->delete();
       
        // delete the user
        return parent::delete();
    }
}
