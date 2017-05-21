<?php
/**
 * Created by PhpStorm.
 * User: anderson
 * Date: 20/05/17
 * Time: 17:11
 */

namespace Hagatus\Ota\Elements;


use Hagatus\Ota\Attributes\DateTimeAttribute;

class VehRentalCore extends AbstractElement
{

    public function __construct(){
        $this->addAttribute(new DateTimeAttribute('PickUpDateTime'));
        $this->addAttribute(new DateTimeAttribute('ReturnDateTime'));

        $this->addElement(new PickUpLocation());
        $this->addElement(new ReturnLocation());

    }
}