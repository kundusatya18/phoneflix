<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\GenreContract;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class GenreController extends BaseController
{
    /**
     * @var GenreContract
     */
    protected $genreRepository;


    /**
     * PageController constructor.
     * @param GenreContract $genreRepository
     */
    public function __construct(GenreContract $genreRepository)
    {
        $this->genreRepository = $genreRepository;
        
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index()
    {
        $genres = $this->genreRepository->listGenres();

        $this->setPageTitle('Genre', 'List of all Genres');
        return view('admin.genre.index', compact('genres'));
    }
    
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('Genre', 'Create Genre');
        return view('admin.genre.create');
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
        
        $genre = $this->genreRepository->createGenre($params);

        if (!$genre) {
            return $this->responseRedirectBack('Error occurred while creating genre.', 'error', true, true);
        }
        return $this->responseRedirect('admin.genres.index', 'Genre added successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $targetGenre = $this->genreRepository->findGenreById($id);
        
        $this->setPageTitle('Genre', 'Edit Genre : '.$targetGenre->title);
        return view('admin.genre.edit', compact('targetGenre'));
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

        $genre = $this->genreRepository->updateGenre($params);

        if (!$genre) {
            return $this->responseRedirectBack('Error occurred while updating genre.', 'error', true, true);
        }
        return $this->responseRedirectBack('Banner updated successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $genre = $this->genreRepository->deleteGenre($id);

        if (!$genre) {
            return $this->responseRedirectBack('Error occurred while deleting genre.', 'error', true, true);
        }
        return $this->responseRedirect('admin.genres.index', 'Banner deleted successfully' ,'success',false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request){

        $params = $request->except('_token');

        $genre = $this->genreRepository->updateGenreStatus($params);

        if ($genre) {
            return response()->json(array('message'=>'Genre status successfully updated'));
        }
    }
}
