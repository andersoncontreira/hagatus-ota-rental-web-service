<?php
/**
 * Created by PhpStorm.
 * User: Anderson
 * Date: 21/05/2017
 * Time: 00:46
 */

namespace Hagatus\Ota\Attributes;


use Carbon\Carbon;

class TimeStampAttribute extends AbstractAttribute{
    /**
     * ISO 8601
     */
    protected $format = \DateTime::ISO8601;

    public function validate($value) {
        $isValid = true;


        return $isValid;
    }

    public function setValue($value) {
        if ($this->validate($value)) {
            $this->value = $value;
        }
    }
}