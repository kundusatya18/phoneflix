<?php
namespace App\Repositories;

use App\Contracts\EpisodeContract;
use App\Models\Episode;
use App\Traits\UploadAble;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\UploadedFile;

/**
 * Class EpisodeRepository
 *
 * @package \App\Repositories
 */
class EpisodeRepository extends BaseRepository implements EpisodeContract
{
    use UploadAble;

    /**
     * EpisodeRepository constructor.
     * @param Episode $model
     */
    public function __construct(Episode $model)
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
    public function listEpisodes(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findEpisodeById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Episode|mixed
     */
    public function createEpisode(array $params)
    {
        try {

            $collection = collect($params);

            $Episode = new Episode;

            $Episode->name = $collection['name'];
            $Episode->showId = $collection['showId'];
            $Episode->video = $collection['video'];
            $Episode->type = $collection['type'];

            $Episode->showtime = $collection['showtime'];
            $Episode->description = $collection['description'];
            
            $profile_image = $collection['image'];
            $imageName = time().".".$profile_image->getClientOriginalName();
            $profile_image->move("shows/",$imageName);
            $uploadedImage = $imageName;
            $Episode->image = $uploadedImage;
            
            $Episode->save();

            return $Episode;
            
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateEpisode(array $params)
    {
        $Episode = $this->findOneOrFail($params['id']); 
        $collection = collect($params)->except('_token'); 

        $Episode->name = $collection['name'];
        $Episode->showId = $collection['showId'];
        $Episode->video = $collection['video'];
        $Episode->type = $collection['type'];
        $Episode->showtime = $collection['showtime'];
        $Episode->description = $collection['description'];
        
        $profile_image = $collection['image'];
        $imageName = time().".".$profile_image->getClientOriginalName();
        $profile_image->move("shows/",$imageName);
        $uploadedImage = $imageName;
        $Episode->image = $uploadedImage;

        $Episode->save();

        return $Episode;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteEpisode($id)
    {
        $Episode = $this->findOneOrFail($id);
        $Episode->delete();
        return $Episode;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateEpisodeStatus(array $params){
        $Episode = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $Episode->is_active = $collection['check_status'];
        $Episode->save();

        return $Episode;
    }
    
    /**
     * @return mixed
    */
    public function showEpisodes(){
        return Episode::where("is_active","1")->get();
    }
}