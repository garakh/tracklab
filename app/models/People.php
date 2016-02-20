<?php

namespace TrackLab\Models;

/**
 * Class People
 * @property    string $email
 * @property    string $project
 */
class People extends ModelBase
{

    public function getSource()
    {
        return "people_" . $this->project;
    }

    public function beforeSave()
    {
        unset($this->project);
    }

}
