<?php

namespace App\Repositories;


use Illuminate\Database\Eloquent\Collection;
use App\Models\Photo as Model;
use App\Models\Photo;
use Intervention\Image\ImageManagerStatic as Image;

class PhotoRepository extends CoreRepository
{
    protected function getModelClass(){
        return Model::class;
    }
    public function getPhoto($id){
        return $this
            ->startConditions()
            ->where('announcement_id',$id)
            ->first();
    }

    public function storePhoto($request,$id,$fileName)
    {
        $request->validate(['file' => 'image|mimes:jpeg,jpg,png|max:10000']);
        $item=$this->getPhoto($id);
        if($item){
            unlink(storage_path('app/public/images/'.$item->file_patch));
            $item->update(['file_patch'=> $fileName]);
        }else{
            $photos=[
                'file_patch'        => $fileName,
                'announcement_id'   => $id
            ];
            (new Photo())->create($photos);
        }
        $request->file->storeAs('public/images',$fileName);

//        $img = Image::make($request->file('file'));
//        $img->resize(320, 240);
//        dd($img);

    }
}

