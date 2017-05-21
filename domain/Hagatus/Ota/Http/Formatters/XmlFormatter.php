<?php
/**
 * Created by PhpStorm.
 * User: Anderson
 * Date: 21/05/2017
 * Time: 01:57
 */

namespace Hagatus\Ota\Http\Formatters;


use Hagatus\Ota\Elements\AbstractElement;

class XmlFormatter
{

    public function __construct()
    {

    }

    public function formatter(AbstractElement $element)
    {
        $class = (new \ReflectionClass($element))->getShortName();
        $xmlRootElement = '<' . $class . '/>';


        $xml = new \SimpleXMLElement($xmlRootElement);

        $this->formatAttributes($element, $xml);


        if (count($element->getElements()) > 0) {
            foreach ($element->getElements() as $element) {
                $this->formatElement($element, $xml);

            }
        }

        header('Content-type: text/xml');
        echo($xml->asXML());
        exit();
    }

    /**
     * @param AbstractElement $element
     * @param $xml
     */
    protected function formatAttributes(AbstractElement $element, $xml)
    {
        if (count($element->getAttributes()) > 0) {
            foreach ($element->getAttributes() as $attribute) {
                if (!empty($attribute->getValue())) {
                    $xml->addAttribute($attribute->getName(), $attribute->getValue());
                }
            }
        }
    }


    private function formatElement(AbstractElement $element, \SimpleXMLElement $xml)
    {


        if (count($element->getElements()) > 0 || count($element->getAttributes()) > 0) {
            $class = (new \ReflectionClass($element))->getShortName();
            $childElement = $xml->addChild($class);
            $this->formatAttributes($element, $childElement);

            if (count($element->getElements()) > 0) {
                foreach ($element->getElements() as $childElementItem) {
                    $this->formatElement($childElementItem, $childElement);
                }
            }
        }

    }
}