<?php
namespace TrackLab\Controllers\Models;

use TrackLab\Models\AppException;

/**
 * Description of ResponseView
 *
 * @author garakh
 */
class ResponseView
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
            $this->response = false;
            $this->error = $input->getError();
            $this->errorMessage = $input->getMessage();
        }
        else if ($input instanceof Exception)
        {
            $this->response = false;
	    $this->error = $input->getMessage();
            $this->errorMessage = $input->getMessage();
        }
        else
        {
            $input = $this->findView($input);

            $this->response = $input;
        }
    }

    protected function findView($input)
    {
        if (is_object($input))
        {
            $ns = get_class($input);
            $ns = explode('\\', $ns);
            $class = end($ns);
            $classview = 'TrackLab\\Controllers\\Models\\'. $class . 'View';
            if (class_exists($classview))
            {
                $args = func_get_args();
                array_shift($args);
                $input = new $classview($input, $args);
            }
        }
        
        $input = $this->proccesCommonObject($input);
        
        return $input;
    }

    private function proccesCommonObject($item)
    {
        if (is_object($item))
        {
            if (isset($item->_id) && isset($item->_id->{'$id'}))
            {
                if (!isset($item->id))
                {
                    $item->id = $item->_id->{'$id'};
                }

                unset($item->_id);
            }
        }
        elseif (is_array($item))
        {
            if (isset($item['_id']) && isset($item['_id']->{'$id'}))
            {
                if (!isset($item['id']))
                {
                    $item['id'] = $item['_id']->{'$id'};
                }

                unset($item['_id']);
            }
        }

        return $item;
    }

}
