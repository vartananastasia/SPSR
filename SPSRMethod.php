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
            if (!array_key_exists($key, $fields))
                $correct_arr = False;
        }

        # if items in array
        if ($correct_arr) {
            foreach ($item_keys as $item_key) {
                foreach ($fields['items'] as $item) {
                    if (!array_key_exists($item_key, $item)) {
                        $correct_arr = False;
                        break;
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
}