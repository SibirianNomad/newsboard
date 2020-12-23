<?php

namespace App\Http\Controllers\Announcement;

use App\Http\Controllers\Announcement\BaseController;
use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Repositories\AnnouncementRepository;
use App\Repositories\CategoryRepository;

class AnnouncementController extends BaseController
{
    private $announcementRepository;
    private $categoryRepository;

    public function __construct(){
        parent::__construct();
        $this->announcementRepository=app(AnnouncementRepository::class);
        $this->categoryRepository=app(CategoryRepository::class);
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
        $cities=$this->announcementRepository->getAllCities();

        return view('announcement.index',compact('paginator','categories','cities'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd(__METHOD__);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

        if(empty($item)){
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
        dd(__METHOD__);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
