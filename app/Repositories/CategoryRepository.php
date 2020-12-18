<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Category as Model;


class CategoryRepository extends CoreRepository
{
    protected function getModelClass(){
        return Model::class;
    }


 public function getAllCategory(){
    $result=$this
        ->startConditions()
        ->select(['id', 'name'])
        ->toBase()
        ->get();

    return $result;
    }
}

