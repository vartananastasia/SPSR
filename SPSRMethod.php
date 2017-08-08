<?php

namespace SPSR;


/**
 * Class SPSRMethod
 * @package SPSR
 */
abstract class SPSRMethod
{
    /**
     * @var \SimpleXMLElement
     */
    protected $body;


    /**
     * @param array $fields
     * @param array $keys
     * @param array $item_keys
     * @return bool
     */
    protected function CheckFields(array $fields, array $keys = [], array $item_keys = [])
    {
        $correct_arr = True;

        foreach ($keys as $key) {
            if (!array_key_exists($key, $fields)) {
                $correct_arr = False;
                break;
            }
            if (substr_count($key, 'date')) {
                self::DateValidate($fields[$key]);
            }
        }

        # if items in array
        if ($correct_arr) {
            foreach ($item_keys as $item_key) {
                foreach ($fields['items'] as $item) {
                    if (!array_key_exists($item_key, $item)) {
                        $correct_arr = False;
                        break;
                    }
                    if (substr_count($item_key, 'date')) {
                        self::DateValidate($item[$item_key]);
                    }
                }
            }
        }
        return $correct_arr;
    }


    /**
     * @return \SimpleXMLElement
     */
    public function GetBody()
    {
        return $this->body;
    }


    /**
     * @param $date
     * @throws SPSR_Exception
     */
    private function DateValidate($date)
    {
        if (!preg_match('/[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])/', $date))
            throw new SPSR_Exception(SPSR_Exception::INCORRECT_DATE);
    }
}