<?php
/**
 * Created by PhpStorm.
 * User: Anderson
 * Date: 20/05/2017
 * Time: 23:42
 */

namespace Hagatus\Ota\Providers;


use Closure;
use Hagatus\Ota\Exceptions\MessageException;
use Hagatus\Ota\Messages\OTA_VehAvailRateRQ;

class MessageProvider
{

    public function __construct()
    {
        $this->register();
    }

    /**
     * @var array
     */
    protected $container = [];

    public function register()
    {
        $this->add($this->getClassNameOnly(OTA_VehAvailRateRQ::class), function(){
            return new OTA_VehAvailRateRQ();
        });
    }

    public function add($name, $callback)
    {
        $this->container[$name] = $callback;
    }

    public function get($name)
    {

        if (array_key_exists($name, $this->container)) {
            $item = $this->container[$name];

            $instance = null;

            if (is_string($item) && class_exists($item)) {
                $instance = new $item();
            } else if (is_object($item) && ($item instanceof Closure)) {
                $instance = $item();
            } else {
                throw new \InvalidArgumentException('Unsupported type of container item.');
            }

            return $instance;
        } else {
            throw new MessageException('Unsupported OTA message type.');
        }
    }

    /**
     * @return string
     */
    public function getMessagePrefix()
    {
        return $this->messagePrefix;
    }

    /**
     * @param string $messagePrefix
     */
    public function setMessagePrefix($messagePrefix)
    {
        $this->messagePrefix = $messagePrefix;
    }

    private function getClassNameOnly($class)
    {
        $className = (new \ReflectionClass($class))->getShortName();
        return $className;
    }
}