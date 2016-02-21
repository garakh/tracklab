<?php

namespace TrackLab\Services;

use TrackLab\Models\PeopleTrigger;
use TrackLab\Models\EventTrigger;
use TrackLab\Models\PeopleCondition;
use TrackLab\Models\EventCondition;

class EventService extends ServiceBase
{

    public function save($collectionName, $data)
    {
        $collection = $this->getMongoCollection($collectionName);
        $collection->save($data, array('w' => 1));
    }

    /**
     * @param $project
     * @param $peopleData
     */
    public function processPeople($project, $peopleData)
    {
        echo "people";
        $segments = PeopleTrigger::findByProject($project);
        foreach ($segments as $segment)
        {
            $triggerName = $segment->trigger;
            $class = "TrackLab\\Trigger\\People\\" . $project->code . "\\$triggerName";
            $trigger = new $class('people_' . $project->code, 'event_' . $project->code, $this->getMongoCollection('people_' . $project->code), $this->getMongoCollection('event_' . $project->code), $this->getDB(), $this->di);

            $data = $segment->data;
            if ($trigger->check($peopleData, $data) && !$segment->hasPeople($peopleData->getId()))
            {
                if($segment->handler)
                    $this->runHandler($segment->handler, $data, $peopleData);
                
                $segment->addPeople($peopleData->getId());
                $segment->save();
            }
        }
    }

    public function processEvent($project, $eventData)
    {
        echo "event";
        
        $triggers = EventTrigger::findByProject($project);
        
        
        foreach ($triggers as $tr)
        {
            $triggerName = $tr->trigger;
            echo $triggerName;
            $class = "TrackLab\\Trigger\\Event\\" . $project->code . "\\$triggerName";
            $trigger = new $class('people_' . $project->code, 'event_' . $project->code, $this->getMongoCollection('people_' . $project->code), $this->getMongoCollection('event_' . $project->code), $this->getDB(), $this->di);

            $data = $tr->data;
            if ($trigger->check($eventData, $data))
            {
                if($tr->handler)
                    $this->runHandler($tr->handler, $data, $eventData);
            }
        }
    }

    public function runHandler($type, $settings, $data)
    {
        $class = "TrackLab\\Handler\\$type";
        $handler = new $class($this->di);
        $handler->run($settings, $data);
    }

}
