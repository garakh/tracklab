<?php
namespace TrackLab\Trigger\People\Passwork;

use TrackLab\Trigger\People\BasePeopleTrigger;

class Trigger1 extends BasePeopleTrigger{
    public function check($people) {
        return true;
    }
} 