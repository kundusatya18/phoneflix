<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\CategoryContract;
use App\Contracts\EpisodeContract;
use App\Contracts\GenreContract;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Show;
use Illuminate\Http\Request;

class EpisodeController extends BaseController
{
    /**
     * @var EpisodeContract
     */
    protected $episodeRepository;

    /**
     * EpisodeController constructor.
     * @param EpisodeContract $episodeRepository
     * 
     */
     
    public function __construct(EpisodeContract $episodeRepository)
    {
        $this->episodeRepository = $episodeRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index()
    {
        $episode = $this->episodeRepository->listEpisodes();

        $this->setPageTitle('Episode', 'List of all episode');
        return view('admin.episode.index', compact('episode'));
    }
    
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $shows = Show::where('category_id',3)->get();

        $this->setPageTitle('Episode', 'Create Episode');
        return view('admin.episode.create',compact('shows'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required',
            'image'     =>  'required',
            'video'     =>  'required',
            'type'     =>  'required',
        ]);

        $params = $request->except('_token');
        
        $episode = $this->episodeRepository->createEpisode($params);

        if (!$episode) {
            return $this->responseRedirectBack('Error occurred while creating episode.', 'error', true, true);
        }
        return $this->responseRedirect('admin.episode.index', 'Episode added successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $targetEpisode = $this->episodeRepository->findEpisodeById($id);

        $shows = Show::where('category_id',3)->get();
        
        $this->setPageTitle('episode', 'Edit episode : '.$targetEpisode->movieName);
        return view('admin.episode.edit', compact('targetEpisode','shows'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            
            'name'      =>  'required',
            'image'     =>  'required',
            'video'     =>  'required',
            'type'     =>  'required',
        ]);

        $params = $request->except('_token');
        
        $episode = $this->episodeRepository->updateEpisode($params);

        if (!$episode) {
            return $this->responseRedirectBack('Error occurred while updating episode.', 'error', true, true);
        }
        return $this->responseRedirectBack('Episode updated successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $episode = $this->episodeRepository->deleteEpisode($id);

        if (!$episode) {
            return $this->responseRedirectBack('Error occurred while deleting episode.', 'error', true, true);
        }
        return $this->responseRedirect('admin.episode.index', 'Episode deleted successfully' ,'success',false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request){

        $params = $request->except('_token');

        $episode = $this->episodeRepository->updateEpisodeStatus($params);

        if ($episode) {
            return response()->json(array('message'=>'Episode status successfully updated'));
        }
    }
}
