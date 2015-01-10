<?php

namespace controllers\api\services;

use controllers\api\interfaces\ApiInterface;
use controllers\api\libs\XmlDomConstructor;

class XMLController implements ApiInterface
{
    public function sendResponse($response=null)
    {
        echo $response;
    }

    public function convertArray($array)
    {

        $array2XmlConverter  = new XmlDomConstructor('1.0', 'utf-8');
        $array2XmlConverter->xmlStandalone   = TRUE;
        $array2XmlConverter->formatOutput    = TRUE;

        try {
            $array2XmlConverter->fromMixed( $array );
            $array2XmlConverter->normalizeDocument ();
            $xml    = $array2XmlConverter->saveXML();
//        echo "\n\n-----vvv start returned xml vvv-----\n";
//        print_r( $xml );
//        echo "\n------^^^ end returned xml ^^^----\n"
            return  $xml;
        }
        catch( \Exception $ex )  {
//        echo "\n\n-----vvv Rut-roh Raggy! vvv-----\n";
//        print_r( $ex->getCode() );     echo "\n";
//        print_r( $->getMessage() );
//        var_dump( $ex );
//        echo "\n------^^^ end Rut-roh Raggy! ^^^----\n"
            return  $ex;
        }
    }

}
