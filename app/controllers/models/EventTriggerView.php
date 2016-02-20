<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace TrackLab\Controllers\Models;

use TrackLab\Models\EventTrigger;

class EventTriggerView
{
    
    function __construct(EventTrigger $model)
    {
        $props = array('name', 'trigger', 'handler', 'data');
        
        foreach($props as $p)
            $this->$p = $model->$p;
        
        $this->id = $model->getId();
    }
}