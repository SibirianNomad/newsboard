<?php

namespace App\Http\Controllers\Announcement;

use App\Http\Controllers\Announcement\BaseController;
use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\User;
use App\Models\Photo;
use App\Repositories\AnnouncementRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\PhotoRepository;
use Auth;
use App\Http\Requests\AnnouncementCreateRequest;
use App\Http\Requests\AnnouncementUpdateRequest;

class AnnouncementController extends BaseController
{
    private $announcementRepository;
    private $categoryRepository;
    private $photoRepository;

    public function __construct(){
        parent::__construct();
        $this->announcementRepository=app(AnnouncementRepository::class);
        $this->categoryRepository=app(CategoryRepository::class);
        $this->photoRepository=app(PhotoRepository::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $paginator=$this->announcementRepository->getAllWithPaginate(20,$request);
        $categories=$this->categoryRepository->getAllCategory();
        $cities=Announcement::getAllCities();

        return view('announcement.index',compact('paginator','categories','cities'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user=Auth::user();
        if($user==null){
            return redirect('/login');
        }
        $userId=$user->id;
        $item=new Announcement();

        $title='Добавить';
        $categories=$this->categoryRepository->getAllCategory();
        $cities=Announcement::getAllCities();

        return view('announcement.edit_page',compact('title','categories','cities','item','userId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnnouncementCreateRequest $request)
    {
        $data=$request->only(['title','category_id','description','city','price','user_id']);
        $data['status']=1;

        $photo=$request->file('file');

        $item=(new Announcement())->create($data);

        if($photo!=null && $item){
            $fileName = $item->id.'_images'.time().'.'.$photo->getClientOriginalExtension();
            $this->photoRepository->storePhoto($request,$item->id,$fileName);
        }
        if($item){
            return redirect('/announcements/'.$data['user_id'])
                ->with(['success'=>'Объявление успешно сохранено']);
        }else{
            return back()->withErrors(['msg'=>"Ошибка сохранения"])->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item=$this->announcementRepository->getAnnouncement($id);

        if(empty($item) || $item->status==0){
            abort(404);
        }
        $number=$this->announcementRepository->getAllAnnouncements($item->user_id);

        return view('announcement.announcement_page',compact('item','number'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=Auth::user();
        if($user==null){
            return redirect('/login');
        }
        $userId=$user->id;
        $item=$this->announcementRepository->getAnnouncement($id);

        if(empty($item) || $item->status==0){
            abort(404);
        }
        $title='Изменить';
        $categories=$this->categoryRepository->getAllCategory();
        $cities=Announcement::getAllCities();

        return view('announcement.edit_page',compact('title','categories','cities','item','userId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AnnouncementUpdateRequest $request, $id)
    {
        $item=$this->announcementRepository->getAnnouncement($id);

        if(empty($item)){
            return back()->withErrors(['msg'=>"Объявление id[{$id}] не найдено"])->withInput();
        }

        $data=$request->only(['title','category_id','description','city','price','user_id']);

        $result=$item->update($data);

        $photo=$request->file('file');
        if($photo!=null && $item){
            $fileName = $item->id.'_images'.time().'.'.$photo->getClientOriginalExtension();
            $this->photoRepository->storePhoto($request,$item->id,$fileName);
        }

        if($result){
            return redirect('/announcements/'.$data['user_id'])
                ->with(['success'=>'Объявление успешно изменено']);
        }else{
            return back()->withErrors(['msg'=>"Ошибка сохранения"])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item=$this->announcementRepository->getAnnouncement($id);

        if(empty($item)){
            abort(404);
        }
        $result=$item->update(['status'=>0]);

        if($result){
            return redirect('/announcements/'.Auth::user()->id)
                ->with(['success'=>"Объявление успешно снято с публикации"]);
        }else{
            return back()->withErrors(['msg'=>"Ошибка смены статуса объявления"]);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Announcements of one user with $id
     */

    public function user_announcements(Request $request,$id)
    {
        $paginator=$this->announcementRepository->getAllWithPaginate(20,$request,$id);
        $categories=$this->categoryRepository->getAllCategory();
        $status=$request->input('status');
        return view('announcement.announcements_user',compact('paginator','categories','status'));
    }

}
