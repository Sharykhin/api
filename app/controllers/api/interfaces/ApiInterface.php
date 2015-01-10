<?php

namespace controllers\api\interfaces;

interface ApiInterface
{
    public function sendResponse();

    public function convertArray($data);
}