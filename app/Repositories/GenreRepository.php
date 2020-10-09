<?php
namespace App\Repositories;

use App\Models\Genre;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\GenreContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class GenreRepository
 *
 * @package \App\Repositories
 */
class GenreRepository extends BaseRepository implements GenreContract
{
    use UploadAble;

    /**
     * GenreRepository constructor.
     * @param Genre $model
     */
    public function __construct(Genre $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listGenres(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findGenreById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Genre|mixed
     */
    public function createGenre(array $params)
    {
        try {
            $collection = collect($params);

            $Genre = new Genre;

            $Genre->name = $collection['name'];
            $Genre->slug = $collection['slug'];
            $Genre->metakey = $collection['metakey'];
            $Genre->metadescription = $collection['metadescription'];
            
            $Genre->save();

            return $Genre;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateGenre(array $params)
    {
        $Genre = $this->findOneOrFail($params['id']); 
        $collection = collect($params)->except('_token'); 

        $Genre->name = $collection['name'];
        $Genre->slug = $collection['slug'];
        $Genre->metakey = $collection['metakey'];
        $Genre->metadescription = $collection['metadescription'];

        $Genre->save();

        return $Genre;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteGenre($id)
    {
        $genre = $this->findOneOrFail($id);
        $genre->delete();
        return $genre;
    }

     /**
     * @param array $params
     * @return mixed
     */
    public function updateGenreStatus(array $params){
        $genre = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $genre->status = $collection['check_status'];
        $genre->save();

        return $genre;
    }

    /**
     * @param string $slug
     * @return mixed
     */
    public function getShowsBySlug($slug){
        return Genre::where('slug',$slug)->with('shows')->get();
    }
}