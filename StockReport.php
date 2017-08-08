<?php

namespace SPSR;


/**
 * Constructs xml body for StockReport API method
 *
 * Class StockReport
 * @package SPSR
 */
class StockReport extends SPSRMethod
{
    /**
     * @var \SimpleXMLElement
     */
    protected $body;


    /**
     * StockReport constructor.
     * @param array $fields
     * @throws SPSR_Exception
     */
    public function __construct(array $fields = [
        'report_date' => '2017-08-08',
    ])
    {
        $keys = ['report_date'];

        if (self::CheckFields($fields, $keys)) {
            $body = new \SimpleXMLElement(file_get_contents(Client::FILE_STOCK_REPORT));

            $body->ReportDate = $fields["report_date"];
            $this->body = $body;
        } else
            throw new SPSR_Exception(SPSR_Exception::KEY_NOT_IN_ARRAY);
    }
}