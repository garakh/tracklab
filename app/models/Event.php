<?php

namespace TrackLab\Models;

/**
 * Class Event
 * @property    String email
 * @property    String project
 */
class Event extends ModelBase
{

    public function getSource()
    {
        return "event_" . $this->project;
    }

    public function beforeSave()
    {
        unset($this->project);
    }

}
