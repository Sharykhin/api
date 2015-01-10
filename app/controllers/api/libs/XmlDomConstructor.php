<?php
namespace controllers\api\libs;
/**
 * Extends the DOMDocument to implement personal (utility) methods.
 * - From: http://www.devexp.eu/2009/04/11/php-domdocument-convert-array-to-xml/
 * - `parent::` See http://www.php.net/manual/en/class.domdocument.php
 *
 * @throws   DOMException   http://www.php.net/manual/en/class.domexception.php
 *
 * @author Toni Van de Voorde
 */
class   XmlDomConstructor   extends \DOMDocument {

    /**
     * Constructs elements and texts from an array or string.
     * The array can contain an element's name in the index part
     * and an element's text in the value part.
     *
     * It can also creates an xml with the same element tagName on the same
     * level.
     *
     * ex:
    \verbatim
    <nodes>
    <node>text</node>
    <node>
    <field>hello</field>
    <field>world</field>
    </node>
    </nodes>
    \verbatim
     *
     *
     * Array should then look like:
    \verbatim
    array(
    "nodes" => array(
    "node" => array(
    0 => "text",
    1 => array(
    "field" => array (
    0 => "hello",
    1 => "world",
    ),
    ),
    ),
    ),
    );
    \endverbatim
     *
     * @param mixed $mixed An array or string.
     *
     * @param DOMElement[optional] $domElement Then element
     * from where the array will be construct to.
     *
     */
    public  function    fromMixed($mixed, \DOMElement $domElement = null) {

        $domElement = is_null($domElement) ? $this : $domElement;

        if (is_array($mixed)) {
            foreach( $mixed as $index => $mixedElement ) {

                if ( is_int($index) ) {
                    if ( $index == 0 ) {
                        $node = $domElement;
                    }
                    else {
                        $node = $this->createElement($domElement->tagName);
                        $domElement->parentNode->appendChild($node);
                    }
                }
                else {
                    $node = $this->createElement($index);
                    $domElement->appendChild($node);
                }

                $this->fromMixed($mixedElement, $node);
            }
        }
        else {
            $domElement->appendChild($this->createTextNode($mixed));
        }
    }
} // end of class