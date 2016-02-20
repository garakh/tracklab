<?php

namespace TrackLab\Models;

/**
 * Class Trigger
 * @property string $name
 * @property string $projectId     mongoId project
 * @property string $trigger      class id
 * @property object $handler      class id
 * @property object $data     
 */
class EventTrigger extends ModelBase
{

    /**
     * 
     * @param \TrackLab\Models\Project $project
     * @param type $eventName
     * @return EventTrigger[]
     */
    public static function findByProject(Project $project, $eventName = null)
    {
        if ($eventName !== null)
            return EventTrigger::find(array(array('projectId' => new \MongoId($project->getId()), 'name' => $eventName)));
        else
            return EventTrigger::find(array(array('projectId' => new \MongoId($project->getId()))));
    }

}
