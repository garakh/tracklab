<?php
namespace TrackLab\Handler;

use TrackLab\Models\Mail;

class Email {

    public function run($handlerData) {
//        Mail::
        file_put_contents('emailLog.txt', json_encode($handlerData), FILE_APPEND | LOCK_EX);
    }

} 