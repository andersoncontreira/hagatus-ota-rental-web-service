<?php
/**
 * Created by PhpStorm.
 * User: anderson
 * Date: 20/05/17
 * Time: 17:07
 */

namespace Hagatus\Ota\Messages;



use Hagatus\Ota\Attributes\StringAttribute;
use Hagatus\Ota\Attributes\TimeStampAttribute;
use Hagatus\Ota\Elements\CustomerID;
use Hagatus\Ota\Elements\POS;
use Hagatus\Ota\Elements\VehAvailRQCore;

class OTA_VehAvailRateRQ extends AbstractMessage
{

    public function __construct()
    {
        $this->addAttribute(new StringAttribute('Version'));
        $this->addAttribute(new TimeStampAttribute('TimeStamp'));

        $this->addElement(new CustomerID());
        $this->addElement(new POS());
        $this->addElement(new VehAvailRQCore());
        
    }


}