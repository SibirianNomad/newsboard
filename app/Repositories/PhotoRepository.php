<?php

namespace App\Repositories;

use App\Models\Photo;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Photo as Model;


class PhotoRepository extends CoreRepository
{
    protected function getModelClass(){
        return Model::class;
    }

    public function storePhoto($request,$id,$fileName)
    {
        $request->validate(['file' => 'image|mimes:jpeg,jpg,png|max:10000']);
        $request->file->storeAs('public/images',$fileName);
        $photos=[
            'file_patch'        => $fileName,
            'announcement_id'   => $id
        ];
        (new Photo())->create($photos);
    }
}

