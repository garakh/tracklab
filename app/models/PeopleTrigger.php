<?php

namespace TrackLab\Models;

/**
 * Class PeopleTrigger
 * @property string $name
 * @property string $projectId     id project
 * @property string $trigger     trigger class name
 * @property object  $handler      handler class name
 * @property object  $data     
 * @property array  $people    
 */
class PeopleTrigger extends ModelBase
{

    public static function findByProject(Project $project)
    {
        return self::find(array(array('projectId' => new \MongoId($project->getId()))));
    }

    /**
     * Check people in segment
     * @param $peopleMongoId
     * @return bool
     */
    public function hasPeople($peopleMongoId)
    {
        return isset($this->people[$peopleMongoId]);
    }

    /**
     * Add people in segment
     * @param $peopleMongoId
     */
    public function addPeople($peopleMongoId)
    {
        $peoples = $this->people;
        $peoples[$peopleMongoId] = array('id' => new \MongoId($peopleMongoId), 'date' => new \MongoDate());
        $this->people = $peoples;
    }

    /**
     * Remove people from segment
     * @param $peopleMongoId
     */
    public function removePeople($peopleMongoId)
    {
        if(isset($this->people[$peopleMongoId]))
            unset($this->people[$peopleMongoId]);
    }

}
