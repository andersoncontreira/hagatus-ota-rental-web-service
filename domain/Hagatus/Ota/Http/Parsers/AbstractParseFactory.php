<?php


namespace Hagatus\Ota\Http\Parsers;


use Hagatus\Ota\Enums\ParserFormatEnum;
use Hagatus\Ota\Exceptions\ParseException;
use Hagatus\Ota\Http\Parsers\Formats\JsonParser;
use Hagatus\Ota\Http\Parsers\Formats\XmlParser;

abstract class AbstractParseFactory
{
    /**
     * @param $type
     * @return AbstractParser
     * @throws ParseException
     */
    public static  function factory($type)
    {
        $parser = null;

        switch ($type) {
            case ParserFormatEnum::XML:
                    $parser = new XmlParser();
                break;
            case ParserFormatEnum::JSON:
                    $parser = new JsonParser();
                break;
            default:
                $message = sprintf('Unable to factory for requested type (%s)', $type);
                throw new ParseException($message);
                break;
        }

        return $parser;

    }
}