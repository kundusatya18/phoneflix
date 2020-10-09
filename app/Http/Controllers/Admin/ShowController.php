<?php

namespace App\Http\Controllers\Admin;

use App\Models\Show;
use App\Models\Language;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Contracts\ShowContract;
use App\Contracts\CategoryContract;
use App\Contracts\LanguageContract;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class ShowController extends BaseController
{
    /**
     * @var ShowContract
     * @var CategoryContract
     * @var LanguageContract
     */
    protected $showRepository;
    protected $categoryRepository;
    protected $languageRepository;

    /**
     * PageController constructor.
     * @param ShowContract $showRepository
     * @param CategoryContract $categoryRepository
     * @param LanguageContract $languageRepository
     */
    public function __construct(ShowContract $showRepository,CategoryContract $categoryRepository,LanguageContract $languageRepository)
    {
        $this->showRepository = $showRepository;
        $this->categoryRepository = $categoryRepository;
        $this->languageRepository = $languageRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index()
    {
        $shows = Show::select("shows.*","categories.name as category_name","languages.name as language_name")
                     ->leftjoin("categories", "categories.id", "=", "shows.category_id")
                     ->leftjoin("languages", "languages.id", "=", "shows.language_id")
                     ->orderBy('id', 'DESC')
                     ->where('category_id','!=',3)
                     ->get(); 

        $this->setPageTitle('Show', 'List of all shows');
        return view('admin.show.index', compact('shows'));
    }
    
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $category = Category::where('id',1)->get();
        $language = $this->languageRepository->listLanguages();
        $this->setPageTitle('Show', 'Create Show');
        return view('admin.show.create',compact('category','language'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'      =>  'required|max:191',
            'category_id'      =>  'required',
            'language_id'      =>  'required',
            'slug'      =>  'required|max:191',
            'image1'     =>  'required|mimes:jpg,jpeg,png|max:1000',
            'image2'     =>  'required|mimes:jpg,jpeg,png|max:1000',
            'description'     =>  'required|max:1000',
            'year_of_release'     =>  'required',
            'show_time'     =>  'required',
            'age_group'     =>  'required',
            'director'     =>  'required',
            'starrring'     =>  'required',
            'video_file'     =>  'required',
            'trailer_video_file'     =>  'required',
            'type'     =>  'required'
        ]);

        $params = $request->except('_token');
        
        $show = $this->showRepository->createShow($params);

        if (!$show) {
            return $this->responseRedirectBack('Error occurred while creating show.', 'error', true, true);
        }
        return $this->responseRedirect('admin.show.create', 'Show added successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $targetshow = $this->showRepository->findShowById($id);

        $category = Category::where('id',1)->get();
        $language = $this->languageRepository->listLanguages();
        
        $this->setPageTitle('show', 'Edit show : '.$targetshow->title);
        return view('admin.show.edit', compact('targetshow','category','language'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'title'      =>  'required|max:191',
            'category_id'      =>  'required',
            'language_id'      =>  'required',
            'slug'      =>  'required|max:191',
            'description'     =>  'required|max:1000',
            'year_of_release'     =>  'required',
            'show_time'     =>  'required',
            'age_group'     =>  'required',
            'director'     =>  'required',
            'starrring'     =>  'required',
            'video_file'     =>  'required',
            'trailer_video_file'     =>  'required',
            'type'     =>  'required'
        ]);

        $params = $request->except('_token');

        $show = $this->showRepository->updateShow($params);

        if (!$show) {
            return $this->responseRedirectBack('Error occurred while updating show.', 'error', true, true);
        }
        return $this->responseRedirectBack('Show updated successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $show = $this->showRepository->deleteShow($id);

        if (!$show) {
            return $this->responseRedirectBack('Error occurred while deleting show.', 'error', true, true);
        }
        return $this->responseRedirect('admin.show.index', 'Show deleted successfully' ,'success',false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request){

        $params = $request->except('_token');

        $show = $this->showRepository->updateShowStatus($params);

        if ($show) {
            return response()->json(array('message'=>'Show status successfully updated'));
        }
    }

    public function getPayPerClickSubscriptions(){
        $subscriptions = $this->showRepository->fetchAllPayPerClickSubscriptions();

        $this->setPageTitle('All Pay Per Click Subscriptions', 'List of all pay per click subscriptions');
        return view('admin.show.pay_per_click_subscriptions', compact('subscriptions'));
    }

    public function getTransactionsData(){
        $transactions = $this->showRepository->fetchAllTransactions();

        $this->setPageTitle('All Transactions', 'List of all transactions');
        return view('admin.show.transaction_list', compact('transactions'));
    }
}
