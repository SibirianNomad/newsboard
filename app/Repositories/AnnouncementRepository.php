<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

use App\Models\Announcement as Model;
use Auth;

class AnnouncementRepository extends CoreRepository
{

    protected function getModelClass(){
        return Model::class;
    }
    public function getAllWithPaginate($limit,$request,$id=null){

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
        $text=$request->input('searchText');
        $status=$request->input('status');
        if($id==null){
            $city=$this->checkInputSession($request,'city');
            if($city==null && $id==null){
                if(isset(Auth::user()->city)){
                    $city=$userCity=Auth::user()->city;
                }
            }
        }else{
            $city=null;
        }

        $result=$this
            ->startConditions()
            ->select($fields)
            ->when($category_id, function ($result,$category_id) {
                session(['category_id' => $category_id]);
                $result->where('category_id', $category_id);

            })
            ->when($city, function ($result,$city) {
                session(['city' => $city]);
                if($city!='все'){
                    $result->where('city', $city);
                }
            })
            ->when($id==null,function ($result){
                $result->where('status', 1);
            })
            ->when($id,function ($result,$id){
                $result->where('user_id', $id);
            })
            ->when($status==1,function ($result){
                $result->where('status', 1);
            })
            ->when($status==2,function ($result){
                $result->where('status', 0);
            })
            ->where('title','like','%'.$text.'%')
            ->orderBy('created_at','DESC')
            ->paginate($limit);


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

