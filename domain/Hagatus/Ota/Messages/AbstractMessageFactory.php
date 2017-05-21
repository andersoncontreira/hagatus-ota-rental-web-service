<?php
/**
 * Created by PhpStorm.
 * User: anderson
 * Date: 20/05/17
 * Time: 21:55
 */

namespace Hagatus\Ota\Messages;



use Hagatus\Ota\Providers\MessageProvider;

abstract class AbstractMessageFactory
{
    
    public static function factory($otaMessageType)
    {
        $provider = new MessageProvider();

        $messageClass = $provider->get($otaMessageType);

        return $messageClass;
    }
}