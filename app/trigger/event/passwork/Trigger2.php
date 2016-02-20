<?php
namespace TrackLab\Trigger\Event\Passwork;

use TrackLab\Trigger\Event\Base;

class Trigger2 extends Base{

    public function check($event) {
        return true;
    }

}