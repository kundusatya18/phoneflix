<?php
namespace App\Repositories;

use App\Models\Trailer;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\TrailerContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class TrailerRepository
 *
 * @package \App\Repositories
 */
class TrailerRepository extends BaseRepository implements TrailerContract
{
    use UploadAble;

    /**
     * TrailerRepository constructor.
     * @param Trailer $model
     */
    public function __construct(Trailer $model)
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
    public function listTrailers(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findTrailerById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Trailer|mixed
     */
    public function createTrailer(array $params)
    {
        try {

            $collection = collect($params);

            $Trailer = new Trailer;
            $Trailer->movieName = $collection['movieName'];
            $Trailer->trailerName = $collection['trailerName'];
            

            $profile_image = $collection['image'];
            $imageName = time().".".$profile_image->getClientOriginalName();
            $profile_image->move("shows/",$imageName);
            $uploadedImage = $imageName;
            $Trailer->image = $uploadedImage;
            
            $Trailer->save();

            return $Trailer;
            
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateTrailer(array $params)
    {
        $Trailer = $this->findOneOrFail($params['id']); 
        $collection = collect($params)->except('_token'); 

        $Trailer->movieName = $collection['movieName'];
        $Trailer->trailerName = $collection['trailerName'];
        
        $profile_image = $collection['image'];
        $imageName = time().".".$profile_image->getClientOriginalName();
        $profile_image->move("shows/",$imageName);
        $uploadedImage = $imageName;
        $Trailer->image = $uploadedImage;

        $Trailer->save();

        return $Trailer;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteTrailer($id)
    {
        $Trailer = $this->findOneOrFail($id);
        $Trailer->delete();
        return $Trailer;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateTrailerStatus(array $params){
        $Trailer = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $Trailer->is_active = $collection['check_status'];
        $Trailer->save();

        return $Trailer;
    }
    
    /**
     * @return mixed
    */
    public function showTrailers(){
        return Trailer::where("is_active","1")->get();
    }
}