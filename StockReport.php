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
    private $body;


    /**
     * StockReport constructor.
     * @param array $fields
     * @throws SPSRException
     */
    public function __construct(array $fields = [
        'report_date' => '2010-10-10',
    ])
    {
        $keys = ['report_date'];

        if (self::CheckFields($fields, $keys)) {
            $body = new \SimpleXMLElement(file_get_contents(Client::FILE_STOCK_REPORT));

            $body->ReportDate = $fields["report_date"];
            $this->body = $body;
        } else
            throw new SPSRException(SPSRException::KEY_NOT_IN_ARRAY);
    }
}