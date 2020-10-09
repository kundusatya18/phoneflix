<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\LanguageContract;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class LanguageController extends BaseController
{
    /**
     * @var LanguageContract
     */
    protected $languageRepository;

    /**
     * PageController constructor.
     * @param LanguageContract $languageRepository
     */
    public function __construct(LanguageContract $languageRepository)
    {
        $this->languageRepository = $languageRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index()
    {
        $languages = $this->languageRepository->listLanguages();

        $this->setPageTitle('Language', 'List of all Languages');
        return view('admin.language.index', compact('languages'));
    }
    
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('Language', 'Create Language');
        return view('admin.language.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'     =>  'required|max:191',
            'slug'     =>  'required|max:191'
        ]);

        $params = $request->except('_token');
        
        $language = $this->languageRepository->createLanguage($params);

        if (!$language) {
            return $this->responseRedirectBack('Error occurred while creating language.', 'error', true, true);
        }
        return $this->responseRedirect('admin.language.index', 'Language added successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $targetLanguage = $this->languageRepository->findLanguageById($id);
        
        $this->setPageTitle('Language', 'Edit Language : '.$targetLanguage->title);
        return view('admin.language.edit', compact('targetLanguage'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name'     =>  'required|max:191',
            'slug'     =>  'required|max:191'
        ]);

        $params = $request->except('_token');

        $language = $this->languageRepository->updateLanguage($params);

        if (!$language) {
            return $this->responseRedirectBack('Error occurred while updating language.', 'error', true, true);
        }
        return $this->responseRedirectBack('Language updated successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $language = $this->languageRepository->deleteLanguage($id);

        if (!$language) {
            return $this->responseRedirectBack('Error occurred while deleting language.', 'error', true, true);
        }
        return $this->responseRedirect('admin.language.index', 'Language deleted successfully' ,'success',false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request){

        $params = $request->except('_token');

        $language = $this->languageRepository->updateLanguageStatus($params);

        if ($language) {
            return response()->json(array('message'=>'language status successfully updated'));
        }
    }
}
