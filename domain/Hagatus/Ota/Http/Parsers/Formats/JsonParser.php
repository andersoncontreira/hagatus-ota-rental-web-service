<?php
/**
 * Created by PhpStorm.
 * User: anderson
 * Date: 20/05/17
 * Time: 16:47
 */

namespace Hagatus\Ota\Http\Parsers\Formats;



use Hagatus\Http\Parsers\AbstractParser;
use Hagatus\Ota\Elements\AbstractElement;

class JsonParser extends AbstractParser
{

    public function parse($string)
    {
        // TODO: Implement parse() method.
        throw new \RuntimeException('Not implemented yet');
    }


    public function populate(AbstractElement $message, $data)
    {
        // TODO: Implement populate() method.
    }
}