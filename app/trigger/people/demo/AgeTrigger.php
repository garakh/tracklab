<?php

namespace TrackLab\Trigger\People\Demo;

use TrackLab\Trigger\People\Base;

class AgeTrigger extends Base
{

    public function check($people, &$settings)
    {
        $s = json_decode($settings);
        if(!$s)
            return false;
        
        $age = (int)$s->age;
        $peopleAge = (int)$people->age;
        
        file_put_contents(__DIR__ . '/../../../../../public/AgeTriggerLog.txt', json_encode(array($age, $peopleAge)), FILE_APPEND | LOCK_EX);
        
        return $age <= $peopleAge;
    }

}
