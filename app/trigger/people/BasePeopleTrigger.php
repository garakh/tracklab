<?php
namespace TrackLab\Trigger\People;


class BasePeopleTrigger {
    public function __construct($peopleColName, $eventColName, $peoples, $events, $db, $di) {
        $this->peopleColName = $peopleColName;
        $this->eventColName = $eventColName;
        $this->peoples = $peoples;
        $this->events = $events;
        $this->db = $db;
        $this->di = $di;
    }
}