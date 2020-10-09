<?php
namespace App\Repositories;

use App\Models\Show;
use App\Models\UserPayPerClicks;
use App\Models\UserTransaction;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\WebseriesContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class WebseriesRepository
 *
 * @package \App\Repositories
 */
class WebseriesRepository extends BaseRepository implements WebseriesContract
{
    use UploadAble;

    /**
     * WebseriesRepository constructor.
     * @param Show $model
     */
    
    public function __construct(Show $model)
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
    public function listWebseries(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findWebseriesById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Show|mixed
     */
    public function createWebseries(array $params)
    {
        try {
            $collection = collect($params);

            $Webseries = new Show;
            $Webseries->category_id = $collection['category_id'];
            $Webseries->language_id = $collection['language_id'];
            $Webseries->title = $collection['title'];

            $Webseries->slug = $collection['slug'];
            $Webseries->description = $collection['description'];
            $Webseries->year_of_release = $collection['year_of_release'];
            $Webseries->show_time = $collection['show_time'];
            $Webseries->age_group = $collection['age_group'];
            $Webseries->director = $collection['director'];

            $Webseries->video_file = $collection['video_file'];
            $Webseries->trailer_video_file = $collection['trailer_video_file'];
            
            $Webseries->starrring = $collection['starrring'];
            
            
            $Webseries->metakey = $collection['metakey'];
            $Webseries->metadescription = $collection['metadescription'];

            $profile_image = $collection['image1'];
            $imageName = time().".".$profile_image->getClientOriginalName();
            $profile_image->move("shows/",$imageName);
            $uploadedImage = $imageName;
            $Webseries->image1 = $uploadedImage;

            $profile_image1 = $collection['image2'];
            $imageName1 = time().".".$profile_image1->getClientOriginalName();
            $profile_image1->move("shows/",$imageName1);
            $uploadedImage1 = $imageName1;
            $Webseries->image2 = $uploadedImage1;

            $Webseries->save();

            return $Webseries;
            
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateWebseries(array $params)
    {
        $Webseries = $this->findOneOrFail($params['id']); 
        $collection = collect($params)->except('_token'); 

        $Webseries->category_id = $collection['category_id'];
        $Webseries->language_id = $collection['language_id'];
        $Webseries->title = $collection['title'];

        $Webseries->slug = $collection['slug'];
        $Webseries->description = $collection['description'];
        $Webseries->year_of_release = $collection['year_of_release'];
        $Webseries->show_time = $collection['show_time'];
        $Webseries->age_group = $collection['age_group'];
        $Webseries->director = $collection['director'];

        $Webseries->video_file = $collection['video_file'];
        $Webseries->trailer_video_file = $collection['trailer_video_file'];
        
        $Webseries->starrring = $collection['starrring'];
        
        $Webseries->metakey = $collection['metakey'];
        $Webseries->metadescription = $collection['metadescription'];

        // $profile_image = $collection['image1'];
        // $imageName = time().".".$profile_image->getClientOriginalName();
        // $profile_image->move("shows/",$imageName);
        // $uploadedImage = $imageName;
        // $Show->image1 = $uploadedImage;

        // $profile_image1 = $collection['image2'];
        // $imageName1 = time().".".$profile_image1->getClientOriginalName();
        // $profile_image1->move("shows/",$imageName1);
        // $uploadedImage1 = $imageName1;
        // $Show->image2 = $uploadedImage1;

        $Webseries->save();

        return $Webseries;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteWebseries($id)
    {
        $Webseries = $this->findOneOrFail($id);
        $Webseries->delete();
        return $Webseries;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateWebseriesStatus(array $params){
        $Webseries = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $Webseries->status = $collection['check_status'];
        $Webseries->save();

        return $Webseries;
    }
}