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
        $segments = PeopleTrigger::findByProject($project);
        foreach ($segments as $segment)
        {
            $triggerName = $segment->trigger;
            $class = "TrackLab\\Trigger\\People\\" . $project->code . "\\$triggerName";
            $trigger = new $class('people_' . $project->code, 'event_' . $project->code, $this->getMongoCollection('people_' . $project->code), $this->getMongoCollection('event_' . $project->code), $this->getDB(), $this->di);


            if ($trigger->check($peopleData) && !$segment->hasPeople($peopleData->getId()))
            {
                $this->runHandler($segment->handler, $segment->data, $peopleData);
                $segment->addPeople($peopleData->getId());
                $segment->save();
            }
        }
    }

    public function processEvent($project, $eventData)
    {
        $triggers = array_merge(
                EventTrigger::findByProject($project, $eventData->name),
                EventTrigger::findByProject($project, false));
        
        
        foreach ($triggers as $tr)
        {
            $triggerName = $tr->trigger;
            $class = "TrackLab\\Trigger\\Event\\" . $project->code . "\\$triggerName";
            $trigger = new $class('people_' . $project->code, 'event_' . $project->code, $this->getMongoCollection('people_' . $project->code), $this->getMongoCollection('event_' . $project->code), $this->getDB(), $this->di);

            if ($trigger->check($eventData))
            {
                $this->runHandler($tr->handler, $tr->data, $eventData);
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
