<?php

namespace Hagatus\Ota\Http\Request;

use Hagatus\Ota\Enums\ContentTypeEnum;
use Hagatus\Ota\Enums\ParserFormatEnum;
use Hagatus\Ota\Exceptions\ParseException;
use Hagatus\Ota\Http\Parsers\AbstractParseFactory;
use Illuminate\Http\Request;

class RequestParserService
{

    public function __construct()
    {

    }

    /**
     * @param Request $request
     * @return \Hagatus\Ota\Messages\AbstractMessage
     * @throws ParseException
     * @throws \Hagatus\Ota\Exceptions\ParseException
     */
    public function parse(Request $request)
    {

        $contentType = $request->headers->get('content-type');
            
        if (preg_match($this->getRegExpPattern(ContentTypeEnum::XML), $contentType)) {
            $parseFormat = ParserFormatEnum::XML;
        } elseif (preg_match($this->getRegExpPattern(ContentTypeEnum::JSON), $contentType)) {
            $parseFormat = ParserFormatEnum::JSON;
        } else {
            throw new ParseException('Unsupported format wait for (XML or JSON)'); 
        }

        $parser = AbstractParseFactory::factory($parseFormat);
        
        return $parser->parse($request->getContent());
    }

    /**
     * @param $textToMatch
     * @return string
     */
    public function getRegExpPattern($textToMatch)
    {
        $pattern = '#({type})#';
        $pattern = str_replace('{type}', $textToMatch, $pattern);

        return $pattern;
    }
}