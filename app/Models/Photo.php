<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table='photos';

    protected $fillable=[
        'announcement_id',
        'file_patch'
    ];
    public function announcement()
    {
        return $this->belongsTo('App\Models\Photo','id','announcement_id');
    }


}
