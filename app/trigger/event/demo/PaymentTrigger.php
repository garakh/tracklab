<?php

namespace TrackLab\Trigger\Event\Demo;

use TrackLab\Trigger\Event\Base;

class PaymentTrigger extends Base
{

    public function check($event, &$settings)
    {
        $s = json_decode($settings);
        if (!$s)
            return false;

        if ($event->name == 'payment')
        {
            $s->injectedData = 'some data';
            $settings = json_encode($s);
            
            file_put_contents(__DIR__ . '/../../../../public/PaymentTriggerLog.txt', json_encode($settings), FILE_APPEND | LOCK_EX);
            
            return true;
        }

        return false;
    }

}
