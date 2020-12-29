<?php

namespace App\Models;

use Jenssegers\Date\Date;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Announcement extends Model
{
    protected $table='announcements';

    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'user_id',
        'title',
        'description',
        'city',
        'price',
        'status'
    ];
    public function getCreatedAtAttribute($valueFromObject)
    {
        if($valueFromObject==null){
            return null;
        }else{
            return Date::parse($valueFromObject)->format('d.m.Y h:m:s');
        }
    }
    public function category()
    {
        return $this->belongsTo('App\Models\Category','category_id','id');
    }
    public function user()
    {
        return $this->hasOne('App\Models\User','id','user_id');
    }
    public function photos()
    {
        return $this->hasMany('App\Models\Photo','announcement_id','id');
    }
    public static function getAllCities(){
        $result=[];
        $string = file_get_contents("cities.json");
        $json_a = json_decode($string, true);
        foreach ($json_a as $value){
            $result[]=$value['name'];
        }
        sort($result);
        return $result;
    }



}
