<?php
namespace controllers\api;

abstract class BaseController
{
    private $typeResponse='xml';

    private $availableTypes = array('xml','html','text','json');

    private $data=null;

    const SERVICE_DIR='services';

    public function setTypeRespose($type)
    {
        if(!in_array(strtolower($type),$this->availableTypes)) {
            throw new \InvalidArgumentException('You should use one of these types in response: '.implode(",",$this->availableTypes));
        }

        $this->typeResponse = strtolower($type);
        return $this;
    }

    public function get($serviceName)
    {
        $className = __NAMESPACE__.'\\'.self::SERVICE_DIR.'\\'.strtoupper($serviceName).'Controller';

        if(class_exists($className)) {
            return new $className();
        } else {
            throw new \Exception('Class not found: '.$className);
        }

    }

    public function getTypeResponse()
    {
        return $this->typeResponse;
    }

    public function sendResponse()
    {
        $class = __NAMESPACE__.'\\'.self::SERVICE_DIR.'\\'.strtoupper($this->typeResponse).'Controller';
        $instance = new $class();
        $instance->sendResponse($this->data);
    }

    private function getAppropriateInstance()
    {
        $class = __NAMESPACE__.'\\'.self::SERVICE_DIR.'\\'.strtoupper($this->typeResponse).'Controller';
        if(class_exists($class)) {
            return  new $class();
        }
        return null;
    }

    public function setDataToResponse($data)
    {
        if(is_array($data)) {
            $instance = $this->getAppropriateInstance();
            $convertedData = $instance->convertArray($data);
            $this->data = $convertedData;
        }
        return $this;
    }


}