<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table='categories';



    public function announcements()
    {
        return $this->hasMany('App\Models\Announcement','category_id','id');
    }
}
