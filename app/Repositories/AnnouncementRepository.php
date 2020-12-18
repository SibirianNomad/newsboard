<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

use App\Models\Announcement as Model;


class AnnouncementRepository extends CoreRepository
{
    protected function getModelClass(){
        return Model::class;
    }
    public function getAllWithPaginate($limit){

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
        $result=$this
            ->startConditions()
            ->select($fields)
            ->orderBy('created_at','DESC')
            ->paginate($limit);

        return $result;

    }
    public function getEdit($id){
        return $this->startConditions()->find($id);
    }


}

