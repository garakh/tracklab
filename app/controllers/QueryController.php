<?php

namespace TrackLab\Controllers;

use TrackLab\Models\AppException;

/**
 * @property \TrackLab\Services\QueryService $queryService
 */
class QueryController extends ControllerBase
{

    public function indexAction()
    {
        
    }

    public function queryEventsAction()
    {
        $project = $this->projectService->findByCode($this->get('project'));
        if (!$project)
            throw new AppException("WrongRequest", "Bad project");

        $query = $this->get('query');
        $query = $query ? json_decode($query, true) : null;

        $sort = $this->get('sort');
        $sort = $sort ? json_decode($sort, true) : null;

        $limit = $this->get('limit');
        $limit = $limit ? (int) $limit : 100;

        $type = $this->get('type');
        $type = $type ? $type : 'query';

        $result = $this->queryService->queryEvents($type, $project, $query, $sort, $limit);

        $this->json($result);
    }

    public function queryPeopleAction()
    {
        $project = $this->projectService->findByCode($this->get('project'));
        if (!$project)
            throw new AppException("WrongRequest", "Bad project");

        $query = $this->get('query');
        $query = $query ? json_decode($query, true) : null;

        $sort = $this->get('sort');
        $sort = $sort ? json_decode($sort, true) : null;

        $limit = $this->get('limit');
        $limit = $limit ? (int) $limit : 100;

        $type = $this->get('type');
        $type = $type ? $type : 'query';

        $result = $this->queryService->queryPeople($type, $project, $query, $sort, $limit);

        $this->json($result);
    }

}
