<?php

namespace TrackLab\Controllers;

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{

    protected function json($input)
    {
        if (!($input instanceof Models\ResponseView || $input instanceof Models\ArrayResponseView))
        {
            $input = new Models\ResponseView($input);
        }

        $response = new \Phalcon\Http\Response();
        $response->setHeader("Content-Type", "application/json; charset=UTF-8");
        $response->setContent(json_encode($input));
        
        if($input->response !== false)
            $response->setStatusCode(200, "OK");
        else
            $response->setStatusCode(400, "ERROR");
        
        $response->send();
        //$this->view->disable();
    }

    /**
     * Получение данных из запроса (post, get)
     * @param $param
     * @return mixed
     */
    public function get($param)
    {
        $data = json_decode(file_get_contents("php://input"));
        return isset($data->$param) ? $data->$param : null;
    }

    /**
     * Получить все данные что пришли
     * @return mixed
     */
    public function getRequestData()
    {
        return json_decode(file_get_contents("php://input"));
    }

    public function replaceId($el)
    {
        if (is_array($el))
        {
            foreach ($el as $key => $e)
            {
                $el[$key] = $this->replaceId($e);
            }
            return $el;
        }
        if (gettype($el) == "object")
        {
            $id = $el->getId();
            $el->id = $id;
            unset($el->_id);
        }
        return $el;
    }

}
