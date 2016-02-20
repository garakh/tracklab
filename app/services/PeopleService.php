<?php

namespace TrackLab\Services;

use TrackLab\Models\Event,
    TrackLab\Models\People,
    TrackLab\Models\Project,
    TrackLab\Models\EntityModel,
    TrackLab\Models\AppException;

class PeopleService extends ServiceBase
{

    public function save($collectionName, $people)
    {
        $collection = $this->getMongoCollection($collectionName);
        $collection->save($people, array('w' => 1));
    }
    
    
    public function saveModel(People $model)
    {
        $model->save();
    }
}
