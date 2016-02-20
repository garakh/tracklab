<?php

namespace TrackLab\Models;

class AppException extends \Exception
{

    /**
     * Код ошибки
     * @var string
     */
    private $error = null;

    /**
     * Конструктор
     * @param string $error Сообщение об ошибке
     * @param string $message   Код ошибки
     *
     */
    public function __construct($error, $message = '')
    {
        parent::__construct($message);
        $this->error = $error;
    }

    /**
     * Получает код ошибки
     * @return type
     */
    public function getError()
    {
        return $this->error ? $this->error : $this->getMessage();
    }

}
