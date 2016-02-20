<?php

namespace TrackLab\Services;

use TrackLab\Models\Event,
    TrackLab\Models\People,
    TrackLab\Models\Project,
    TrackLab\Models\EntityModel,
    TrackLab\Models\AppException;

/**
 * @property PeopleService $peopleService 
 * @property EventService $eventService 
 * @property ProjectService $projectService
 */
class GateService extends ServiceBase
{

    public function process($request)
    {
        if ($request['type'] == "event")
            $this->processEvent($request);
        else
            $this->processPeople($request);
    }

    private function getPeopleId($email, $project)
    {
        $collection = 'people_' . $project;
        $people = $this->peopleService->findFirst($collection, array('email' => $email));
        if($people)
            return $people['_id'];
        
        $people = new People();
        $people->email = $email;
        $people->project = $project;
        
        $this->peopleService->saveModel($people);
        return $people->getId();
                
                
    }

    private function processEvent($request)
    {
        $eventData = isset($request['data']) ? json_decode($request['data']) : array();

        $project = $this->projectService->checkProject($request['project']);
        $peopleId = $this->getPeopleId($request['email'], $request['project']);

        /* create new event */
        $event = new EntityModel();

        $event->peopleId = new \MongoId($peopleId);
        $event->name = $request['name'];
        $event->_date = new \MongoDate();

        foreach ($eventData as $key => $value)
        {
            $event->$key = $value;
        }
        $this->eventService->save('event_' . $request['project'], $event);

        $this->eventService->processEvent($project, $event);
    }

    private function processPeople($request)
    {
        $peopleData = isset($request['data']) ? json_decode($request['data']) : array();
        $project = $this->projectService->checkProject($request['project']);
        $peopleId = $this->getPeopleId($request['email'], $request['project']);

        $peopleObj = new EntityModel();
        $peopleObj->setId($peopleId);
        $peopleObj->email = $request['email'];
        $peopleObj->_date = new \MongoDate();

        foreach ($peopleData as $key => $value)
        {
            $peopleObj->$key = $value;
        }
        $this->peopleService->save('people_' . $request['project'], $peopleObj);

        $this->eventService->processPeople($project, $peopleObj);
    }

}
