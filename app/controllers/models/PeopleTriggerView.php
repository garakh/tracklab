<?php
namespace TrackLab\Controllers\Models;

use TrackLab\Models\PeopleTrigger;

class PeopleTriggerView
{
    
    function __construct(PeopleTrigger $model)
    {
        $props = array('name', 'trigger', 'handler', 'data');
        
        foreach($props as $p)
            $this->$p = $model->$p;
        
        $this->id = $model->getId();
    }
}