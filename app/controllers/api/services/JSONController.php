<?php

namespace controllers\api\services;

use controllers\api\interfaces\ApiInterface;

class JSONController implements ApiInterface
{
    public function sendResponse($response=null)
    {
        echo $response;
    }

    public function convertArray($data)
    {
        if(is_array($data)) {
           return json_encode($data);
        }
    }
}