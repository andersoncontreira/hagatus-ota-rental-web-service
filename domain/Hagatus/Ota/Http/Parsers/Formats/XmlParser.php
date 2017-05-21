<?php
/**
 * Created by PhpStorm.
 * User: anderson
 * Date: 20/05/17
 * Time: 16:46
 */

namespace Hagatus\Ota\Http\Parsers\Formats;


use Hagatus\Ota\Exceptions\ParseException;
use Hagatus\Ota\Http\Parsers\AbstractParser;
use Hagatus\Ota\Elements\AbstractElement;
use Hagatus\Ota\Messages\AbstractMessage;
use Hagatus\Ota\Messages\AbstractMessageFactory;

class XmlParser extends AbstractParser
{
    /**
     * @param $string
     * @return AbstractMessage
     * @throws ParseException
     * @throws \Exception
     * @throws \MessageException
     */
    public function parse($string)
    {

        $xmlData = new \SimpleXMLElement($string);

        $otaMessageType = $xmlData->getName();

        try {
            $otaMessageObject = AbstractMessageFactory::factory($otaMessageType);
        } catch(\MessageException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw new ParseException('Unable to parse the XML ('.$e->getMessage().')');
        }

        $this->populate($otaMessageObject, $xmlData);

        return $otaMessageObject;
    }

    /**
     * @param AbstractElement $element
     * @param \SimpleXMLElement $xmlData
     */
    public function populate(AbstractElement $element, $xmlData)
    {
        $this->parseAttributes($element, $xmlData);

        $elementName = $xmlData->getName();

        /**
         * TODO tem de fazer a leitura com base no xml e validar com a estrutura do objeto, para poder tratar as repeticoes
         */
        if (count($element->getElements()) > 0) {
            foreach ($element->getElements() as $childElement) {

                $childElementName = (new \ReflectionClass($childElement))->getShortName();

                $xpath = '/' . $elementName . '/' . $childElementName;

                /** @var \SimpleXMLElement[] $childElementData */
                $childElementData = $xmlData->xpath($xpath);

                /**
                 * If not find passing the current element, try to call only the children
                 */
                if (empty($childElementData)) {
                    $childElementData = $xmlData->xpath($childElementName);
                }

                //var_dump($childElementName, $xpath,'$childElementData',$childElementData, $xmlData);
                if (!empty($childElementData)) {

                    if (is_array($childElementData)) {
                        foreach ($childElementData as $childElementDataItem) {
                            //$this->recursiveElementPopulate($childElement, $childElementDataItem);
                            $this->populate($childElement, $childElementDataItem);
                        }
                    }
                }

            }
        }

    }

    /**
     * @param AbstractElement $element
     * @param \SimpleXMLElement $xmlData
     */
    public function parseAttributes(AbstractElement $element, $xmlData)
    {

        if ($xmlData->attributes()->count() > 0) {
            $attributes = (array)$xmlData->attributes();
            $xmlAttributes = $attributes['@attributes'];

            if (count($element->getAttributes()) > 0) {
                foreach ($element->getAttributes() as $attribute) {

                    if (array_key_exists($attribute->getName(), $xmlAttributes)) {
                        $value = $xmlAttributes[$attribute->getName()];

                        if (!empty($value)) {
                            $attribute->setValue($value);
                        }

                    }

                }
            }
        }
    }

}