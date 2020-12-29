<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

use App\Models\User as Model;
use Auth;

class UserRepository extends CoreRepository
{

    protected function getModelClass(){
        return Model::class;
    }

    public function getEdit($id){
        return $this->startConditions()->find($id);
    }
    public function updateAvatar($request){
        $request->validate(['avatar' => 'required|image|mimes:jpeg,png,jpg|max:3000',]);

        $user = Auth::user();
        $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();

        $request->avatar->storeAs('public/avatars',$avatarName);

        $user->avatar = $avatarName;
        $user->save();
    }
}

