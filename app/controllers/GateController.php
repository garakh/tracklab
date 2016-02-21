<?php

namespace TrackLab\Controllers;

use TrackLab\Models\AppException;

class GateController extends ControllerBase
{

    public function indexAction()
    {

            /* only post data */
            if (!$this->request->isPost())
            {
                throw new AppException("WrongRequest", "Use POST");
            }
            
            $request1 = $this->request->get();
            $request2 = $this->getRequestData(true);
            $request = count($request1) > count($request2) ? $request1 : $request2;
            
            /* require data */
            if (
                    !array_key_exists('email', $request) ||
                    !array_key_exists('project', $request) ||
                    !array_key_exists('type', $request)
            )
            {
                throw new AppException("WrongRequest", "Data absent");
            }

            /* check secret */
            if ($this->config->app->secret && $request['secret'] != $this->config->app->secret)
            {
                throw new AppException("WrongRequest", "Bad secret");
            }

            
            $this->gateService->process($request);



            /* echo */
            $this->json(true);

    }

}
