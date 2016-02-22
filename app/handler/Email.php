<?php

namespace TrackLab\Handler;

use TrackLab\Models\Mail;

class Email
{

    private $di;

    public function __construct($di)
    {
        $this->di = $di;
    }

    public function run($settings, $data)
    {
        file_put_contents(__DIR__ . '/../../public/EmailLog.txt', json_encode(array($settings, $data)), FILE_APPEND | LOCK_EX);
    }

}
