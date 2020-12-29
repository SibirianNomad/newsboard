<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\User\BaseController;
use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Repositories\UserRepository;
use Auth;
use Illuminate\Support\Facades\Storage;


class UserController extends BaseController
{
    private $userRepository;

    public function __construct(){
        parent::__construct();
        $this->userRepository=app(UserRepository::class);
    }
    public function index()
    {
        if(Auth::user()==null){
            return redirect('/login');
        }else{
            $user=Auth::user();
            $cities=Announcement::getAllCities();

            return view('user.index',compact('user','cities'));
        }
    }
    public function update(Request $request,$id)
    {

        $item=$this->userRepository->getEdit($id);

        if(empty($item)){
            return back()->withErrors(['msg'=>"Пользователь id[{$id}] не найден"])->withInput();
        }
        $data=$request->all();

        $result=$item->update($data);

        if($result){
            return back()->with(['success'=>'Успешно сохранено']);
        }else{
            return back()->withErrors(['msg'=>"Ошибка сохранения"])->withInput();
        }
    }
    public function destroy($id)
    {
        $idUser=Auth::user()->id;

        if($idUser==$id){
            $item=$this->userRepository->getEdit($id);
            if(empty($item)){
                return back()->withErrors(['msg'=>"Пользователь id[{$id}] не найден"])->withInput();
            }

            Storage::delete('public/avatars/'.Auth::user()->avatar);
            $result=$item->update(['avatar'=>null]);

            if($result){
                return back()->with(['success'=>'Автарка удалена']);
            }else{
                return back()->withErrors(['msg'=>"Ошибка, аватар не удален"])->withInput();
            }
        }
    }
    public function update_avatar(Request $request)
    {

        $this->userRepository->updateAvatar($request);
        return back()->with('success','Ваше изображение удачно загружено');
    }


}
