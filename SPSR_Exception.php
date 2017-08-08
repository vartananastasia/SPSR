<?php

namespace SPSR;

use Throwable;


/**
 * if request can not be constructed
 *
 * Class SPSR_Exception
 * @package SPSR
 */
class SPSR_Exception extends \Exception{

    const KEY_NOT_IN_ARRAY = 1;
    const INCORRECT_DATE = 2;


    public function __construct($code = 0, Throwable $previous = null)
    {
        switch ($code){
            case self::KEY_NOT_IN_ARRAY:
                $message = 'Not all keys provided in array';
                break;
            case self::INCORRECT_DATE:
                $message = 'Incorrect date. Date format must be yyyy-mm-dd';
                break;
            default:
                $message = 'Unknown SPSR_Exception';
                break;
        }
        parent::__construct($message, $code, $previous);
    }

    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}