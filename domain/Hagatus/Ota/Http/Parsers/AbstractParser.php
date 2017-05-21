<?php


namespace Hagatus\Ota\Http\Parsers;

use Hagatus\Ota\Elements\AbstractElement;

abstract class AbstractParser
{
    /**
     * @param $string
     * @return AbstractMessage
     * @throws ParseException
     */
    public abstract function parse($string);

    public abstract function populate(AbstractElement $message, $data);
}