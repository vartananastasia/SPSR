<?php

namespace SPSR;

use Throwable;


/**
 * if request can not be constructed
 *
 * Class SPSRException
 * @package SPSR
 */
class SPSRException extends \Exception{

    const KEY_NOT_IN_ARRAY = 1;


    public function __construct($code = 0, Throwable $previous = null)
    {
        switch ($code){
            case self::KEY_NOT_IN_ARRAY:
                $message = 'Not all keys provided in array';
                break;
            default:
                $message = 'Unknown SPSR_Exeption';
                break;
        }
        parent::__construct($message, $code, $previous);
    }

    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}