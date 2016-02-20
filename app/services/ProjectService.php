<?php

namespace TrackLab\Services;

use TrackLab\Models\Event,
    TrackLab\Models\People,
    TrackLab\Models\Project,
    TrackLab\Models\EntityModel,
    TrackLab\Models\AppException;

class ProjectService extends ServiceBase
{

    /**
     * 
     * @param type $code
     * @return Project
     */
    public function findByCode($code)
    {
        return Project::findFirst(array(array('code' => $code)));
    }
    
    /**
     * 
     * @param string $code
     * @return Project
     */
    public function checkProject($code)
    {
        if(!$code)
            return false;
        
        $project = Project::findFirst(array(array(
            'code' => $code
        )));
        
        if(!$project)
        {
            $project = new Project();
            $project->code = $code;
            $this->save($project);
                    
        }
        
        return $project;
                
    }

    
    public function save(Project $project)
    {
        $project->save();
    }
}
