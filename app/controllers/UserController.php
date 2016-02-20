<?php
namespace TrackLab\Controllers;

use TrackLab\Models\Project;
use TrackLab\Models\PeopleCondition;

class UserController extends ControllerBase
{

    public function indexAction()
    {
        echo "hello";
    }

    /**
     * Получение тригерров проектов
     */
    public function getAction()
    {
        $projects_out = array();
        $projects = Project::find(); //array(array('userId' => $currentUser)));

        foreach($projects as $project) {
            $project_for_insert = array(
                'name' => $project->code,
                'code' => $project->code,
            );
            array_push($projects_out, $project_for_insert);
        }

        $this->json($projects_out);
    }
}

