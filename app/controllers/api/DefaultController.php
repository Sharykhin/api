<?php
namespace controllers\api;


class DefaultController extends BaseController
{
    public function indexAction()
    {
        $arr = array('items'=>array(
                array('value'=>4),
                array('value'=>12321),
                array('value'=>12),
        ));
        
        $this->setDataToResponse($arr);
        $this->sendResponse();
    }
}