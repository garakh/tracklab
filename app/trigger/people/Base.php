<?php

namespace TrackLab\Trigger\People;

abstract class Base
{

    /**
     *
     * @var string 
     */
    protected $peopleColName;

    /**
     *
     * @var string 
     */
    protected $eventColName;

    /**
     *
     * @var \MongoCollection 
     */
    protected $peoples;

    /**
     *
     * @var \MongoCollection 
     */
    protected $events;

    /**
     *
     * @var \MongoDB 
     */
    protected $db;

    public function __construct($peopleColName, $eventColName, $peoples, $events, $db, $di)
    {
        $this->peopleColName = $peopleColName;
        $this->eventColName  = $eventColName;
        $this->peoples       = $peoples;
        $this->events        = $events;
        $this->db            = $db;
        $this->di            = $di;
    }

    /**
     * @return bool
     */
    abstract public function check($people, &$settings);
}
