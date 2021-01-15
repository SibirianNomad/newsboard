<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\User\BaseController;
use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Repositories\UserRepository;
use Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Cache;

class UserController extends BaseController
{
    private $userRepository;

    public function __construct(){
        parent::__construct();
        $this->userRepository=app(UserRepository::class);
    }
    public function index()
    {

            $user=Auth::user();
            $cities=Announcement::getAllCities();

            return view('user.index',compact('user','cities'));
    }
    public function update(UserUpdateRequest $request,$id)
    {
        $item=$this->userRepository->getEdit($id);

        if(empty($item)){
            return back()->withErrors(['msg'=>"Пользователь id[{$id}] не найден"])->withInput();
        }

        $data=$request->all();
        $photo=$request->file('avatar');

        if($photo!=null && $item){
            $avatarName = $item->id.'_avatar'.time().'.'.$photo->getClientOriginalExtension();
            $this->userRepository->updateAvatar($request,$avatarName,$item);
            $data['avatar']=$avatarName;
        }

        $result=$item->update($data);

        if($result){
            return back()->with(['success'=>'Успешно сохранено']);
        }else{
            return back()->withErrors(['msg'=>"Ошибка сохранения"])->withInput();
        }
    }
    public function destroy($id)
    {

    }


}
