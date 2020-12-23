<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

use App\Models\Announcement as Model;


class AnnouncementRepository extends CoreRepository
{

    protected function getModelClass(){
        return Model::class;
    }
    public function getAllWithPaginate($limit,$request){

        $fields=[
            'id',
            'title',
            'user_id',
            'category_id',
            'description',
            'city',
            'price',
            'status',
            'created_at'
        ];

        $category_id=$this->checkInputSession($request,'category_id');
        $city=$this->checkInputSession($request,'city');
        $text=$request->input('searchText');

        $result=$this
            ->startConditions()
            ->select($fields)
            ->when($category_id, function ($result,$category_id) {
                session(['category_id' => $category_id]);
                $result->where('category_id', $category_id);

            })
            ->when($city, function ($result,$city) {
                session(['city' => $city]);
                $result->where('city', $city);
            })
            ->where('title','like','%'.$text.'%')
            ->where('status',1)
            ->orderBy('created_at','DESC')
            ->paginate($limit);


        return $result;

    }
    public function getAllCities(){
        $result=[];
        $string = file_get_contents("cities.json");
        $json_a = json_decode($string, true);
        foreach ($json_a as $value){
            $result[]=$value['name'];
        }
       sort($result);
       return $result;
    }

    public function getAnnouncement($id){
        return $this
            ->startConditions()
            ->with(['user','photos','category'])
            ->find($id);
    }

    public function getAllAnnouncements($userId){
        return $this
            ->startConditions()
            ->where('user_id',$userId)
            ->count();
    }

    function checkInputSession($request,$fieldName){
        $value=$request->input($fieldName);
        if($value=='all'){
            session([$fieldName => '']);
            return null;
        }
        if(empty($value)){
            $value=session($fieldName);
        }
        return $value;
    }


}

