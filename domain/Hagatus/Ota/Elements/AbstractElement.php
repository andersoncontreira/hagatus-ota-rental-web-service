<?php

namespace Hagatus\Ota\Elements;


use Hagatus\Ota\Http\Formatters\XmlFormatter;
use Hagatus\Ota\Attributes\AbstractAttribute;

abstract class AbstractElement
{
    /**
     * @var AbstractAttribute[]
     */
    protected $attributes;

    /**
     * @var AbstractElement[]
     */
    protected $elements;


    public function addAttribute(AbstractAttribute $attribute) {
        $this->attributes[] = $attribute;
    }

    public function addElement(AbstractElement $element) {
        $this->elements[] = $element;
    }

    public function toJson()
    {

    }

    public function toXml()
    {
        $xmlFormatter = new XmlFormatter();
        return $xmlFormatter->formatter($this);

    }

    /**
     * @return \Hagatus\Ota\Attributes\AbstractAttribute[]
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param \Hagatus\Ota\Attributes\AbstractAttribute[] $attributes
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * @return \Hagatus\Ota\Elements\AbstractElement[]
     */
    public function getElements()
    {
        return $this->elements;
    }

    /**
     * @param \Hagatus\Ota\Elements\AbstractElement[] $elements
     */
    public function setElements($elements)
    {
        $this->elements = $elements;
    }
}