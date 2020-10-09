<?php

namespace App\Http\Controllers\Admin;

use App\Models\Show;
use App\Models\Language;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Contracts\WebseriesContract;
use App\Contracts\CategoryContract;
use App\Contracts\LanguageContract;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class WebseriesController extends BaseController
{
    /**
     * @var WebseriesContract
     * @var CategoryContract
     * @var LanguageContract
     */
    protected $webseriesRepository;
    protected $categoryRepository;
    protected $languageRepository;

    /**
     * WebseriesController constructor.
     * @param WebseriesContract $webseriesRepository
     * @param CategoryContract $categoryRepository
     * @param LanguageContract $languageRepository
     */
    public function __construct(WebseriesContract $webseriesRepository,CategoryContract $categoryRepository,LanguageContract $languageRepository)
    {
        $this->webseriesRepository = $webseriesRepository;
        $this->categoryRepository = $categoryRepository;
        $this->languageRepository = $languageRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index()
    {
        $webseries = Show::select("shows.*","categories.name as category_name","languages.name as language_name")
                     ->leftjoin("categories", "categories.id", "=", "shows.category_id")
                     ->leftjoin("languages", "languages.id", "=", "shows.language_id")
                     ->orderBy('id', 'DESC')
                     ->where('category_id',3)
                     ->get(); 

        $this->setPageTitle('Webseries', 'List of all webseries');
        return view('admin.webseries.index', compact('webseries'));
    }
    
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $category = $this->categoryRepository->listCategories();
        $language = $this->languageRepository->listLanguages();
        $this->setPageTitle('Webseries', 'Create webseries');
        return view('admin.webseries.create',compact('category','language'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'      =>  'required',
            'category_id'      =>  'required',
            'language_id'      =>  'required',
            'slug'      =>  'required',
            'image1'     =>  'required',
            'image2'     =>  'required',
            'description'     =>  'required',
            'year_of_release'     =>  'required',
            'show_time'     =>  'required',
            'age_group'     =>  'required',
            'director'     =>  'required',
            'starrring'     =>  'required',
            'video_file'     =>  'required',
            'trailer_video_file'     =>  'required',
        ]);

        $params = $request->except('_token');
        
        $webseries = $this->webseriesRepository->createWebseries($params);

        if (!$webseries) {
            return $this->responseRedirectBack('Error occurred while creating webseries.', 'error', true, true);
        }
        return $this->responseRedirect('admin.webseries.create', 'Webseries added successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $targetwebseries = $this->webseriesRepository->findWebseriesById($id);

        $category = $this->categoryRepository->listCategories();
        $language = $this->languageRepository->listLanguages();
        
        $this->setPageTitle('Webseries', 'Edit Webseries : '.$targetwebseries->title);
        return view('admin.webseries.edit', compact('targetwebseries','category','language'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'title'      =>  'required',
            'category_id'      =>  'required',
            'language_id'      =>  'required',
            'slug'      =>  'required',
            'description'     =>  'required',
            'year_of_release'     =>  'required',
            'show_time'     =>  'required',
            'age_group'     =>  'required',
            'director'     =>  'required',
            'starrring'     =>  'required',
            'video_file'     =>  'required',
            'trailer_video_file'     =>  'required',
        ]);

        $params = $request->except('_token');

        $webseries = $this->webseriesRepository->updateWebseries($params);

        if (!$webseries) {
            return $this->responseRedirectBack('Error occurred while updating webseries.', 'error', true, true);
        }
        return $this->responseRedirectBack('Webseries updated successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $webseries = $this->webseriesRepository->deleteWebseries($id);

        if (!$webseries) {
            return $this->responseRedirectBack('Error occurred while deleting webseries.', 'error', true, true);
        }
        return $this->responseRedirect('admin.webseries.index', 'Webseries deleted successfully' ,'success',false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request){

        $params = $request->except('_token');

        $webseries = $this->webseriesRepository->updateWebseriesStatus($params);

        if ($webseries) {
            return response()->json(array('message'=>'webseries status successfully updated'));
        }
    }
}
