<?php

namespace TrackLab\Controllers;

use TrackLab\Models\PeopleTrigger,
    TrackLab\Models\EventTrigger,
    TrackLab\Models\AppException;

/**
 * @property \TrackLab\Services\TriggerService $triggerService
 * @property \TrackLab\Services\ProjectService $projectService 
 */
class TriggerController extends ControllerBase
{

    public function indexAction()
    {
        
    }

    public function getEventsAction()
    {
        $project = $this->projectService->findByCode($this->get('project'));
        if (!$project)
            throw new AppException("WrongRequest", "Bad project");

        $triggers = $this->triggerService->getEventTriggers($project);

        $triggers = new Models\ArrayResponseView($triggers);
        $this->json($triggers);
    }

    public function getEventAction()
    {
        $id = $this->get('id');
        if (!$id)
            throw new AppException("WrongRequest", "Bad ID");

        $trigger = $this->triggerService->getEventTrigger($id);

        $this->json($trigger);
    }

    public function addEventAction()
    {
        $project = $this->projectService->findByCode($this->get('project'));
        if (!$project)
            throw new AppException("WrongRequest", "Bad project");

        $model = new EventTrigger();
        $model->name = $this->get('name');
        $model->trigger = $this->get('trigger');
        $model->projectId = new \MongoId($project->getId());
        $model->handler = $this->get('handler');
        $model->data = $this->get('data');

        $this->triggerService->saveEvent($model);

        $this->json(true);
    }

    public function editEventAction()
    {
        $id = $this->get('id');
        if (!$id)
            throw new AppException("WrongRequest", "Bad ID");

        $model = $this->triggerService->getEventTrigger($id);

        $model->name = $this->get('name');
        $model->trigger = $this->get('trigger');
        $model->handler = $this->get('handler');
        $model->data = $this->get('data');

        $this->triggerService->saveEvent($model);

        $this->json(true);
    }

    public function deleteEventAction()
    {
        $id = $this->get('id');
        if (!$id)
            throw new AppException("WrongRequest", "Bad ID");

        $this->triggerService->deleteEvent($id);

        $this->json(true);
    }

    
    /** ==== PEOPLE =====  **/
    
    public function getPeoplesAction()
    {
        $project = $this->projectService->findByCode($this->get('project'));
        if (!$project)
            throw new AppException("WrongRequest", "Bad project");

        $triggers = $this->triggerService->getPeopleTriggers($project);

        $triggers = new Models\ArrayResponseView($triggers);
        $this->json($triggers);
    }

    public function getPeopleAction()
    {
        $id = $this->get('id');
        if (!$id)
            throw new AppException("WrongRequest", "Bad ID");

        $trigger = $this->triggerService->getPeopleTrigger($id);

        $this->json($trigger);
    }

    public function addPeopleAction()
    {
        $project = $this->projectService->findByCode($this->get('project'));
        if (!$project)
            throw new AppException("WrongRequest", "Bad project");

        $model = new PeopleTrigger();
        $model->name = $this->get('name');
        $model->trigger = $this->get('trigger');
        $model->projectId = new \MongoId($project->getId());
        $model->handler = $this->get('handler');
        $model->data = $this->get('data');

        $this->triggerService->savePeople($model);

        $this->json(true);
    }

    public function editPeopleAction()
    {
        $id = $this->get('id');
        if (!$id)
            throw new AppException("WrongRequest", "Bad ID");

        $model = $this->triggerService->getPeopleTrigger($id);

        $model->name = $this->get('name');
        $model->trigger = $this->get('trigger');
        $model->handler = $this->get('handler');
        $model->data = $this->get('data');

        $this->triggerService->savePeople($model);

        $this->json(true);
    }

    public function deletePeopleAction()
    {
        $id = $this->get('id');
        if (!$id)
            throw new AppException("WrongRequest", "Bad ID");

        $this->triggerService->deletePeople($id);

        $this->json(true);
    }

}
