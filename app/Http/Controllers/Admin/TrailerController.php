<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\TrailerContract;
use App\Contracts\GenreContract;
use App\Contracts\CategoryContract;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class TrailerController extends BaseController
{
    /**
     * @var TrailerContract
     */
    protected $trailerRepository;

    /**
     * PageController constructor.
     * @param TrailerContract $trailerRepository
     * 
     */
     
    public function __construct(TrailerContract $trailerRepository)
    {
        $this->trailerRepository = $trailerRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index()
    {
        $trailer = $this->trailerRepository->listTrailers();

        $this->setPageTitle('Trailer', 'List of all trailer');
        return view('admin.trailer.index', compact('trailer'));
    }
    
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('Trailer', 'Create Trailer');
        return view('admin.trailer.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'movieName'      =>  'required',
            'image'     =>  'required',
            'trailerName'     =>  'required|max:1000',
        ]);

        $params = $request->except('_token');
        
        $triler = $this->trailerRepository->createTrailer($params);

        if (!$triler) {
            return $this->responseRedirectBack('Error occurred while creating triler.', 'error', true, true);
        }
        return $this->responseRedirect('admin.trailer.index', 'Trailer added successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $targetTrailer = $this->trailerRepository->findTrailerById($id);
        
        $this->setPageTitle('Trailer', 'Edit Trailer : '.$targetTrailer->movieName);
        return view('admin.trailer.edit', compact('targetTrailer'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'movieName'      =>  'required',
            'image'     =>  'required',
            'trailerName'     =>  'required|max:1000',
        ]);

        $params = $request->except('_token');
        
        $trailer = $this->trailerRepository->updateTrailer($params);

        if (!$trailer) {
            return $this->responseRedirectBack('Error occurred while updating trailer.', 'error', true, true);
        }
        return $this->responseRedirectBack('Trailer updated successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $trailer = $this->trailerRepository->deleteTrailer($id);

        if (!$trailer) {
            return $this->responseRedirectBack('Error occurred while deleting trailer.', 'error', true, true);
        }
        return $this->responseRedirect('admin.trailer.index', 'Trailer deleted successfully' ,'success',false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request){

        $params = $request->except('_token');

        $trailer = $this->trailerRepository->updateTrailerStatus($params);

        if ($trailer) {
            return response()->json(array('message'=>'Trailer status successfully updated'));
        }
    }
}
