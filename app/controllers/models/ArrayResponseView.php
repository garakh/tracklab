<?php
namespace TrackLab\Controllers\Models;

use TrackLab\Models\AppException;

/**
 * Description of ResponseView
 *
 * @author garakh
 */
class ArrayResponseView extends ResponseView
{


    public $response = true;

    /**
     * @param null $input
     */
    public function __construct($input = null)
    {
        if ($input === null)
            return;

        if ($input instanceof AppException)
        {
            parent::__construct($input);
            return;
        }

        if ($input instanceof Exception)
        {
            parent::__construct($input);
            return;
        }

        if (!is_array($input))
        {
            parent::__construct($input);
            return;
        }

        foreach ($input as $key => $value)
        {
            $input[$key] = $this->findView($value);
        }

        $this->response = $input;
    }
}
