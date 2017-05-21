<?php
/**
 * Created by PhpStorm.
 * User: anderson
 * Date: 20/05/17
 * Time: 17:11
 */

namespace Hagatus\Ota\Elements;


class POS extends AbstractElement
{

    public function __construct() {
        $this->addElement(new Source());
    }
}