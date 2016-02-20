<?php

namespace TrackLab\Services;

use TrackLab\Models\Project,
    TrackLab\Models\PeopleTrigger,
    TrackLab\Models\EventTrigger,
    TrackLab\Models\AppException;

class TriggerService extends ServiceBase
{

    public function saveEvent(EventTrigger $model)
    {
        $model->save();
    }

    public function deleteEvent($id)
    {
        $model = $this->getEventTrigger($id);
        if ($model)
            $model->delete();
    }

    public function deletePeople($id)
    {
        $model = $this->getPeopleTrigger($id);
        if ($model)
            $model->delete();
    }    
    
    public function savePeople(PeopleTrigger $model)
    {
        $model->save();
    }

    
    /**
     * 
     * @param Project $project
     * @return EventTrigger[]
     */
    public function getEventTriggers(Project $project)
    {
        return EventTrigger::findByProject($project);
    }

    /**
     * 
     * @return EventTrigger
     */
    public function getEventTrigger($id)
    {
        return EventTrigger::findById($id);
    }

    /**
     * 
     * @param Project $project
     * @return PeopleTrigger[]
     */
    public function getPeopleTriggers(Project $project)
    {
        return PeopleTrigger::findByProject($project);
    }

    /**
     * 
     * @return PeopleTrigger
     */
    public function getPeopleTrigger($id)
    {
        return PeopleTrigger::findById($id);
    }    
    
}
