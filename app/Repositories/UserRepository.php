<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

use App\Models\User as Model;
use Auth;
use Intervention\Image\ImageManagerStatic as Image;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Google\Cloud\Firestore\FirestoreClient;


class UserRepository extends CoreRepository
{

    protected function getModelClass(){
        return Model::class;
    }

    public function getEdit($id){
        return $this->startConditions()->find($id);
    }
    public function updateAvatar($request,$avatarName,$user){
        $request->validate(['avatar' => 'image|mimes:jpeg,png,jpg|max:3000',]);
        $user = Auth::user();
        if($user->avatar!=null){
            unlink(storage_path('app/public/avatars/'.$user->avatar));
        }
        $request->avatar->storeAs('public/avatars',$avatarName);
        $user->avatar = $avatarName;
        $user->save();
    }
}

