<?php

namespace TrackLab\Events;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SomeListener
 *
 * @author garakh
 */
class SomeListener
{

    //put your code here
    public function enableListeners()
    {
        $self = $this;

        $this->eventsManager->attach('someEvent', function($event, $component, $data) use ($self)
        {
            $self->someEventHandler();
        });
    }

}
