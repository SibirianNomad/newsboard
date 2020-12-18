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

    public function index()
    {
        $paginator=$this->announcementRepository->getAllWithPaginate(6);
        $categories=$this->categoryRepository->getAllCategory();

        return view('announcement.index',compact('paginator','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
