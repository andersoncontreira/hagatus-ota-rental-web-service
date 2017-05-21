<?php
/**
 * Created by PhpStorm.
 * User: anderson
 * Date: 20/05/17
 * Time: 17:11
 */

namespace Hagatus\Ota\Elements;


use Hagatus\Ota\Attributes\StringAttribute;

class RequestorID extends AbstractElement
{

    public function __construct(){
        $this->addAttribute(new StringAttribute('Type'));
        $this->addAttribute(new StringAttribute('ID'));
        $this->addAttribute(new StringAttribute('MessagePassword'));
    }
}